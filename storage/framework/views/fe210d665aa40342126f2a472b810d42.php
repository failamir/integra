<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Trainer')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Trainer')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create trainer')): ?>
    
            <a href="#" data-size="lg" data-url="<?php echo e(route('trainer.create')); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>" data-title="<?php echo e(__('Create New Trainer')); ?>" class="btn btn-sm btn-primary">
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
                                <th><?php echo e(__('Branch')); ?></th>
                                <th><?php echo e(__('Full Name')); ?></th>
                                <th><?php echo e(__('Contact')); ?></th>
                                <th><?php echo e(__('Email')); ?></th>
                                <?php if( Gate::check('edit trainer') ||Gate::check('delete trainer') ||Gate::check('show trainer')): ?>
                                    <th width="200px"><?php echo e(__('Action')); ?></th>
                                <?php endif; ?>
                            </tr>
                            </thead>
                            <tbody class="font-style">
                            <?php $__currentLoopData = $trainers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trainer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e(!empty($trainer->branches)?$trainer->branches->name:''); ?></td>
                                    <td><?php echo e($trainer->firstname .' '.$trainer->lastname); ?></td>
                                    <td><?php echo e($trainer->contact); ?></td>
                                    <td><?php echo e($trainer->email); ?></td>
                                    <?php if( Gate::check('edit trainer') ||Gate::check('delete trainer') || Gate::check('show trainer')): ?>
                                        <td>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show trainer')): ?>
                                            <div class="action-btn bg-info ms-2">
                                                <a href="#" data-url="<?php echo e(route('trainer.show',$trainer->id)); ?>" data-size="lg" data-ajax-popup="true" data-title="<?php echo e(__('Trainer Detail')); ?>" class="mx-3 btn btn-sm align-items-center" data-bs-toggle="tooltip" title="<?php echo e(__('View')); ?>" data-original-title="<?php echo e(__('View Detail')); ?>">
                                                <i class="ti ti-eye text-white"></i>
                                                </a>
                                            </div>
                                                <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit trainer')): ?>
                                            <div class="action-btn bg-primary ms-2">
                                                <a href="#" data-url="<?php echo e(route('trainer.edit',$trainer->id)); ?>" data-size="lg" data-ajax-popup="true" data-title="<?php echo e(__('Edit Trainer')); ?>" class="mx-3 btn btn-sm align-items-center" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>" data-original-title="<?php echo e(__('Edit')); ?>">
                                                <i class="ti ti-pencil text-white"></i>
                                                </a>
                                            </div>
                                                <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete trainer')): ?>
                                            <div class="action-btn bg-danger ms-2">
                                            <?php echo Form::open(['method' => 'DELETE', 'route' => ['trainer.destroy', $trainer->id],'id'=>'delete-form-'.$trainer->id]); ?>


                                                <a href="#" class="mx-3 btn btn-sm align-items-center bs-pass-para" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($trainer->id); ?>').submit();" data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>" data-original-title="<?php echo e(__('Delete')); ?>">
                                                <i class="ti ti-trash text-white"></i>

                                                </a>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/integra.platformbisnis.com/public_html/resources/views/trainer/index.blade.php ENDPATH**/ ?>