<?php

namespace App\Http\Controllers;

use App\Collections\PaymentsCollection;
use App\Http\Requests\PaymentsRequest;
use App\Http\Resources\PaymentsResource;
use App\Models\Payment;
use App\Services\PaymentService;
use Illuminate\Http\Request;

use Stripe\Stripe;
use Stripe\Charge;

class PaymentController extends Controller
{
 
    public function processPayment(Request $request)
    {
       
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'token' => 'required',
        ]);

        try {
            // Set your secret key
            Stripe::setApiKey(env('STRIPE_SECRET'));

            // Create a charge
            $charge = Charge::create([
                'amount' => $request->amount * 100, // Amount in cents
                'currency' => 'usd',
                'source' => $request->token,
                'description' => 'Payment without postal code',
            ]);

            return response()->json(['message' => 'Payment successful!'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
    //==================================================

    protected $PaymentService;
    public function __construct()
    {
        $this->PaymentService = new PaymentService();
    }

    public function index(Request $request)
    {
        $filters = $request->only(['amount', 'payment_method', 'status']);
        $payment = $this->PaymentService->getFilteredPayment($filters);
        return new PaymentsCollection($payment);
    }

    public function show($id)
    {
        $payment = $this->PaymentService->getPaymentById($id);
        return new PaymentsResource($payment);
    }

    public function store(PaymentsRequest $request)
    {
        $payment = $this->PaymentService->createPayment($request->validated());
        return new PaymentsResource($payment);
    }

    public function update(PaymentsRequest $request, $id)
    {
        $payment = $this->PaymentService->getPaymentById($id);
        $updatedPayment = $this->PaymentService->updatePayment($payment, $request->validated());
        return new PaymentsResource($updatedPayment);
    }

    public function destroy($id)
    {
        $payment = $this->PaymentService->getPaymentById($id);
        $this->PaymentService->deletePayment($payment);
        return response()->json(null, 204);
    }
}
