<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quangcao extends Model
{
    use HasFactory;

    protected $table="quangcao";

    protected $fillable = ['quangcao_anh','quangcao_trang_thai'];

	public $timestamps = false;
}
