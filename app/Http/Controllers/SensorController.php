<?php

namespace App\Http\Controllers;

use App\Models\Sensor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SensorController extends Controller
{
    public function index() {
        // $sensor = [
        //     [
        //         "nama_sensor" => "Sensor 1",
        //         "data" => "5",
        //     ],
        //     [
        //         "nama_sensor" => "Sensor 2",
        //         "data" => "14",
        //     ],
        //     [
        //         "nama_sensor" => "Sensor 3",
        //         "data" => "34",
        //     ],
        // ];

        // $sensor = DB::table('sensors')
        //             //   ->limit(2)
        //             //   ->orderBy('id', 'desc')
        //               ->get();

        $sensor = Sensor::orderBy('id', 'asc')->paginate(5);

        return view("sensor.index", compact('sensor'));
    }

    public function create() {
        return view("sensor.create");
    }

    public function store(Request $request) {
        // $requestData = '';

        // if ($request->data == '') {
        //     $requestData = 'Tidak ada data';
        // } else {
        //     $requestData = $request->data;
        // }

        $request->validate([
            "nama_sensor" => ['required'],
            "data" => ['required'],
        ], [
            "nama_sensor.required" => "Nama sensor harus diisi",
            "data.required" => "Data harus diisi",
            "data.numeric" => "Data harus berupa angka",
        ]);

        $sensorData = [
            "nama_sensor" => $request->nama_sensor,
            "data" => $request->data,
        ];

        // DB::table('sensors')->insert($sensorData);

        $sensor = Sensor::create($sensorData);

        return redirect('/sensor')->with('success', 'Berhasil menambahkan data');
    }

    public function edit($id) {
        $sensor = Sensor::findOrFail($id);


        return view('sensor.edit', [
            "sensor" => $sensor,
        ]);
    }

    public function update(Request $request, $id) {
        $request->validate([
            "nama_sensor" => ['required'],
            "data" => ['required'],
        ], [
            "nama_sensor.required" => "Nama sensor harus diisi",
            "data.required" => "Data harus diisi",
            "data.numeric" => "Data harus berupa angka",
        ]);

        $sensorData = [
            'nama_sensor' => $request->nama_sensor,
            'data' => $request->data,
        ];

        // DB::table('sensors')
        //     ->where('id', $id)
        //     ->update($sensorData);

        $sensor = Sensor::findOrFail($id);

        $sensor->update($sensorData);

        return redirect('/sensor')->with('success', 'Berhasil mengubah data');
    }

    public function delete($id) {
        // DB::table('sensors')
        //     ->where('id', $id)
        //     ->delete();

        $sensor = Sensor::findOrFail($id);
        $sensor->delete();

        return redirect('/sensor')->with('success', 'Berhasil menghapus data sensor ' . $sensor->nama_sensor);
    }
}
