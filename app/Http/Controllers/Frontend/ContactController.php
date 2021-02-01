<?php

namespace App\Http\Controllers\Frontend;

use App\Factories\ContactFactory;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Contact\SendContactRequest;
use App\Mail\Frontend\Contact\SendContact;
use App\Repositories\ContactCategoryRepository;
use Illuminate\Support\Facades\Mail;

/**
 * Class ContactController.
 */
class ContactController extends Controller
{
    /**
     * @param ContactCategoryRepository $contactCategoryRepository
     * @return \Illuminate\View\View
     */
    public function index(ContactCategoryRepository $contactCategoryRepository)
    {
        $categories = $contactCategoryRepository->allForOptions();

        return view('frontend.contact')->withContactCategories($categories);
    }

    /**
     * @param SendContactRequest $request
     *
     * @return mixed
     */
    public function send(SendContactRequest $request, ContactFactory $contactFactory)
    {
        $contactFactory->create($request->validated());

        return redirect()->back()->withFlashSuccess(__('alerts.frontend.contact.sent', [], 'ar'));
    }
}
