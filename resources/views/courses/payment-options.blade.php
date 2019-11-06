@if(!isset($getSubscription->created_at) || !Auth::check() || 
(!isset($getSubscription->created_at) && (Auth::check() && (Auth::user()->id != $course->user_id || Auth::user()->role_id > 2)  ) ) )


<?php 
//used to tell elements below that payments-option element is displaying
$paymentShowing = 'yes';
?>
<div class="col-md-10">
 <div  style="border-radius: 10px;">
           <h3 class="text-center">Enroll in this online course</h3>     
           
           <div class="panel panel-default">

              @if(isset($summaryCourses) || isset($mainCourse))
              <div class="panel-body text-center">
                <p> <b>Payment options</b>: There are multiple price options for you below.  </p>
                <p><b>Installments</b>: Dont have money? No worries, you can pay in 2 - 3 installments. Your access will be granted once your payment is complete. Click on the 'enroll' button below to start with your first payment. </p>
                <p><b>Choose the one that best suites your wants.</b></p>

<script>
function startTimer(duration, display) {
    var timer = duration, minutes, seconds;
    setInterval(function () {
        minutes = parseInt(timer / 60, 10)
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.textContent = minutes + ":" + seconds;

        if (--timer < 0) {
            timer = duration;
        }
    }, 1000);
}

window.onload = function () {
    var fiveMinutes = 30 * 59,
        display = document.querySelector('#time');
    startTimer(fiveMinutes, display);
};
</script>


<div class="text-center">
  
  <i class="glyphicon glyphicon-clock text-muted"></i> Time may be running out on this low price!<br/>
     <span id="time" class="text-success" style="font-weight: bold; font-size: 30px;">59:00</span> minutes remaining!
</div>

              </div>
        


<div class="media" 
style="border-bottom: 1px solid grey; 
padding-bottom: 10px;margin-bottom: 10px; ">
  <div class="media-left">
    {{-- <i class="text-success glyphicon glyphicon-play"></i> --}}
  </div>
  
  <div class="media-body">
    <h4 class="media-heading">
     This course: <h3 >
                         {{$course->title }}  | 
                        
                         {{$course->items_count }} videos
                      
                      </h3>
                         <small class="text-muted">  
                           {{$course->sub_title }} 
                          
                      
                    </small>
                     
                        <div class=" col-md-12"  >
                            <span class="summaryCourse">
                    
                          <span  class="text-green">
                               ₦{!! number_format($course->actual_price) !!} 
                              
                          </span>
                          </span>
                        <span class="thisCourseDiscount" style="display:none"  >
                          <div class="text-bold text-green text-success"> 
                            Congratulations! you just unlocked the new prices below</div>
                        <span style=" font-weight: bold; font-size:20px;" class="text-default">
                        
                          
                        </span>
                          <span  class=" text-green">
                              ₦{!! number_format($course->discount_price) !!} 
                              <span style=" text-decoration:line-through; 
                              margin-left: 5px;" class="ml-3 text-danger"
                            >₦{!! number_format($course->actual_price) !!}
                          </span> 
                          
                          </span>
                          </span> </span>
   <button type="button" class="btn btn-success btn-sm enrollButtonThisCourse" 
                          data-toggle="modal" data-target="#myModal">
                            <i class="glyphicon glyphicon-education"></i> Make Payment
                          </button>
                          </span>
                      
         <span class="thisCourse">
         

                          <br/>
                          <br/>
                           <b>TIP:</b> Share this course to reduce the 
                           price to <b>₦{!! number_format($course->discount_price) !!} 
                          </b>
                         <br/> 
                           <button type="button" class="btn btn-danger btn-sm shareButton" 
                          data-toggle="modal" data-target="#shareModal">
                            <i class="glyphicon glyphicon-share"></i> Click to share
                          </button>
                        </span>
                          
  </div>
  </div>


</div>    











                    
@if(isset($summaryCourses))
      @foreach($summaryCourses as $summaryCourse)

