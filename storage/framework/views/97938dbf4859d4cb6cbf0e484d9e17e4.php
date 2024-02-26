<?php echo e(Form::open(array('url' => 'bank-account'))); ?>

<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-6">
            <?php echo e(Form::label('chart_account_id', __('Account'),['class'=>'form-label'])); ?>

            
            <select name="chart_account_id" class="form-control" required="required">
                <?php $__currentLoopData = $chartAccounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $chartAccount): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($key); ?>" class="subAccount"><?php echo e($chartAccount); ?></option>
                    <?php $__currentLoopData = $subAccounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subAccount): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($key == $subAccount['account']): ?>
                            <option value="<?php echo e($subAccount['id']); ?>" class="ms-5"> &nbsp; &nbsp;&nbsp; <?php echo e($subAccount['code_name']); ?></option>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('holder_name', __('Bank Holder Name'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('holder_name', '', array('class' => 'form-control','required'=>'required' , 'placeholder'=>__('Enter Bank Holder Name')))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('bank_name', __('Bank Name'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('bank_name', '', array('class' => 'form-control','required'=>'required' , 'placeholder' => __('Enter Bank Name')))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('account_number', __('Account Number'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('account_number', '', array('class' => 'form-control','required'=>'required' , 'placeholder' => __('Enter Account Number')))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('opening_balance', __('Opening Balance'),['class'=>'form-label'])); ?>

            <?php echo e(Form::number('opening_balance', '', array('class' => 'form-control','step'=>'0.01' , 'placeholder'=>__('Enter Opening Balance')))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('contact_number', __('Contact Number'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('contact_number', '', array('class' => 'form-control' , 'placeholder'=>__('Enter Contact Number')))); ?>


        </div>
        <div class="form-group col-md-12">
            <?php echo e(Form::label('bank_address', __('Bank Address'),['class'=>'form-label'])); ?>

            <?php echo e(Form::textarea('bank_address', '', array('class' => 'form-control','rows'=>3 , 'placeholder' => __('Enter Bank Address')))); ?>

        </div>
        <?php if(!$customFields->isEmpty()): ?>
            <div class="col-md-12">
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

<?php /**PATH /home/integra.platformbisnis.com/public_html/resources/views/bankAccount/create.blade.php ENDPATH**/ ?>