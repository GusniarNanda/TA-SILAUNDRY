<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function handle(): void
    {
        $data = $this->data;

        Mail::send('emails.notifikasi', [
            'title' => $data['subject'],
            'body' => $data['body'],
        ], function ($message) use ($data) {
            $message->to($data['to']);
            $message->subject($data['subject']);
        });
    }
}
