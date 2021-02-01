<?php
/**
 * User: amir
 * Date: 3/4/20
 * Time: 6:33 PM
 */

namespace App\Http\Controllers\Backend\Skill;


use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\AdminRequest;
use App\Repositories\SkillRepository;

class SkillController extends Controller
{
    /**
     * @var SkillRepository
     */
    private $skillRepository;

    public function __construct(SkillRepository $skillRepository)
    {
        $this->skillRepository = $skillRepository;
    }

    public function index(AdminRequest $request)
    {
        return view('backend.skill.index')
            ->withSkills($this->skillRepository->paginate($request->query->get('size', 25)));
    }

    public function show(AdminRequest $request, SkillRepository $skillRepository, $skill)
    {
        $skill = $this->skillRepository->getById($skill);

        if (!$skill) {
            abort(404);
        }

        return view('backend.skill.show')
            ->withSkill($skill);
    }

    public function edit(AdminRequest $request, $skill)
    {
        $skill = $this->skillRepository->getById($skill);
        if (!$skill) {
            abort(404);
        }

        return view('backend.skill.edit')
            ->withSkill($skill);
    }

    public function update(AdminRequest $request, $skill, SkillRepository $skillRepository)
    {
        $skill = $this->skillRepository->getById($skill);
        if (!$skill) {
            abort(404);
        }

        $skillRepository->update($skill, ['name' => $request->name]);

        return redirect()->route('admin.skill.index')->withFlashSuccess(__('alerts.backend.skill.updated'));
    }
}
