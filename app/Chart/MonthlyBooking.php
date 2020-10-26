<?php

namespace App\Chart;

use Illuminate\Support\Facades\DB;

class MonthlyBooking
{
    public static function config()
    {
        $colors = [
            'rgb(54, 162, 235)',
            'rgb(75, 192, 192)',
            'rgb(201, 203, 207)',
            'rgb(255, 159, 64)',
            'rgb(153, 102, 255)',
            'rgb(255, 99, 132)',
            'rgb(255, 205, 86)',
            'rgb(150, 170, 0)',
            'rgb(150, 37, 51)',
            'rgb(150, 249, 51)'
        ];

        $bookings =  DB::select("select date_part('month',gc_event_begins) as month, 
            date_part('year',gc_event_begins) as year, 
            count(id) as count
            from bookings
            group by month, year
            order by year, month");

        $years =  [];
        foreach($bookings as $booking){
            array_push($years, $booking->year);
        }

        $years = array_unique($years);

        $datasets = [];
        foreach($years as $year) {
            $months = [];
            $index = 0;
            foreach($bookings as $booking){
                if($booking->year == $year)
                {
                    $months[$booking->month] = $booking->count;
                }
            }
            $color = array_pop($colors);
            $dataset = [
                'label' => $year,
                'backgroundColor' => $color,
                'borderColor' => $color,
                'data' => [
                    array_key_exists(1, $months) ? $months[1] : null,
                    array_key_exists(2, $months) ? $months[2] : null,
                    array_key_exists(3, $months) ? $months[3] : null,
                    array_key_exists(4, $months) ? $months[4] : null,
                    array_key_exists(5, $months) ? $months[5] : null,
                    array_key_exists(6, $months) ? $months[6] : null,
                    array_key_exists(7, $months) ? $months[7] : null,
                    array_key_exists(8, $months) ? $months[8] : null,
                    array_key_exists(9, $months) ? $months[9] : null,
                    array_key_exists(10, $months) ? $months[10] : null,
                    array_key_exists(11, $months) ? $months[11] : null,
                    array_key_exists(12, $months) ? $months[12] : null
                ],
                'fill' => false,
            ];
            array_push($datasets, $dataset);
        }
        

        $data = [
            'type' => 'line',
            'data' => [
                'labels' => ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                'datasets' => $datasets,
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
