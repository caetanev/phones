<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhoneState extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'phone_state';

    /**
     * Set the relationship with CustomerCountryPhone Model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function customerCountryPhone(){
        return $this->belongsToMany(CustomerCountryPhone::class, 'valid_phone', 'id');
    }
}
