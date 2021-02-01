<?php

namespace App\Http\Requests\Api\Tasker\BankAccount;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateBankAccountRequest extends FormRequest
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
            'iban' => ['required', 'string', Rule::unique('tasker_bank_accounts', 'iban')->where(function ($query) {
                return $query->where('tasker_attributes_id', $this->user()->user_attributes->id);
            })],
            'bank_name' => 'required|string',
        ];
    }
}
