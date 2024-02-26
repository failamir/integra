<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Plan-Request')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Plan Request')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <div class="d-inline-block">
        <h5 class="h4 d-inline-block font-weight-400 mb-0"><?php echo e(__('Plan Request')); ?></h5>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
            <div class="card-body table-border-style">
                    <div class="table-responsive">
                    <table class="table header " width="100%">
                            <tbody>
                            <?php if($plan_requests->count() > 0): ?>
                                <?php $__currentLoopData = $plan_requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prequest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <thead>
                                <tr>
                                    <th><?php echo e(__('Name')); ?></th>
                                    <th><?php echo e(__('Plan Name')); ?></th>
                                    <th><?php echo e(__('Total Users')); ?></th>
                                    <th><?php echo e(__('Total Customers')); ?></th>
                                    <th><?php echo e(__('Total Vendors')); ?></th>
                                    <th><?php echo e(__('Total Clients')); ?></th>
                                    <th><?php echo e(__('Duration')); ?></th>
                                    <th><?php echo e(__('Date')); ?></th>
                                    <th><?php echo e(__('Action')); ?></th>

                                </tr>
                                </thead>

                                    <tr>
                                        <td>
                                            <div class="font-style "><?php echo e($prequest->user->name); ?></div>
                                        </td>
                                        <td>
                                            <div class="font-style "><?php echo e($prequest->plan->name); ?></div>
                                        </td>
                                        <td>
                                            <div class=""><?php echo e($prequest->plan->max_users); ?></div>
                                        </td>
                                        <td>
                                            <div class=""><?php echo e($prequest->plan->max_customers); ?></div>
                                        </td>
                                        <td>
                                            <div class=""><?php echo e($prequest->plan->max_venders); ?></div>
                                        </td>
                                        <td>
                                            <div class=""><?php echo e($prequest->plan->max_clients); ?></div>
                                        </td>
                                        <td>
                                            <?php if($prequest->duration == "year"): ?>
                                            <div class="font-style "><?php echo e(__('Yearly')); ?></div>
                                            <?php elseif($prequest->duration == "month"): ?>
                                            <div class="font-style "><?php echo e(__('Monthly')); ?></div>
                                            <?php else: ?>
                                            <div class="font-style "><?php echo e(__('Lifetime')); ?></div>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e(Utility::getDateFormated($prequest->created_at,true)); ?></td>
                                        <td>
                                            <div>
                                                <a href="<?php echo e(route('response.request',[$prequest->id,1])); ?>" class="btn btn-success btn-sm">
                                                    <i class="ti ti-check"></i>
                                                </a>
                                                <a href="<?php echo e(route('response.request',[$prequest->id,0])); ?>" class="btn btn-danger btn-sm">
                                                <i class="ti ti-x"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <tr>
                                    <th scope="col" colspan="7"><h6 class="text-center"><?php echo e(__('No Manually Plan Request Found.')); ?></h6></th>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/integra.platformbisnis.com/public_html/resources/views/plan_request/index.blade.php ENDPATH**/ ?>