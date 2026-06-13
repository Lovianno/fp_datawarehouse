<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessWarehouseETL;
use App\Models\Warehouse;
use Illuminate\Http\JsonResponse;

class WarehouseController extends Controller
{
  /**
   * Trigger proses konversi data warehouse.
   */
  public function convertToWarehouse()
  {
    // Cek apakah ada warehouse yang ada
    $warehouse = Warehouse::firstOrCreate([]);

    // Update timestamp terakhir proses ekstraksi
    $warehouse->last_extracted_at = now();
    $warehouse->save();

    // Dispatch job untuk proses ETL secara sinkron (langsung)
    ProcessWarehouseETL::dispatchSync();

    return redirect()->back()->with('success', 'Proses konversi data warehouse telah selesai.');
  }
}
