<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isNull;

class Pallet extends Model
{
    use HasFactory;
    protected $table = 'pallet';
    // protected $fillable = ['parent_id','label', 'url'];

    public static function getItemByLocation($location)
    {
        return DB::select("
        SELECT a.*, b.item_code, b.expire, b.batch_no
        FROM pallet a 
        INNER JOIN stok b ON b.stock_no = a.stock_no
        WHERE a.qty_alloc = 0 AND a.qty_avail > 0 AND a.loc_id = '$location'");
    }

    public static function searchByLocAndItem($post)
    {
        $location = $post['lokasi_asal'];
        $item_code = $post['item_code'];
        $prod_date = $post['prod_date'];

        $sql = "SELECT a.*, b.item_code, b.expire, b.batch_no
        FROM pallet a 
        INNER JOIN stok b ON b.stock_no = a.stock_no
        WHERE a.qty_alloc = 0 AND a.qty_avail > 0";

        if (!is_null($location)) {
            $sql .= " AND loc_id = '$location'";
        }
        if (!is_null($item_code)) {
            $sql .= " AND item_code = '$item_code'";
        }
        if (!is_null($prod_date)) {
            $sql .= " AND b.expire = '$prod_date'";
        }

        $sql .= " ORDER BY b.item_code ASC, a.qty_avail DESC";

        return DB::select($sql);
    }

    // public static function generatePalletId(){
    //     $queryx = "SELECT MAX(pallet_id) as maxID FROM pallet";
    //     $hasilx = DB::select($queryx);
    //     $idMax = $hasilx['maxID'];
    //     $noUrut = (int) substr($idMax, 2, 10);
    //     $noUrut++;
    //     $pal_id = "P" . sprintf("%09s", $noUrut);
    //     return $pal_id;
    // }

    public static function generatePalletId()
    {
        // Mengambil nilai maksimum dari kolom 'pallet_id'
        $idMax = Pallet::max('pallet_id');

        // Memeriksa apakah ada nilai maksimum yang ditemukan
        if (!is_null($idMax)) {
            $noUrut = (int) substr($idMax, 1); // Menghapus karakter pertama 'P'
        } else {
            $noUrut = 0;
        }

        $noUrut++;
        $pal_id = "P" . sprintf("%09s", $noUrut);
        return $pal_id;
    }
}
