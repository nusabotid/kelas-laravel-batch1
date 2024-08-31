<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function index() {
        $devices = Device::paginate(10);

        return view('device.index', compact('devices'));
    }

    public function create() {
        return view('device.create');
    }

    public function store(Request $request) {
        $request->validate([
            "serial_number" => ["required"],
            "meta_data" => ["required"],
        ], [
            "serial_number.required" => "Serial Number harus diisi",
            "meta_data.required" => "Meta data harus diisi",
        ]);

        $deviceData = [
            "serial_number" => $request->serial_number,
            "meta_data" => $request->meta_data,
        ];

        Device::create($deviceData);

        return redirect('/device')->with('success', 'Berhasil menambahkan data device');
    }

    public function edit($id) {
        $device = Device::findOrFail($id);

        return view('device.edit', [
            'device' => $device,
        ]);
    }

    public function update(Request $request, $id) {
        $request->validate([
            "serial_number" => ["required"],
            "meta_data" => ["required"],
        ], [
            "serial_number.required" => "Serial Number harus diisi",
            "meta_data.required" => "Meta data harus diisi",
        ]);

        $deviceData = [
            "serial_number" => $request->serial_number,
            "meta_data" => $request->meta_data,
        ];

        Device::findOrFail($id)->update($deviceData);

        return redirect('/device')->with('success', 'Berhasil mengubah data device');
    }

    public function delete($id) {
        $device = Device::findOrFail($id);
        $device->delete();

        return redirect('/device')->with('success', 'Berhasil menghapus data device dengan no seri ' . $device->serial_number);
    }
}
