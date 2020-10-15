<?php

namespace App\Chart;
use Illuminate\Support\Facades\DB;

class IncompleteBooking
{
    public static function extractTotal($data)
    {
        return $data->total;
    }

    public static function extractTeam($data)
    {
        return $data->gc_team;
    }

    public static function config()
    {
        $incompleteBookings = DB::select('select gc_team, count(gc_team) as total from bookings where price is null or 
            gc_address is null or
            gc_event_begins is null or
            gc_event_ends is null or
            gc_description is null or
            name is null or
            phone_no is null and
            deleted_at is not null
            group by gc_team order by gc_team');

        $data = [
            'type'=> 'doughnut',
            'data'=> [
                'datasets'=> [[
                    'data'=> array_map(array('self','extractTotal'), $incompleteBookings),
                    'backgroundColor'=> [
                        'rgb(54, 162, 235)',
                        'rgb(75, 192, 192)',
                        'rgb(255, 159, 64)',
                        'rgb(153, 102, 255)',
                        'rgb(255, 99, 132)',
                        'rgb(255, 205, 86)',
                        'rgb(214, 126, 207)',
                        'rgb(25, 254, 207)'

                    ],
                    'label'=> 'Dataset 1'
                ]],
                'labels'=> array_map(array('self','extractTeam'), $incompleteBookings)
            ],
            'options'=> [
                'responsive'=> true,
                'legend'=> [
                    'position'=> 'top',
                ],
                'animation'=> [
                    'animateScale'=> true,
                    'animateRotate'=> true
                ]
            ]
        ];
        return json_encode($data);
    }

   
}