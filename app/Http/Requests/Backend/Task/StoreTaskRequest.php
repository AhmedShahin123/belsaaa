<?php
/**
 * User: amir
 * Date: 4/17/20
 * Time: 1:38 AM
 */

namespace App\Http\Requests\Backend\Task;

use App\Models\Task;
use Illuminate\Validation\Rule;

class StoreTaskRequest extends UpdateTaskRequest
{
    public function authorize()
    {
        return $this->user()->isAdmin();
    }

    public function rules()
    {
        $rules = parent::rules();

        $rules['latitude'] = ['required'];
        $rules['longitude'] = ['required'];
        $rules['task_type'] = [Rule::in(Task::TASK_TYPES), 'required'];
        $rules['employer_id'] = ['required', 'exists:users,id'];

        return $rules;
    }
}
