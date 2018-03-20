<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Number;
use App\User;
use App\Http\Requests;
use App\Http\Session;
use App\Http\Controllers\Controller;
use Twilio\Twiml;

class DirectoryController extends Controller {

    public function search(Request $request) {
        $msg_arr = [];
        $body = $request->input('Body');
        if ($body) {
            $msg_arr = explode(' ', $body);
        }

        $query = Number::whereIn('number', $msg_arr);
        $count = $query->count();
        if ($count > 0) {
            return $this->_singleResult($query);
        } else {
            return $this->_notFound();
        }
    }

    private function _singleResult($query) {
        $twiml = new Twiml;
        $number = $query->first();
        $twiml->message($number->msg);
        return $this->_xmlResponse($twiml);
    }

    private function _notFound() {
        $twiml = new Twiml;
        $settings = User::findOrFail(1);
        $twiml->message($settings->default_message);
        return $this->_xmlResponse($twiml);
    }

    private function _xmlResponse($twiml) {
        return response($twiml, 200)->header('Content-Type', 'application/xml');
    }

}
