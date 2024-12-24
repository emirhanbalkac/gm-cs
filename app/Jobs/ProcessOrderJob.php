<?php

namespace App\Jobs;

use App\Models\Order;
use App\Services\InvoiceService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\SerializesModels;

class ProcessOrderJob implements ShouldQueue
{
    use Queueable, SerializesModels;

    private Order $order;
    private array $data;

    private InvoiceService $invoiceService;

    /**
     * Create a new job instance.
     */
    public function __construct(Order $order, array $data)
    {
        $this->order = $order;
        $this->data = $data;

        $this->invoiceService = new InvoiceService();
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->invoiceService->createInvoice($this->order, $this->data);
    }
}
