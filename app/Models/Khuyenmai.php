<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Khuyenmai extends Model
{
    use HasFactory;
    protected $table = "khuyenmai";

    protected $fillable = ['id','khuyenmai_tieu_de','khuyenmai_url','khuyenmai_noi_dung','khuyenmai_anh','khuyenmai_phan_tram','khuyenmai_thoi_gian','khuyenmai_tinh_trang'];

	public $timestamps = true;
}
