<?php

namespace App\Console\Commands;

use App\Helpers\BlockCypher;
use App\Models\Payment;
use Illuminate\Console\Command;

class PaymentsCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payments:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $limit = env('PAYMENTS_AWAIT_LIMIT_SECONDS');
        $limitDate = date('Y-m-d H:i:s', date('U') - $limit);

        $payments = Payment::where([
            ['created_at', '<', $limitDate],
            ['status', Payment::AWAIT]
        ])
            ->with('currency')
            ->get();

        Payment::where([
            ['created_at', '<', $limitDate],
            ['status', Payment::AWAIT]
        ])
            ->update(['status' => Payment::TIME_EXCEED,
                'payment_forwarding_address' => 'Deleted'
            ]);

        foreach ($payments as $payment){
            app('BlockCypher')->currency = $payment->currency->currency_code;
            app('BlockCypher')->deletePaymentEndpoint($payment->pay_id);
        }

        return 'done';
    }
}
