<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;
    protected $company;
    protected $investment;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct ($user, $company, $investment)
    {
        $this->user = $user;
        $this->company = $company;
        $this->investment = $investment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build ()
    {
        return $this->from(config('mail.from.address'))
            ->to(config('mail.admin.director'))
            ->view('email.order_data')
            ->with([
                'user'       => $this->user,
                'company'    => $this->company,
                'investment' => $this->investment
            ]);
    }
}
