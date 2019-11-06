<table class="table table-responsive" id="payments-table">

    <thead>
        <tr>
            <th>Course</th>
            <th>Status</th>
            <th colspan="3"></th>
        </tr>
    </thead>
    <tbody>
        @foreach($payments as $payment)
        <tr>
            <td>
                @if($payment->status == 'confirmed')
                Click here <i class="glyphicon glyphicon-hand-right"></i>
                @endif
                <a class="text-bold 
                    @if($payment->status == 'confirmed')
                        text-success
                        @endif
                    " href="/courses/{{ $payment->course['id'] }}">
                    {!! $payment->course['title'] !!} </a> <br />
                <a href="/users/{{ $payment->user['id'] }}" class="text-muted">
                    {{ $payment->user['email'] }}</a>
                | {!! $payment->mode_of_payment !!}
                <br />
                <span class="text-muted">
                    <b>Price:</b> ₦{{ number_format($payment->course['actual_price']) }} | ${{ number_format($payment->course['actual_price']/360) }}
                    | <b>Discount Price:</b> ₦{{ number_format($payment->course['discount_price']) }} | ${{ number_format($payment->course['discount_price']/360) }}
                    | <b>Amount Paid</b> ₦{!! number_format($payment->amount) !!} | ${!! number_format($payment->amount/360) !!}
                </span>

            </td>

            <td><span class="@if($payment->status == 'pending confirmation')
                    text-danger
                    @elseif($payment->status == 'confirmed')
                    text-success
                @endif
                 text-bold">
                    {!! $payment->status !!}</span>
                @if($payment->status == 'confirmed')
                <br>
                <small>{!! $payment->updated_at->format('h:i a - D d, M Y') !!} </small>
                @else

                @if(Auth::user()->role_id < 3) {!! Form::model($payment, ['route'=> ['payments.update', $payment->id], 'method' => 'patch']) !!}

                    {!! Form::hidden('status', 'confirmed', ['class' => 'form-control']) !!}
                    {!! Form::button('<i class="glyphicon glyphicon-thumbs-up"></i> Confirm Payment', ['type' => 'submit', 'class' => 'btn btn-default btn-xs', 'onclick' => "return confirm('Are you sure you want to approve this payment?')"]) !!}

                    {!! Form::close() !!}
                    @endif
                    @endif
            </td>
            <!--<td class="hidden-xs">{!! $payment->payment_processor !!} <br/>
            <small>{!! $payment->created_at->format('h:i a - D d, M Y') !!} </small>
            </td> -->
            <td>
                @if(Auth::user()->role_id < 3) {!! Form::open(['route'=> ['payments.destroy', $payment->id], 'method' => 'delete']) !!}

                    <div class='btn-group'>
                        <a href="{!! route('payments.show', [$payment->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('payments.edit', [$payment->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                    @else
                    <div class='btn-group'>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#myModal">
                            <i class="glyphicon glyphicon-thumbs-down"></i> Request Refund
                        </button>
                    </div>








                    <!-- Modal -->
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

                        <div class="modal-dialog" role="document">

                            <div class="modal-content">

                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Request For Refund <br />
                                        <small> Note that this will permanently revoke your access to this course </small></h4>


                                </div>
                                {!! Form::model($payment, ['route' => ['payments.update', $payment->id], 'method' => 'patch']) !!}

                                <div class="modal-body">

                                    <div class="box box-primary col-md-12">
                                        <div class="box-body">
                                            <div class="row">

                                                <div class="well text-bold"> <a href="/payments/{{ $payment->course['id']}}">
                                                        {{ $payment->course['title']}} </a> </div>


                                                <input type="hidden" name="status" value="refund requested">
                                                <!-- Status Field -->

                                                <!-- Payment Processor Field -->
                                                <div class="form-group col-sm-12">
                                                    {!! Form::label('refund_details', 'Why do you want a refund?:') !!}
                                                    {!! Form::text('refund_details', null,
                                                    ['class' => 'form-control', 'required'=>'required']) !!}
                                                </div>
                                                <div class="form-group col-sm-12">
                                                    {!! Form::label('refund_payment_details', 'Your bank details:') !!}
                                                    {!! Form::text('refund_payment_details',null,
                                                    ['class' => 'form-control', 'required'=>'required', 'placeholder'=>'name of bank, your full name, account number']) !!}
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    {!! Form::submit('Request Refund', ['class' => 'btn btn-primary']) !!}
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>


                                </div>

                                {!! Form::close() !!}






                            </div>
                        </div>
                    </div>








                    @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>