@if(isset($payment))
<h3> <a href="/payments/{{ $payment->course['id']}}">
     {{ $payment->course['title']}} </a> </h3>
     @endif
<!-- Amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('amount', 'Amount:') !!}
    {!! Form::number('amount', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Field -->

<div class="form-group col-sm-6">
  <label for="sel1">Status:</label>
  <select class="form-control" name="status" id="sel1">
    <option value="{{$payment->status}}">{{$payment->status}}</option>
    <option value="pending confirmation">pending confirmation</option>
    <option value="confirmed">confirmed</option>
    <option value="refunded">refunded</option>
  </select>
</div>

<!-- User Id Field -->


<div class="form-group col-sm-6">
  <label for="sel1">course:</label>
  <select class="form-control" name="course_id" id="course_id">
    <option value="{{$payment->course['id']}}">{{$payment->course['title']}}</option>
    @foreach($courses as $course)
    <option value="{{$course['id']}}">{{$course['title']}}</option>
    @endforeach
  </select>
</div>


<!-- Payment Processor Field -->
<div class="form-group col-sm-6">
    {!! Form::label('payment_processor', 'Payment Processor:') !!}
    {!! Form::text('payment_processor', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('payments.index') !!}" class="btn btn-default">Cancel</a>
</div>
