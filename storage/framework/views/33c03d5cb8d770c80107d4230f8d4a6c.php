<?php echo e(Form::model(null, array('route' => array('feature_update', $key), 'method' => 'POST','enctype' => "multipart/form-data"))); ?>

<div class="modal-body">
    <?php echo csrf_field(); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <?php echo e(Form::label('Heading', __('Heading'), ['class' => 'form-label'])); ?>

                <?php echo e(Form::text('feature_heading',$feature['feature_heading'], ['class' => 'form-control ', 'placeholder' => __('Enter Heading')])); ?>

            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <?php echo e(Form::label('Description', __('Description'), ['class' => 'form-label'])); ?>

                <?php echo e(Form::textarea('feature_description', $feature['feature_description'], ['class' => 'form-control summernote-simple', 'placeholder' => __('Enter Description')])); ?>

            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <?php echo e(Form::label('Logo', __('Logo'), ['class' => 'form-label'])); ?>

                <input type="file" name="feature_logo" class="form-control">
            </div>
        </div>

    </div>
</div>
<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Update')); ?>" class="btn  btn-primary">
</div>
<?php echo e(Form::close()); ?>







<?php /**PATH /home/integra.platformbisnis.com/public_html/Modules/LandingPage/Resources/views/landingpage/features/edit.blade.php ENDPATH**/ ?>