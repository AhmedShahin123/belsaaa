<?php
/**
 * User: amir
 * Date: 2/13/20
 * Time: 5:03 PM
 */

namespace App\Factories;


use App\Models\TaskRepeatedAttributes;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Webmozart\Assert\Assert;

class TaskRepeatedAttributesFactory
{
    /**
     * @var TaskRepeatedDayFactory
     */
    private $dayFactory;

    public function __construct(TaskRepeatedDayFactory $dayFactory)
    {
        $this->dayFactory = $dayFactory;
    }

    public function create(array $data)
    {
        Assert::keyExists($data, 'days');
        Assert::keyExists($data, 'repeat');

        $startDate = Carbon::now();
        if ($data['repeat']) {
            $endDate = Carbon::now()->addWeeks(8)->subDay();
        } else {
            $endDate = Carbon::now()->addWeek()->subDay();
        }

        $attributes = $this->initialize([
            'start_date' => $startDate,
            'end_date' => $endDate,
            'repeat' => $data['repeat'],
        ]);

        $attributes->save();

        $daysPerWeekday = array_reduce($data['days'], function ($carry, $day) {
            $carry[$day['weekday']] = $day;

            return $carry;
        }, []);
        $period = CarbonPeriod::create($startDate, $endDate);

        /** @var Carbon $date */
        foreach ($period as $date) {
            $weekday = strtolower($date->englishDayOfWeek);
            if (!\array_key_exists($weekday, $daysPerWeekday)) {
                continue;
            }
            $this->dayFactory->create([
                'date' => $date->format('Y-m-d'),
                'weekday' => $weekday,
                'start_time' => $daysPerWeekday[$weekday]['start_time'],
                'end_time' => $daysPerWeekday[$weekday]['end_time'],
            ], $attributes);
        }

        return $attributes;
    }

    public function initialize(array $data = [])
    {
        $attributes = new TaskRepeatedAttributes();
        $attributes->fill($data);

        return $attributes;
    }
}
