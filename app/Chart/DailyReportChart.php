<?php

namespace App\Chart;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DailyReportChart
{
    public static function config($dailyReports)
    {
		$labels = [];
		$accumulatedEstimates = [];
		$totalEstimates = 0;
		$totalActual = 0;
		$accumulatedActual = [];
		$dailyReportsActualSales = [];
		$dailyReportsEstimatesSales = [];
		foreach($dailyReports as $dailyReport)
		{
			array_push($labels, $dailyReport->date->format('d-m'));
			array_push($dailyReportsActualSales, $dailyReport->actual_total_sales());
			array_push($dailyReportsEstimatesSales, $dailyReport->estimates_total_sales());
			$totalEstimates += $dailyReport->estimates_total_sales();
			array_push($accumulatedEstimates, $totalEstimates);
			$totalActual += $dailyReport->actual_total_sales();
			array_push($accumulatedActual, $totalActual);
		}
        $dataset = [
			'labels' => $labels,
			'datasets'=> [
				[
					'type'=> 'line',
					'label'=> 'Accumulated Estimates',
					'borderColor'=>'rgb(54, 162, 235)',
					'fill'=> false,
					'data'=> $accumulatedEstimates,
					'yAxisID'=> 'accumulated'
				],[
					'type'=> 'line',
					'label'=> 'Accumulated Actual',
					'borderColor'=>'rgb(150, 170, 0)',
					'fill'=> false,
					'data'=> $accumulatedActual,
					'yAxisID'=> 'accumulated'
				], [
					'type'=> 'bar',
					'label'=> 'Daily Actual',
					'backgroundColor'=>'rgb(153, 102, 255)',
					'data'=> $dailyReportsActualSales,
					'borderColor'=> 'white',
					'yAxisID'=> 'daily'
				], [
					'type'=> 'bar',
					'label'=> 'Daily Estimates',
					'backgroundColor'=>'rgb(150, 249, 51)',
					'data'=> $dailyReportsEstimatesSales,
					'borderColor'=> 'white',
					'yAxisID'=> 'daily'
				]
			]

		];

        $data = [
            'type'=> 'bar',
            'data'=> $dataset,
            'options'=> [
                'responsive'=> true,
                'legend'=> [
                    'position'=> 'top',
                ],
                'animation'=> [
                    'animateScale'=> true,
                    'animateRotate'=> true
                ],
                'tooltips'=> [
					'mode'=> 'index',
					'intersect'=> true
				],
				'scales'=> [
                    'xAxes'=> [
                        'stacked'=> true,
                    ],
                    'yAxes'=> [
                        [
							'type'=> 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
							'display'=> true,
							'position'=> 'left',
							'id'=> 'accumulated',
						], [
							'type'=> 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
							'display'=> true,
							'position'=> 'right',
							'id'=> 'daily',

							// grid line settings
							'gridLines'=> [
								'drawOnChartArea'=> false, // only want the grid lines for one axis to show up
							],
						]
                    ]
                ]
            ]
        
        ];

        return json_encode($data);
    }
}
