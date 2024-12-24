<?php

namespace App\Console\Commands;

use App\Models\Transaction;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class UpdateTransactionStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:transaction-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix Transaction Realtime';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $client = new \GuzzleHttp\Client();

        $transactions = Transaction::where('status', 'pending')->get();

        foreach ($transactions as $transaction) {
            // Fetch transaction status dari Midtrans API (route ada di api.php)
            $response = $client->request('GET', 'https://api.sandbox.midtrans.com/v2/' . $transaction->transaction_code . '/status', [
                'headers' => [
                    'accept' => 'application/json',
                    'authorization' => 'Basic U0ItTWlkLXNlcnZlci1pNU9GbWpiR1ppSGc5cVBHVmg3MHdHcTI6',
                ],
            ]);

            // Decode the response JSON
            $responseData = json_decode($response->getBody()->getContents(), true);
            Log::info('Midtrans API Response:', $responseData);

            $status = isset($responseData['transaction_status']) ? $responseData['transaction_status'] : 'failed';

            // Check if the transaction status is 'expire'
            switch ($status) {
                case 'capture':
                case 'settlement':
                    $status = 'success';
                    break;
                case 'pending':
                    $status = 'pending';
                    break;
                case 'deny':
                case 'expire':
                case 'cancel':
                    $status = 'failed';
                    break;
                case 'refund':
                case 'partial_refund':
                    $status = 'refund';
                    break;
                default:
                    $status = 'failed';
                    break;
            }
            
            Transaction::where('id', $transaction->id)->update(['status' => $status,]);
        }
    }
}
