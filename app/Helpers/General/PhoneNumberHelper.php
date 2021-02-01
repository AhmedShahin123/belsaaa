<?php
/**
 * User: amir
 * Date: 1/30/20
 * Time: 12:52 PM
 */

namespace App\Helpers\General;


use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumberFormat;

class PhoneNumberHelper
{
    public function normalizeCellphone($phone)
    {
        $phone = (array) $phone;

        return array_map(function ($value) {
            try {
                return phone($value, ['SA', 'IR'], PhoneNumberFormat::E164);
            } catch (NumberParseException $exception) {
                return $value;
            }
        }, $phone);
    }
}
