<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;

class InHouseCleaningController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $orders = Order::with('customer')
            ->orderBy('id', 'ASC')
            ->where('state', '=' ,'App\State\Order\InHouseCleaning')
            ->paginate(50);
        return view('vendor.index', compact('orders'))
            ->with('i', ($orders->get('page', 1) - 1) * 50);
    }
}

