   Make a bank trasfer of the above sum to: <br/>
                            <b>Bank:</b> GTBank <br>
                            <b>Account Number:</b> 045 6874 551 <br>
                            <b>Account Name:</b> Braintemple Software <br>
                           <b> Phone:</b> +234 80 3511 7575 <small>(no calls or text)</small><br>
                           <br>
                        <p>
                            If you are outside Nigeria, you can transfer money to the above account using 
                            <a href="https://azimo.com" target="_blank">azimo.com</a> or 
                            <a href="https://worldremit.com" target="_blank">Worldremit.com</a>. Just visit the website, it is very very easy and very secure.   </p>
<br>
<div style="color: red; font-weight: bold;">
NB: If you have made payment using any of the above means, you must click the button below to notify us.</br>
</div>                 <br/>

                 
<button class="btn btn-danger" type="button" 
data-toggle="collapse" data-target="#bankConfirm" aria-expanded="false" aria-controls="bankConfirm">
 <i class="glyphicon glyphicon-arrow-down"></i> I have made payment
</button>
<div class="collapse" id="bankConfirm">
    <br>
    <p> Give use the details of your payment eg. teller number, the full name on your bank account etc </p>
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

<p> NB: This form wont submit if you leave any of the fields above empty.
    After submiting the form, email proof of payment to realDavePartner@gmail.com and your access will be granted.
    <p> 
        Click the submit button below.

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
</div>






                    {!! Form::close() !!}


</div>

<div class="clearfix"> </div> 