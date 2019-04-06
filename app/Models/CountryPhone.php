<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CountryPhone extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'country_phone';
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Set the relationship with CustomerCountryPhone Model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function customerCountryPhone(){
        return $this->belongsToMany('App\Models\CustomerCountryPhone', 'country_phone_id', 'id');
    }

}
