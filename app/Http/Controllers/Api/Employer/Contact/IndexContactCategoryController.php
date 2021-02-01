<?php
/**
 * User: amir
 * Date: 3/3/20
 * Time: 3:04 PM
 */

namespace App\Http\Controllers\Api\Employer\Contact;

use App\Http\Controllers\Api\Controller;
use App\Repositories\ContactCategoryRepository;
use Illuminate\Http\Request;

class IndexContactCategoryController extends Controller
{
    /**
     * @var ContactCategoryRepository
     */
    private $contactCategoryRepository;

    public function __construct(ContactCategoryRepository $contactCategoryRepository)
    {
        $this->contactCategoryRepository = $contactCategoryRepository;
    }

    public function __invoke(Request $request)
    {
        return $this->contactCategoryRepository->paginate($request->query('size', 25));
    }
}
