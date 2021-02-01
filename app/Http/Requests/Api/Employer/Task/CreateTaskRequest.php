<?php

namespace App\Http\Requests\Api\Employer\Task;

use App\Models\Task;
use App\Models\TaskRepeatedAttributes;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->method() === 'POST' || (isset($this->task) && $this->task instanceof Task);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'hour_rate' => ['required', 'integer', function($attribute, $value, $fail) {
                $minHourRate = (int) setting('minimum_hour_rate');

                if ($value < $minHourRate) {
                    $fail('Hour rate must not be lower than '.$minHourRate);
                }
            }],
            'required_tasker_number' => ['required', 'integer'],
            'required_tasker_gender' => [Rule::in(['male', 'female'])],
            'task_type' => [Rule::in(Task::TASK_TYPES), 'required'],
            'latitude' => ['numeric', 'required'],
            'longitude' => ['numeric', 'required'],
        ];

        $rules = array_merge($rules, $this->oneTimeTaskRules());
        $rules = array_merge($rules, $this->repeatedTaskRules());
        $rules = array_merge($rules, $this->continuedTaskRules());

        return $rules;
    }

    protected function oneTimeTaskRules()
    {
        return [
            'one_time_start_date' => ['date_format:Y-m-d', 'required_if:task_type,one_time'],
            'one_time_start_time' => ['date_format:H:i', 'required_if:task_type,one_time', function($attribute, $value, $fail) {
                try {
                    $startAt = Carbon::createFromFormat('Y-m-d H:i:s', $this->one_time_start_date.' '.$value.':00');

                    if ($startAt < Carbon::now()) {
                        $fail('Start date and time must not before now');
                    }
                } catch (\Throwable $exception) {
                    $fail('Invalid start date or time');
                }
            }],
            'one_time_end_time' => ['date_format:H:i', 'required_if:task_type,one_time'],
        ];
    }

    protected function repeatedTaskRules()
    {
        return [
            'repeated_days' => ['array', 'min:1', 'required_if:task_type,repeated'],
            'repeated_days.*.weekday' => ['distinct', Rule::in(TaskRepeatedAttributes::WEEKDAYS), 'required'],
            'repeated_days.*.start_time' => ['date_format:H:i:s', 'required'],
            'repeated_days.*.end_time' => ['date_format:H:i:s', 'required'],
            'repeated_repeat' => ['boolean', 'required_if:task_type,repeated'],
        ];
    }

    protected function continuedTaskRules()
    {
        return [
            'continued_start_at' => ['required_if:task_type,continued', 'date_format:Y-m-d H:i:s'],
            'continued_daily_duration' => ['required_if:task_type,continued', 'integer'],
            'continued_end_date' => ['required_if:task_type,continued', 'date_format:Y-m-d'],
        ];
    }

    public function taskAttributes()
    {
        $taskType = $this->has('task_type') ? $this->get('task_type') : $this->task->task_type;
        switch ($taskType) {
            case 'one_time':
                return $this->oneTimeAttributes();
            case 'repeated':
                return $this->repeatedAttributes();
            case 'continued':
                return $this->continuedAttributes();
            default:
                throw new \InvalidArgumentException();
        }
    }

    protected function oneTimeAttributes()
    {
        $data = $this->only(['one_time_start_date', 'one_time_start_time', 'one_time_end_time']);

        $oneTimeAttributes = [];
        foreach ($data as $key => $value) {
            $oneTimeAttributes[substr($key, 9)] = $value;
        }

        return $oneTimeAttributes;
    }

    protected function repeatedAttributes()
    {
        $data = $this->only(['repeated_days', 'repeated_repeat']);

        $oneTimeAttributes = [];
        foreach ($data as $key => $value) {
            $oneTimeAttributes[substr($key, 9)] = $value;
        }

        return $oneTimeAttributes;
    }

    protected function continuedAttributes()
    {
        $data = $this->only(['continued_start_at', 'continued_daily_duration', 'continued_end_date']);

        $oneTimeAttributes = [];
        foreach ($data as $key => $value) {
            $oneTimeAttributes[substr($key, 10)] = $value;
        }

        return $oneTimeAttributes;
    }

    public function messages()
    {
        return [

        ];
    }
}
