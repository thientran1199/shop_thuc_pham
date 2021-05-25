@extends('frontend.master')
@section('content')
  <!-- catg header banner section -->
  <section id="aa-catg-head-banner">
   <img src="{{asset('/images/cartpannel.jpg') }}" alt="fashion img" style="width: 1920px; height: 300px;" >
   <div class="aa-catg-head-banner-area">
     <div class="container">
      <div class="aa-catg-head-banner-content">
        <h2>Giỏ hàng</h2>
        <ol class="breadcrumb">
          <li><a href="{{url('/') }}">Trang chủ</a></li>
          <li class="active">Giỏ hàng</li>
        </ol>
      </div>
     </div>
   </div>
  </section>
  <!-- / product category -->

  <!-- Support section -->
  @include('frontend.blocks.trans')
  <!-- / Support section -->

 <!-- Cart view section -->
 <section id="cart-view">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
         <div class="cart-view-area">
           <div class="cart-view-table">
             <form action="">
               <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>

                        <th>Ảnh</th>
                        <th>Sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                        <th>Cập nhật</th>
                        <th>Xoá</th>
                      </tr>
                    </thead>

                    <tbody>
                    <form action="" method="POST" accept-charset="utf-8">
                    <input type="hidden" name="_token" value="{{csrf_token() }}" />
                    @foreach ($content as $item)
                      <?php
                          $sanpham = DB::table('sanpham')->where('id',$item->id)->first();
                       ?>
                      <tr>
                        <td><a href="{{url('san-pham',$sanpham->sanpham_url) }}"><img src="{{asset('upload/sanpham/'.$sanpham->sanpham_anh) }}"  style="width: 45px; height: 50px;"></a></td>
                        <td><a class="aa-cart-title" href="{{url('san-pham',$sanpham->sanpham_url) }}">{{ $item->name }}</a></td>
                        <td>{{ number_format($item->price) }}vnđ</td>
                        <td><input class="qty aa-cart-quantity" type="number" value="{{ $item->qty }}"></td>
                        <td>{{number_format( $item->price*$item->qty) }}vnđ</td>
                        <td><a class="updatecart "  id="{{ $item->rowId }}" href='javascript:void(0)'><fa class=" fa fa-edit"></fa></a></td>
                        <td><a class="remove" href='{{ url('xoa-san-pham',['id'=>$item->rowId]) }}'><fa class="fa fa-close"></fa></a></td>

                      </tr>
                    @endforeach
                    </form>
                      </tbody>

                  </table>
                </div>
             </form>
             <!-- Cart Total view -->
             <div class="cart-view-total">
               <!-- <h4>Tổng tiền</h4> -->
               <table class="aa-totals-table">
                 <tbody>
                   <tr>
                     <th>Tổng tiền</th>
                     <td> {{ Cart::total() }} vnđ</td>
                   </tr>
                 </tbody>
               </table>
               @if (Auth::check())
                  <a href="{{url('/') }}" class="aa-cart-view-btn"> Mua tiếp</a>
                  <a href="{{URL::route('getThanhtoan') }}" class="aa-cart-view-btn">Thanh Toán</a>

               @else
                  <a href="{{url('/') }}" class="aa-cart-view-btn">Mua tiếp</a>
                  <a href="{{url('login') }}" class="aa-cart-view-btn">Thanh Toán</a>
               @endif

             </div>
           </div>
         </div>
       </div>
     </div>
   </div>
 </section>
 <!-- / Cart view section -->
 <!-- Footer -->
@include('frontend.blocks.footer')
<!-- / Footer -->
@stop
