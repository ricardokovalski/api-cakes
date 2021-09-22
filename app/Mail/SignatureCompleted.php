<?php

namespace App\Mail;

use App\Models\Cake;
use App\Models\Customer;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SignatureCompleted extends Mailable
{
    use Queueable, SerializesModels;

    protected $cake;

    protected $interested;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Cake $cake, Customer $interested)
    {
        $this->cake = $cake;
        $this->interested = $interested;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Inscrição concluída')
            ->view('emails.signature-completed', [
                'cake' => $this->cake,
                'interested' => $this->interested
            ]);
    }
}
