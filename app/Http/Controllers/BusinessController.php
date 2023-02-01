<?php

namespace App\Http\Controllers;

use App\Http\Requests\BusinessRequest;
use App\Models\Business;
use App\Models\BusinessCategories;
use App\Models\BusinessLocation;
use App\Traits\ApiResponser;
use App\Traits\UuidGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BusinessController extends Controller
{
    use ApiResponser, UuidGenerator;

    public function index()
    {
        //
    }

    public function store(BusinessRequest $request)
    {
        $create = Business::create([
            'alias' => $request->alias,
            'name' => $request->name,
            'image_url' => $request->image_url,
            'is_closed' => $request->is_closed,
            'url' => $request->url,
            'review_count' => $request->review_count,
            'rating' => $request->rating,
            'latitude' => $request['coordinates']['latitude'],
            'longitude' => $request['coordinates']['longitude'],
            'price' => $request->price,
            'phone' => $request->phone,
            'display_phone' => $request->display_phone,
            'distance' => $request->distance
        ]);

        if ($create) {
            foreach ($request->categories as $category) {
                $return[] = $category;

                BusinessCategories::create([
                    'business_id' => $create->id,
                    'alias' => strtolower(str_replace(' ', '', $category['alias'])),
                    'title' => $category['title']
                ]);
            }

            BusinessLocation::create([
                'business_id' => $create->id,
                'address1' => $request['location']['address1'],
                'address2' => $request['location']['address2'],
                'address3' => $request['location']['address3'],
                'city' => $request['location']['city'],
                'zip_code' => $request['location']['zip_code'],
                'country' => $request['location']['country'],
                'state' => $request['location']['state'],
            ]);

            return $this->showOne(null);
        }
    }

    public function show(Business $business)
    {
        //
    }

    public function update(BusinessRequest $request, $id)
    {
        $create = Business::find($id)->update([
            'alias' => $request->alias,
            'name' => $request->name,
            'image_url' => $request->image_url,
            'is_closed' => $request->is_closed,
            'url' => $request->url,
            'review_count' => $request->review_count,
            'rating' => $request->rating,
            'latitude' => $request['coordinates']['latitude'],
            'longitude' => $request['coordinates']['longitude'],
            'price' => $request->price,
            'phone' => $request->phone,
            'display_phone' => $request->display_phone,
            'distance' => $request->distance
        ]);

        if ($create) {
            foreach ($request->categories as $category) {
                $return[] = $category;

                BusinessCategories::where('business_id', $id)->update([
                    'alias' => strtolower(str_replace(' ', '', $category['alias'])),
                    'title' => $category['title']
                ]);
            }

            BusinessLocation::where('business_id', $id)->update([
                'address1' => $request['location']['address1'],
                'address2' => $request['location']['address2'],
                'address3' => $request['location']['address3'],
                'city' => $request['location']['city'],
                'zip_code' => $request['location']['zip_code'],
                'country' => $request['location']['country'],
                'state' => $request['location']['state'],
            ]);

            return $this->showOne(null);
        }
    }

    public function destroy($id)
    {
        $cekdata = Business::find($id);

        if ($cekdata) {
            BusinessCategories::where('business_id', $id)->delete();
            BusinessLocation::where('business_id', $id)->delete();
            Business::find($id)->delete();

            return $this->showOne(null);
        }

        return $this->errorResponse('No data available', 404, 40400);
    }
}
