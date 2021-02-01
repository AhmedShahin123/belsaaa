<?php

namespace App\Http\Requests\Backend\Task;

use App\Http\Requests\Api\Employer\Task\CreateTaskRequest;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends CreateTaskRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return parent::authorize() && $this->user()->isAdmin();
    }

    public function rules()
    {
        $rules = parent::rules();

        $rules['active'] = ['required', 'boolean'];
        unset($rules['task_type']);
        unset($rules['city_id']);

        return $rules;
    }

    protected function oneTimeTaskRules()
    {
        $rules = parent::oneTimeTaskRules();
        unset($rules['one_time_start_at']);
        $rules['one_time_start_date'] = ['date_format:Y-m-d', 'required_if:task_type,one_time'];
        $rules['one_time_start_time'] = ['required_if:task_type,one_time'];

        return $rules;
    }

    protected function repeatedTaskRules()
    {
        $rules = parent::repeatedTaskRules();

        $rules['repeated_days.*.start_time'] = ['date_format:H:i', 'required'];
        $rules['repeated_days.*.end_time'] = ['date_format:H:i', 'required'];

        return $rules;
    }

    protected function oneTimeAttributes()
    {
        $data = $this->only(['one_time_start_date', 'one_time_start_time', 'one_time_end_time']);

        $oneTimeAttributes = [];
        foreach ($data as $key => $value) {
            $oneTimeAttributes[substr($key, 9)] = $value;
        }

        $startAt = Carbon::createFromFormat('Y-m-d H:i', $oneTimeAttributes['start_date'].' '.$oneTimeAttributes['start_time'], 'Asia/Riyadh');
        $endAt = Carbon::createFromFormat('Y-m-d H:i', $oneTimeAttributes['start_date'].' '.$oneTimeAttributes['end_time'], 'Asia/Riyadh');
        $startAt->setTimezone('UTC');
        $endAt->setTimezone('UTC');

        return [
            'start_date' => $startAt->format('Y-m-d'),
            'start_time' => ($startAt->format('Y-m-d') == $endAt->format('Y-m-d')) ? $startAt->format('H:i') : '00:00',
            'end_time' => $endAt->format('H:i'),
        ];
    }

    protected function continuedTaskRules()
    {
        $rules = parent::continuedTaskRules();
        unset($rules['continued_start_at']);
        $rules['continued_start_date'] = ['date_format:Y-m-d', 'required_if:task_type,continued', 'before:continued_end_date'];
        $rules['continued_start_time'] = ['required_if:task_type,continued'];

        return $rules;
    }

    protected function continuedAttributes()
    {
        $data = $this->only(['continued_start_date', 'continued_start_time', 'continued_daily_duration', 'continued_end_date']);

        $oneTimeAttributes = [];
        foreach ($data as $key => $value) {
            $oneTimeAttributes[substr($key, 10)] = $value;
        }

        $oneTimeAttributes['start_at'] = $oneTimeAttributes['start_date'].' '.$oneTimeAttributes['start_time'];
        unset($oneTimeAttributes['start_date']);
        unset($oneTimeAttributes['start_time']);

        if (count(explode(':', $oneTimeAttributes['start_at'])) != 3) {
            $oneTimeAttributes['start_at'] .= ':00';
        }

        return $oneTimeAttributes;
    }
}
