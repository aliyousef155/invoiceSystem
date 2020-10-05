<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class invoiceDetails extends Model
{
    protected $guarded=[];

    public function invoice(){
        return $this->belongsTo(invoice::class);
    }
}
