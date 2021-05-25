<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoaisanphamAddRequest;
use App\Http\Requests\LoaisanphamEditRequest;
use App\Models\Loaisanpham;
use App\Models\Nhom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class LoaisanphamController extends Controller
{
    //
    public function getList()
	{
		$data =  DB::table('loaisanpham')->orderBy('id','DESC')->get();
		return view('backend.loaisanpham.danhsach',compact('data'));
	}

	public function getAdd() {
		$nhom = Nhom::all();

		return view('backend.loaisanpham.them',compact('nhom'));
	}

	public function postAdd(LoaisanphamAddRequest $request) {
		$loaisanpham = new Loaisanpham();
		$imageName = $request->file('fImage')->getClientOriginalName();

        $request->file('fImage')->move(
            base_path() . 'upload/loaisanpham/', $imageName
        );
		$loaisanpham->loaisanpham_ten	= $request->txtLSPName;
		$loaisanpham->nhom_id			= $request->txtLSPParent;
		$loaisanpham->loaisanpham_mo_ta	= $request->txtLSPIntro;
		$loaisanpham->loaisanpham_anh	= $imageName;
		$loaisanpham->loaisanpham_url	= Replace_TiengViet($request->txtLSPName);

		$loaisanpham->save();
		return redirect()->route('admin.loaisanpham.list')->with(['flash_level'=>'success','flash_message'=>'Thêm loại sản phẩm thành công!!!']);
	}

	public function getDelete($id)
	{
		$loaisanpham = DB::table('loaisanpham')->where('id',$id)->first();
        $img = 'upload/loaisanpham/'.$loaisanpham->loaisanpham_anh;
        File::delete($img);
		DB::table('loaisanpham')->where('id',$id)->delete();
        return redirect()->route('admin.loaisanpham.list')->with(['flash_level'=>'success','flash_message'=>'Xóa loại sản phẩm thành công!!!']);
	}

	public function getEdit($id)
	{
		$loaisanpham = DB::table('loaisanpham')->where('id',$id)->first();

		$nhom = Nhom::all();

		return view('backend.loaisanpham.sua',compact('nhom','loaisanpham','id'));
	}

	public function postEdit(LoaisanphamEditRequest $request,$id)
	{
		$fImage = $request->fImage;
        $img_current = 'upload/loaisanpham/'.$request->fImageCurrent;
        if (!empty($fImage )) {
             $filename=$fImage ->getClientOriginalName();
             DB::table('loaisanpham')->where('id',$id)
                            ->update([
                                'loaisanpham_ten' => $request->txtLSPName,
								'loaisanpham_url' => $request->txtLSPName,
								'nhom_id'=>$request->txtLSPParent,
								'loaisanpham_mo_ta'=>$request->txtLSPIntro,
                                'loaisanpham_anh' => $filename
                                ]);
             $fImage ->move(base_path() . 'upload/loaisanpham/', $filename);
             File::delete($img_current);
        } else {
            DB::table('loaisanpham')->where('id',$id)
                            ->update([
                                'loaisanpham_ten' => $request->txtLSPName,
								'loaisanpham_url' => $request->txtLSPName,
								'nhom_id'=>$request->txtLSPParent,
								'loaisanpham_mo_ta'=>$request->txtLSPIntro
                                ]);
        }

		return redirect()->route('admin.loaisanpham.list')->with(['flash_level'=>'success','flash_message'=>'Chỉnh sửa loại sản phẩm thành công!!!']);
	}
}
