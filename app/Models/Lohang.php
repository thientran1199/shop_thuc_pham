<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lohang extends Model
{
    use HasFactory;

    protected $table = "lohang";

    protected $fillable = ['id','lohang_ky_hieu','lohang_han_su_dung','lohang_gia_mua_vao','lohang_gia_ban_ra','lohang_so_luong_sp','nhacungcap_id','sanpham_id'];

	public $timestamps = true;
}
