<?php

namespace App\Http\Controllers\Admin;

use App\Models\Checkout;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;
use App\Mail\Checkout\Paid;

class CheckoutController extends Controller
{
    public function update(Request $request, Checkout $checkout)
    {
        // ubah status dari wait->success
        $checkout->is_paid = true;
        $checkout->save();
        
        // send eMail ke user
        Mail::to($checkout->User->email)->send(new Paid($checkout));

        $request->session()->flash('success', "Checkout with ID {$checkout->id} has been updated");
        return redirect(route('admin.dashboard'));
    }
}