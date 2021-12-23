<?php

namespace App\Chart;

use Illuminate\Support\Facades\DB;

class DimensionScores
{
    public static function config()
    {
        $data = [
            'type'=> 'horizontalBar',            
            'data' => [
                'datasets' => [
                    [
                        "data" => [100,66,78,49,89,103,97,],
                        "backgroundColor" =>'#51e072',
                        "borderColor" => 'rgba(255,255,255,0.5)',
                        "label"=>"Respondent",
                    ],
                ],
                'labels' => ["Integrity ","Emotional Intelligence ","Adaptability ","Mindfulness ","Resilience ","Communication ","Teamwork ",]
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