<div class="media" 
style="border-bottom: 1px solid grey; 
padding-bottom: 10px;margin-bottom: 10px; ">
  <div class="media-left">
    {{-- <i class="text-success glyphicon glyphicon-play"></i> --}}
  </div>
  
  <div class="media-body">
    <h4 class="media-heading">
     &nbsp; Similar course: <a href="/courses/{{$summaryCourse->id }}">
                         {{$summaryCourse->title }} </a>
                      | 
                        
                         {{$summaryCourse->items_count }} videos
                      </h4>
                         <small class="text-muted">  
                           {{$summaryCourse->sub_title }} 
                          
                       
                    </small>
                     
                        <div class="col-md-12"  >
                           <span class="summaryCourse">
                       
                          <span  class="text-green">
                               ₦{!! number_format($summaryCourse->actual_price) !!} 
                              
                          
                          </span>
                          </span>
                          

                        <span class="summaryCourseDiscount" style="display:none"  >
                          
                          <div class="text-bold text-green text-success"> 
                            Congratulations! you just unlocked the new prices below</div>
                      
                          <span  class="text-green">
                               ₦{!! number_format($summaryCourse->discount_price) !!} 
                              <span style=" text-decoration:line-through; 
                              margin-left: 5px;" class="ml-3 text-danger">
                              ₦{!! number_format($summaryCourse->actual_price) !!}
                          </span> 
                          
                          </span>
   <button type="button" class="btn btn-success btn-sm enrollButtonSummaryCourse" 
                          data-toggle="modal" data-target="#myModal">
                            <i class="glyphicon glyphicon-education"></i> Make Payment
                          </button>
                          </span>
                      
         <span class="summaryCourse">
                          <br/>
                          <br/>
                           <b>TIP:</b> Share this course to reduce the 
                           price to 
                           <b>
                           ₦{!! number_format($summaryCourse->discount_price) !!} </b>
                         <br/></span>
                           <button type="button" class="btn btn-danger btn-sm shareButton" 
                          data-toggle="modal" data-target="#shareModal">
                            <i class="glyphicon glyphicon-share"></i> Click to share
                          </button>
                              
  </div>
  </div>


</div>    
  
@endforeach
@endif
                    @if(isset($mainCourse))

                    <div class="media" style="border-bottom: 1px solid grey; 
padding-bottom: 10px;margin-bottom: 10px;">
  
  <div class="media-body">
    <h4 class="media-heading">
    Similar course:  <a href="/courses/{{$mainCourse->id }}">
                         {{$mainCourse->title }} </a>  | 
                        {{ $mainCourse->items_count }} videos
                      </h4>
                         <small class="text-muted">  {{$mainCourse->sub_title }} </small>
                    
<div>
                   <div class=" col-md-12"  >
                      <span class="mainCourse">
                      
                          <span  class=" text-green">
                               ₦{!! number_format($mainCourse->actual_price) !!} 
                              
                          
                          </span>
                          </span>
                          


                     <span class="mainCourseDiscount" style="display:none" >
                       
                          <div class="text-bold text-green text-success"> 
                            Congratulations! you just unlocked the new prices below</div>
                   

                          <span  class=" text-green">
                               ₦{!! number_format($mainCourse->discount_price) !!} 
                              <span style=" text-decoration:line-through; 
                              margin-left: 5px;" class="ml-3 text-danger"
                            >₦{!! number_format($mainCourse->actual_price) !!}
                          </span> 
                          
                          </span> 
                       
                          </span>
                             <button type="button" class="btn btn-success btn-sm enrollButtonMainCourse" 
                              data-toggle="modal" data-target="#myModal">
                                <i class="glyphicon glyphicon-education"></i> Make Payment
                              </button>
                         <span class="mainCourse">
                         

                                 <br/>
                          <br/>
                           <b>TIP:</b> Share this course to reduce the 
                           price to <b>₦{!! number_format($mainCourse->discount_price) !!} 
                       </b>
                         <br/>
                           <button type="button" class="btn btn-danger btn-sm shareButton" 
                          data-toggle="modal" data-target="#shareModal">
                            <i class="glyphicon glyphicon-share"></i> Click to share
                          </button>
                           </span> 
  </div>
  </div>
