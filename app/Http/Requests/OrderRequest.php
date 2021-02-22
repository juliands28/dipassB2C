<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'schedule_id' => 'required|exists:schedules,id',
            'route_id' => 'required|exists:routes,id',
            'departure_city' => 'required|exists:cities,id',
            'departure_point' => 'required|exists:points,id',
            'departure_date' => 'required',
            'departure_time' => 'required',
            'arrival_city' => 'required|exists:cities,id',
            'arrival_point' => 'required|exists:points,id',
            'arrival_date' => 'required',
            'arrival_time' => 'required',
            'total_price' => 'required|numeric',

            // 'name' => 'required|string|max:50',
            // 'phone' => 'required|string|max:15',
            // 'email' => 'required|string|max:50',

            // 'passenger_name' => 'required|array',
            // 'passenger_name.*' => 'required|string|max:50',
            // 'passenger_nik' => 'required|array',
            // 'passenger_nik.*' => 'required|string|max:20',
            // 'passenger_seat_number' => 'required|array',
            // 'passenger_seat_number.*' => 'required|string|max:10|distinct',
            // 'passenger_age' => 'required|array',
            // 'passenger_age.*' => 'required|numeric',
            // 'passenger_gender' => 'required|array',
            // 'passenger_gender.*' => 'required|in:Male,Female',
            // 'passenger_pax_price' => 'required|array',
            // 'passenger_pax_price.*' => 'required|numeric',
        ];
    }
}
