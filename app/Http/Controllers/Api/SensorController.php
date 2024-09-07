<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Sensor;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class SensorController extends Controller
{
    public function index() {
        try {
            $sensors = Sensor::all();

            return response()->json([
                "status" => "success",
                "code" => Response::HTTP_OK,
                "message" => "Berhasil mendapatkan data sensor",
                "data" => $sensors,
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                "status" => "failed",
                "code" => Response::HTTP_INTERNAL_SERVER_ERROR,
                "message" => "Gagal mendapatkan data sensor",
                "data" => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id) {
        try {
            $sensor = Sensor::findOrFail($id);

            return response()->json([
                "status" => "success",
                "code" => Response::HTTP_OK,
                "message" => "Berhasil mendapatkan data sensor dengan id " . $id,
                "data" => $sensor,
            ], Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                "status" => "failed",
                "code" => Response::HTTP_NOT_FOUND,
                "message" => "Gagal mendapatkan data sensor dengan id " . $id,
                "data" => $e->getMessage(),
            ], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json([
                "status" => "failed",
                "code" => Response::HTTP_INTERNAL_SERVER_ERROR,
                "message" => "Gagal mendapatkan data sensor dengan id " . $id,
                "data" => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(Request $request) {
        $validatedData = Validator::make($request->all(), [
            "nama_sensor" => ['required', 'min:2'],
            "data" => ['required'],
            "topic" => ['required'],
        ], [
            "nama_sensor.required" => "Nama sensor harus diisi",
            "nama_sensor.min" => "Nama sensor minimal 2 karakter",
            "data.required" => "Data harus diisi",
            "topic.required" => "Topic harus diisi",
        ]);

        try {
            if (!$validatedData->fails()) { // jika validasi berhasil (tidak gagal)
                $sensor = Sensor::create([
                    "nama_sensor" => $request->nama_sensor,
                    "data" => $request->data,
                    "topic" => $request->topic,
                ]);

                if ($sensor) {
                    return response()->json([
                        "status" => "success",
                        "code" => Response::HTTP_CREATED,
                        "message" => "Berhasil menyimpan data sensor",
                        "data" => $sensor,
                    ], Response::HTTP_CREATED);
                } else {
                    return response()->json([
                        "status" => "success",
                        "code" => Response::HTTP_INTERNAL_SERVER_ERROR,
                        "message" => "Berhasil menyimpan data sensor",
                        "data" => null,
                    ], Response::HTTP_INTERNAL_SERVER_ERROR);
                }

            } else {
                throw new ValidationException($validatedData);
            }
        } catch (ValidationException $e) {
            return response()->json([
                "status" => "failed",
                "code" => 422,
                "message" => "Gagal menyimpan data sensor",
                "data" => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                "status" => "failed",
                "code" => Response::HTTP_INTERNAL_SERVER_ERROR,
                "message" => "Gagal menyimpan data sensor",
                "data" => null,
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    public function update(Request $request, $id) {
        $validatedData = Validator::make($request->all(), [
            "nama_sensor" => ['required', 'min:2'],
            "data" => ['required'],
            "topic" => ['required'],
        ], [
            "nama_sensor.required" => "Nama sensor harus diisi",
            "nama_sensor.min" => "Nama sensor minimal 2 karakter",
            "data.required" => "Data harus diisi",
            "topic.required" => "Topic harus diisi",
        ]);

        try {
            if (!$validatedData->fails()) {
                $sensor = Sensor::findOrFail($id);
                $updateSensor = $sensor->update([
                    "nama_sensor" => $request->nama_sensor,
                    "data" => $request->data,
                    "topic" => $request->topic,
                ]);

                if ($updateSensor) {
                    return response()->json([
                        "status" => "success",
                        "code" => Response::HTTP_OK,
                        "message" => "Berhasil mengubah data dengan id " . $id,
                        "data" => $sensor,
                    ], Response::HTTP_OK);
                } else {
                    return response()->json([
                        "status" => "failed",
                        "code" => Response::HTTP_INTERNAL_SERVER_ERROR,
                        "message" => "Gagal mengubah data sensor dengan id " . $id,
                        "data" => null,
                    ], Response::HTTP_INTERNAL_SERVER_ERROR);
                }
            } else {
                throw new ValidationException($validatedData);
            }
        } catch (ValidationException $e) {
            return response()->json([
                "status" => "failed",
                "code" => Response::HTTP_UNPROCESSABLE_ENTITY,
                "message" => "Gagal mengubah data sensor dengan id " . $id,
                "data" => $e->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (\Exception $e) {
            return response()->json([
                "status" => "failed",
                "code" => Response::HTTP_INTERNAL_SERVER_ERROR,
                "message" => "Gagal mengubah data sensor dengan id " . $id,
                "data" => null,
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    public function delete($id) {
        try {
            $sensor = Sensor::findOrFail($id);
            $deleted = $sensor->delete();

            if ($deleted) {
                return response()->json([
                    "status" => "success",
                    "code" => Response::HTTP_OK,
                    "message" => "Berhasil menghapus data sensor dengan id " . $id,
                    "data" => $sensor,
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                "status" => "failed",
                "code" => Response::HTTP_INTERNAL_SERVER_ERROR,
                "message" => "Gagal menghapus data sensor dengan id " . $id,
                "data" => null,
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
