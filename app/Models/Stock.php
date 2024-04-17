<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    protected $table = 'stok';

    public static function generateStockId()
    {
        // Mengambil nilai maksimum dari kolom 'pallet_id'
        $idMax = Stock::max('stock_no');

        // Memeriksa apakah ada nilai maksimum yang ditemukan
        if (!is_null($idMax)) {
            $noUrut = (int) substr($idMax, 2, 10); // Menghapus karakter pertama 'P'
        } else {
            $noUrut = 0;
        }

        $noUrut++;
        $newnostock = "S" . sprintf("%09s", $noUrut);
        return $newnostock;
    }
}
