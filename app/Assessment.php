<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    protected $guarded = [];

    public function questionaire() {

        return $this->belongsTo(Questionaire::class);
    }

    public function responses() {

        return $this->hasMany(AssessmentResponse::class);
    }
}
