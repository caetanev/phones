<?php

namespace App\Http\Controllers;

use App\Models\CountryPhone;
use App\Models\CustomerCountryPhone;
use App\Models\PhoneState;
use Illuminate\Http\Request;

class PhoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        /**
         * Get all the CountryPhones from the database to fill the dropdown filter
         *
         * @var Illuminate\Database\Eloquent\Collection
         */
        $countryPhones = CountryPhone::all();

        /**
         * Get all the PhoneStates from the database to fill the dropdown filter
         *
         * @var Illuminate\Database\Eloquent\Collection
         */
        $phoneStates = PhoneState::all();

        /**
         * Load the data to the view
         *
         */
        return view('index', compact('countryPhones', 'phoneStates'));
    }

    /**
     * The grid Action returns the view with the table
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function grid(Request $request){

        /** Initialize the CustomerCountryPhone model eager loading the CountryPhone and Customer models
         * @var CustomerCountryPhone $customerCountryPhone
         */
        $request->validate([
            'countryId' => 'exists:country_phone,id',
            'validPhone' => 'exists:phone_state,id'
        ]);

        /** Initialize the CustomerCountryPhone model eager loading the CountryPhone and Customer models
         * @var CustomerCountryPhone
         */
        $customerCountryPhone = CustomerCountryPhone::with('countryPhone', 'customer', 'phoneState');

        /** If the countryId was received as parameter in the request add to the where
         * @var int|string|null
         */
        if(null !== ($countryId = $request->get('countryId'))){
            $customerCountryPhone->where('country_phone_id','=', $countryId);
        }

        /** If the validPhone was received as parameter in the request add to the where
         * @var int|string|null
         */
        if(null !== ($validPhone = $request->get('validPhone'))){
            $customerCountryPhone->where('valid_phone','=', (bool)$validPhone);
        }

        /** If the customerCountryPhones filtered and paginated
         *
         * @var Illuminate\Contracts\Pagination\LengthAwarePaginator
         */
        $customerCountryPhones = $customerCountryPhone->paginate(5);

        /**
         * Load the data to the view
         */
        return view('grid', compact('customerCountryPhones'));
    }

}
