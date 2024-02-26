
<?php echo e(Form::open(array('url' => 'performanceType'))); ?>

<div class="modal-body">

    <div class="form-group">
        <?php echo e(Form::label('name', __('Name'),['class'=>'form-label'])); ?>

        <?php echo e(Form::text('name', '', array('class' => 'form-control','required'=>'required' , 'placeholder' => 'Enter Performance Type Name'))); ?>

    </div>
</div>
<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn  btn-primary">
</div>
<?php echo e(Form::close()); ?>


<?php /**PATH /home/integra.platformbisnis.com/public_html/resources/views/performanceType/create.blade.php ENDPATH**/ ?>