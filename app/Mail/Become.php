<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Become extends Mailable
{
    use Queueable, SerializesModels;

    public $expert;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($expert)
    {
        $this->expert = (object)$expert;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this
            ->subject('Стать экспертом!')
            ->view('emails.become')
        ;

        if($this->expert->resume) {
            try {
                $ext = $this->expert->resume->extension();
            } catch(\Exception $e) {
                $ext = $this->expert->resume->clientExtension();
            }
            $this->attach(
                $this->expert->resume->path(),
                [
                    'as' => 'Резюме.' . $ext,
                    'mime' => $this->expert->resume->getMimeType()
                ]
            );
        }

        return $this;
    }
}
