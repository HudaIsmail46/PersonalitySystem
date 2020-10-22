<?php

namespace App\Chart;

use Illuminate\Support\Facades\DB;

class WeeklyBooking
{
    public static function config()
    {
        $bookings =  DB::select("select date_part('month',gc_event_begins)
        as event_by_month,
        count(id) as count
        from bookings
        group by date_part('month',gc_event_begins)
        order by event_by_month");

        $result[] = $bookings;
        foreach ($result as $month) {
            $January = $month[0]->count;
            $February = $month[1]->count;
            $March = $month[2]->count;
            $April = $month[3]->count;
            $May = $month[4]->count;
            $June = $month[5]->count;
            $July = $month[6]->count;
            $August = $month[7]->count;
            $September = $month[8]->count;
            $October = $month[9]->count;
            $November = $month[10]->count;
            $December = $month[11]->count;
        }


        $data = [
            'type' => 'line',
            'data' => [
                'labels' => ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                'datasets' => [
                    [
                        'label' => 'My First Dataset',
                        'backgroundColor' => 'rgb(75, 192, 192)',
                        'borderColor' => 'rgb(75, 192, 192)',
                        'data' => [
                            $January,
                            $February,
                            $March,
                            $April,
                            $May,
                            $June,
                            $July,
                            $August,
                            $September,
                            $October,
                            $November,
                            $December
                        ],
                        'fill' => false,
                    ]
                ],
                'options' => [
                    'responsive' => true,
                    'title' => [
                        'display' => true,
                        'text' => 'Monthly Boooking by Month and Year'
                    ],
                    'tooltips' => [
                        'mode' => 'index',
                        'intersect' => false,
                    ],
                    'hover' => [
                        'mode' => 'nearest',
                        'intersect' => true
                    ],
                    'scales' => [
                        'xAxes' => [[
                            'display' => true,
                            'scaleLabel' => [
                                'display' => true,
                                'labelString' => 'Month'
                            ]
                        ]],
                        'yAxes' => [[
                            'display' => true,
                            'scaleLabel' => [
                                'display' => true,
                                'labelString' => 'Value'
                            ]
                        ]]
                    ]
                ]
            ]
        ];
        return json_encode($data);
    }
}
