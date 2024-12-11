<?php

namespace App\Http\Controllers;

use App\Models\City;
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
        $collection = collect(
            [
                [
                    "province_id" => "1",
                    "province" => "Bali"
                ],
                [
                    "province_id" => "2",
                    "province" => "Bangka Belitung"
                ],
                [
                    "province_id" => "3",
                    "province" => "Banten"
                ],
                [
                    "province_id" => "4",
                    "province" => "Bengkulu"
                ],
                [
                    "province_id" => "5",
                    "province" => "DI Yogyakarta"
                ],
                [
                    "province_id" => "6",
                    "province" => "DKI Jakarta"
                ],
                [
                    "province_id" => "7",
                    "province" => "Gorontalo"
                ],
                [
                    "province_id" => "8",
                    "province" => "Jambi"
                ],
                [
                    "province_id" => "9",
                    "province" => "Jawa Barat"
                ],
                [
                    "province_id" => "10",
                    "province" => "Jawa Tengah"
                ],
                [
                    "province_id" => "11",
                    "province" => "Jawa Timur"
                ],
                [
                    "province_id" => "12",
                    "province" => "Kalimantan Barat"
                ],
                [
                    "province_id" => "13",
                    "province" => "Kalimantan Selatan"
                ],
                [
                    "province_id" => "14",
                    "province" => "Kalimantan Tengah"
                ],
                [
                    "province_id" => "15",
                    "province" => "Kalimantan Timur"
                ],
                [
                    "province_id" => "16",
                    "province" => "Kalimantan Utara"
                ],
                [
                    "province_id" => "17",
                    "province" => "Kepulauan Riau"
                ],
                [
                    "province_id" => "18",
                    "province" => "Lampung"
                ],
                [
                    "province_id" => "19",
                    "province" => "Maluku"
                ],
                [
                    "province_id" => "20",
                    "province" => "Maluku Utara"
                ],
                [
                    "province_id" => "21",
                    "province" => "Nanggroe Aceh Darussalam (NAD)"
                ],
                [
                    "province_id" => "22",
                    "province" => "Nusa Tenggara Barat (NTB)"
                ],
                [
                    "province_id" => "23",
                    "province" => "Nusa Tenggara Timur (NTT)"
                ],
                [
                    "province_id" => "24",
                    "province" => "Papua"
                ],
                [
                    "province_id" => "25",
                    "province" => "Papua Barat"
                ],
                [
                    "province_id" => "26",
                    "province" => "Riau"
                ],
                [
                    "province_id" => "27",
                    "province" => "Sulawesi Barat"
                ],
                [
                    "province_id" => "28",
                    "province" => "Sulawesi Selatan"
                ],
                [
                    "province_id" => "29",
                    "province" => "Sulawesi Tengah"
                ],
                [
                    "province_id" => "30",
                    "province" => "Sulawesi Tenggara"
                ],
                [
                    "province_id" => "31",
                    "province" => "Sulawesi Utara"
                ],
                [
                    "province_id" => "32",
                    "province" => "Sumatera Barat"
                ],
                [
                    "province_id" => "33",
                    "province" => "Sumatera Selatan"
                ],
                [
                    "province_id" => "34",
                    "province" => "Sumatera Utara"
                ]
            ]
        );

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
