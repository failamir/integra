<?php echo e(Form::open(array('url' => 'clients'))); ?>

<div class="modal-body">
    <div class="row">
        <div class="form-group">
            <?php echo e(Form::label('name', __('Name'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('name', null, array('class' => 'form-control','placeholder'=>__('Enter client Name'),'required'=>'required'))); ?>

        </div>
        <div class="form-group">
            <?php echo e(Form::label('email', __('E-Mail Address'),['class'=>'form-label'])); ?>

            <?php echo e(Form::email('email', null, array('class' => 'form-control','placeholder'=>__('Enter Client Email'),'required'=>'required'))); ?>

        </div>
        <div class="col-md-5 mb-3 form-group mt-4">
            <label for="password_switch"><?php echo e(__('Login is enable')); ?></label>
            <div class="form-check form-switch custom-switch-v1 float-end">
                <input type="checkbox" name="password_switch" class="form-check-input input-primary pointer" value="on" id="password_switch">
                <label class="form-check-label" for="password_switch"></label>
            </div>
        </div>
        <div class="col-md-12 ps_div d-none">
            <div class="form-group">
                <?php echo e(Form::label('password', __('Password'), ['class' => 'form-label'])); ?>

                <?php echo e(Form::password('password', ['class' => 'form-control', 'placeholder' => __('Enter Client Password'), 'minlength' => '6'])); ?>

                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <small class="invalid-password" role="alert">
                        <strong class="text-danger"><?php echo e($message); ?></strong>
                    </small>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>

        <?php if(!$customFields->isEmpty()): ?>
            <?php echo $__env->make('custom_fields.formBuilder', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>

    </div>
</div>

<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn  btn-primary">
</div>

<?php echo e(Form::close()); ?>



<?php /**PATH /home/integra.platformbisnis.com/public_html/resources/views/clients/create.blade.php ENDPATH**/ ?>