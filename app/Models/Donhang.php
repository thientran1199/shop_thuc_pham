<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donhang extends Model
{
    use HasFactory;

    protected $table = "donhang";

    protected $fillable = ['id','donhang_nguoi_nhan','donhang_nguoi_nhan_email','donhang_nguoi_nhan_sdt','donhang_nguoi_nhan_dia_chi','donhang_ghi_chu','donhang_tong_tien','khachhang_id','tinhtranghd_id'];

	public $timestamps = true;
}
