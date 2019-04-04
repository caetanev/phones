<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Country;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PhoneController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::with('country')->get();

        return new JsonResponse($customers);
    }

}
