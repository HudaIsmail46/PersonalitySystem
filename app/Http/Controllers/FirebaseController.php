<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class FirebaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/umsfri-firebase-adminsdk-p0303-e6a681d203.json');
        $firebase = (new Factory)
        ->withServiceAccount($serviceAccount)
        ->withDatabaseUri('https://umsfri-default-rtdb.firebaseio.com')
        ->create();

        $database = $firebase->getDatabase();

        $newStudent = $database
        ->getReference('student/results')
        ->push([
        'id' => '17146952/1' ,
        'results' => '40'
        ]);
        echo '<pre>';
        print_r($newStudent->getvalue());
    }

}