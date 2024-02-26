
<?php echo e(Form::model($performanceType, array('route' => array('performanceType.update', $performanceType->id), 'method' => 'PUT'))); ?>

<div class="modal-body">

    <div class="form-group">
        <?php echo e(Form::label('name', __('Name'),['class'=>'form-label'])); ?>

        <?php echo e(Form::text('name', null, array('class' => 'form-control','required'=>'required'))); ?>

    </div>
</div>
<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Update')); ?>" class="btn btn-primary">
</div>

<?php echo e(Form::close()); ?>


<?php /**PATH /home/integra.platformbisnis.com/public_html/resources/views/performanceType/edit.blade.php ENDPATH**/ ?>