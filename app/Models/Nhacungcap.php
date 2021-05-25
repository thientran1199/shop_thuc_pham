<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nhacungcap extends Model
{
    use HasFactory;
    protected $table = "nhacungcap";

    protected $fillable = ['nhacungcap_ten','nhacungcap_dia_chi','nhacungcap_sdt'];

	public $timestamps = false;
}
