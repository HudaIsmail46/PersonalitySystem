<?php

namespace App\Chart;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TodayTeamSales
{
    public static function today_team_sales(){
        $today_team_sales = DB::select("select count(*), agents.fullname as team, sum(price/100) as sum
        from bookings
        join agent_assignments on agent_assignments.booking_id = bookings.id
        join agents on agents.id = agent_assignments.agent_id
        where event_begins::date = ? ::date
        and agent_assignments.status != 'Declined'
        and agent_assignments.status != 'Cancelled'
        and deleted_at is NULL
        GROUP BY agents.id", [Carbon::now()]);

        return $today_team_sales;
    }


    public static function extractSum($data)
    {
        return $data->sum;
    }

    public static function extractTeam($data)
    {
        return $data->team;
    }

    public static function todayDatasets()
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
            'rgb(231, 102, 255)',
            'rgb(255, 99, 341)',
            'rgb(255, 756, 86)',
            'rgb(150, 512, 0)',
            'rgb(150, 37, 342)',
            'rgb(150, 249, 51)'
        ];

        $datasets = [];
        $datas = array_map(array('self','extractSum'), static::today_team_sales());
        $teams = array_map(array('self','extractTeam'), static::today_team_sales());
        foreach($datas as $data){
            $dataset = [
                'data'=> [$data],
                'backgroundColor'=> array_pop($colors),
                'label'=> array_pop($teams),
            ];
            array_push($datasets, $dataset);
        }

        return $datasets;
    }

    public static function config()
    {
        $data = [
            'type'=> 'bar',
            'data'=> [
                'datasets'=> static::todayDatasets(),
                'labels'=> ['Today']
            ],
            'options'=> [
                'responsive'=> true,
                'legend'=> [
                    'position'=> 'top',
                ],
                'animation'=> [
                    'animateScale'=> true,
                    'animateRotate'=> true
                ],
                'scales'=> [
                    'xAxes'=> [
                        'stacked'=> true,
                    ],
                    'yAxes'=> [
                        'stacked'=> true
                    ]
                ]
            ]

        ];

        return json_encode($data);
    }
}
