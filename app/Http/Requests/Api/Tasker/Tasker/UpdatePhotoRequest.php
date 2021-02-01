<?php

namespace App\Http\Requests\Api\Tasker\Tasker;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePhotoRequest extends FormRequest
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
            'photo' => ['image', 'required_without:photo_base64'],
            'photo_base64'  => ['required_without:photo', 'base64_image']
        ];
    }

    public function photo()
    {
        return $this->photo ?? $this->photo_base64;
    }
}
