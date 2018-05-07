<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/**
 * use the following to send sms
 */
use Twilio\Twiml;
use Twilio\Rest\Client;
use Twilio\Exceptions\TwilioException;
use Log;

class TargetNumber extends Model {

    public $rules = [
        'target_number' => 'required|unique:target_numbers'
    ];

    public function scheduleRelation() {
        return $this->belongsTo('\App\ScheduleLkp', 'schedule_id', 'id');
    }

    /**
     * Proccess scheduled sms
     * this method is called from the cron job command "app/console/commands/inspire"
     * @param nothing
     */
    public function proccessSchedule() {
        if ($this->send_start_date != '' && ($this->send_type == 1 || ($this->send_type == 2 && $this->schedule_id != ''))) {
            if ($this->_getDateDifference() == 0 && !$this->is_suspended) {
                $this->_insertOutboundSMS(); //insert and send sms
                $this->last_send_date = date('Y-m-d H:i:s');
                $this->save();
                return "Sent";
            }
            return "Send date still not reached!";
        }
        return "Not configured well!";
    }

    private function _getDateDifference() {
        $today = strtotime(date('Y-m-d'));
        $start_send_date = strtotime($this->send_start_date);
        if ($this->send_type == 1) {
            return $today - $start_send_date;
        }
        $recurringDays = $this->scheduleRelation->period_in_hours / 24; //in days
        return ($today - $start_send_date) % ($recurringDays * 24 * 60 * 60);
    }

    /**
     * send sms using twilio account configured in the env file
     * @param type $from
     * @param type $to
     * @param type $message
     */
    private function _sendSMS($to, $message) {
        $accountSid = env('TWILIO_ACCOUNT_SID');
        $authToken = env('TWILIO_AUTH_TOKEN');
        $twilioNumber = env('APP_NUMBER', '+15614752885');

        $client = new Client($accountSid, $authToken);

        try {
            $client->messages->create(
                    $to, [
                "body" => $message,
                "from" => $twilioNumber
                    //   On US phone numbers, you could send an image as well!
                    //  'mediaUrl' => $imageUrl
                    ]
            );
            Log::info('Message sent to ' . $to);
            return '';
        } catch (TwilioException $e) {
            return $e;
            /* echo $e;
              die; */
        }
    }

    private function _insertOutboundSMS() {
        $model = new InOutBoundSms();
        $model->is_outbound = 1;
        $model->sent_from = env('APP_NUMBER');
        $model->sent_to = $this->target_number;
        $model->message = $this->message;
        $model->is_processed = 1;
        $model->error_msg = $this->_sendSMS($this->target_number, $this->message);
        $model->save();
    }

}
