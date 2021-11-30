<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class VendorController extends Controller
{
    public function index()
    {
        $vendors = \App\User::orderby('created_at', 'desc')->get();
        return view('admin.vendors.index', get_defined_vars());
    }

    public function show($vendor)
    {
        $vendor = \App\User::findOrFail($vendor);

        $vendorAddress = \App\CustomerAddress::where('cust_id', $vendor->id)->first();
        $packagesPromotion = \App\PackagesPromotion::where('cust_id', $vendor->id)->first();
        $vendorImages = \App\VendorImages::where('vendor_id', $vendor->id)->get();

        return view('admin.vendors.show', get_defined_vars());
    }
    
    public function edit($vendor)
    {
        return view('admin.vendors.edit', get_defined_vars());
    }

    public function delete(Request $request)
    {
        // 
    }
    
    public function approve($vendor, Request $request)
    {
        $vendor = \App\User::findOrFail($vendor);
        $vendor->status = \App\User::APPROVED;
        
        if($vendor->save()) {
            $vendor->notify(new \App\Notifications\VendorProfileApprovedNotification());
        }

        return redirect()->back()->with('success_message', 'Vendor account sucessfully approved');
    }
    
    public function verify($vendor, Request $request)
    {
        $vendor = \App\User::findOrFail($vendor);
        $vendor->verify_status = \App\User::BOTH_VERIFIED;
        
        if($vendor->save()) {
            $vendor->notify(new \App\Notifications\VendorProfileVerifyNotification());
        }

        return redirect()->back()->with('success_message', 'Vendor account sucessfully verified');
    }

    public function activate($vendor, Request $request)
    {
        $vendor = \App\User::findOrFail($vendor);
        $vendor->status = \App\User::ACTIVE;
        
        if($vendor->save()) {
            $vendor->notify(new \App\Notifications\VendorProfileActivateNotification());
        }

        return redirect()->back()->with('success_message', 'Vendor profile published successfully.');
    }
    
    public function deactivate($vendor, Request $request)
    {
        $vendor = \App\User::findOrFail($vendor);
        $vendor->status = \App\User::DE_ACTIVE;
        
        if($vendor->save()) {
            $vendor->notify(new \App\Notifications\VendorProfileDeactivateNotification());
        }

        return redirect()->back()->with('success_message', 'Vendor profile un-published successfully.');
    }

    public function advetiesment()
    {
        $advetiesments = \App\Advertisment::orderBy('status', 'asc')->get();
        return view('admin.vendors.advetiesments', compact('advetiesments'));
    }

    public function advetiesmentApprove($id, Request $request)
    {
        $advetiesment = \App\Advertisment::findOrFail($id);
        if($advetiesment && $advetiesment->is_paid == 1) {
            $advetiesment->status = \App\Advertisment::ACTIVE;

            if($advetiesment->save()) {
                return redirect()->back()->with('success_message', 'Advertisment approved successfully.');
            }
        }

        return redirect()->back()->with('error_message', 'Invalid advertisment or not paid.');
    }

    public function advetiesmentUnpublish($id, Request $request)
    {
        $advetiesment = \App\Advertisment::findOrFail($id);
        if($advetiesment) {
            $advetiesment->status = \App\Advertisment::DE_ACTIVE;

            if($advetiesment->save()) {
                return redirect()->back()->with('success_message', 'Advertisment unpublished successfully.');
            }
        }

        return redirect()->back()->with('error_message', 'Invalid advertisment.');
    }

    public function advetiesmentDelete($id, Request $request)
    {
        $advetiesment = \App\Advertisment::findOrFail($id);
        if($advetiesment) {
            if($advetiesment->delete()) {
                return redirect()->back()->with('success_message', 'Advertisment deleted successfully.');
            }
        }

        return redirect()->back()->with('error_message', 'Invalid advertisment.');
    }

    public function export(Request $request)
    {
        $vendors = \App\User::where('type', \App\User::VENDOR)->orderby('created_at', 'desc')->get();
        // 
        $pdf = \App::make('dompdf.wrapper');
        $pdf->setPaper('a4', 'portrait');

        $data_rows= '';
        foreach($vendors as $key => $vendor) {
            //
            if(!isset($vendor->vendorAddress)){continue;}
            $address =  ($vendor->vendorAddress->address()) ? $vendor->vendorAddress->address() : '' ;
            $address .= ($vendor->vendorAddress->_city) ? ', '.$vendor->vendorAddress->_city->name : '';
            $address .= ($vendor->vendorAddress->_district) ? ', '. $vendor->vendorAddress->_district->name : '';

            $ratings = 0;
            if($vendor->reviews->count() > 0) {
                $ratings = 100 * $vendor->reviews->sum('rating') / ($vendor->reviews->count() * 5);
            }
            // dd($vendor->reviews->sum('rating'), $ratings);

            $data_rows  .= '<tr>
                                <td style="padding: 2px 5px;">'.$vendor->vendorAddress->name.'</td>
                                <td style="padding: 2px 5px;">'.$vendor->email.'</td>
                                <td style="padding: 2px 5px;">'.$vendor->vendorAddress->telephone.'</td>
                                <td style="padding: 2px 5px;">'.$ratings.' %</td>
                                <td style="padding: 2px 5px;text-align:right;">'.$vendor->status().'</td>
                            </tr>';
        }

        $html ='<table style="width: 100%;padding: 10px;margin: 0 auto;page-break-inside: auto;">
                        <tr>
                            <td>
                                <img src="'.asset('frontend/svg/weddingbook.png').'" width="110" />
                            </td>
                            <td style="vertical-align: bottom; text-align: right;margin: 0; font-size: 28px;">Vendors Report</td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align:right;">'.route('home').'</td>
                        </tr>
                        
                        <tr><td colspan="2" style="text-align:right;">&nbsp;</td></tr>

                        <tr>
                            <td colspan="2">
                                <table style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <td style="padding: 2px 5px;border-bottom: 1px solid;background: #c3c3c3;font-weight: bold;">Name</td>
                                            <td style="padding: 2px 5px;border-bottom: 1px solid;background: #c3c3c3;font-weight: bold;">Email</td>
                                            <td style="padding: 2px 5px;border-bottom: 1px solid;background: #c3c3c3;font-weight: bold;">Contact</td>
                                            <td style="padding: 2px 5px;border-bottom: 1px solid;background: #c3c3c3;font-weight: bold;">Ratings</td>
                                            <td style="padding: 2px 5px;border-bottom: 1px solid;background: #c3c3c3;font-weight: bold;text-align:right;">Status</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        '.$data_rows.'
                                    </tbody>
                                </table>
                            </td>
                        </tr>                        
                        <tr><td colspan="2" style="text-align:right;">&nbsp;</td></tr>
                </table>';

        $pdf->loadHTML($html);

        $pdf->download('vendors.pdf');
        return $pdf->stream();
    }
}
