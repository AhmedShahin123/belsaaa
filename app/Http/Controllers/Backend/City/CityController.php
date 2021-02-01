<?php
/**
 * User: amir
 * Date: 3/4/20
 * Time: 6:33 PM
 */

namespace App\Http\Controllers\Backend\City;


use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\AdminRequest;
use App\Repositories\CityRepository;

class CityController extends Controller
{
    /**
     * @var CityRepository
     */
    private $cityRepository;

    public function __construct(CityRepository $cityRepository)
    {
        $this->cityRepository = $cityRepository;
    }

    public function index(AdminRequest $request)
    {
        return view('backend.city.index')
            ->withCities($this->cityRepository->paginate($request->query->get('size', 25)));
    }

    public function show(AdminRequest $request, CityRepository $cityRepository, $city)
    {
        $city = $this->cityRepository->getById($city);

        if (!$city) {
            abort(404);
        }

        return view('backend.city.show')
            ->withCity($city);
    }

    public function edit(AdminRequest $request, $city)
    {
        $city = $this->cityRepository->getById($city);
        if (!$city) {
            abort(404);
        }

        return view('backend.city.edit')
            ->withCity($city);
    }

    public function update(AdminRequest $request, $city, CityRepository $cityRepository)
    {
        $this->validate($request, ['name' => 'required']);
        $city = $this->cityRepository->getById($city);
        if (!$city) {
            abort(404);
        }

        $cityRepository->update($city, ['name' => $request->name]);

        return redirect()->route('admin.city.index')->withFlashSuccess(__('alerts.backend.city.updated'));
    }
}
