<?php echo e(Form::open(['url' => 'users', 'method' => 'post'])); ?>

<div class="modal-body">
    <div class="row">
        <?php if(\Auth::user()->type == 'super admin'): ?>
            <div class="col-md-6">
                <div class="form-group">
                    <?php echo e(Form::label('name', __('Name'), ['class' => 'form-label'])); ?>

                    <?php echo e(Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('Enter Company Name'), 'required' => 'required'])); ?>

                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <small class="invalid-name" role="alert">
                            <strong class="text-danger"><?php echo e($message); ?></strong>
                        </small>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?php echo e(Form::label('email', __('Email'), ['class' => 'form-label'])); ?>

                    <?php echo e(Form::text('email', null, ['class' => 'form-control', 'placeholder' => __('Enter Company Email'), 'required' => 'required'])); ?>

                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <small class="invalid-email" role="alert">
                            <strong class="text-danger"><?php echo e($message); ?></strong>
                        </small>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            <?php echo Form::hidden('role', 'company', null, ['class' => 'form-control select2', 'required' => 'required']); ?>

            <div class="col-md-6 mb-3 form-group mt-4">
                <label for="password_switch"><?php echo e(__('Login is enable')); ?></label>
                <div class="form-check form-switch custom-switch-v1 float-end">
                    <input type="checkbox" name="password_switch" class="form-check-input input-primary pointer" value="on" id="password_switch">
                    <label class="form-check-label" for="password_switch"></label>
                </div>
            </div>
            <div class="col-md-6 ps_div d-none">
                <div class="form-group">
                    <?php echo e(Form::label('password', __('Password'), ['class' => 'form-label'])); ?>

                    <?php echo e(Form::password('password', ['class' => 'form-control', 'placeholder' => __('Enter Company Password'), 'minlength' => '6'])); ?>

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
        <?php else: ?>
            <div class="col-md-6">
                <div class="form-group">
                    <?php echo e(Form::label('name', __('Name'), ['class' => 'form-label'])); ?>

                    <?php echo e(Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('Enter User Name'), 'required' => 'required'])); ?>

                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <small class="invalid-name" role="alert">
                            <strong class="text-danger"><?php echo e($message); ?></strong>
                        </small>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?php echo e(Form::label('email', __('Email'), ['class' => 'form-label'])); ?>

                    <?php echo e(Form::text('email', null, ['class' => 'form-control', 'placeholder' => __('Enter User Email'), 'required' => 'required'])); ?>

                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <small class="invalid-email" role="alert">
                            <strong class="text-danger"><?php echo e($message); ?></strong>
                        </small>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
            <div class="form-group col-md-6">
                <?php echo e(Form::label('role', __('User Role'), ['class' => 'form-label'])); ?>

                <?php echo Form::select('role', $roles, null, ['class' => 'form-control select', 'required' => 'required']); ?>

                <?php $__errorArgs = ['role'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <small class="invalid-role" role="alert">
                        <strong class="text-danger"><?php echo e($message); ?></strong>
                    </small>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-5 mb-3 form-group mt-4">
                <label for="password_switch"><?php echo e(__('Login is enable')); ?></label>
                <div class="form-check form-switch custom-switch-v1 float-end">
                    <input type="checkbox" name="password_switch" class="form-check-input input-primary pointer" value="on" id="password_switch">
                    <label class="form-check-label" for="password_switch"></label>
                </div>
            </div>
            <div class="col-md-6 ps_div d-none">
                <div class="form-group">
                    <?php echo e(Form::label('password', __('Password'), ['class' => 'form-label'])); ?>

                    <?php echo e(Form::password('password', ['class' => 'form-control', 'placeholder' => __('Enter Company Password'), 'minlength' => '6'])); ?>

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
        <?php endif; ?>
        <?php if(!$customFields->isEmpty()): ?>
            <div class="col-md-6">
                <div class="tab-pane fade show" id="tab-2" role="tabpanel">
                    <?php echo $__env->make('customFields.formBuilder', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
        <?php endif; ?>
    </div>

</div>

<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn  btn-primary">
</div>

<?php echo e(Form::close()); ?>

<?php /**PATH /home/integra.platformbisnis.com/public_html/resources/views/user/create.blade.php ENDPATH**/ ?>