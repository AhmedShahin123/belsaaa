<?php
/**
 * User: amir
 * Date: 7/29/20
 * Time: 11:54 AM
 */

namespace App\Http\Requests\Api\Tasker\Task;


use App\Models\AssignmentRequestTasker;
use App\Models\Task;
use App\Repositories\TaskRepository;
use Illuminate\Foundation\Http\FormRequest;

class RateTaskRequest extends FormRequest
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
            $taskRepository->getForTaskerSingle($this->user(), $this->task->id) &&
            $this->task->canRate($this->user()->id);
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
