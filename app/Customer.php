<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'customer';
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    protected $appends = ['country_code'];

    public function getCountryCodeAttribute()
    {
        preg_match('/\((.*)\)\ */', $this->getPhone() , $outputArray);
        trim(array_shift($outputArray), '');
    }

    public function country(){
        return $this->hasOne(Country::class);
    }

}
