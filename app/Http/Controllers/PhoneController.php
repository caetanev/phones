<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\JsonResponse;

class PhoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::whereHas(['country' => function ($query) {
            $query->where('code', 258);
        }])->get();

        return new JsonResponse($customers);
    }
}
