<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $guarded = [];
    protected $table = 'transactions';


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
