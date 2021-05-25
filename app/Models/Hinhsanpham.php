<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hinhsanpham extends Model
{
    use HasFactory;
    protected $table = "hinhsanpham";

    protected $fillable = ['id','hinhsanpham_ten','sanpham_id'];

	public $timestamps = false;
}
