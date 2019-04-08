<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerCountryPhone extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'customer_country_phone';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Set the relationship with the Customer model
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function customer(){
        return $this->hasOne(Customer::class, 'id', 'customer_id');
    }

    /**
     * Set the relationship with the Country model
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function countryPhone(){
        return $this->hasOne(CountryPhone::class, 'id', 'country_phone_id');
    }

    /**
     * Set the relationship with the Country model
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function phoneState(){
        return $this->hasOne(PhoneState::class, 'id', 'valid_phone');
    }

}
