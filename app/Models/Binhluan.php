<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Binhluan extends Model
{
    use HasFactory;
    protected $table = "binhluan";

    protected $fillable = ['id','binhluan_ten','binhluan_email','binhluan_noi_dung','binhluan_trang_thai','sanpham_id'];

	public $timestamps = true;
}
