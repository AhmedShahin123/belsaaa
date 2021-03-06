<?php

namespace App\Http\Requests\Api\Employer\AssignmentRequestTasker;

use App\Models\AssignmentRequestTasker;
use Illuminate\Foundation\Http\FormRequest;

class AcceptAssignmentRequestTaskerRequest extends FormRequest
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
            $this->user()->id == $this->assignmentRequestTasker->task->employer->id &&
            $this->assignmentRequestTasker->can('employer_accept')
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
            //
        ];
    }
}
