<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountingConsultation extends Model
{
    protected $table = 'accounting_consultations';

    protected $fillable = [
        'title',
        'title_kk',
        'title_en',
        'description',
        'description_kk',
        'description_en',
        'button_text',
        'button_text_kk',
        'button_text_en',
    ];
}
