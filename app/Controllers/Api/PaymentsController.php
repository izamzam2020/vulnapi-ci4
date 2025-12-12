<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\PaymentModel;
use App\Models\VehicleModel;
use App\Models\WebhookModel;

/**
 * Payments Controller
 * 
 * VULNERABILITIES:
 * - Price Override: Client can set payment amount
 * - Webhook Forgery: No signature validation
 * - No replay protection on webhooks
 * - IDOR: Can view any payment
 */
class PaymentsController extends BaseController
{
    protected PaymentModel $paymentModel;
    protected VehicleModel $vehicleModel;
    protected WebhookModel $webhookModel;

    public function __construct()
    {
        $this->paymentModel = new PaymentModel();
        $this->vehicleModel = new VehicleModel();
        $this->webhookModel = new WebhookModel();
    }

    /**
     * GET /api/payments
     * 
     * List user's payments (but doesn't properly filter)
     */
    public function index()
    {
        $user = $this->getAuthUser();
        
        // VULNERABILITY: Should filter by user_id, shows all instead
        // Correct: $payments = $this->paymentModel->getByUser($user->user_id);
        $payments = $this->paymentModel->findAll();

        return $this->success([
            'payments' => $payments,
            'count'    => count($payments)
        ]);
    }

    /**
     * GET /api/payments/{id}
     * 
     * VULNERABILITY: IDOR - Can view any payment
     */
    public function show($id = null)
    {
        if (!$id) {
            return $this->error('Payment ID is required', 400);
        }

        // VULNERABILITY: No ownership check
        $payment = $this->paymentModel->getWithDetails((int)$id);

        if (!$payment) {
            return $this->error('Payment not found', 404);
        }

        return $this->success(['payment' => $payment]);
    }

    /**
     * POST /api/payments/checkout
     * 
     * VULNERABILITY: Client can override amount!
     * The payment amount should be calculated server-side from vehicle price.
     */
    public function checkout()
    {
        $user = $this->getAuthUser();
        $json = $this->request->getJSON(true);

        if (!$json) {
            return $this->error('Invalid JSON payload', 400);
        }

        $vehicleId = $json['vehicle_id'] ?? null;
        
        if (!$vehicleId) {
            return $this->error('Vehicle ID is required', 400);
        }

        $vehicle = $this->vehicleModel->find($vehicleId);
        
        if (!$vehicle) {
            return $this->error('Vehicle not found', 404);
        }

        // VULNERABILITY: Client can override amount!
        // Should be: $amount = $vehicle['price'];
        // Instead, we accept client-provided amount:
        $amount = $json['amount'] ?? $vehicle['price'];

        // Create payment with potentially manipulated amount
        $paymentData = [
            'vehicle_id' => $vehicleId,
            'user_id'    => $user->user_id,
            'amount'     => $amount, // VULNERABILITY!
            'status'     => 'pending'
        ];

        $paymentId = $this->paymentModel->insert($paymentData);

        if (!$paymentId) {
            return $this->error('Failed to create payment', 500);
        }

        $payment = $this->paymentModel->find($paymentId);

        return $this->success([
            'payment'         => $payment,
            'original_price'  => $vehicle['price'],
            'charged_amount'  => $amount,
            'message'         => 'Payment initiated successfully'
        ], 201);
    }

    /**
     * POST /api/payments/webhook
     * 
     * VULNERABILITIES:
     * - No signature validation
     * - No replay protection
     * - Accepts any payload
     * - Can forge payment status updates
     */
    public function webhook()
    {
        $json = $this->request->getJSON(true);

        if (!$json) {
            return $this->error('Invalid webhook payload', 400);
        }

        // VULNERABILITY: No signature validation!
        // Should verify: hash_equals($expectedSignature, $providedSignature)
        
        // VULNERABILITY: No replay protection!
        // Should check: Has this webhook ID been processed before?

        // Log the webhook (for forensics)
        $this->webhookModel->insert([
            'event_name'  => $json['event'] ?? 'unknown',
            'raw_payload' => json_encode($json),
            'created_at'  => date('Y-m-d H:i:s')
        ]);

        // Process payment update based on webhook
        $paymentId = $json['payment_id'] ?? null;
        $status = $json['status'] ?? null;

        if ($paymentId && $status) {
            // VULNERABILITY: Blindly trusts webhook data
            $this->paymentModel->update($paymentId, ['status' => $status]);
            
            return $this->success([
                'message'    => 'Webhook processed',
                'payment_id' => $paymentId,
                'new_status' => $status
            ]);
        }

        return $this->success(['message' => 'Webhook received']);
    }
}

