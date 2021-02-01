<?php
/**
 * User: amir
 * Date: 7/29/20
 * Time: 11:54 AM
 */

namespace App\Http\Requests\Api\Employer\AssignmentRequestTasker;


use App\Models\AssignmentRequestTasker;
use Illuminate\Foundation\Http\FormRequest;

class RateAssignmentRequestTaskerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return
            isset($this->assignmentRequestTasker) &&
            $this->assignmentRequestTasker instanceof AssignmentRequestTasker &&
            $this->assignmentRequestTasker->canRate($this->user()->id)
        ;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'rate' => ['numeric', 'min:1', 'max:5', 'required'],
            'comment' => ['string', 'nullable'],
        ];
    }
}
