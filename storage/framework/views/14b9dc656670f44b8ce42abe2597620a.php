
    <?php echo e(Form::model($jobStage, array('route' => array('job-stage.update', $jobStage->id), 'method' => 'PUT'))); ?>

    <div class="modal-body">

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <?php echo e(Form::label('title',__('Title'),['class'=>'form-label'])); ?>

                <?php echo e(Form::text('title',null,array('class'=>'form-control','placeholder'=>__('Enter stage title')))); ?>

            </div>
        </div>

    </div>
</div>

<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Update')); ?>" class="btn btn-primary">
</div>
    <?php echo e(Form::close()); ?>




<?php /**PATH /home/integra.platformbisnis.com/public_html/resources/views/jobStage/edit.blade.php ENDPATH**/ ?>