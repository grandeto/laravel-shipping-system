<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Price;

class PriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return [];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return [];
    }

    /**
     * Shows a all matched prices by the given criteria.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function compare(Request $request)
    {
        $data = $request->all();

        $validator = Price::getValidator($data);
        if ($validator->fails()) {
                return response()->json([
                    'result' => false,
                    'request' => $request->all(),
                    'message' => $validator->messages(),
                ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $prices = Price::where([
                ['origin_country_id', '=', $data['origin_country_id']],
                ['destination_country_id', '=', $data['destination_country_id']],
                ['min_weight', '<=', $data['weight']],
                ['max_weight', '>=', $data['weight']],
            ])->get();
        } catch (\Exception $err) {
            return response()->json([
                'result' => false,
                'message' => 'Shipping data not fetched. Please try again later.',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $compareList = $prices->map(function ($item, $key) {
            $new['id'] = $item->id;
            $new['method_id'] = $item->shippingMethod->name;
            $new['origin_country_id'] = $item->originCountry->name;
            $new['destination_country_id'] = $item->destinationCountry->name;
            $new['min_weight'] = $item->min_weight;
            $new['max_weight'] = $item->max_weight;
            $new['price'] = $item->price;
            return $new;
        });
        return response($compareList->jsonSerialize(), Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        return [];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return [];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        return [];
    }
}
