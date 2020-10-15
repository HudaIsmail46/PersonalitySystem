<?php

namespace App\Chart;
use App\Booking;

class WeeklyBooking
{
    public static function config()
    {
        $data = [
            'type'=> 'line',
            'data'=> [
                'labels'=> ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                'datasets'=> [[
                    'label'=> 'My First dataset',
                    'backgroundColor'=> 'rgb(75, 192, 192)',
                    'borderColor'=> 'rgb(75, 192, 192)',
                    'data'=> [
                        10,
                        20,
                        40,
                        10,
                        70,
                        20,
                        10
                    ],
                    'fill'=> false,
                ]],
            'options'=> [
                'responsive'=> true,
                'title'=> [
                    'display'=> true,
                    'text'=> 'Chart.js Line Chart'
                ],
                'tooltips'=> [
                    'mode'=> 'index',
                    'intersect'=> false,
                ],
                'hover'=> [
                    'mode'=> 'nearest',
                    'intersect'=> true
                ],
                'scales'=> [
                    'xAxes'=> [[
                        'display'=> true,
                        'scaleLabel'=> [
                            'display'=> true,
                            'labelString'=> 'Month'
                        ]
                    ]],
                    'yAxes'=> [[
                        'display'=> true,
                        'scaleLabel'=> [
                            'display'=> true,
                            'labelString'=> 'Value'
                        ]
                    ]]
                ]
            ]
        ]];
        return json_encode($data);
    }
}