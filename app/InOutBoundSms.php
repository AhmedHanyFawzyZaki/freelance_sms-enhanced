<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InOutBoundSms extends Model {

    public $rules = [
        'sent_from' => 'required',
        'sent_to' => 'required',
        'message' => 'required'
    ];
    
    public $rules_without_from = [
        //'sent_from' => 'required',
        'sent_to' => 'required',
        'message' => 'required'
    ];

}
