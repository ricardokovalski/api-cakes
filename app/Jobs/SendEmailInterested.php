<?php

namespace App\Jobs;

use App\Mail\SignatureCompleted;
use App\Models\Cake;
use App\Models\Customer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailInterested implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $cake;

    protected $interested;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Cake $cake, Customer $interested)
    {
        $this->cake = $cake;
        $this->interested = $interested;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new SignatureCompleted($this->cake, $this->interested);
        Mail::to($this->interested->email)->send($email);
    }
}
