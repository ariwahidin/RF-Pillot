<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trans extends Model
{
    use HasFactory;
    protected $table = 'trans';

    public static function generateTransId()
    {
        $idMax = Trans::max('trans_no');

        if (!is_null($idMax)) {
            $noUrut = (int) substr($idMax, 2, 10); 
        } else {
            $noUrut = 0;
        }

        $noUrut++;
        $notrans = "T" . sprintf("%09s", $noUrut);
        return $notrans;
    }
}
