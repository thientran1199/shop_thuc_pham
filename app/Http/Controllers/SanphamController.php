<?php

namespace App\Http\Controllers;

use App\Http\Requests\SanphamAddRequest;
use App\Http\Requests\SanphamEditRequest;
use App\Models\Donvitinh;
use App\Models\Hinhsanpham;
use App\Models\Loaisanpham;
use App\Models\Sanpham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class SanphamController extends Controller
{
    //

    public function getList()
    {
        $data1 = DB::table('sanpham')

            ->get();
            // print_r($data1);
        foreach ($data1 as $item) {
            $data2 = DB::table('sanphamkhuyenmai')->where('sanpham_id',$item->id)->get();
            // print_r($data2);
            foreach ($data2 as $val1) {
                if (!is_null($val1)) {
                $data3 = DB::table('khuyenmai')->where('id',$val1->khuyenmai_id)->first();
                // print_r($data3);
                // $data3 = DB::table('khuyenmai')->where('id',$data2->khuyenmai_id)->first();
                if ($data3->khuyenmai_tinh_trang == 0) {
                    $u = DB::table('sanpham')
                        ->where('id',$item->id)
                        ->update(['sanpham_khuyenmai' => 0 ]);
                    }

                else{
                    $u = DB::table('sanpham')
                        ->where('id',$item->id)
                        ->update(['sanpham_khuyenmai' => 1 ]);
                }
                // print_r($u);
                }
            }
        }
        $data = DB::table('sanpham')
            ->orderBy('id','DESC')->get();
    	return view('backend.sanpham.danhsach',compact('data'));
    }

    public function getAdd()
    {
        $units = Donvitinh::all();
        $cates = Loaisanpham::all();
    	return view('backend.sanpham.them',compact('cates','units'));
    }

    public function postAdd(SanphamAddRequest $request)
    {
        $filename=$request->file('txtSPImage')->getClientOriginalName();
        $request->file('txtSPImage')->move(
            base_path() . '/upload/sanpham/', $filename
        );
    	$sanpham = new Sanpham;
        $sanpham->sanpham_ky_hieu   = $request->txtSPSignt;
        $sanpham->sanpham_ten           = $request->txtSPName;
        $sanpham->sanpham_url           = $request->txtSPName;
        $sanpham->sanpham_mo_ta = $request->txtSPIntro;
        $sanpham->sanpham_anh = $filename;
        $sanpham->loaisanpham_id = $request->txtSPCate;
        $sanpham->donvitinh_id = $request->txtSPUnit;

        $sanpham->sanpham_khuyenmai = 0;
        $sanpham->save();

        $files =[];
        if ($request->file('txtSPImage1')) {
            $files[] = $request->file('txtSPImage1');
        }
        if ($request->file('txtSPImage2')) {
            $files[] = $request->file('txtSPImage2');
        }
        if ($request->file('txtSPImage3')) {
            $files[] = $request->file('txtSPImage3');
        }
        if ($request->file('txtSPImage4')) {
            $files[] = $request->file('txtSPImage4');
        }
        if ($request->file('txtSPImage5')) {
            $files[] = $request->file('txtSPImage5');
        }

        $names =[];

        foreach ($files as $file) {
            if(!empty($file)){
                $filename=$file->getClientOriginalName();
                $file->move(
                    base_path().'/upload/chitietsanpham/', $filename
                );

                $hinh = new Hinhsanpham;
                $hinh->hinhsanpham_ten = $filename;
                $hinh->sanpham_id = $sanpham->id;
                $hinh->save();
            }
        }

        return redirect()->route('admin.sanpham.list')->with(['flash_level'=>'success','flash_message'=>'Thêm loại sản phẩm thành công!!!']);
    }

    public function getDelete($id)
    {
        $binhluan = DB::table('binhluan')->where('sanpham_id',$id)->get();
        foreach ($binhluan as $val) {

            DB::table('binhluan')->where('sanpham_id',$id)->delete();
        }
        DB::table('lohang')->where('sanpham_id',$id)->delete();
        $chitiet = DB::table('hinhsanpham')->where('sanpham_id',$id)->get();
        foreach ($chitiet as $val) {
            $image = 'upload/chitietsanpham/'.$val->hinhsanpham_ten;
            File::delete($image);
            DB::table('hinhsanpham')->where('sanpham_id',$id)->delete();
        }
    	$sanpham = DB::table('sanpham')->where('id',$id)->first();
        $img = 'upload/sanpham/'.$sanpham->sanpham_anh;
        File::delete($img);
        DB::table('sanpham')->where('id',$id)->delete();

        return redirect()->route('admin.sanpham.list')->with(['flash_level'=>'success','flash_message'=>'Xóa loại sản phẩm thành công!!!']);
    }

    public function getEdit($id)
    {
    	$units = Donvitinh::all();
        // foreach ($units as $key => $val) {
        //     $unit[] = ['id' => $val->id, 'name'=> $val->donvitinh_ten];
        // }
        $cates = Loaisanpham::all();
        // foreach ($cates as $key => $val) {
        //     $cate[] = ['id' => $val->id, 'name'=> $val->loaisanpham_ten];
        // }
        $sanpham = DB::table('sanpham')->where('id',$id)->first();
        $images = DB::table('hinhsanpham')->where('sanpham_id',$id)->get();
        return view('backend.sanpham.sua',compact('cates','units','sanpham','id','images'));
    }

    public function postEdit($id, SanphamEditRequest $request)
    {
        $sanpham = Sanpham::find($id);
        $sanpham->sanpham_ky_hieu   = $request->input('txtSPSignt');
        $sanpham->sanpham_ten       = $request->input('txtSPName');
        $sanpham->sanpham_url       = Replace_TiengViet($request->input('txtSPName'));
        $sanpham->sanpham_mo_ta     = $request->input('txtSPIntro');
        $sanpham->loaisanpham_id    = $request->input('txtSPCate');
        $sanpham->donvitinh_id      = $request->input('txtSPUnit');

        $img_current = 'upload/sanpham/'.$request->input('fImageCurrent');
        if (!empty($request->file('fImage'))) {
             $filename=$request->file('fImage')->getClientOriginalName();
             $sanpham->sanpham_anh = $filename;
             $request->file('fImage')->move(base_path() . 'upload/sanpham/', $filename);
             File::delete($img_current);
        } else {
            echo "File empty";
        }

        if(!empty($request->file('fEditImage'))) {
            foreach ($request->file('fEditImage') as $file) {
                $detail_img = new Hinhsanpham();
                if (isset($file)) {
                    $detail_img->hinhsanpham_ten = $file->getClientOriginalName();
                    $detail_img->sanpham_id = $id;
                    $file->move('upload/chitietsanpham/', $file->getClientOriginalName());
                    $detail_img->save();
                }
          }
        }

        $sanpham->save();

        return redirect()->route('admin.sanpham.list')->with(['flash_level'=>'success','flash_message'=>'Chỉnh sửa sản phẩm thành công!!!']);
    }

    public function delImage(Request $request,$id){
        if ($request->ajax()) {
            $idHinh = (int)$request->get('idHinh');
            $image_detail = Hinhsanpham::find($idHinh);
            if(!empty($image_detail)) {
                $img = 'upload/chitietsanpham/'.$image_detail->hinhsanpham_ten;
                //print_r($img);
                //if(File::isFile($img)) {
                    File::delete($img);
                //}
                $image_detail->delete();
            }
            return "Oke";
        }
    }
}
