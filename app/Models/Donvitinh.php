<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donvitinh extends Model
{
    use HasFactory;
    protected $table = 'donvitinh';

	protected $fillable = ['donvitinh_ten','donvitinh_mo_ta','donvitinh_da_xoa'];

	public $timestamps = false;
}
