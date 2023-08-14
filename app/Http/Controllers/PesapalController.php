<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Knox\Pesapal\Facades\Pesapal;

class PesapalController extends Controller
{
    /**
     * Initiates payment
     */
    public function payment()
    {
        $payments = new Payment;
        $payments -> businessid = rand(100, 10000); //Business ID
        $payments -> transactionid = Pesapal::random_reference();
        $payments -> status = 'NEW'; //if user gets to iframe then exits, i prefer to have that as a new/lost transaction, not pending
        $payments -> amount = 10;
        // $payments -> save();

        $details = array(
            'amount' => $payments -> amount,
            'description' => 'Test Transaction',
            'type' => 'MERCHANT',
            'first_name' => 'Fname',
            'last_name' => 'Lname',
            'email' => 'test@test.com',
            'phonenumber' => '254-723232323',
            'reference' => $payments -> transactionid,
            'height'=>'400px',
            'currency' => 'KES'
        );
        
        $iframe = Pesapal::makePayment($details);

        return $iframe;

        return view('payments.business.pesapal', compact('iframe'));
    }

    /**
     * Pesapal confirmation funciton
     */
    public function confirmation($trackingid, $status,$payment_method, $merchant_reference)
    {
        $payments = Payments::where('tracking',$trackingid)->first();
        $payments -> payment_status = $status;
        $payments -> payment_method = $payment_method;
        $payments -> save();
    } 

    public function paymentsuccess($request)
    {
        return "TADA";
    }
}