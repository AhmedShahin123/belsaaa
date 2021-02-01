<?php
/**
 * User: amir
 * Date: 8/4/20
 * Time: 5:41 PM
 */

namespace App\Http\Requests\Backend\Invoice;


use App\Http\Requests\Backend\AdminRequest;
use Illuminate\Validation\Rule;

class PayEmployerCommissionRequest extends AdminRequest
{
    public function rules()
    {
        return [
            'before_invoice_id' => [
                Rule::exists('invoices', 'id')->where('employer_id', $this->employer->id),
                'required',
            ],
            'amount' => [
                'required',
                'numeric',
            ]
        ];
    }
}
