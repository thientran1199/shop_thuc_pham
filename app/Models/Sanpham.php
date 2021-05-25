<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sanpham extends Model
{
    use HasFactory;

    protected $table = "sanpham";

    protected $fillable = ['id','sanpham_ky_hieu','sanpham_ten','sanpham_url','sanpham_anh','sanpham_mo_ta','loaisanpham_id','sanpham_khuyenmai','donvitinh_id'];

	public $timestamps = true;
}
