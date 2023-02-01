<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BusinessRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'alias' => 'required|string',
            'name' => 'required|string',
            'image_url' => 'required|string',
            'is_closed' => 'required|boolean',
            'url' => 'required|string',
            'review_count' => 'required|string',
            'categories.*' => 'required|array|min:1',
            'categories.*.alias' => 'required|string',
            'categories.*.title' => 'required|string',
            'rating' => 'required|string',
            'coordinates.*' => 'required|array|min:1',
            'coordinates.latitude' => 'required|string',
            'coordinates.longitude' => 'required|string',
            'price' => 'string',
            'location.*' => 'required|array|min:1',
            'location.address1' => 'string',
            'location.address2' => 'string|nullable',
            'location.address3' => 'string|nullable',
            'location.city' => 'required|string',
            'location.zip_code' => 'string',
            'location.country' => 'string',
            'location.state' => 'string',
            'distance' => 'string|nullable',
            'phone' => 'required|string',
            'display_phone' => 'required|string',
        ];
    }
}
