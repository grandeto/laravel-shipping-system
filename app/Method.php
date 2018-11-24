<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Method extends Model
{
    use SoftDeletes;

    protected $table = 'methods';
    public $timestamps = true;

    protected $fillable = [
        'name'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Get the prices for the given method.
     */
    public function prices()
    {
        return $this->hasMany('App\Price', 'method_id');
    }

    /**
     * The origin countries that belong to the method.
     */
    public function originCountries()
    {
        return $this->belongsToMany('App\Country', 'prices', 'method_id', 'origin_country_id');
    }

    /**
     * The destination countries that belong to the method.
     */
    public function destinationCountries()
    {
        return $this->belongsToMany('App\Country', 'prices', 'method_id', 'destination_country_id');
    }
}
