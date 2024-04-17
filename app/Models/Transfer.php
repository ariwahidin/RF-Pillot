<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    use HasFactory;
    protected $table = 'transfer';

    protected $fillable = [
        'transfer_id',
        'trans_no',
        'f_pallet_id',
        'pallet_id',
        'f_loc',
        't_loc',
        'old_prod_date',
        'new_prod_date',
        'qa_before',
        'qa_after',
        'trans_time',
        'trans_qty',
        'rem',
        't_wh_code'
    ];

    public static function generateTransferId()
    {
        $idMax = Transfer::max('transfer_id');

        // // dd((int)substr($idMax, 2, 10));
        // dd(sprintf("%09s", (int)substr($idMax, 2, 10)));

        if (!is_null($idMax)) {
            $noUrut = (int) substr($idMax, 2, 10);
        } else {
            $noUrut = 0;
        }

        $noUrut++;
        $noit = "F" . sprintf("%09s", $noUrut);
        return $noit;
    }
}
