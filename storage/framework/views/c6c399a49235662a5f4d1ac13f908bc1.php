<?php echo e(Form::open(array('url'=>'travel','method'=>'post'))); ?>

<div class="modal-body">
    
    <?php
        $plan= \App\Models\Utility::getChatGPTSettings();
    ?>
    <?php if($plan->chatgpt == 1): ?>
    <div class="text-end">
        <a href="#" data-size="md" class="btn  btn-primary btn-icon btn-sm" data-ajax-popup-over="true" data-url="<?php echo e(route('generate',['travel'])); ?>"
           data-bs-placement="top" data-title="<?php echo e(__('Generate content with AI')); ?>">
            <i class="fas fa-robot"></i> <span><?php echo e(__('Generate with AI')); ?></span>
        </a>
    </div>
    <?php endif; ?>
    
    <div class="row">
        <div class="form-group col-md-12">
            <?php echo e(Form::label('employee_id', __('Employee'),['class'=>'form-label'])); ?>

            <?php echo e(Form::select('employee_id', $employees,null, array('class' => 'form-control select','required'=>'required'))); ?>

        </div>
        <div class="form-group col-lg-6 col-md-6">
            <?php echo e(Form::label('start_date',__('Start Date'),['class'=>'form-label'])); ?>

            <?php echo e(Form::date('start_date',null,array('class'=>'form-control'))); ?>

        </div>
        <div class="form-group col-lg-6 col-md-6">
            <?php echo e(Form::label('end_date',__('End Date'),['class'=>'form-label'])); ?>

            <?php echo e(Form::date('end_date',null,array('class'=>'form-control'))); ?>

        </div>
        <div class="form-group col-lg-6 col-md-6">
            <?php echo e(Form::label('purpose_of_visit',__('Purpose of Trip'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('purpose_of_visit',null,array('class'=>'form-control' , 'placeholder'=>__('Enter Purpose of Visit')))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('place_of_visit',__('Country'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('place_of_visit',null,array('class'=>'form-control' ,'placeholder'=>__('Enter Place of Visit')))); ?>

        </div>
        <div class="form-group col-md-12">
            <?php echo e(Form::label('description',__('Description'),['class'=>'form-label'])); ?>

            <?php echo e(Form::textarea('description',null,array('class'=>'form-control','placeholder'=>__('Enter Description')))); ?>

        </div>

    </div>
</div>
<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn  btn-primary">
</div>
    <?php echo e(Form::close()); ?>

<?php /**PATH /home/integra.platformbisnis.com/public_html/resources/views/travel/create.blade.php ENDPATH**/ ?>