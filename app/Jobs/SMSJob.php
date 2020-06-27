<?php

namespace App\Jobs;

use App\Http\Controllers\SystemController;
use App\SMS;
use App\Traits\SMSGate;
use Illuminate\Bus\Queueable;
use Illuminate\Config\Repository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use ShiftechAfrica\CodeGenerator\ShiftCodeGenerator;

class SMSJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, SMSGate;

    /**
     * @var Repository|Application|mixed
     */
    private $baseUri;
    /**
     * @var string
     */
    private $phone_number;
    /**
     * @var string
     */
    private $message;

    /**
     * Create a new job instance.
     *
     * @param string $phone_number
     * @param string $message
     */
    public function __construct(string $phone_number, string $message)
    {
        $this->baseUri = config('sms.url.endpoint');
        $this->phone_number = $phone_number;
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $sms = SMS::query();
        if (count($sms->get()) >= 5) {
            // don't send any sms
        } else {

            $correlator = (new ShiftCodeGenerator())->generate();

            // create a sms push
            SMS::query()->create([
                'phone_number' => SystemController::trimPhoneNumber($this->phone_number),
                'correlator' => $correlator,
            ]);

            // send the request
            $this->processRequest(
                config('sms.url.send-sms'),
                [
                    (object)[
                        "sender" => config('sms.keys.sender'),
                        "message" => $this->message,
                        "phone" => SystemController::trimPhoneNumber($this->phone_number),
                        "correlator" => $correlator,
                        "endpoint" => route('sms.call.back'),
                    ]
                ],
                'POST'
            );
        }
    }
}
