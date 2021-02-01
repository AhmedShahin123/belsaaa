<?php

namespace App\Http\Controllers\Api\Employer\City;

use App\Http\Controllers\Controller;
use App\Repositories\CityRepository;
use Illuminate\Http\Request;

class IndexCityController extends Controller
{
    /**
     * @var CityRepository
     */
    private $cityRepository;

    public function __construct(CityRepository $cityRepository)
    {
        $this->cityRepository = $cityRepository;
    }

    public function __invoke(Request $request)
    {
        return $this->cityRepository->paginate($request->query('size', 25));
    }
}
