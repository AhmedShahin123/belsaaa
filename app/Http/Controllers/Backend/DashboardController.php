<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Repositories\TaskRepository;

/**
 * Class DashboardController.
 *
 * @TODO refactor this class, this class has many duplicated codes
 */
class DashboardController extends Controller
{
    /**
     * @var TaskRepository
     */
    private $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {

        return view('backend.dashboard')->with([
            'tasksChartData' => $this->tasksByStatus(),
            'lastWeekTasks' => $this->lastWeekTasks(),
            'lastMonthTasks' => $this->lastMonthTasks(),
            'lastYearTasks' => $this->lastYearTasks(),
        ]);
    }

    private function lastWeekTasks()
    {
        $initiateTasks = $this->taskRepository->lastWeekTasks('initiate');
        $selectedByTaskerTasks = $this->taskRepository->lastWeekTasks('selected_by_tasker');
        $selectedByEmployerTasks = $this->taskRepository->lastWeekTasks('selected_by_employer');
        $startedTasks = $this->taskRepository->lastWeekTasks('started');
        $finishedTasks = $this->taskRepository->lastWeekTasks('finished');
        $canceledTasks = $this->taskRepository->lastWeekTasks('canceled');

        $data = [
            "datasets" => [
                [
                    'label' => 'initiate',
                    'data' => [],
                    'borderColor' => 'red',
                ],
                [
                    'label' => 'selected by tasker',
                    'data' => [],
                    'borderColor' => 'yellow',
                ],
                [
                    'label' => 'selected by employer',
                    'data' => [],
                    'borderColor' => 'green',
                ],
                [
                    'label' => 'started',
                    'data' => [],
                    'borderColor' => 'gray',
                ],
                [
                    'label' => 'finished',
                    'data' => [],
                    'borderColor' => 'black',
                ],
                [
                    'label' => 'canceled',
                    'data' => [],
                    'borderColor' => 'pink',
                ]
            ],
            "labels" => [],
        ];
        for ($i = 0; $i < 7; $i++) {
            $data['datasets'][0]['data'][] = $initiateTasks[$i]->total;
            $data['datasets'][1]['data'][] = $selectedByTaskerTasks[$i]->total;
            $data['datasets'][2]['data'][] = $selectedByEmployerTasks[$i]->total;
            $data['datasets'][3]['data'][] = $startedTasks[$i]->total;
            $data['datasets'][4]['data'][] = $finishedTasks[$i]->total;
            $data['datasets'][5]['data'][] = $canceledTasks[$i]->total;
            $data['labels'][] = $initiateTasks[$i]->date;
        }

        return $data;
    }

    private function lastMonthTasks()
    {
        $initiateTasks = $this->taskRepository->lastMonthTasks('initiate');
        $selectedByTaskerTasks = $this->taskRepository->lastMonthTasks('selected_by_tasker');
        $selectedByEmployerTasks = $this->taskRepository->lastMonthTasks('selected_by_employer');
        $startedTasks = $this->taskRepository->lastMonthTasks('started');
        $finishedTasks = $this->taskRepository->lastMonthTasks('finished');
        $canceledTasks = $this->taskRepository->lastMonthTasks('canceled');

        $data = [
            "datasets" => [
                [
                    'label' => 'initiate',
                    'data' => [],
                    'borderColor' => 'red',
                ],
                [
                    'label' => 'selected by tasker',
                    'data' => [],
                    'borderColor' => 'yellow',
                ],
                [
                    'label' => 'selected by employer',
                    'data' => [],
                    'borderColor' => 'green',
                ],
                [
                    'label' => 'started',
                    'data' => [],
                    'borderColor' => 'gray',
                ],
                [
                    'label' => 'finished',
                    'data' => [],
                    'borderColor' => 'black',
                ],
                [
                    'label' => 'canceled',
                    'data' => [],
                    'borderColor' => 'pink',
                ]
            ],
            "labels" => [],
        ];
        for ($i = 0; $i < count($initiateTasks); $i++) {
            $data['datasets'][0]['data'][] = $initiateTasks[$i]->total;
            $data['datasets'][1]['data'][] = $selectedByTaskerTasks[$i]->total;
            $data['datasets'][2]['data'][] = $selectedByEmployerTasks[$i]->total;
            $data['datasets'][3]['data'][] = $startedTasks[$i]->total;
            $data['datasets'][4]['data'][] = $finishedTasks[$i]->total;
            $data['datasets'][5]['data'][] = $canceledTasks[$i]->total;
            $data['labels'][] = $initiateTasks[$i]->date;
        }

        return $data;
    }

    private function lastYearTasks()
    {
        $initiateTasks = $this->taskRepository->lastYearTasks('initiate');
        $selectedByTaskerTasks = $this->taskRepository->lastYearTasks('selected_by_tasker');
        $selectedByEmployerTasks = $this->taskRepository->lastYearTasks('selected_by_employer');
        $startedTasks = $this->taskRepository->lastYearTasks('started');
        $finishedTasks = $this->taskRepository->lastYearTasks('finished');
        $canceledTasks = $this->taskRepository->lastYearTasks('canceled');

        $data = [
            "datasets" => [
                [
                    'label' => 'initiate',
                    'data' => [],
                    'borderColor' => 'red',
                ],
                [
                    'label' => 'selected by tasker',
                    'data' => [],
                    'borderColor' => 'yellow',
                ],
                [
                    'label' => 'selected by employer',
                    'data' => [],
                    'borderColor' => 'green',
                ],
                [
                    'label' => 'started',
                    'data' => [],
                    'borderColor' => 'gray',
                ],
                [
                    'label' => 'finished',
                    'data' => [],
                    'borderColor' => 'black',
                ],
                [
                    'label' => 'canceled',
                    'data' => [],
                    'borderColor' => 'pink',
                ]
            ],
            "labels" => [],
        ];
        for ($i = 0; $i < count($initiateTasks); $i++) {
            $data['datasets'][0]['data'][] = $initiateTasks[$i]->total;
            $data['datasets'][1]['data'][] = $selectedByTaskerTasks[$i]->total;
            $data['datasets'][2]['data'][] = $selectedByEmployerTasks[$i]->total;
            $data['datasets'][3]['data'][] = $startedTasks[$i]->total;
            $data['datasets'][4]['data'][] = $finishedTasks[$i]->total;
            $data['datasets'][5]['data'][] = $canceledTasks[$i]->total;
            $data['labels'][] = $initiateTasks[$i]->date;
        }

        return $data;
    }

    private function tasksByStatus()
    {
        $tasksByStatus = $this->taskRepository->groupByStatusCount();

        $counts = [];
        $labels = [];

        foreach ($tasksByStatus as $status) {
            $counts[] = $status->task_count;
            $labels[] = $status->status;
        }

        return [
            "datasets" => [["data" => $counts]],
            "labels" => $labels,
        ];
    }
}
