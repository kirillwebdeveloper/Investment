<?php

namespace App\Mail;

use App\Http\Requests\ContactRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminEmailContact extends Mailable
{
    use Queueable, SerializesModels;

    protected $contactRequest;

    /**
     * AdminEmailContact constructor.
     * @param ContactRequest $request
     */
    public function __construct (ContactRequest $request)
    {
        $this->contactRequest = $request;
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
            ->view('email.contact_data')
            ->with([
                'contactRequest' => $this->contactRequest,
            ]);
    }
}
