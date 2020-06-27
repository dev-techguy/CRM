<?php

namespace App\Http\Controllers;

use App\SMS;
use Illuminate\Http\Request;

class SMSCallBack extends Controller
{
    /**
     * sms callback
     * @param Request $request
     */
    public function callback(Request $request)
    {
        // log the request
        SystemController::log(
            [
                'sms_load' => $request->getContent()
            ], 'info', 'sms'
        );

        $response = json_decode($request->getContent());
        if ($response->status) {
            $sms = SMS::query()
                ->latest()
                ->where('correlator', $response->correlator)
                ->first();
            if ($sms)
                $sms->update([
                    'sms_load' => $request->getContent(),
                    'is_sent' => true,
                ]);

        }
    }
}
