<?php

namespace App\Http\Requests;

use App\Http\Traits\TJsonResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TabletsModeRequest extends FormRequest
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
            'status' => 'required|'. Rule::in(['on', 'off']),
            'time' => 'date|required',
            'mac_address' => 'required|string',
        ];
    }
}
