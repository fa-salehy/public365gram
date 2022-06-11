<?php


namespace App\Http\Controllers;


use App\Models\Payment;
use Evryn\LaravelToman\CallbackRequest;
use Evryn\LaravelToman\Facades\Toman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class PaymentController extends Controller
{
    public function create()
    {
        $auth_user= Auth::user();
        $shoudPay = true;
        $transactions = Payment::where('user_id','=',$auth_user->id)->get();
        if (sizeof($transactions)!=0) {
            foreach ($transactions as $transaction) {
                if ($transaction->reference_id != null) {
                    $shoudPay = false;
                    break;
                }
            }
        }
        
        // dd($transaction);
        return view('create',compact('shoudPay'));
    }

    /**
     * Request a new payment creation and redirect user to the payment URL
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|int',
            'description' => 'nullable|string'
        ]);
        $order_id = rand(1000,9999);
        $newPayment = Toman
            ::orderId('orderId_'.$order_id)
            ->amount($request->amount)
            ->callback(route('payment.callback'))
            ->description($request->description)
            ->request();

        if ($newPayment->failed()) {
            return back()->withErrors($newPayment->message());
        }

        // We should save amount and retrieved transaction id in order to
        // make it possible to verify after callback.
        Payment::create([
            'amount' => $request->amount,
            'transaction_id' => $newPayment->transactionId(),
            'user_id'=>Auth::user()->id,
        ]);

        return $newPayment->pay();
    }

    /**
     * Verify payment callback request to check if the payment was successful or not
     *
     * @param CallbackRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function callback(CallbackRequest $request)
    {
        $payment = Payment::whereTransactionId($request->transactionId())->firstOrFail();

        $verification = $request->amount($payment->amount)->verify();

        if ($verification->failed()) {
            $payment->failed_at = now();
        }

        if ($verification->alreadyVerified()) {
            // In case you haven't saved reference_id on the first verification
            $payment->reference_id = $verification->referenceId();
        }

        if ($verification->successful()) {
            $payment->reference_id = $verification->referenceId();
            $payment->paid_at = now();
        }

        $payment->save();

        return view('show', compact(['payment', 'verification']));
    }
}