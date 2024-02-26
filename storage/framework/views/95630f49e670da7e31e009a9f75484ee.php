    <?php echo e(Form::model($document,array('route' => array('document.update', $document->id), 'method' => 'PUT'))); ?>

    <div class="modal-body">
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <?php echo e(Form::label('name',__('Name',['class'=>'form-label']))); ?>

                <?php echo e(Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter Department Name')))); ?>

                <?php $__errorArgs = ['name'];
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
        <div class="col-12">
            <div class="form-group">
                <?php echo e(Form::label('is_required', __('Required Field'),['class'=>'form-label'])); ?>

                <select class="form-control select2" required name="is_required">
                    <option value="0" <?php if($document->is_required == 0): ?> selected <?php endif; ?>><?php echo e(__('Not Required')); ?></option>
                    <option value="1" <?php if($document->is_required == 1): ?> selected <?php endif; ?>><?php echo e(__('Is Required')); ?></option>
                </select>
            </div>
        </div>

    </div>
    </div>

    <div class="modal-footer">
        <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn btn-light" data-bs-dismiss="modal">
        <input type="submit" value="<?php echo e(__('Update')); ?>" class="btn btn-primary">
    </div>
    <?php echo e(Form::close()); ?>

<?php /**PATH /home/integra.platformbisnis.com/public_html/resources/views/document/edit.blade.php ENDPATH**/ ?>