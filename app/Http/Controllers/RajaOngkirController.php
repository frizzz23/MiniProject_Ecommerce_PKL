<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RajaOngkirController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function cost(Request $request)
    {

        $destination = $request->input('destination');
        $weight = $request->input('weight');
        $courier = $request->input('courier');

        $response = Http::withHeaders([
            'key' => '1be36f38939f13e8b7c08edb1f2e66b7',
        ])->post('https://api.rajaongkir.com/starter/cost', [
            "origin" => 255, // lokasi pusat web (malang)
            "destination" => $destination,
            "weight" => $weight,
            "courier" => $courier,
        ]);
        return response()->json($response->json());
    }

    public static function province(Request $request)
    {
        $collection = Province::relatedData();

        if ($request->input('province_id')) {
            $collection = $collection->where('province_id', $request->input('province_id'));
        }

        if ($request->input('province')) {
            $collection = $collection->where('province', $request->input('province'));
        }

        return $collection;
    }

    public static function city(Request $request)
    {
        $collection =  City::relatedData();

        if ($request->input('city_id')) {
            $collection = $collection->where('city_id', $request->input('city_id'));
        }
        if ($request->input('province_id')) {
            $collection = $collection->where('province_id', $request->input('province_id'));
        }
        if ($request->input('province')) {
            $collection = $collection->where('province', $request->input('province'));
        }
        if ($request->input('type')) {
            $collection = $collection->where('type', $request->input('type'));
        }
        if ($request->input('city_name')) {
            $collection = $collection->where('city_name', $request->input('city_name'));
        }
        if ($request->input('postal_code')) {
            $collection = $collection->where('postal_code', $request->input('postal_code'));
        }
        return $collection;
    }
}
