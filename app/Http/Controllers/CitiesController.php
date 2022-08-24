<?php


namespace App\Http\Controllers;


use App\Models\City;

class CitiesController extends Controller
{
    /**
     * @param $id
     * @return mixed
     */
    public function getByRegion ($id)
    {
         return City::where('region_id', $id)->get(['id', 'name']);
    }
}
