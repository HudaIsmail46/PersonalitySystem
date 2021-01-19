<?php

namespace App\Http\Controllers;

use App\Vehicle;
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

    protected function validateVehicles()
    {
        return request()->validate([
            'plat_no' => 'required',
        ]);
    }
}
