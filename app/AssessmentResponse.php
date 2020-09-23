<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssessmentResponse extends Model
{
    protected $guarded =[];

    public function assessment() {

        return $this->belongsTo(Assessment::class);
    }

    public function questionaire() {

        return $this->belongsToMany(Questionaire::class);
    }

    public function questions() {

        return $this->belongsToMany(Questions::class);
    }

    public function answers() {

        return $this->belongsToMany(Answers::class);
    }
}
