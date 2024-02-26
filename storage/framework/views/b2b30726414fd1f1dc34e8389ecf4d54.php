<?php echo e(Form::open(['url' => 'chart-of-account'])); ?>

<div class="modal-body">
    
    <?php
        $plan = \App\Models\Utility::getChatGPTSettings();
    ?>
    <?php if($plan->chatgpt == 1): ?>
        <div class="text-end">
            <a href="#" data-size="md" class="btn  btn-primary btn-icon btn-sm" data-ajax-popup-over="true"
                data-url="<?php echo e(route('generate', ['chart of account'])); ?>" data-bs-placement="top"
                data-title="<?php echo e(__('Generate content with AI')); ?>">
                <i class="fas fa-robot"></i> <span><?php echo e(__('Generate with AI')); ?></span>
            </a>
        </div>
    <?php endif; ?>
    
    <div class="row">

        <div class="form-group col-md-12">
            <?php echo e(Form::label('name', __('Name'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::text('name', '', ['class' => 'form-control', 'required' => 'required' , 'placeholder'=>__('Enter Name')])); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('code', __('Code'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::number('code', '', ['class' => 'form-control', 'required' => 'required' , 'placeholder'=>__('Enter Code')])); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('sub_type', __('Account Type'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::select('sub_type', $account_type, null, ['class' => 'form-control select', 'required' => 'required'])); ?>

        </div>

        <div class="col-md-2">
            <div class="form-group ">
                <?php echo e(Form::label('is_enabled', __('Is Enabled'), ['class' => 'form-label'])); ?>

                <div class="form-check form-switch">
                    <input type="checkbox" class="form-check-input" name="is_enabled" id="is_enabled" checked>
                    <label class="custom-control-label form-check-label" for="is_enabled"></label>
                </div>
            </div>
        </div>

        <div class="col-md-4 mt-4 acc_check d-none">
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="account">
                <label class="form-check-label" for="account"><?php echo e(__('Make this a sub-account')); ?></label>
            </div>
        </div>

        <div class="form-group col-md-6 acc_type d-none">
            <?php echo e(Form::label('parent', __('Parent Account'), ['class' => 'form-label'])); ?>

            <select class="form-control select" name="parent" id="parent">
            </select>
        </div>

        <div class="form-group col-md-12">
            <?php echo e(Form::label('description', __('Description'), ['class' => 'form-label'])); ?>

            <?php echo Form::textarea('description', null, ['class' => 'form-control', 'rows' => '2'  , 'placeholder'=>__('Enter Description')]); ?>

        </div>

    </div>
</div>
<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn  btn-primary">
</div>
<?php echo e(Form::close()); ?>

<?php /**PATH /home/integra.platformbisnis.com/public_html/resources/views/chartOfAccount/create.blade.php ENDPATH**/ ?>