</div>
                    @endif

          
  @else

    <p>
        <div class="text-center">
   
             <span style="font-size: 18px;" class=" text-green">
                ₦{!! number_format($course->discount_price) !!} 

               <span style=" text-decoration:line-through; 
                        margin-left: 5px;" class="ml-3 text-danger">
                        ₦{!! number_format($course->actual_price) !!}
              </span> 
          
          </span>
          
@endif



<div class="modal fade" tabindex="-1"  id="shareModal" aria-labelledby="shareModalLabel" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">To win a huge discount on this course, 
          click any of the share buttons below and share, 
          then click the "I have shared" button below to 
          return to the course page and purchase at the new discounted price!
           </h4>
      </div>
      <div class="modal-body">
        <p>
          
                <!-- Go to www.addthis.com/dashboard to customize your tools -->
                <div class="addthis_sharing_toolbox"></div>
            
        </p>
      </div>
      <div class="modal-footer">
       
        <button type="button" class="btn btn-default" data-dismiss="modal">I have shared it</button>
   {{--       <button type="button" class="btn btn-primary">Save changes</button> --}}
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->




<!-- Button trigger modal -->
{{-- <button type="button" class="btn btn-success btn-lg btn-block col-md-6" data-toggle="modal" data-target="#myModal">
  <i class="glyphicon glyphicon-education"></i> Enroll now
</button> --}}

<!-- Modal -->
<div class="modal fade " id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header ">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Enroll now</h4>
      </div>
      <div class="modal-body">

        <!-- refund_policy Field -->
 <div class="form-group col-md-11 text-center">
    {!! Form::label('refund_policy', 'Refund Policy:') !!}
    <p>

        @if($course->refund_policy)
            {!! $course->refund_policy !!}
        @else
           All sales are final due to the nature of the product. We do not offer refunds.

In this course, a lot of sensitive and high-value information is revealed that can not be unseen or unlearned. 
This policy is in place to protect the intellectual property contained within this course.

Please contact realDavePartner@gmail.com if you have any questions about this.
            
        @endif
    </p>

    <p class="priceArea"></p>
</div> 

<br/>
<div class="text-center well">
               Choose payment method below
        </div>
        <br/>

            
          

            <button class="btn btn-primary" type="button" data-toggle="collapse" 
            data-target="#bank" aria-expanded="false" aria-controls="bank">
           <i class="glyphicon glyphicon-arrow-down"></i> Bank Transfer (24 hours)
            </button>
            
              <br/><br/>
              
            <button class="btn btn-primary" type="button" data-toggle="collapse" 
            data-target="#paystack" aria-expanded="false" aria-controls="paystack">
            <i class="glyphicon glyphicon-arrow-down"></i>USD Card Payment (instant)
            </button>

            <br/>
            <br/>
            <button class="btn btn-danger" type="button" 
data-toggle="collapse" data-target="#bankConfirm" aria-expanded="false" aria-controls="bankConfirm">
 <i class="glyphicon glyphicon-arrow-down"></i> I have made payment
</button>
             <br/>
            <br/>
            
            <div class="collapse" id="bank">
                    <div class="well">
                          @include('courses.bank-payment')
                    </div>
            </div>
            <div class="collapse" id="paystack">
                    <div class="well">
                    
                            @include('courses.paystack')
                    </div>
            </div>

            <br/>
            <p> Send an email to <b>realDavePartner@gmail.com</b> if you have any issues </p>
            
            
            
            
            
            
            
            
            
            
            
            
<div class="collapse" id="bankConfirm">
    <br>
    <p> Give us the details of your payment eg. teller number, the full name on your bank account etc </p>
    <p> Your course will be enabled within 24 hours, so check back.  </p>
 
   
  {!! Form::open(['route' => 'payments.store']) !!}

                        

<!-- User Id Field -->



<?php if(Auth::check()){
    $email = Auth::user()->email;
}else{
    $email = '';
} 
?>

