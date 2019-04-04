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

    protected $appends = ['country_code', 'state'];

    public function getCountryCodeAttribute()
    {
        preg_match('/\((.*?)\)/', $this->phone, $match);

        return $match[1];
    }

    public function country()
    {
        return $this->hasOne(Country::class, 'code', 'country_code');
    }

    public function getStateAttribute()
    {
        return preg_match($this->country->regex, $this->phone);
    }

    public function findByCountry(int $countryCode)
    {
        return $this->whereRaw("phone REGEXP '\(($countryCode)\)*$'");
    }
}
