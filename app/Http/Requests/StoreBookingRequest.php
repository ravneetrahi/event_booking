<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Assuming no authentication or authorization is required for now
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
            'event_id' => 'required|exists:events,id',
            'attendee_id' => 'required|exists:attendees,id',
        ];
    }

    /**
     * Customize the error messages for the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'event_id.required' => 'The event ID is required.',
            'event_id.exists' => 'The specified event does not exist.',
            'attendee_id.required' => 'The attendee ID is required.',
            'attendee_id.exists' => 'The specified attendee does not exist.',
        ];
    }
}
