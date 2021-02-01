<?php
/**
 * User: amir
 * Date: 3/24/20
 * Time: 5:06 AM
 */

namespace App\Http\Controllers\Api\Employer\Contact;


use App\Factories\ContactFactory;
use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Api\Common\Contact\SubmitContactRequest;

class SubmitContactController extends Controller
{
    /**
     * @var ContactFactory
     */
    private $factory;

    public function __construct(ContactFactory $factory)
    {
        $this->factory = $factory;
    }

    public function __invoke(SubmitContactRequest $request)
    {
        return $this->factory->create($request->only(['subject', 'email', 'category_id', 'body']));
    }
}
