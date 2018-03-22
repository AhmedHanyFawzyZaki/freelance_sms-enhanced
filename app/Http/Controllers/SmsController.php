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
use App\TargetNumber;

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
     * process the sms message
     * @param Request $request
     * @return type
     */
    public function postSendSms(Request $request) {
        $model = new InOutBoundSms();
        $request->flash(); //save the input before redirect

        $validator = Validator::make($request->all(), $model->rules_without_from);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {

            $num = $request->input("sent_to");
            $targetNumber = $this->_setTargetNumber($num);

            //if target number is suspended don't send the message

            $model->is_outbound = 1;
            $model->sent_from = env('APP_NUMBER');
            $model->sent_to = $num;
            $model->message = $request->input("message");
            $model->is_processed = 1;
            if ($targetNumber && !$targetNumber->is_suspended) {
                $model->error_msg = $this->_sendSMS($model->sent_to, $model->message); //send the sms and receive the error if found
                $model->save();
                return redirect()->route('sms-marketing.index')->with('message', 'New SMS has been sent successfully to the following number: ' . $model->sent_to);
            } else {
                //$model->error_msg = 'This Number is suspended, please remove suspension and try again later.';
                return redirect()->route('sms-marketing.index')->with('message', 'This Number is suspended, please remove suspension and try again later.');
            }
        }
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
            Log::info('Message sent to ' . $twilioNumber);
            return '';
        } catch (TwilioException $e) {
            return $e;
            /* echo $e;
              die; */
        }
    }

    /**
     * Show the form for uploading csv to send mass sms.
     *
     * @return Response
     */
    public function getUploadExcel() {
        return view('targetnumber.excel.getUploadExcel');
    }

    /**
     * Import the uploaded csv and store it in database to be queued and sent.
     *
     * @param Request $request
     * @return Response
     */
    public function postUploadExcel(Request $request) {
        if ($request->hasFile('file')) {
            $path = $request->file('file')->getRealPath();
            $data = \Excel::load($path)->get();
            if ($data->count()) {
                foreach ($data as $key => $value) {
                    $num = $value->phone_to_send_sms_too;
                    $msg = $value->message_to_send;

                    $targetNumber = $this->_setTargetNumber($num);

                    //if target number is suspended don't send the message

                    $model = new InOutBoundSms();
                    $model->is_outbound = 1;
                    $model->sent_from = env('APP_NUMBER');
                    $model->sent_to = $num;
                    $model->message = $msg;
                    $model->is_processed = 1;
                    if ($targetNumber && !$targetNumber->is_suspended) {
                        $model->error_msg = $this->_sendSMS($model->sent_to, $model->message); //send the sms and receive the error if found
                    } else {
                        $model->error_msg = 'This Number is suspended, please remove suspension and try again later.';
                    }
                    $model->save();
                }
                return redirect()->back()->with('message', 'The excel sheet has been imported successfully.');
            } else {
                return redirect()->back()->with('message', 'The excel sheet uploaded is empty!');
            }
        } else {
            return redirect()->back()->with('message', 'Please make sure that you uploaded a valid excel sheet.');
        }
    }

    /**
     * check for the provided number and add it if not found in db
     * set the has queue flag in order to mark this number to be able to send sms
     * @param type $number
     */
    private function _setTargetNumber($number) {
        $target = TargetNumber::where('target_number', $number)->first();
        if ($target) {
            //$target->has_queue = 1; //set its queue
        } else {
            $target = new TargetNumber();
            $target->target_number = $number;
            //$target->has_queue = 1;
        }
        $target->save();
        return $target;
    }

}
