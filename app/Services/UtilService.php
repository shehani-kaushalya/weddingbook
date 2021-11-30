<?php



namespace App\Services;


use App\Product;

class UtilService
{
    public static function getInvoiceItemTotalQty($id)
    {
        $invoiceService = new InvoiceService();
        $qty = $invoiceService->getItemTotalQty($id);
        return $qty;
    }


    public static function getProductImageById($id) {


    	$img =  Product::findOrFail($id)->img;

    	if ($img) {

    		return $img;

			} else {

    		return false;

			}

		}
}