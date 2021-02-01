<?php
/**
 * User: amir
 * Date: 3/4/20
 * Time: 6:33 PM
 */

namespace App\Http\Controllers\Backend\Contact;


use App\Factories\ContactCategoryFactory;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\AdminRequest;
use App\Models\ContactCategory;
use App\Repositories\ContactCategoryRepository;

class ContactCategoryController extends Controller
{
    /**
     * @var ContactCategoryRepository
     */
    private $contactCategoryRepository;

    public function __construct(ContactCategoryRepository $contactCategoryRepository)
    {
        $this->contactCategoryRepository = $contactCategoryRepository;
    }

    public function index(AdminRequest $request)
    {
        return view('backend.contact_category.index')
            ->withContactCategories($this->contactCategoryRepository->paginate($request->query->get('size', 25)));
    }

    public function show(AdminRequest $request, ContactCategoryRepository $contactCategoryRepository, $contactCategory)
    {
        $contactCategory = $this->contactCategoryRepository->getById($contactCategory);

        if (!$contactCategory) {
            abort(404);
        }

        return view('backend.contact_category.show')
            ->withContactCategory($contactCategory);
    }

    public function edit(AdminRequest $request, $contactCategory)
    {
        $contactCategory = $this->contactCategoryRepository->getById($contactCategory);
        if (!$contactCategory) {
            abort(404);
        }

        return view('backend.contact_category.edit')
            ->withContactCategory($contactCategory);
    }

    public function update(AdminRequest $request, $contactCategory, ContactCategoryRepository $contactCategoryRepository)
    {
        $contactCategory = $this->contactCategoryRepository->getById($contactCategory);
        if (!$contactCategory) {
            abort(404);
        }

        $contactCategoryRepository->update($contactCategory, ['name' => $request->name]);

        return redirect()->route('admin.contact_category.index')->withFlashSuccess(__('alerts.backend.contact_category.updated'));
    }

    public function create(AdminRequest $request, ContactCategoryFactory $factory)
    {
        return view('backend.contact_category.create')
            ->withContactCategory($factory->initialize());
    }

    public function store(AdminRequest $request, ContactCategoryFactory $factory)
    {
        $contactCategory = $factory->create($request->name);

        return redirect()->route('admin.contact_category.edit', $contactCategory->id);
    }
}
