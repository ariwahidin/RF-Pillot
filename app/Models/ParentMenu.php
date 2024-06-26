<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentMenu extends Model
{
    use HasFactory;
    protected $table = 'parent_menu';
    protected $fillable = ['label'];
}
