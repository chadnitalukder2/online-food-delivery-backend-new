<?php

namespace App\Services;

use App\Models\Menu;
use App\Models\Payment;
use GuzzleHttp\Psr7\Request;

class PaymentService
{
    // Get all menus with optional filtering and pagination
    public function getFilteredPayment(array $filters, $perPage = 10)
    {
        $query = Payment::query();

        if (isset($filters['amount'])) {
            $query->where('amount', $filters['amount']);
        }
        if (isset($filters['payment_method'])) {
            $query->where('payment_method', $filters['payment_method']);
        }
        if (isset($filters['status'])) {
            $query->where('status', $filters['status']);
        }
       

        return $query->get();
    }

    public function getPaymentById($id)
    {
        return Payment::findOrFail($id);
    }

    public function createPayment(array $data)
    {
        return Payment::create($data);
    }

    public function updatePayment(Payment $payment, array $data)
    {
        $payment->update($data);
        return $payment;
    }

    public function deletePayment(Payment $payment)
    {
        $payment->delete();
    }
}
