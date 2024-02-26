<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Quotation')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Quotataion')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
    <script>
        $('.copy_link').click(function(e) {
            e.preventDefault();
            var copyText = $(this).attr('href');

            document.addEventListener('copy', function(e) {
                e.clipboardData.setData('text/plain', copyText);
                e.preventDefault();
            }, true);

            document.execCommand('copy');
            show_toastr('success', 'Url copied to clipboard', 'success');
        });
    </script>
<?php $__env->stopPush(); ?>


<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">


        
        
        

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create quotation')): ?>
            
            <a href="#" data-size="lg" data-url="<?php echo e(route('quotation.create')); ?>" data-ajax-popup="true"
                data-bs-toggle="tooltip" data-title="<?php echo e(__('Quotataion Create')); ?>" class="btn btn-sm btn-primary">
                <i class="ti ti-plus"></i>
            </a>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th> <?php echo e(__('Quotataion ID')); ?></th>
                                    <th> <?php echo e(__('Date')); ?></th>
                                    <th> <?php echo e(__('Customer')); ?></th>
                                    <th> <?php echo e(__('Warehouse')); ?></th>
                                    <?php if(Gate::check('edit quotation') || Gate::check('delete quotation') || Gate::check('convert quotation')): ?>
                                        <th> <?php echo e(__('Action')); ?></th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>


                                <?php $__currentLoopData = $quotations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quotation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="Id">
                                            <a href="<?php echo e(route('quotation.show', \Crypt::encrypt($quotation->id))); ?>"
                                                class="btn btn-outline-primary"><?php echo e(Auth::user()->quotationNumberFormat($quotation->quotation_id)); ?></a>
                                        </td>
                                        <td><?php echo e(Auth::user()->dateFormat($quotation->quotation_date)); ?></td>
                                        <td> <?php echo e(!empty($quotation->customer) ? $quotation->customer->name : ''); ?> </td>
                                        <td><?php echo e(!empty($quotation->warehouse) ? $quotation->warehouse->name : ''); ?></td>

                                        <?php if(Gate::check('edit quotation') || Gate::check('delete quotation') || Gate::check('convert quotation')): ?>
                                            <td class="Action">
                                                <span>

                                                    <?php if($quotation->is_converted == 0): ?>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('convert quotation')): ?>
                                                            <div class="action-btn bg-warning ms-2">
                                                                <a href="<?php echo e(route('poses.index', $quotation->id)); ?>"
                                                                    class="mx-3 btn btn-sm align-items-center"
                                                                    data-bs-toggle="tooltip" title="<?php echo e(__('Convert to POS')); ?>"
                                                                    data-original-title="<?php echo e(__('Detail')); ?>">
                                                                    <i class="ti ti-exchange text-white"></i>
                                                                </a>
                                                            </div>
                                                        <?php endif; ?>
                                                        <?php else: ?>
                                                        
                                                            <div class="action-btn bg-warning ms-2">
                                                                <a href="<?php echo e(route('pos.show', \Crypt::encrypt($quotation->converted_pos_id))); ?>" class="mx-3 btn btn-sm align-items-center"
                                                                    data-bs-toggle="tooltip"
                                                                    title="<?php echo e(__('Already convert to POS')); ?>"
                                                                    data-original-title="<?php echo e(__('Detail')); ?>">
                                                                    <i class="ti ti-file text-white"></i>
                                                                </a>
                                                            </div>
                                                        
                                                    <?php endif; ?>

                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit quotation')): ?>
                                                        <div class="action-btn bg-primary ms-2">
                                                            <a href="<?php echo e(route('quotation.edit', \Crypt::encrypt($quotation->id))); ?>"
                                                                class="mx-3 btn btn-sm align-items-center"
                                                                data-bs-toggle="tooltip" title="Edit"
                                                                data-original-title="<?php echo e(__('Edit')); ?>">
                                                                <i class="ti ti-pencil text-white"></i>
                                                            </a>
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete quotation')): ?>
                                                        <div class="action-btn bg-danger ms-2">
                                                            <?php echo Form::open([
                                                                'method' => 'DELETE',
                                                                'route' => ['quotation.destroy', $quotation->id],
                                                                'class' => 'delete-form-btn',
                                                                'id' => 'delete-form-' . $quotation->id,
                                                            ]); ?>

                                                            <a href="#"
                                                                class="mx-3 btn btn-sm align-items-center bs-pass-para"
                                                                data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>"
                                                                data-original-title="<?php echo e(__('Delete')); ?>"
                                                                data-confirm="<?php echo e(__('Are You Sure?') . '|' . __('This action can not be undone. Do you want to continue?')); ?>"
                                                                data-confirm-yes="document.getElementById('delete-form-<?php echo e($quotation->id); ?>').submit();">
                                                                <i class="ti ti-trash text-white"></i>
                                                            </a>
                                                            <?php echo Form::close(); ?>

                                                        </div>
                                                    <?php endif; ?>
                                                </span>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/integra.platformbisnis.com/public_html/resources/views/quotation/index.blade.php ENDPATH**/ ?>