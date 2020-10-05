<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class invoice extends Model
{
    protected $guarded=[];

    public function details(){
        return $this->hasMany(invoiceDetails::class);
    }
}//end of model
