<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\BusinessCategories;
use App\Models\BusinessLocation;
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
            "id" => "required|string",
            "alias" => "required|string",
            "name" => "required|string",
            "image_url" => "required|string",
            "is_closed" => "required|boolean",
            "url" => "required|string",
            "categories.*" => "required|array|min:1",
            "categories.*.alias" => "required|string",
            "categories.*.title" => "required|string",
            "rating" => "required|string",
            "coordinates.*" => "required|array|min:1",
            "coordinates.latitude" => "required|string",
            "coordinates.longitude" => "required|string",
            "price" => 'string',
            "location.*" => "required|array|min:1",
            "location.address1" => "string",
            "location.address2" => "string|nullable",
            "location.address3" => "string|nullable",
            "location.city" => "required|string",
            "location.zip_code" => "string",
            "location.country" => "string",
            "location.state" => "string",
            "distance" => "string|nullable",
            "phone" => "required|string",
            "display_phone" => "required|string",
        ]);

        if ($validate->fails()) {
            return $this->errorResponse($validate->errors()->toArray(), 400, 40000);
        }

        $create = Business::create([
            "id" => $request->id,
            "alias" => strtolower(str_replace(' ', '-', $request->name) . '-' . str_replace(' ', '-', $request['location']['city'])),
            "name" => $request->name,
            "image_url" => $request->image_url,
            "is_closed" => $request->is_closed,
            "url" => $request->url,
            "latitude" => $request['coordinates']['latitude'],
            "longitude" => $request['coordinates']['longitude'],
            "country_code" => $request->country_code,
            "phone" => $request->phone,
            "display_phone" => $request->display_phone,
            "distance" => $request->distance,

        ]);

        if ($create) {
            foreach ($request->categories as $category) {
                $return[] = $category;

                BusinessCategories::create([
                    'business_id' => $request->id,
                    'alias' => strtolower(str_replace(' ', '', $category['alias'])),
                    'title' => $category['title']
                ]);
            }

            BusinessLocation::create([
                'business_id' => $request->id,
                "address1" => $request['location']['address1'],
                "address2" => $request['location']['address2'],
                "address3" => $request['location']['address3'],
                "city" => $request['location']['city'],
                "zip_code" => $request['location']['zip_code'],
                "country" => $request['location']['country'],
                "state" => $request['location']['state'],
            ]);

            return $this->showOne(null);
        }

        // return $request->categories;
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
