<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use SoftDeletes;

    protected $table = 'countries';
    public $timestamps = true;

    protected $fillable = [
        'code', 'name',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Get the prices where the country is origin.
     */
    public function originPrices()
    {
        return $this->hasMany('App\Price', 'origin_country_id');
    }

    /**
     * Get the prices where the country is destination.
     */
    public function destinationPrices()
    {
        return $this->hasMany('App\Price', 'destination_country_id');
    }

    /**
     * The methods that belong to the origin country.
     */
    public function originMethods()
    {
        return $this->belongsToMany('App\Method', 'prices', 'origin_country_id', 'method_id');
    }

    /**
     * The methods that belong to the destination country.
     */
    public function destinationMethods()
    {
        return $this->belongsToMany('App\Method', 'prices', 'destination_country_id', 'method_id');
    }
}
