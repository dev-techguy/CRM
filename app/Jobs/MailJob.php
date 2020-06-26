<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Snowfire\Beautymail\Beautymail;

class MailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $email;
    /**
     * @var string
     */
    private $body;

    /**
     * Create a new job instance.
     *
     * @param string $name
     * @param string $email
     * @param string $body
     */
    public function __construct(string $name, string $email, string $body)
    {
        $this->name = $name;
        $this->email = $email;
        $this->body = $body;
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws BindingResolutionException
     */
    public function handle()
    {
        $beautymail = app()->make(Beautymail::class);
        $beautymail->send('emails.mail', [
            'name' => $this->name,
            'email' => $this->email,
            'body' => $this->body,
        ], function ($message) {
            $message
                ->from(env('MAIL_USERNAME'))
                ->to($this->email, $this->name)
                ->subject(config('app.name'));
        });
    }
}
