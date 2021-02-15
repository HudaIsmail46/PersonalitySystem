<?php

namespace App\Http\Controllers;

use App\Vehicle;
use App\VehicleSchedule;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index(Request $request)
    {
        $plat_no = $request->plat_no;

        $vehicles = Vehicle::when($plat_no, function ($q) use ($plat_no) {
            return $q->where('plat_no', 'ILIKE', '%' . $plat_no . '%');
        })
        ->get();

        return view('vehicle.index', compact('vehicles'));
    }

    public function show(Vehicle $vehicle)
    {
        return view('vehicle.show', compact('vehicle'));
    }

    public function create()
    {
        return view('vehicle.create');
    }

    public function store(Request $request)
    {
        $this->validatevehicles();
        $vehicle = Vehicle::create($request->all());

        $this->updateVehicleSchedule($vehicle);

        return redirect()->route('vehicle.show', $vehicle->id)->with('success', 'Vehicles created successfully.');
    }

    public function edit(Vehicle $vehicle)
    {
        return view('vehicle.edit', compact('vehicle'));
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $this->validatevehicles();
        $vehicle->update($request->all());

        return redirect()->route('vehicle.show', $vehicle->id)->with('success', 'Vehicles updated successfully.');
    }

    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();

        return redirect()->route('vehicle.index')->with('Vehicle succesfully deleted.');
    }



    public function updateVehicleSchedule($vehicle)
    {
        
        $vehicleSchedules = VehicleSchedule::whereMonth('date','>=', $vehicle->created_at->format('m'))->get();
        $newVehicle = [['vehicle_id' => $vehicle->id, 'vehicle_plat_no' => $vehicle->plat_no, 'remarks' => '', 'availability' =>'1']];

        foreach ($vehicleSchedules as $vehicleSchedule) {

            $newVehicles = array_merge($newVehicle, $vehicleSchedule->vehicles);
            $vehicleSchedule->update(['vehicles' => $newVehicles]);
        }

        foreach ($vehicleSchedule->vehicles as $vehicle) {
            $vehicle_availabilities[] = $vehicle['availability'];
        }

        $vehicleSchedule->fill([
            'total_vehicle' => array_sum($vehicle_availabilities),
        ]);
        $vehicleSchedule->save();
    }
    protected function validateVehicles()
    {
        return request()->validate([
            'plat_no' => 'required',
        ]);
    }
}
