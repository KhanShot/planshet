<?php

namespace App\Http\Requests;

use App\Http\Traits\TJsonResponse;
use Illuminate\Foundation\Http\FormRequest;

class VideoEndRequest extends FormRequest
{
    use TJsonResponse;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'video_name' => 'required|exists:ad_videos,name',
            'mac_address' => 'required|exists:tablets,mac_address',
            'time' => 'required|date',
        ];
    }
}
