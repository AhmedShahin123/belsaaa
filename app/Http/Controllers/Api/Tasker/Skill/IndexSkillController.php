<?php

namespace App\Http\Controllers\Api\Tasker\Skill;

use App\Http\Controllers\Controller;
use App\Repositories\SkillRepository;
use Illuminate\Http\Request;

class IndexSkillController extends Controller
{
    /**
     * @var SkillRepository
     */
    private $skillRepository;

    public function __construct(SkillRepository $skillRepository)
    {
        $this->skillRepository = $skillRepository;
    }

    public function __invoke()
    {
        return $this->skillRepository->paginate();
    }
}
