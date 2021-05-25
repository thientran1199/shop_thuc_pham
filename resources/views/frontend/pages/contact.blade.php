@extends('frontend.master')
@section('content')
  <!-- catg header banner section -->
  <section id="aa-catg-head-banner">
   <img src="{{ asset('images/contactpanel.jpg') }}" alt="fashion img" style="width: 1920px; height: 300px;" >
   <div class="aa-catg-head-banner-area">
     <div class="container">
      <div class="aa-catg-head-banner-content">
        <h2>Liên hệ</h2>
        <ol class="breadcrumb">
          <li><a href="{{ url('/') }}">Home</a></li>
          <li class="active">Liên hệ</li>
        </ol>
      </div>
     </div>
   </div>
  </section>
  </section>
  <!-- / product category -->
  <!-- start contact section -->
 <section id="aa-contact">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
         <div class="aa-contact-area">
           <div class="aa-contact-top">
             <h2 style="font:30px tahoma, sans-serif; color:green;">Chúng tôi đang chờ để được hỗ trợ bạn</h2>
             <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quasi, quos.</p> -->
           </div>
           <!-- contact map -->
           <div class="aa-contact-map">
       <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15256.272990602514!2d107.02263233635455!3d17.069314080218046!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3140c5ddb0e043cf%3A0x4b49899699579b71!2zVGhp4bq_dCBL4bq_IFdlYnNpdGU!5e0!3m2!1svi!2s!4v1617195379762!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe></div>
           <!-- Contact address -->
           <div class="aa-contact-address">
             <div class="row">
               <div class="col-md-8">
                 <div class="aa-contact-address-left">
                   <form class="comments-form contact-form" action="" method="POST">
                   <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <input type="text" name="txtName" placeholder="Your Name" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <input type="email" name="txtMail" placeholder="Email" class="form-control">
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <textarea class="form-control" name="txtContent" rows="3" placeholder="Message"></textarea>
                    </div>
                    <button class="aa-secondary-btn">Gửi</button>
                  </form>
                 </div>
               </div>
               <div class="col-md-4">
                 <div class="aa-contact-address-right" style="font: tahoma, sans-serif;">
                   <address>
                     <h4 style="font:24px tahoma, sans-serif; color:red;"><b><i>Nông sản sạch Cần Thơ</i></b></h4>
                     <p>Chất lượng là hàng đầu</p>
                     <p><span class="fa fa-home"></span>Ninh Kiều-Cần Thơ</p>
                     <p><span class="fa fa-phone"></span>0167.899.12.81</p>
                     <p><span class="fa fa-envelope"></span>Email: nongsancantho@gmail.com</p>
                   </address>
                 </div>
               </div>
             </div>
           </div>
         </div>
       </div>
     </div>
   </div>
 </section>
<!-- Footer -->
@include('frontend.blocks.footer')
<!-- / Footer -->
@stop
