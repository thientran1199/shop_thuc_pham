<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tuyendung extends Model
{
    use HasFactory;

    protected $table ='tuyendung';

    protected $fillable = ['tuyendung_tieu_de', 'tuyendung_url', 'tuyendung_anh', 'tuyendung_mo_ta','tuyendung_lien_he','tuyendung_thoi_gian'];

	public $timestamps = true;
}
