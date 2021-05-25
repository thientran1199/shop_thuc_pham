<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Khachhang extends Model
{
    use HasFactory;
    protected $table = "khachhang";

    protected $fillable = ['khachhang_ten','khachhang_dia_chi','khachhang_sdt','khachhang_email','user_id'];

	public $timestamps = false;
}
