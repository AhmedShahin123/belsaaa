<?php
/**
 * User: amir
 * Date: 3/3/20
 * Time: 3:04 PM
 */

namespace App\Http\Controllers\Api\Tasker\City;

use App\Http\Controllers\Api\Controller;
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
