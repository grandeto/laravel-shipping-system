<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class Price extends Model
{
    use SoftDeletes;

    protected $table = 'prices';
    public $timestamps = true;

    protected $fillable = [
        'method_id', 'origin_country_id', 'destination_country_id', 'min_weight', 'max_weight', 'price',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Validate consumers operations.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  String  $rule
     * @return \Illuminate\Support\Facades\Validator
     */
    public static function getValidator($data, $rule = 'default')
    {
        $rules = [
            'default' => [
                'origin_country_id' => 'required|numeric',
                'destination_country_id' => 'required|numeric',
                'weight' => 'required|numeric',
            ],
        ];

        if (!isset($rules[$rule])) $rule = 'default';

        return Validator::make($data, $rules[$rule]);
    }

    /**
     * Get the method that owns the price.
     */
    public function shippingMethod()
    {
        return $this->belongsTo('App\Method', 'method_id');
    }

    /**
     * Get the origin country for the given price.
     */
    public function originCountry()
    {
        return $this->belongsTo('App\Country', 'origin_country_id');
    }

    /**
     * Get the destinations country for the given price.
     */
    public function destinationCountry()
    {
        return $this->belongsTo('App\Country', 'destination_country_id');
    }
}