<!-- Amount Field -->
<div class="form-group col-sm-12">
    {!! Form::label('email', 'Your email address:') !!}
    {!! Form::text('email', $email, ['required'=>'required', 'class' => 'form-control','placeholder'=> 'eg. john@gmail.com']) !!}
</div>



<input type="hidden" name="course_id" value="{{ $course->id }}">
<input type="hidden" name="status" value="pending confirmation">
<!-- Mode Of Payment Field -->
    {!! Form::hidden('mode_of_payment', 'Bank Transfer') !!}



<!-- Amount Field -->
<div class="form-group col-sm-12">
    {!! Form::label('amount', 'How much did you pay (in Naira) [type numbers only, no comma]:') !!}
    {!! Form::number('amount', null, ['required'=>'required', 'class' => 'form-control','placeholder'=> $course->discount_price]) !!}
</div>





<!-- Payment Processor Field -->
<div class="form-group col-sm-12">
    {!! Form::label('payment_processor', 
    'Payment Processor: 
     The bank or service you transfered the payment from?') !!}
    {!! Form::text('n', null, ['required'=>'required','class' => 'form-control','placeholder'=>'eg. Azimo or First Bank']) !!}
 </div>

<!-- Payment Processor Field -->
<div class="form-group col-sm-12">
    {!! Form::label('name_of_depositor', 
    'Name of depositor as it appears on the payment slip:') !!}
    {!! Form::text('name_of_depositor', null, ['required'=>'required','class' => 'form-control','placeholder'=>'eg. Ciroma Adekunle']) !!}
 </div>

 {{-- 
<!-- Description Field -->
<div class="form-group col-md-12 ">
    {!! Form::label('proof_of_payment', 'Proof of payment: Eg. teller number or screenshot') !!}
    {!! Form::textarea('proof_of_payment', null, [ 'rows' => '10', 'width' => '100%', 'class' => 'form-control']) !!}

</div>  --}}


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
</div>






                    {!! Form::close() !!}


</div>

<div class="clearfix"> </div> 
            
            
            
            
           
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
      </div>
    </div>
  </div>
</div>





        <div class="text-center">
                <i class="fa fa-plus-circle text-muted"></i> 
                <a href="/privacy" target="_blank">Privacy Policy</a> | 
                <a href="/refund" target="_blank">Refund Policy</a> | 
                <a href="/tos" target="_blank">Terms of Service</a> 
                {{-- REFUND: If you don't like the course
                within 24-hours, you'll get your full money back, guaranteed.
                 --}}
        </div>
        </div>
    </p>
</div>
</div>
                      @endif
                      <script>

                        $(function() {

                          

                          $('.enrollButtonSummaryCourse').click(function() {
                            $( ".priceArea" ).html('');
                          $( ".summaryCourseDiscount" ).clone().prependTo( ".priceArea" );
                        });

                          $('.enrollButtonThisCourse').click(function() {
                            $( ".priceArea" ).html('');
                          $( ".thisCourseDiscount" ).clone().prependTo( ".priceArea" );
                        });

                          $('.enrollButtonMainCourse').click(function() {
                            $( ".priceArea" ).html('');
                            $( ".mainCourseDiscount" ).clone().prependTo( ".priceArea" );
                        });

                        //hide elements on share 
                        $('.shareButton').click(function() {
                                $('.summaryCourse').hide();
                                $('.mainCourse').hide();
                                $('.thisCourse').hide();

                                
                                $('.summaryCourseDiscount').show();
                                $('.mainCourseDiscount').show();
                                $('.thisCourseDiscount').show();

                                //for this to work, I had to import 
                                //https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js
                                Cookies.set('clickedShareButton', 'yes', { expires: 7 }); //expires in 7 days
                               
                              });


                              if(Cookies.get('clickedShareButton') == "yes"){
                                
                                $('.summaryCourse').hide();
                                $('.mainCourse').hide();
                                $('.thisCourse').hide();

                                
                                $('.summaryCourseDiscount').show();
                                $('.mainCourseDiscount').show();
                                $('.thisCourseDiscount').show();

                                //create cookie to 
                                Cookies.set('clickedShareButton', 'yes');
                              
                          }
                        });


                       
                          
                      </script>