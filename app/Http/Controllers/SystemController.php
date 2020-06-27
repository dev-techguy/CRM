<?php

namespace App\Http\Controllers;

use App\Report;
use App\SetDate;
use App\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
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
     * @param string|null $answer
     * @param string|null $disposition
     * @return Model|Builder|object|null
     */
    public static function generateReport(int $script_id, string $answer = null, string $disposition = null)
    {
        $report = Report::query()
            ->where('script_id', $script_id)
            ->where('client', request()->getClientIp());
        $data = $report->first();
        if ($data) {
            DB::transaction(function () use ($data, $report, $answer, $disposition) {
                $report->update([
                    'disposition' => isset($disposition) ? $disposition : $data->disposition,
                    'answer' => isset($answer) ? $answer : $data->answer,
                    'is_complete' => true
                ]);
            }, 5);
        } else {
            DB::transaction(function () use ($script_id, $answer, $disposition) {
                DB::table((new Report())->getTable())->insert([
                    'script_id' => $script_id,
                    'client' => request()->getClientIp(),
                    'answer' => $answer,
                    'disposition' => $disposition,
                    'is_complete' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }, 5);
        }

        return $report;
    }

    /**
     * set date for call back here
     * @param null $appointment_date
     * @param null $callback_date
     * @return \Illuminate\Database\Eloquent\Builder|Model|object|null
     * @throws Exception
     */
    public static function setDates($appointment_date = null, $callback_date = null)
    {
        $query = SetDate::query();
        $setDate = $query
            ->where('client', request()->getClientIp())
            ->first();
        if ($setDate) {
            $setDate->update([
                'appointment_date' => isset($appointment_date) ? $appointment_date : $setDate->appointment_date,
                'callback_date' => isset($callback_date) ? $callback_date : $setDate->callback_date,
            ]);
        } else {
            $query->create([
                'client' => request()->getClientIp(),
                'appointment_date' => $appointment_date,
                'callback_date' => $callback_date,
            ]);
        }

        return $setDate;
    }

    /**
     * set caller details
     * @param string|null $email
     * @param string|null $phone_number
     * @return \Illuminate\Database\Eloquent\Builder|Model|object|null
     * @throws Exception
     */
    public static function setCallDetails(string $email = null, string $phone_number = null)
    {
        $query = User::query();
        $user = $query
            ->where('client', request()->getClientIp())
            ->first();
        if ($user) {
            $user->fill([
                'email' => isset($email) ? $email : $user->email,
                'phone_number' => isset($phone_number) ? $phone_number : $user->phone_number
            ]);
            $user->save();
        } else {
            $query->create([
                'client' => request()->getClientIp(),
                'name' => cache()->get('name_and_title' . request()->getClientIp()),
                'email' => $email,
                'phone_number' => $phone_number,
                'password' => bcrypt($phone_number),
            ]);
        }

        return $user;
    }

    /**
     * trim phone
     * number here
     * @param $phoneNumber
     * @return null|string|string[]
     */
    public static function trimPhoneNumber($phoneNumber)
    {
        return preg_replace("/^0/", "254", $phoneNumber);
    }
}
