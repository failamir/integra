<?php echo e(Form::open(array('url' => 'custom-field'))); ?>

<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-12">
            <?php echo e(Form::label('name',__('Custom Field Name'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('name',null,array('class'=>'form-control','required'=>'required' , 'placeholder'=>__('Enter Custom Field Name')))); ?>

        </div>
        <div class="form-group col-md-12">
            <?php echo e(Form::label('type', __('Type'),['class'=>'form-label'])); ?>

            <?php echo e(Form::select('type',$types,null, array('class' => 'form-control select ','required'=>'required'))); ?>

        </div>
        <div class="form-group col-md-12">
            <?php echo e(Form::label('module', __('Module'),['class'=>'form-label'])); ?>

            <?php echo e(Form::select('module',$modules,null, array('class' => 'form-control select ','required'=>'required'))); ?>

        </div>

    </div>
</div>

<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn  btn-primary">
</div>
<?php echo e(Form::close()); ?>

<?php /**PATH /home/integra.platformbisnis.com/public_html/resources/views/customFields/create.blade.php ENDPATH**/ ?>