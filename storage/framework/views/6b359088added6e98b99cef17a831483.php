
    <?php echo e(Form::open(array('url'=>'competencies','method'=>'post'))); ?>

    <div class="modal-body">

    <div class="row ">
        <div class="col-12">
            <div class="form-group">
                <?php echo e(Form::label('name',__('Name'),['class'=>'form-label'])); ?>

                <?php echo e(Form::text('name',null,array('class'=>'form-control'))); ?>

            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <?php echo e(Form::label('type',__('Type'),['class'=>'form-label'])); ?>

                <?php echo e(Form::select('type',$performance,null,array('class'=>'form-control select' , 'placeholder' => 'Enter Competencies Name'))); ?>

            </div>
        </div>

    </div>
</div>
    <div class="modal-footer">
        <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
        <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn  btn-primary">
    </div>
    <?php echo e(Form::close()); ?>


<?php /**PATH /home/integra.platformbisnis.com/public_html/resources/views/competencies/create.blade.php ENDPATH**/ ?>