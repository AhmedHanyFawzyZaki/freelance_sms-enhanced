<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TargetNumber;
use App\User;
use App\Http\Requests;
use App\Http\Session;
use App\Http\Controllers\Controller;
use Twilio\Twiml;

class DirectoryController extends Controller {

    public function incomingSmsHandling(Request $request) {
        $msg_arr = [];
        $is_suspended = 0;
        $body = $request->input('Body');
        $from = $request->input('From');
        $to = $request->input('To');
        if ($body) {
            $msg_arr = explode(' ', $body);
            $is_suspended = $this->_checkForSuspensionText($msg_arr);
        }

        $target = TargetNumber::where('target_number', $from)->first();
        if ($target) {
            $target->is_suspended = $is_suspended;
            $target->save();
        } else {
            $target = new TargetNumber();
            $target->target_number = $from;
            $target->is_suspended = $is_suspended;
            $target->save();
        }

        $this->_insertNewIncomingSms($from, $to, $body);
    }

    private function _checkForSuspensionText($arr) {
        $is_suspended = 0;
        if ($arr) {
            foreach ($arr as $v) {
                $keyword = strtolower($v);
                if ($keyword == 'stop' || $keyword == '"stop"') {
                    $is_suspended = 1;
                }
            }
        }
        return $is_suspended;
    }

    private function _insertNewIncomingSms($from, $to, $message) {
        $model = new \App\InOutBoundSms();
        $model->sent_from = $from;
        $model->sent_to = $to;
        $model->message = $message;
        $model->is_outbound = 0;
        $model->is_processed = 1; //all incoming sms should be marked as processed
        $model->save();
    }

}
