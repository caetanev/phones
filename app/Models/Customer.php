<?php

namespace App\Models;

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

    /**
     * Indicates if the model should be timestamped.
     *
     * @var array
     */
    protected $appends = ['phone_suffix'];

    /**
     * Set the relationship with CustomerCountryPhone Model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function customerCountryPhone(){
        return $this->belongsToMany(CustomerCountryPhone::class, 'customer_id', 'id');
    }

    /**
     * Remove the country code of the recorded number
     *
     * @return string
     */
    public function getPhoneSuffixAttribute(){
        preg_match('/(\(.*\)) (.*)/', $this->phone, $matches);
        return end($matches);
    }

}
