<?php echo e(Form::open(array('url' => 'warehouse-transfer'))); ?>

<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-6">
            <?php echo e(Form::label('from_warehouse', __('From Warehouse'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
            <select class="form-control select" name="from_warehouse" id="warehouse_id" placeholder="Select Warehouse">
                <option value=""><?php echo e(__('Select Warehouse')); ?></option>
                <?php $__currentLoopData = $from_warehouses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $warehouse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($warehouse->id); ?>"><?php echo e($warehouse->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('to_warehouse',__('To Warehouse'),array('class'=>'form-label'))); ?><span class="text-danger">*</span>
            <?php echo e(Form::select('to_warehouse', $to_warehouses,null, array('class' => 'form-control select','required'=>'required'))); ?>

        </div>
        <div class="form-group col-md-6" id="product_div">
            <?php echo e(Form::label('product',__('Product'),array('class'=>'form-label'))); ?>

            <select class="form-control select" name="product_id" id="product_id" placeholder="Select Product">
            </select>
        </div>

        <div class="form-group col-md-6" id="qty_div">
            <?php echo e(Form::label('quantity', __('Quantity'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
            <?php echo e(Form::number('quantity',null, array('class' => 'form-control','id' => 'quantity'))); ?>

        </div>


        <div class="form-group col-lg-6">
            <?php echo e(Form::label('date',__('Date'))); ?>

            <?php echo e(Form::date('date',null,array('class'=>'form-control datepicker w-100 mt-2'))); ?>

        </div>

    </div>
</div>
<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn btn-primary">
</div>
<?php echo e(Form::close()); ?>

<?php /**PATH /home/integra.platformbisnis.com/public_html/resources/views/warehouse-transfer/create.blade.php ENDPATH**/ ?>