<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sanphamkhuyenmai extends Model
{
    use HasFactory;

    protected $table = 'sanphamkhuyenmai';

	protected $fillable = ['sanpham_id','khuyenmai_id'];

	public $timestamps = false;
}
