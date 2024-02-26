{{Form::model($coupon, array('route' => array('coupons.update', $coupon->id), 'method' => 'PUT')) }}
<div class="modal-body">
    {{-- start for ai module--}}
    @php
        $settings = \App\Models\Utility::settings();
    @endphp
    @if(!empty($settings['chat_gpt_key']))
    <div class="text-end">
        <a href="#" data-size="md" class="btn  btn-primary btn-icon btn-sm" data-ajax-popup-over="true" data-url="{{ route('generate',['coupon']) }}"
           data-bs-placement="top" data-title="{{ __('Generate content with AI') }}">
            <i class="fas fa-robot"></i> <span>{{__('Generate with AI')}}</span>
        </a>
    </div>
    @endif
    {{-- end for ai module--}}
    <div class="row">
        <div class="form-group col-md-12">
            {{Form::label('name',__('Name'),['class'=>'form-label'])}}
            {{Form::text('name',null,array('class'=>'form-control font-style','required'=>'required'))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('discount',__('Discount'),['class'=>'form-label'])}}
            {{Form::number('discount',null,array('class'=>'form-control','required'=>'required','step'=>'0.01'))}}
            <span class="small">{{__('Note: Discount in Percentage')}}</span>
        </div>
        <div class="form-group col-md-6">
            {{Form::label('limit',__('Limit'),['class'=>'form-label'])}}
            {{Form::number('limit',null,array('class'=>'form-control','required'=>'required'))}}
        </div>
        <div class="form-group col-md-12">
            {{Form::label('code',__('Code'),['class'=>'form-label'])}}
            {{Form::text('code',null,array('class'=>'form-control','required'=>'required'))}}
        </div>

    </div>
</div>
<div class="modal-footer">
    <input type="button" value="{{__('Cancel')}}" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{__('Update')}}" class="btn  btn-primary">
</div>
{{ Form::close() }}
