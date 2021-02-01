<?php
/**
 * User: amir
 * Date: 2/1/20
 * Time: 10:41 PM
 */

namespace App\Repositories;

use App\Factories\PaymentFactory;
use App\Models\Auth\User;
use App\Models\CreditCard;
use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use Webmozart\Assert\Assert;

class InvoiceRepository extends BaseRepository
{
    /**
     * @var PaymentFactory
     */
    private $paymentFactory;

    public function __construct(Invoice $model, PaymentFactory $paymentFactory)
    {
        $this->model = $model;
        $this->paymentFactory = $paymentFactory;
    }

    public function paginateByEmployer(User $user)
    {
        Assert::eq('employer', $user->user_type);

        return $this->model->newQuery()->employerId($user->id)->paginate();
    }

    public function paginateByTasker(User $user)
    {
        Assert::eq('tasker', $user->user_type);

        return $this->model->newQuery()->taskerId($user->id)->paginate();
    }

    public function payTaskerAmount(Invoice $invoice)
    {
        $invoice->update(['tasker_amount_paid' => true]);
    }

    public function clearTaskerAmount(Invoice $invoice)
    {
        $invoice->update(['tasker_amount_cleared' => true]);
    }

    public function payCommission(Invoice $invoice)
    {
        $invoice->update(['commission_paid' => true]);
    }

    public function updatePaymentType(Invoice $invoice, $paymentType)
    {
        Assert::oneOf($paymentType, Invoice::PAYMENT_TYPES);
        $invoice->update(['payment_type' => $paymentType]);
    }

    public function payEmployerCommission(User $user, int $beforeInvoiceId = null, float $amount = null)
    {
        $query = $user->employer_commission_not_paid_invoices()->getQuery();

        if ($beforeInvoiceId) {
            $query->where('id', '<=', $beforeInvoiceId);
        }

        $query->lockForUpdate();

        if ($amount) {
            if ($query->sum('commission') != $amount) {
                throw new \LogicException();
            }
        }

        $query->update(['commission_paid' => true]);
    }

    public function clearAllTaskerAmounts(User $user, int $beforeInvoiceId = null, float $amount = null)
    {
        $query = $user->tasker_invoices_not_cleared()->online()->getQuery();

        if ($beforeInvoiceId) {
            $query->where('id', '<=', $beforeInvoiceId);
        }

        $query->lockForUpdate();
        if ($amount) {
            if ($query->sum('tasker_amount') != $amount) {
                throw new \LogicException();
            }
        }

        $query->update(['tasker_amount_cleared' => true]);
    }
}
