<?php
/**
 * User: amir
 * Date: 3/24/20
 * Time: 5:04 AM
 */

namespace App\Http\Requests\Api\Common\Contact;


use Illuminate\Foundation\Http\FormRequest;

class SubmitContactRequest extends FormRequest
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
            'subject' => 'required|string',
            'body' => 'required|string',
            'email' => 'required|email',
            'category_id' => 'exists:contact_categories,id'
        ];
    }
}
