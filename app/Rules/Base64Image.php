<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class Base64Image extends Base64File
{
    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @param $parameters
     * @param $validator
     *
     * @return bool
     */
    public function validate(string $attribute, $value, $parameters, $validator): bool
    {
        try {
            $file = $this->convertBase64ToUploadedFile($value);

            Validator::make(['file' => $file], ['file' => 'image:'.implode(',', $parameters)]);

            return true;
        } catch (\Throwable $exception) {
            return false;
        }
    }
}
