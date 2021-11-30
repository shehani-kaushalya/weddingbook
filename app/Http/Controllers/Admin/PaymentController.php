<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class PaymentController extends Controller
{
    public function index()
    {
        $payments = \App\Payment::orderby('created_at', 'desc')->get();
        return view('admin.payments.index', get_defined_vars());
    }

    public function export(Request $request)
    {
    	$from = $request->from ?? '';
    	$to = $request->to ?? date('Y-m-d').' 23:59:59';

        $payments = \App\Payment::orderby('created_at', 'desc');
    
        if(!empty($from))
        	$payments = $payments->where('created_at', '>=', $from);

        $payments = $payments->where('created_at', '<=', $to);
        $payments = $payments->get();
        // 
        $pdf = \App::make('dompdf.wrapper');
        $pdf->setPaper('a4', 'portrait');

        $data_rows= '';
        foreach($payments as $key => $payment) {
            //
            $data_rows  .= '<tr>
                                <td style="padding: 2px 5px;">'.($key+1).'</td>
                                <td style="padding: 2px 5px;">'.$payment->vendorAddress->name.'</td>
                                <td style="padding: 2px 5px;">'.$payment->description.'</td>
                                <td style="padding: 2px 5px;">'.$payment->created_at.'</td>
                                <td style="padding: 2px 5px;">'.$payment->status().'</td>
                                <td style="padding: 2px 5px;text-align:right;">'.$payment->currency.' '.number_format($payment->amount, 2).'</td>
                            </tr>';
        }

        $html ='<table style="width: 100%;padding: 10px;margin: 0 auto;page-break-inside: auto;">
                    <tr>
                        <td>
                            <img src="'.asset('frontend/svg/weddingbook.png').'" width="110" />
                        </td>
                        <td style="vertical-align: bottom; text-align: right;margin: 0; font-size: 28px;">Payments Report</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align:right;">'.route('home').'</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align:right;">'. ((!empty($from)) ? 'from: '. date('Y-m-d', strtotime($from)) : '')  .' to: '.date('Y-m-d', strtotime($to)).'</td>
                    </tr>
                    
                    <tr><td colspan="2" style="text-align:right;">&nbsp;</td></tr>

                    <tr>
                        <td colspan="2">
                            <table style="width: 100%;">
                                <thead>
                                    <tr>
                                        <td style="padding: 2px 5px;border-bottom: 1px solid;background: #c3c3c3;font-weight: bold;">#</td>
                                        <td style="padding: 2px 5px;border-bottom: 1px solid;background: #c3c3c3;font-weight: bold;">Vendor Name</td>
                                        <td style="padding: 2px 5px;border-bottom: 1px solid;background: #c3c3c3;font-weight: bold;">Description</td>
                                        <td style="padding: 2px 5px;border-bottom: 1px solid;background: #c3c3c3;font-weight: bold;">Date</td>
                                        <td style="padding: 2px 5px;border-bottom: 1px solid;background: #c3c3c3;font-weight: bold;">Status</td>
                                        <td style="padding: 2px 5px;border-bottom: 1px solid;background: #c3c3c3;font-weight: bold;text-align:right;">Amount</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    '.$data_rows.'
                                    <tr><td colspan="6" style="text-align:right;">&nbsp;</td></tr>
	                                <tr>
	                                    <td colspan="6" style="padding: 2px 5px;border-bottom: 1px solid;background: #c3c3c3;text-align:right;font-weight: bold;">LKR '.number_format($payments->sum('amount'), 2).'</td>
	                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>                        
                    <tr><td colspan="2" style="text-align:right;">&nbsp;</td></tr>
                </table>';

        $pdf->loadHTML($html);

        $pdf->download('payments.pdf');
        return $pdf->stream();
    }
}