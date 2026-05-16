<?php

namespace App\Models\ApplicationForm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationAssign extends Model
{
    use HasFactory;


    public function application_form()
    {

        return $this->belongsTo(ApplicationForm::class);
    }
}