<?php echo e(Form::open(array('route' => array('bill.payment', $bill->id),'method'=>'post','enctype' => 'multipart/form-data'))); ?>

    <div class="modal-body">
        <div class="row">
            <div class="form-group col-md-6">
                <?php echo e(Form::label('date', __('Date'),['class'=>'form-label'])); ?>

                <?php echo e(Form::date('date', '', array('class' => 'form-control ','required'=>'required'))); ?>


            </div>
            <div class="form-group col-md-6">
                <?php echo e(Form::label('amount', __('Amount'),['class'=>'form-label'])); ?>

                <?php echo e(Form::number('amount',$bill->getDue(), array('class' => 'form-control','required'=>'required','step'=>'0.01'))); ?>


            </div>
            <div class="form-group col-md-6">
                <?php echo e(Form::label('account_id', __('Account'),['class'=>'form-label'])); ?>

                <?php echo e(Form::select('account_id',$accounts,null, array('class' => 'form-control ','required'=>'required'))); ?>

            </div>
            <div class="form-group col-md-6">
                <?php echo e(Form::label('reference', __('Reference'),['class'=>'form-label'])); ?>

                <?php echo e(Form::text('reference', '', array('class' => 'form-control'))); ?>


            </div>
            <div class="form-group  col-md-12">
                <?php echo e(Form::label('description', __('Description'),['class'=>'form-label'])); ?>

                <?php echo e(Form::textarea('description', '', array('class' => 'form-control','rows'=>3))); ?>

            </div>


            <div class="col-md-6 form-group">
                <?php echo e(Form::label('add_receipt', __('Payment Receipt'), ['class' => 'form-label'])); ?>

                <div class="choose-file ">
                    <label for="file" class="form-label">
                        <input type="file" name="add_receipt" id="image" class="form-control" >
                    </label>
                    <p class="upload_file"></p>
                </div>
            </div>

        </div>
        <div class="modal-footer">

            <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn btn-light" data-bs-dismiss="modal">
            <input type="submit" value="<?php echo e(__('Add')); ?>" class="btn  btn-primary">
        </div>

    </div>
<?php echo e(Form::close()); ?>


<?php /**PATH /home/integra.platformbisnis.com/public_html/resources/views/bill/payment.blade.php ENDPATH**/ ?>