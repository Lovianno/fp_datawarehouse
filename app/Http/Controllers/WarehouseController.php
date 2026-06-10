<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessWarehouseETL;
use Illuminate\Http\JsonResponse;

class WarehouseController extends Controller
{
  /**
   * Trigger proses konversi data warehouse.
   */
  public function convertToWarehouse(): JsonResponse
  {
    // Dispatch job untuk proses ETL secara sinkron (langsung)
    ProcessWarehouseETL::dispatchSync();

    return response()->json([
      'status' => 'success',
      'message' => 'Proses konversi data warehouse telah berhasil dilakukan.'
    ]);
  }
}
