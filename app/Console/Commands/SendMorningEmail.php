<?php

namespace App\Console\Commands;

use App\Mail\GoodMorningMail;
use App\Models\Customer;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendMorningEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-morning-email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send good morning email to customers in post_code 1216 and country Bangladesh';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Customer::where('country_index', 'Bangladesh')
            ->where('post_code_index', '1216')
            ->chunk(200, function ($customers) {
                foreach ($customers as $customer) {
                    Mail::to($customer->email)->queue(new GoodMorningMail($customer));
                }
            });
    }
}
