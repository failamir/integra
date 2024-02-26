<?php echo e(Form::open(array('route'=>array('webhook.store'),'method'=>'post'))); ?>


<div class="modal-body">

    <div class="row ">
        <div class="col-12">
            <div class="form-group">
                <?php echo e(Form::label('module', __('Module'),['class'=>'form-label'])); ?>

                <?php echo Form::select('module', $modules, null,array('class' => 'form-control select','required'=>'required')); ?>

            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <?php echo e(Form::label('url',__('Url'),['class'=>'form-label'])); ?>

                <?php echo e(Form::text('url',null,array('class'=>'form-control','placeholder'=>__('Enter Webhook Url')))); ?>

                <?php $__errorArgs = ['url'];
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
                <?php echo e(Form::label('method', __('Method'),['class'=>'form-label'])); ?>

                <?php echo Form::select('method', $methods, null,array('class' => 'form-control select','required'=>'required')); ?>

            </div>
        </div>

    </div>
</div>
<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn  btn-primary">
</div>
<?php echo e(Form::close()); ?>


<?php /**PATH /home/integra.platformbisnis.com/public_html/resources/views/webhook/create.blade.php ENDPATH**/ ?>