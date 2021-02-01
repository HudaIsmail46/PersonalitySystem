<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Vehicle;
use App\VehicleSchedule;
use Carbon\Carbon;


class VehicleScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $previousMonth = Carbon::now()->subMonths(1)->month;
        $currentMonth = Carbon::now()->month;
        $nextMonth = Carbon::now()->addMonths(1)->month;

        $vehicles = Vehicle::get();
        $previousVehicleSchedules =VehicleSchedule::whereMonth('date',$previousMonth)->orderBy('date', 'ASC')->get();
        $currentVehicleSchedules =VehicleSchedule::whereMonth('date',$currentMonth)->orderBy('date', 'ASC')->get();
        $nextVehicleSchedules =VehicleSchedule::whereMonth('date',$nextMonth)->orderBy('date', 'ASC')->get();

        $todaySchedule =VehicleSchedule::whereDate('date', Carbon::today())->first();

        return view('vehicle_schedule.index', compact('currentMonth', 'vehicles', 'previousVehicleSchedules','currentVehicleSchedules','nextVehicleSchedules','todaySchedule'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vehicle_schedule.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $vehicles = Vehicle::get();
        $allVehicles = $this->getVehicleArray($vehicles);

        foreach ($allVehicles as $allVehicle) {
            $all_vehicle_availability[] = $allVehicle['availability'];
        }

        foreach ($this->dateMonth($request->month) as $date) {

            $vehicleSchedule=VehicleSchedule::where('date', $date)->get();
            if($vehicleSchedule->isEmpty()){
                    $vehicleSchedule = new VehicleSchedule();
                    $vehicleSchedule->create([
                        'date' => $date,
                        'vehicles' => $allVehicles,
                        'total_vehicles' => array_sum($all_vehicle_availability),
                    ]);
            }else{
                return redirect()->back()->with('warning', 'This month schedule already existed.');
            }
        }

        return redirect()->route('vehicle_schedule.index')->with('success', 'Vehicle Schedules created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehicle $vehicle, $date)
    {
        $vehicleSchedules = VehicleSchedule::whereMonth('date', $date)->whereJsonContains('vehicles', [["vehicle_id"=>$vehicle->id]])->orderBy('date', 'ASC')->get();

        foreach ($vehicleSchedules as $vehicleSchedule) {
            $month_name = $vehicleSchedule->date;
            foreach ($vehicleSchedule->vehicles as $vehicles) {
                if ($vehicles['vehicle_id'] == $vehicle->id)

                    $totalAvailabilities[] = $vehicles['availability'];
            }
        }

        return view('vehicle_schedule.edit', compact('vehicle', 'vehicleSchedules', 'month_name'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        $this->validateVehicleSchedule();
        $availabilities = array_combine($request->date, $request->availability);

        foreach ($availabilities as $key => $availability) {
            $vehicleSchedule = VehicleSchedule::where('date', $key)->first();
            $newVehicles = [];

            foreach ($vehicleSchedule->vehicles as $vehicles) {
                if ($vehicles['vehicle_id'] == $vehicle->id) {
                    $vehicles['availability'] = $availability;
                }
                array_push($newVehicles, $vehicles);
            }
            $vehicleSchedule->update(['vehicles' => $newVehicles]);
            $vehicleSchedule->update(['total_vehicles'=>$this->getTotalAvailabilities($vehicleSchedule)]);
        }

        return redirect()->route('vehicle_schedule.index')->with('success', 'Vehicle Schedules created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function dateMonth($month)
    {
        $num = cal_days_in_month(CAL_GREGORIAN,  $month, Carbon::now()->year);
        $dates_month = array();

        for ($i = 1; $i <= $num; $i++) {
            $mktime = mktime(0, 0, 0,  $month, $i, Carbon::now()->year);
            $date = date("d-M-Y", $mktime);
            $dates_month[$i] = $date;
        }
        return $dates_month;
    }

    public function getVehicleArray($vehicles)
    {
        foreach ($vehicles as $key => $vehicle) {

            $id[] = $vehicle->id;
            $vehicle_plat_no[] = $vehicle->plat_no;
            $newVehicles[] = (['vehicle_id' => $id[$key], 'vehicle_plat_no' => $vehicle_plat_no[$key], 'remarks' => '', 'availability' =>'1']);
        }
        return $newVehicles;
    }

    public function getTotalAvailabilities(VehicleSchedule $vehicleSchedule)
    {
        foreach ($vehicleSchedule->vehicles as $vehicle) {
            $vehicle_availabilities[] = $vehicle['availability'];
        }
        $total_vehicle_availabilities = array_sum($vehicle_availabilities);
        return $total_vehicle_availabilities;
    }

    protected function validateVehicleSchedule()
    {
        return request()->validate([
            'availability.*' => 'required',
        ]);
    }
}