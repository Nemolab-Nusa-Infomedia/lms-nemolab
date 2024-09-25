<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Transaction;

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
            // Fetch transaction status from Midtrans API
            $response = $client->request('GET', 'https://api.sandbox.midtrans.com/v2/' . $transaction->transaction_code . '/status', [
                'headers' => [
                    'accept' => 'application/json',
                    'authorization' => 'Basic U0ItTWlkLXNlcnZlci1pNU9GbWpiR1ppSGc5cVBHVmg3MHdHcTI6',
                ],
            ]);

            // Decode the response JSON
            $responseData = json_decode($response->getBody()->getContents(), true);

            // Check if the transaction status is 'expire'
            if ($responseData['transaction_status'] === 'expire') {
                // Update the status of the transaction to 'failed'
                Transaction::where('id', $transaction->id)->update([
                    'status' => 'failed',
                ]);
            }
        }
    }
}
