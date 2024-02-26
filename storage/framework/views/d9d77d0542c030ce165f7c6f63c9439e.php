    <?php echo e(Form::model($leavetype,array('route' => array('leavetype.update', $leavetype->id), 'method' => 'PUT'))); ?>

    <div class="modal-body">

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <?php echo e(Form::label('title',__('Leave Type'),['class'=>'form-label'])); ?>

                <?php echo e(Form::text('title',null,array('class'=>'form-control','placeholder'=>__('Enter Leave Type Name')))); ?>

                <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="invalid-name" role="alert">
                    <strong class="text-danger"><?php echo e($message); ?></strong>
                </span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <?php echo e(Form::label('days',__('Days Per Year'),['class'=>'form-label'])); ?>

                <?php echo e(Form::number('days',null,array('class'=>'form-control','placeholder'=>__('Enter Days / Year')))); ?>

            </div>
        </div>

    </div>
    </div>
    <div class="modal-footer">
        <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn btn-light" data-bs-dismiss="modal">
        <input type="submit" value="<?php echo e(__('Update')); ?>" class="btn btn-primary">
    </div>

    <?php echo e(Form::close()); ?>

<?php /**PATH /home/integra.platformbisnis.com/public_html/resources/views/leavetype/edit.blade.php ENDPATH**/ ?>