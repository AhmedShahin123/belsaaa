<?php

namespace App\Http\Requests\Api\Tasker\Tasker;

use App\Models\TaskRepeatedAttributes;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTaskerRequest extends FormRequest
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
            'available_until' => 'nullable|date_format:Y-m-d',
            'working_days' => ['nullable'],
            'working_days.days' => ['array', 'min:1'],
            'working_days.days.*.weekday' => ['distinct', Rule::in(TaskRepeatedAttributes::WEEKDAYS), 'required'],
            'working_days.days.*.shift_day' => ['boolean', 'required'],
            'working_days.days.*.shift_night' => ['boolean', 'required'],
            'working_days.repeat' => ['boolean', 'required_with:working_days.days'],
            'location.latitude' => ['numeric', 'required_with:location.longitude'],
            'location.longitude' => ['numeric', 'required_with:location.latitude'],
            'first_name' => ['nullable'],
            'last_name' => ['nullable'],
            'email' => ['nullable', 'email', Rule::unique('users')->ignore($this->user()->id)],
            'national_number' => ['nullable'],
            'birth_date' => ['nullable', 'date_format:Y-m-d'],
            'gender' => ['nullable', Rule::in(['male', 'female'])],
            'bio' => ['nullable'],
        ];
    }

    public function getTaskerAttributes()
    {
        return $this->only(['national_number', 'birth_date', 'gender', 'bio', 'available_until']);
    }

    public function getTaskerData()
    {
        $data = $this->only(['first_name', 'last_name', 'email', 'location']);
        $data['attributes'] = $this->getTaskerAttributes();

        return $data;
    }
}
