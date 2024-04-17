<?php

namespace App\Http\Controllers;

use App\Models\Pallet;
use App\Models\Stock;
use App\Models\Trans;
use App\Models\Transfer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InternalTransferController extends Controller
{
    public function byLocation()
    {
        return view('internal_transfer.by_location');
    }

    public function getItemByLocation(Request $request)
    {
        $input = $request->all();
        $loc = $input['lokasi_asal'];

        $item = Pallet::getItemByLocation($loc);

        $data = array(
            'lokasi' => $loc,
            'item' => $item
        );

        $response = array(
            'success' => true,
            'pallet_id' => Pallet::generatePalletId(),
            'stock_id' => Stock::generateStockId(),
            'trans_id' => Trans::generateTransId(),
            'transfer_id' => Transfer::generateTransferId(),
            'content' => view('internal_transfer.item_by_location', $data)->render()
        );

        return response()->json($response);
    }

    public function prosesTransferByLocation(Request $request)
    {
        $input = $request->all();
        $lokasi_asal = $input['tf_lokasi_asal'];
        $lokasi_tujuan = $input['tf_lokasi_tujuan'];
        $dateTimeNow = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        $trans_id = Trans::generateTransId();
        $items = Pallet::getItemByLocation($lokasi_asal);


        if (count($items) > 0) {
            try {
                DB::beginTransaction();

                foreach ($items as $data) {
                    $transfer_id = Transfer::generateTransferId();
                    $pallet_id = Pallet::generatePalletId();

                    // Insert ke tabel pallet
                    DB::table('pallet')->insert([
                        'pallet_id' => $pallet_id,
                        'stock_no' => $data->stock_no,
                        'qty_in' => $data->qty_avail,
                        'qty_out' => 0,
                        'qty_adj' => $data->qty_adj,
                        'qty_alloc' => $data->qty_alloc,
                        'qty_trf' => $data->qty_trf,
                        'qty_avail' => $data->qty_avail,
                        'loc_id' => $lokasi_tujuan,
                        'workstatus' => 'ts',
                        'qastatus' => $data->qastatus,
                        'fl' => '',
                    ]);

                    // Upadate table pallet
                    DB::table('pallet')
                        ->where('pallet_id', $data->pallet_id)
                        ->update([
                            'qty_out' => $data->qty_out + $data->qty_avail,
                            'qty_trf' => $data->qty_trf - $data->qty_trf,
                            'qty_alloc' => $data->qty_alloc + $data->qty_alloc,
                            'qty_avail' =>  $data->qty_avail - $data->qty_avail,
                            'workstatus' => 'is',
                            'fl' => '',
                        ]);


                    // Insert ke tabel transfer
                    DB::table('transfer')->insert([
                        'transfer_id' => $transfer_id,
                        'trans_no' => $trans_id,
                        'f_pallet_id' => $data->pallet_id,
                        'pallet_id' => $pallet_id,
                        'f_loc' => $data->loc_id,
                        't_loc' => $lokasi_tujuan,
                        'old_prod_date' => $data->expire,
                        'new_prod_date' => $data->expire,
                        'qa_before' => $data->qastatus,
                        'qa_after' => $data->qastatus,
                        'trans_time' => $dateTimeNow,
                        'trans_qty' => $data->qty_avail,
                        'rem' => 'ITL',
                        't_wh_code' => $data->batch_no,
                    ]);

                    // Insert ke tabel flag
                    DB::table('flag')->insert([
                        'number' => $transfer_id,
                        'pallet_id' => $data->pallet_id,
                        'no_do' => 'IT BY LOCATION',
                        'item_code' => $data->item_code,
                        'batch_no' => $data->expire,
                        'qa' => $data->qastatus,
                        'fl' => $data->qty_avail,
                        'trans_no' => $trans_id,
                    ]);
                }

                // Insert ke tabel trans
                DB::table('trans')->insert([
                    'trans_no' => $trans_id,
                    'trans_date' => $dateTimeNow,
                    'doc_stat' => 'IT',
                    'username' => Auth::user()->username,
                    'proses' => 'INTERNAL_TRANSFER',
                    'o_date' => $dateTimeNow,
                    'o_by' => Auth::user()->username,
                    'proses_id' => 'BY LOCATION',
                ]);


                DB::commit();

                // Response JSON success
                return response()->json([
                    'success' => true,
                    'message' => 'Operation completed successfully.',
                ]);
            } catch (\Exception $e) {
                // Rollback transaksi jika terjadi kesalahan
                DB::rollback();

                // Lakukan penanganan kesalahan
                // Misalnya, log pesan kesalahan atau kembalikan pesan kesalahan ke pengguna
                return response()->json([
                    'success' => false,
                    'message' => 'An error occurred: ' . $e->getMessage(),
                ]);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
            ]);
        }
    }
}
