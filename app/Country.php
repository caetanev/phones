<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'country';
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

}
