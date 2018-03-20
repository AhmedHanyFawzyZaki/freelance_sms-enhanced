<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmsLog extends Model {

    public $rules = [
        'sent_from' => 'required',
        'sent_to' => 'required',
        'message' => 'required'
    ];

}
