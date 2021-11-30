<?php

namespace App\Services;

use App\DeliveryReceive;
use App\DeliveryReceiveItem;
use App\DeliveryRequest;
use App\DeliveryRequestItem;
use App\Invoice;
use App\PurchaseRequest;
use App\PurchaseRequestItem;
use App\Purchasing;
use App\PurchasingItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RequestService
{
    // todo: add db transaction with error handling
    public function create($type, $data)
    {
        if ($type == 'dr') {
            $deliveryRequest = new DeliveryRequest();
            $deliveryRequest->customer_id = Auth::user()->id;
            $deliveryRequest->status = DeliveryRequest::PENDING;

            if ($deliveryRequest->save()) {
                foreach ($data[0]['items'] as $da) {

                    $delivery_request_item = new DeliveryRequestItem();
                    $delivery_request_item->reference = $da['reference'];
                    $delivery_request_item->tracking_no = $da['tracking_no'];
                    $delivery_request_item->product_code = $da['product_code'];
                    $delivery_request_item->product_name = $da['product_name'];
                    $delivery_request_item->url = $da['url'];
                    $delivery_request_item->qty = $da['qty'];
                    $delivery_request_item->delivery_method = $da['delivery_method'];
                    $delivery_request_item->price = $da['price'];
                    $delivery_request_item->description = $da['desc'];
                    $delivery_request_item->supplier_id = $da['supplier'];
                    $delivery_request_item->delivery_request_id = $deliveryRequest->id;
                    $delivery_request_item->save();
                }
            }

        } elseif ($type == 'pr') {
            $purchaseRequest = new PurchaseRequest();
            $purchaseRequest->customer_id = Auth::user()->id;
            $purchaseRequest->status = PurchaseRequest::PENDING;

            if ($purchaseRequest->save()) {
                foreach ($data as $da) {
                    foreach ($da['items'] as $item) {
                        $purchase_request_item = new PurchaseRequestItem();
                        $purchase_request_item->supplier_id = $item['supplier'];
                        $purchase_request_item->purchase_request_id = $purchaseRequest->id;
                        $purchase_request_item->product_code = $item['product_code'];
                        $purchase_request_item->product_name = $item['product_name'];
                        $purchase_request_item->product_url = $item['url'];
                        $purchase_request_item->description = $item['desc'];
                        $purchase_request_item->qty = $item['qty'];
                        $purchase_request_item->delivery_method = $item['delivery_method'];
                        $purchase_request_item->customer_amount = $item['price'];
                        $purchase_request_item->amount = $item['price'];
                        $purchase_request_item->save();
                    }
                }
            }
        }

        return $data;

    }

    // todo: redo with a better performance test
    public function update($id, $data)
    {
        $pr = PurchaseRequest::find($id);
        $pr->status = PurchaseRequest::PROCESSING;
        $pr->save();
        foreach ($data as $d) {
            $pri = PurchaseRequestItem::find($d['id']);
            $pri->amount = $d['price'];
            $pri->handling_fee = $d['h_fee'];
            $pri->delivery_cost = $d['d_fee'];
            $pri->delivery_method = $d['d_method'];
            $pri->qty = $d['qty'];
            $pri->tax = $d['tax'];
            $pri->save();
        }
        return $pr;
    }

    public function getCustomerRequest($requestType, $id = null)
    {
        $request = null;
        $where = [
            'customer_id' => Auth::user()->id,
        ];

        if ($id != null) {$where['id'] = $id;}

        if ($requestType == 'pr') {
            $request = PurchaseRequest::where($where)->with('items')->get();

        } elseif ($requestType == 'dr') {
            $request = DeliveryRequest::where($where)->with('items')->get();
        }
        return $request;
    }

    public function getAllRequests($requestType)
    {
        $request = null;
        if ($requestType == 'pr') {
            $request = PurchaseRequest::with(['items', 'customers'])->get();

        } elseif ($requestType == 'dr') {
            $request = DeliveryRequest::with(['items', 'customers'])->get();
        }
        return $request;
    }

    public function getRequestFromId($requestType, $id)
    {
        $request = null;
        DB::enableQueryLog();
        if ($requestType == 'pr') {
            $request = PurchaseRequest::with(['items', 'customers', 'invoices.purchasing'])->with(['invoices' => function ($q) use ($id) {
                $q->where([['reference_id', $id], ['type', Invoice::PR_INVOICE]]);
            }])->where('id', $id)->firstOrFail();
        } elseif ($requestType = 'dr') {
            $request = DeliveryRequest::with(['items', 'customers', 'invoices.purchasing'])->with(['invoices' => function ($q) use ($id) {
                $q->where([['reference_id', $id], ['type', Invoice::DR_INVOICE]]);
            }])->where('id', $id)->firstOrFail();
        }
        /* dd($request,DB::getQueryLog());*/
        return $request;
    }

    public function updateRequestAmount($type, $data, $id)
    {
        if ($type = 'pr') {
            $pr = PurchaseRequest::find($id);
        }
    }

    public function getRequestItemFromId($requestType, $id)
    {
        $item = null;
        if ($requestType == 'pr') {
            $item = PurchaseRequestItem::find($id);
        } elseif ($requestType == 'dr') {
            $item = DeliveryRequestItem::find($id);
        }

        return $item;
    }

    public function createDeliveryReceive($id, $data, $invoice_no)
    {
        $deliveryReceive = new DeliveryReceive();
        $totalCount = 0;
        $msg = "";
        foreach ($data as $item) {
            $inItemQty = self::checkIfItemHasDeliveryReceive($item['id']);
            $requestService = new RequestService();
            $pr_item = $requestService->getRequestItemFromId('dr', $item['id']);
            if ($inItemQty > 0) {
                $countOk = false;
            } else {
                $countOk = true;
            }

            if ($countOk) {
                $totalCount++;
            } else {
                $msg .= "$pr_item->product_code($pr_item->product_name) Item already send to the Delivery receive! <br/>";
            }
        }

        if ($totalCount != count($data)) {
            return [
                'type' => 'error',
                'msg' => $msg,
            ];
        }

        $deliveryReceive->invoice_id = $id;
        $deliveryReceive->invoice_no = $invoice_no;
        $deliveryReceive->user_id = Auth::user()->id;
        $deliveryReceive->status = DeliveryReceive::PROCESSING;
        if ($deliveryReceive->save()) {
            foreach ($data as $da) {
                $deliveryReceive_item = new DeliveryReceiveItem();
                $deliveryReceive_item->delivery_receive_id = $deliveryReceive->id;
                $deliveryReceive_item->invoice_item_id = $da['id'];
                $deliveryReceive_item->status = DeliveryReceiveItem::PENDING;
                $deliveryReceive_item->save();
            }
            return $data;
        }
        return null;
    }

    public function checkIfItemHasDeliveryReceive($id)
    {
        $count = DeliveryReceiveItem::where([['invoice_item_id', '=', $id], ['status', '!=', DeliveryReceiveItem::CANCELED]])->count();
        return $count;
    }

    public function getAllDeliveryReceive()
    {
        $delivery_receive = DeliveryReceive::all();
        return $delivery_receive;
    }

    public function getDeliveryReceiveItems($id)
    {
        $delivery_receive_items = DeliveryReceiveItem::where('delivery_receive_id', $id)->with('invoiceItems.drItems.suppliers')->get();
        return $delivery_receive_items;
    }

    public function updateDeliveryReceiveItems($id, $data, $type = null)
    {
        $deliveryReceive = DeliveryReceive::find($id);
        $references = "";
        $currentRef = "";

        if ($deliveryReceive->status == DeliveryReceive::PENDING) {
            if ($type == 'receiving') {
                return [
                    'type' => 'error',
                    'msg' => 'You cannot complete a Delivery with out completing the invoice',
                ];
            }
        }

        foreach ($data as $key => $item) {
            $purchasing_item = DeliveryReceiveItem::find($item['id']);
            if ($purchasing_item->status == DeliveryReceiveItem::DELIVERED) {
                $purchasing_item->status = DeliveryReceiveItem::COMPLETED;
                $purchasing_item->user_id = Auth::user()->id;
            } elseif ($purchasing_item->status == DeliveryReceiveItem::PENDING) {
                $purchasing_item->status = PurchasingItem::PURCHASED;
                /* $purchasing_item->reference = $item['reference'];*/
                $purchasing_item->user_id = Auth::user()->id;
                /*$purchasing_item->tracking_no = $item['tracking_no'];*/
                $purchasing_item->expected_delivery_date = $item['date'];
/*
if ($currentRef != $item['reference']){
if (count($data) == $key+1){
$references.= $item['reference'];
}else{
$references.= $item['reference'].', ';
}

}
$currentRef = $item['reference'];*/
            } elseif ($purchasing_item->status == PurchasingItem::PURCHASED) {
                $purchasing_item->status = PurchasingItem::DELIVERED;
                $purchasing_item->delivered_date = $item['date'];
                $purchasing_item->user_id = Auth::user()->id;
            }

            $purchasing_item->save();
        }

        $CPurchasing_items = DeliveryReceiveItem::where([['status', PurchasingItem::PENDING], ['delivery_receive_id', $id]])->count();
        if ($CPurchasing_items == 0) {
            $deliveryReceive->status = Purchasing::PURCHASED;
        } else {
            $deliveryReceive->status = Purchasing::PARTIAL_PURCHASED;
        }

        if ($type == 'receiving') {
            if ($deliveryReceive->status == Purchasing::PURCHASED) {
                $deliveryReceive->status = Purchasing::DELIVERED;
            }
        }

        if ($type == null) {
            $deliveryReceive->reference = $references;
        }
        $deliveryReceive->save();
        return $deliveryReceive;
    }

}