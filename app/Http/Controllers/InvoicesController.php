<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoice;

class InvoicessController extends AuthenticatedController
{ 
    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function show(Invoice $invoice)
   {
       return view('invoice.show', compact('invoice'));
   }
}
