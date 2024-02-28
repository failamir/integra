<?php echo e(Form::open(array('url'=>'trainer','method'=>'post'))); ?>

<div class="modal-body">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <?php echo e(Form::label('branch',__('Branch'),['class'=>'form-label'])); ?>

                <?php echo e(Form::select('branch',$branches,null,array('class'=>'form-control select','required'=>'required'))); ?>

            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <?php echo e(Form::label('firstname',__('First Name'),['class'=>'form-label'])); ?>

                <?php echo e(Form::text('firstname',null,array('class'=>'form-control','required'=>'required' , 'placeholder'=>__('Enter First Name')))); ?>

            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <?php echo e(Form::label('lastname',__('Last Name'),['class'=>'form-label'])); ?>

                <?php echo e(Form::text('lastname',null,array('class'=>'form-control','required'=>'required' , 'placeholder'=>__('Enter Last Name')))); ?>

            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <?php echo e(Form::label('contact',__('Contact'),['class'=>'form-label'])); ?>

                <?php echo e(Form::text('contact',null,array('class'=>'form-control','required'=>'required' , 'placeholder'=>__('Enter Contact')))); ?>

            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <?php echo e(Form::label('email',__('Email'),['class'=>'form-label'])); ?>

                <?php echo e(Form::text('email',null,array('class'=>'form-control','required'=>'required' , 'placeholder'=>__('Enter email')))); ?>

            </div>
        </div>
        <div class="form-group col-lg-12">
            <?php echo e(Form::label('expertise',__('Expertise'),['class'=>'form-label'])); ?>

            <?php echo e(Form::textarea('expertise',null,array('class'=>'form-control','placeholder'=>__('Expertise')))); ?>

        </div>
        <div class="form-group col-lg-12">
            <?php echo e(Form::label('address',__('Address'),['class'=>'form-label'])); ?>

            <?php echo e(Form::textarea('address',null,array('class'=>'form-control','placeholder'=>__('Address')))); ?>

        </div>
    
    </div>
</div>
<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn  btn-primary">
</div>
<?php echo e(Form::close()); ?>

<?php /**PATH /home/integra.platformbisnis.com/public_html/resources/views/trainer/create.blade.php ENDPATH**/ ?>