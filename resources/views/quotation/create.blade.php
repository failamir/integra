{{ Form::open(['route' => ['quotations.create', 0], 'method' => 'post']) }}
<div class="modal-body">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('customer_id', __('Customer'),['class'=>'form-label']) }}
                {{ Form::select('customer_id', $customers,'', array('class' => 'form-control select','required'=>'required')) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('warehouse_id', __('Warehouse'),['class'=>'form-label']) }}
                {{ Form::select('warehouse_id', $warehouse,null, array('class' => 'form-control select warehouse_id','required'=>'required')) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('quotation_date', __('Quotation Date'),['class'=>'form-label']) }}
                {{Form::date('quotation_date',null,array('class'=>'form-control','required'=>'required'))}}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('quotation_number', __('Quotation Number'),['class'=>'form-label']) }}
                {{ Form::text('quotation_number', $quotation_number, ['class' => 'form-control', 'readonly' => 'readonly']) }}
            </div>
        </div>
    </div>
</div>

<div class="modal-footer">
    <input type="button" value="{{__('Cancel')}}" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{__('Create')}}" class="btn  btn-primary">
</div>

{{Form::close()}}
