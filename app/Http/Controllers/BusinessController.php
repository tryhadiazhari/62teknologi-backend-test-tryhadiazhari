<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Traits\ApiResponser;
use App\Traits\UuidGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BusinessController extends Controller
{
    use ApiResponser, UuidGenerator;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validate = Validator::make($request->all(), [
            "name" => "required|string|nullable",
            "image_url" => "string|nullable",
            "is_closed" => "numeric|nullable",
            "url" => "string|nullable",
            "categories.*" => "required|array|min:1",
            "categories.*.title" => "required|string",
            "coordinates.*" => "required|array|min:1",
            "coordinates.latitude" => "required|numeric|nullable",
            "coordinates.longitude" => "required|numeric|nullable",
            "location.*" => "required|array|min:1",
            "location.address1" => "required|string|nullable",
            "location.address2" => "string|nullable",
            "location.address3" => "string|nullable",
            "location.city" => "required|string|nullable",
            "location.zip_code" => "numeric|nullable",
            "location.country" => "required|string|nullable",
            "location.state" => "required|string|nullable",
            "country_code" => "required|numeric|nullable",
            "phone" => "required|numeric|nullable",
        ]);

        if ($validate->fails()) {
            return $this->errorResponse($validate->errors()->toArray(), 400, 40000);
        }

        $create = Business::create([
            "alias" => strtolower(str_replace(' ', '-', $request->name) . '-' . str_replace(' ', '-', $request['location']['city'])),
            "name" => $request->name,
            "image_url" => $request->image_url,
            "is_closed" => 1,
            "url" => $request->url,
            // "categories_id" => $request->categories_id,
            "latitude" => $request['coordinates']['latitude'],
            "longitude" => $request['coordinates']['longitude'],
            "address1" => $request['location']['address1'],
            "address2" => $request['location']['address2'],
            "address3" => $request['location']['address3'],
            "city" => $request['location']['city'],
            "zip_code" => $request['location']['zip_code'],
            "country" => $request['location']['country'],
            "country_code" => $request->country_code,
            "phone" => $request->phone,

        ]);

        if ($create) {
            return $this->showOne(null);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function show(Business $business)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Business $business)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function destroy(Business $business)
    {
        //
    }
}
