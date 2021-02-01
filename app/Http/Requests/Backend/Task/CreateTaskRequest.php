<?php
/**
 * User: amir
 * Date: 4/16/20
 * Time: 7:23 PM
 */

namespace App\Http\Requests\Backend\Task;


use App\Models\Task;

class CreateTaskRequest extends ManageTaskRequest
{
    public function authorize()
    {
        return parent::authorize() && in_array($this->query('task_type'), Task::TASK_TYPES);
    }
}
