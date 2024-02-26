<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Warehouse Transfer')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Warehouse Transfer')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        <a href="#" data-size="lg" data-url="<?php echo e(route('warehouse-transfer.create')); ?>" data-ajax-popup="true"
            data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>" data-title="<?php echo e(__('Create Warehouse Transfer')); ?>"
            class="btn btn-sm btn-primary">
            <i class="ti ti-plus"></i>
        </a>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th><?php echo e(__('From Warehouse')); ?></th>
                                    <th><?php echo e(__('To Warehouse')); ?></th>
                                    <th><?php echo e(__('Product')); ?></th>
                                    <th><?php echo e(__('Quantity')); ?></th>
                                    <th><?php echo e(__('Date')); ?></th>
                                    <th><?php echo e(__('Action')); ?></th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php $__currentLoopData = $warehouse_transfers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $warehouse_transfer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="font-style">
                                        <td><?php echo e(!empty($warehouse_transfer->fromWarehouse) ? $warehouse_transfer->fromWarehouse->name : ''); ?>

                                        </td>
                                        <td><?php echo e(!empty($warehouse_transfer->toWarehouse) ? $warehouse_transfer->toWarehouse->name : ''); ?>

                                        </td>
                                        <?php if(!empty($warehouse_transfer->product)): ?>
                                            <td><?php echo e(!empty($warehouse_transfer->product) ? $warehouse_transfer->product->name : ''); ?>

                                            </td>
                                        <?php endif; ?>
                                        <td><?php echo e($warehouse_transfer->quantity); ?></td>
                                        <td><?php echo e(Auth::user()->dateFormat($warehouse_transfer->date)); ?></td>

                                        <?php if(Gate::check('edit warehouse') || Gate::check('delete warehouse')): ?>
                                            <td class="Action">
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete warehouse')): ?>
                                                    <div class="action-btn bg-danger ms-2">
                                                        <?php echo Form::open([
                                                            'method' => 'DELETE',
                                                            'route' => ['warehouse-transfer.destroy', $warehouse_transfer->id],
                                                            'id' => 'delete-form-' . $warehouse_transfer->id,
                                                        ]); ?>

                                                        <a href="#"
                                                            class="mx-3 btn btn-sm  align-items-center bs-pass-para"
                                                            data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>"><i
                                                                class="ti ti-trash text-white"></i></a>
                                                        <?php echo Form::close(); ?>

                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script-page'); ?>
    <script>
        $(document).ready(function() {
            var w_id = $('#warehouse_id').val();
            getProduct(w_id);
        });
        $(document).on('change', 'select[name=from_warehouse]', function() {
            var warehouse_id = $(this).val();
            getProduct(warehouse_id);
        });

        function getProduct(wid) {
            $.ajax({
                url: '<?php echo e(route('warehouse-transfer.getproduct')); ?>',
                type: 'POST',
                data: {
                    "warehouse_id": wid,
                    "_token": "<?php echo e(csrf_token()); ?>",
                },
                success: function(data) {
                    $('#product_id').empty();

                    $("#product_div").html('');
                    $('#product_div').append(
                        '<label for="product" class="form-label"><?php echo e(__('Product')); ?></label>');
                    $('#product_div').append(
                        '<select class="form-control" id="product_id" name="product_id"></select>');
                    $('#product_id').append('<option value=""><?php echo e(__('Select Product')); ?></option>');

                    $.each(data.ware_products, function(key, value) {
                        $('#product_id').append('<option value="' + key + '">' + value + '</option>');
                    });

                    $('select[name=to_warehouse]').empty();
                    $.each(data.to_warehouses, function(key, value) {
                        var option = '<option value="' + key + '">' + value + '</option>';
                        $('select[name=to_warehouse]').append(option);
                    });
                }

            });
        }

        $(document).on('change', '#product_id', function() {
            var product_id = $(this).val();
            var warehouse_id = $('#warehouse_id').val();
            getQuantity(product_id, warehouse_id);
        });

        function getQuantity(pid, wid) {
            $.ajax({
                url: '<?php echo e(route('warehouse-transfer.getquantity')); ?>',
                type: 'POST',
                data: {
                    "product_id": pid,
                    "warehouse_id": wid,
                    "_token": "<?php echo e(csrf_token()); ?>",
                },
                success: function(data) {
                    console.log(data);
                    $('#quantity').val(data);
                }
            });
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/integra.platformbisnis.com/public_html/resources/views/warehouse-transfer/index.blade.php ENDPATH**/ ?>