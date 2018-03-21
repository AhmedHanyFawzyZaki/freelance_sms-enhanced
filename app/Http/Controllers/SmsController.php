<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\InOutBoundSms;
use Twilio\Twiml;
use Twilio\Rest\Client;
use Twilio\Exceptions\TwilioException;
use Log;

class SmsController extends Controller {

    /**
     * Create a new home controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Send SMS.
     *
     * @return Response
     */
    public function getSendSms() {
        $model = new InOutBoundSms();
        $model->is_outbound = 1;
        $model->sent_from = env('APP_NUMBER', '5614752885');
        if (isset($_GET['number'])) {
            $model->sent_to = '+' . trim($_GET['number']);
        }
        return view('sms.create', compact('model'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function postSendSms(Request $request) {
        $model = new InOutBoundSms();
        $request->flash(); //save the input before redirect

        $validator = Validator::make($request->all(), $model->rules_without_from);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            $model->is_outbound = 1;
            $model->sent_from = env('APP_NUMBER', '+15614752885');
            $model->sent_to = $request->input("sent_to");
            $model->message = $request->input("message");
            $model->save();

            $this->_sendSMS($model->sent_from, $model->sent_to, $model->message);

            return redirect()->route('sms-marketing.index')->with('message', 'New SMS has been sent successfully to the following number: ' . $model->sent_to);
        }
    }

    private function _sendSMS($from, $to, $message) {
        $accountSid = env('TWILIO_ACCOUNT_SID');
        $authToken = env('TWILIO_AUTH_TOKEN');
        $twilioNumber = $from; //env('APP_NUMBER');

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
            Log::info('Message sent to ' . $twilioNumber);
        } catch (TwilioException $e) {
            echo $e;
            echo 'sd';die;
        }
    }

}
