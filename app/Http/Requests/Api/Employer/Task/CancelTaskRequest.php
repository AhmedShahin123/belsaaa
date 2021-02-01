<?php

namespace App\Http\Requests\Api\Employer\Task;

use App\Models\AssignmentRequestTasker;
use App\Models\Task;
use App\Repositories\TaskRepository;
use Illuminate\Foundation\Http\FormRequest;

class CancelTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        /** @var TaskRepository $taskRepository */
        $taskRepository = app(TaskRepository::class);

        return isset($this->task) &&
            $this->task instanceof Task &&
            $taskRepository->getForEmployerSingle($this->user(), $this->task->id) &&
            $this->task->can_cancel();
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
