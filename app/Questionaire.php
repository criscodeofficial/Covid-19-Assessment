<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questionaire extends Model
{
    protected $guarded =[];

    public function questions() {
        
        return $this->hasMany(Question::class);
    }

    public function assessments() {

        return $this->hasMany(Assessment::class);
    }
}
