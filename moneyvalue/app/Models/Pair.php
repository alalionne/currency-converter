<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pair extends Model
{
    use HasFactory;
    protected $fillable = [
		'currency_id_from',
		'currency_id_to',
        'rate'
	];

    public function currencyFrom(){
        return $this->belongsTo(Currency::class,'currency_id_from');
    }
    public function currencyTo(){
        return $this->belongsTo(Currency::class,'currency_id_to');
    }
}
