<?php

namespace App\Http\Requests;

use App\Modules\Http\RestApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use App\Exceptions\InvalidRequestArgsException;

class GetTopRequest extends FormRequest
{
    use RestApiResponse;

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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'date' => 'required|date_format:Y-m-d|before:today'
        ];
    }

    /**
     * @throws InvalidRequestArgsException
     */
    public function failedValidation(Validator $validator)
    {
        $this->response['errors'] = $validator->errors();
        $this->response['message'] = $validator->errors()->first();
        throw new InvalidRequestArgsException($this->response);
    }


}
