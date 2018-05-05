<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TargetNumber extends Model {

    public $rules = [
        'target_number' => 'required|unique:target_numbers'
    ];

    public function scheduleRelation() {
        return $this->belongsTo('ScheduleLkp', 'schedule_id', 'id');
    }

}
