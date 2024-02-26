<?php echo e(Form::model($productService, array('route' => array('productstock.update', $productService->id), 'method' => 'PUT'))); ?>

<div class="modal-body">
    <div class="row">

        <div class="form-group col-md-6">
            <?php echo e(Form::label('Product', __('Product'),['class'=>'form-label'])); ?><br>
            <?php echo e($productService->name); ?>


        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('Product', __('SKU'),['class'=>'form-label'])); ?><br>
            <?php echo e($productService->sku); ?>


        </div>

        
        
        
        
        
        
        
        
        
        
        
        

        <div class="form-group col-md-12">
            <?php echo e(Form::label('quantity', __('Quantity'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
            <?php echo e(Form::number('quantity',"", array('class' => 'form-control','required'=>'required'))); ?>

        </div>
    </div>
</div>
<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Save')); ?>" class="btn  btn-primary">
</div>
<?php echo e(Form::close()); ?>

<?php /**PATH /home/integra.platformbisnis.com/public_html/resources/views/productstock/edit.blade.php ENDPATH**/ ?>