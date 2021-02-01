<?php

namespace App\Http\Requests\Api\Common\Device;

use Illuminate\Foundation\Http\FormRequest;

abstract class RegisterDeviceRequest extends FormRequest
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
            'device_id' => 'required',
            'fcm_token' => 'required',
        ];
    }

    public function validated()
    {
        $data = parent::validated();

        $data = [
            'device_id' => $data['device_id'],
            'fcm_token' => $data['fcm_token'],
            'owner_type' => $this->getOwnerType(),
        ];

        if ($this->user()) {
            $data['owner_id'] = $this->user()->id;
        }

        $data['language'] = 'ar';
        if ($this->headers->has('Accept-Language')) {
            $lang = $this->headers->get('Accept-language');
            if (in_array($lang, ['ar', 'en'])) {
                $data['language'] = $lang;
            }
        }

        return $data;
    }

    abstract protected function getOwnerType(): string;
}
