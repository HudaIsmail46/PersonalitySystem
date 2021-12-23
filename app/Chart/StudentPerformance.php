<?php

namespace App\Chart;

use Illuminate\Support\Facades\DB;

class StudentPerformance
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
       
        $data = [
            'type' => 'bar',
            'data' => [
                'datasets' => [
                    ['data'=> ['300'],
                    'backgroundColor'=> array_pop($colors),
                    'label'=> 'FSKTM',
                    ],
                    ['data'=> ['200'],
                    'backgroundColor'=> array_pop($colors),
                    'label'=> 'FSSS',
                    ],
                    ['data'=> ['450'],
                    'backgroundColor'=> array_pop($colors),
                    'label'=> 'FS',
                    ],
                    ['data'=> ['210'],
                    'backgroundColor'=> array_pop($colors),
                    'label'=> 'APM',
                    ],
                    ['data'=> ['180'],
                    'backgroundColor'=> array_pop($colors),
                    'label'=> 'API',
                    ],
                    ['data'=> ['144'],
                    'backgroundColor'=> array_pop($colors),
                    'label'=> 'FBL',
                    ],
                    ['data'=> ['320'],
                    'backgroundColor'=> array_pop($colors),
                    'label'=> 'FK',
                    ],
                ],
                'labels' => ['Total Respondents']
            ],
            'options' => [
                'responsive' => true,
                'legend' => [
                    'position' => 'top',
                ],
                'animation' => [
                    'animateScale' => true,
                    'animateRotate' => true
                ],
                'scales' => [
                    'xAxes' => [
                        'stacked' => true,
                    ],
                    'yAxes' => [
                        'stacked' => true
                    ]
                ]
            ]
        ];

        return json_encode($data);
    }
}
