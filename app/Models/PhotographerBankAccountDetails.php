<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhotographerBankAccountDetails extends Model
{
    //
    protected $fillable=['photographer_id','first_name','last_name','bank_name','account_number'];
    protected $table='photographer_bank_account_details';
}
