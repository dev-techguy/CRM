<?php

namespace App\Http\Controllers;

use App\Script;
use App\SetDate;
use App\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Monolog\Formatter\JsonFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class SystemController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * returns the elapsed time
     * @param $time
     * @return false|string
     */
    public static function elapsedTime($time)
    {
        return Carbon::parse($time)->diffForHumans();
    }

    /**
     * Write the system log files
     * @param array $data
     * @param string $channel
     * @param string $fileName
     */
    public static function log(array $data, string $channel, string $fileName)
    {
        $file = storage_path('logs/' . $fileName . '.log');

        // finally, create a formatter
        $formatter = new JsonFormatter();

        // Create the log data
        $log = [
            'ip' => request()->getClientIp(),
            'data' => $data,
        ];
        // Create a handler
        $stream = new StreamHandler($file, Logger::INFO);
        $stream->setFormatter($formatter);

        // bind it to a logger object
        $securityLogger = new Logger($channel);
        $securityLogger->pushHandler($stream);
        $securityLogger->log('info', $channel, $log);
    }

    /**
     * get greetings here
     * @return string
     */
    public static function pass_greetings_to_user()
    {
        if (date("H") < 12) {
            return "Good Morning";
        } elseif (date("H") >= 12 && date("H") < 16) {
            return "Good Afternoon";
        } elseif (date("H") >= 16) {
            return "Good Evening";
        }
    }

    /**
     *generate report
     * for the scripts
     * @param int $script_id
     * @param string|null $answer_type
     * @param string|null $answer_value
     * @param string|null $disposition_type
     * @param null $disposition_value
     * @throws Exception
     */
    public static function generateReport(int $script_id, string $answer_type = null, string $answer_value = null, string $disposition_type = null, $disposition_value = null)
    {
        $report = DB::table((new Script())->getTable())
            ->where('script_id', $script_id)
            ->where('client', cache()->get('name_and_title' . request()->getClientIp()))
            ->first();
        if ($report) {
            DB::transaction(function () use ($report, $answer_type, $answer_value, $disposition_type, $disposition_value) {
                $report->update([
                    'answer->type' => isset($answer_type) ? $answer_type : $report->answer->type,
                    'answer->value' => isset($answer_value) ? $answer_value : $report->answer->value,
                    'disposition->type' => isset($disposition_type) ? $disposition_type : $report->disposition->type,
                    'disposition->value' => isset($disposition_value) ? $disposition_value : $report->disposition->value,
                ]);
            }, 5);
        } else {
            DB::transaction(function () use ($answer_type, $answer_value, $disposition_type, $disposition_value) {
                DB::table((new Script())->getTable())->insert([
                    'client' => cache()->get('name_and_title' . request()->getClientIp()),
                    'answer' => json_encode([
                        'type' => $answer_type,
                        'value' => $answer_value
                    ]),
                    'disposition' => json_encode([
                        'type' => $disposition_type,
                        'value' => $disposition_value
                    ]),
                ]);
            }, 5);
        }
    }

    /**
     * set date for call back here
     * @param null $appointment_date
     * @param null $callback_date
     * @throws Exception
     */
    public static function setDates($appointment_date = null, $callback_date = null)
    {
        $query = SetDate::query();
        $setDate = $query
            ->where('client', cache()->get('name_and_title' . request()->getClientIp()))
            ->first();
        if ($setDate) {
            $setDate->update([
                'appointment_date' => isset($appointment_date) ? $appointment_date : $setDate->appointment_date,
                'callback_date' => isset($callback_date) ? $callback_date : $setDate->callback_date,
            ]);
        } else {
            $query->create([
                'client' => cache()->get('name_and_title' . request()->getClientIp()),
                'appointment_date' => $appointment_date,
                'callback_date' => $callback_date,
            ]);
        }
    }

    /**
     * set caller details
     * @param string|null $email
     * @param string|null $phone_number
     * @throws Exception
     */
    public static function setCallDetails(string $email = null, string $phone_number = null)
    {
        $query = User::query();
        $user = $query
            ->where('client', cache()->get('name_and_title' . request()->getClientIp()))
            ->first();
        if ($user) {
            $user->update([
                'email' => isset($email) ? $email : $user->email,
                'phone_number' => isset($email) ? $email : $user->email
            ]);
        } else {
            $query->create([
                'client' => cache()->get('name_and_title' . request()->getClientIp()),
                'name' => cache()->get('name_and_title' . request()->getClientIp()),
                'email' => $email,
                'phone_number' => $phone_number,
                'password' => bcrypt($phone_number),
            ]);
        }
    }
}
