<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nhanvien extends Model
{
    use HasFactory;

    protected $table = "nhanvien";

    protected $fillable = ['nhanvien_ten','nhanvien_dia_chi','nhanvien_sdt','nhanvien_cmnd','nhanvien_email','nhanvien_ngay_vao_lam','user_id'];

	public $timestamps = true;
}
