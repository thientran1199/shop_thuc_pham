<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monngon extends Model
{
    use HasFactory;

    protected $table = 'monngon';

	protected $fillable = ['monngon_ten_gia','monngon_tieu_de','monngon_tom_tat','monngon_noi_dung','monngon_luot_xem','monngon_da_xoa','monngon_anh'];

	public $timestamps = true;
}
