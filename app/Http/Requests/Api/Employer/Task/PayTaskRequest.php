<?php

namespace App\Http\Requests\Api\Employer\Task;

use App\Models\AssignmentRequestTasker;
use App\Models\CreditCard;
use App\Models\Invoice;
use App\Models\Task;
use App\Repositories\CreditCardRepository;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PayTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {

        return
            isset($this->task) &&
            $this->task instanceof Task &&
            $this->user()->id == $this->task->employer->id &&
            !$this->task->tasker_amount_paid
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
            'payment_type' => [Rule::in(Invoice::PAYMENT_TYPES), 'required'],
            'credit_card_id' => [
                'required_if:payment_type,online',
                Rule::exists('credit_cards', 'id')->where('user_id', $this->user()->id)
            ],
        ];
    }

    public function paymentType()
    {
        return $this->validated()['payment_type'];
    }

    public function creditCard(): ?CreditCard
    {
        if ($this->paymentType() === 'cash') {
            return null;
        }

        return app(CreditCardRepository::class)->getById($this->validated()['credit_card_id']);
    }
}
