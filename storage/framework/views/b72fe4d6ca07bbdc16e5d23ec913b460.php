<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Document')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Document')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create document')): ?>
            <a href="#" data-url="<?php echo e(route('document-upload.create')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Create New Document')); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>"  class="btn btn-sm btn-primary">
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
                                <th><?php echo e(__('Name')); ?></th>
                                <th><?php echo e(__('Document')); ?></th>
                                <th><?php echo e(__('Role')); ?></th>
                                <th><?php echo e(__('Description')); ?></th>
                                <?php if(Gate::check('edit document') || Gate::check('delete document')): ?>
                                    <th><?php echo e(__('Action')); ?></th>
                                <?php endif; ?>
                            </tr>
                            </thead>
                            <tbody class="font-style">
                            <?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $documentPath=\App\Models\Utility::get_file('uploads/documentUpload');
                                    $roles = \Spatie\Permission\Models\Role::find($document->role);
                                ?>
                                <tr>
                                    <td><?php echo e($document->name); ?></td>
                                    <td>
                                        <?php if(!empty($document->document)): ?>
                                            <div class="action-btn bg-primary ms-2">
                                                <a class="mx-3 btn btn-sm align-items-center"
                                                   href="<?php echo e($documentPath . '/' . $document->document); ?>" download>
                                                    <i class="ti ti-download text-white"></i>
                                                </a>
                                            </div>
                                            <div class="action-btn bg-secondary ms-2">
                                                <a class="mx-3 btn btn-sm align-items-center" href="<?php echo e($documentPath . '/' . $document->document); ?>" target="_blank"  >
                                                    <i class="ti ti-crosshair text-white" data-bs-toggle="tooltip" data-bs-original-title="<?php echo e(__('Preview')); ?>"></i>
                                                </a>
                                            </div>
                                        <?php else: ?>
                                            <p>-</p>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e(!empty($roles)?$roles->name:'All'); ?></td>
                                    <td><?php echo e($document->description); ?></td>
                                    <?php if(Gate::check('edit document') || Gate::check('delete document')): ?>
                                        <td>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit document')): ?>
                                            <div class="action-btn bg-primary ms-2">
                                                <a href="#" data-url="<?php echo e(route('document-upload.edit',$document->id)); ?>" data-size="lg" data-ajax-popup="true" data-title="<?php echo e(__('Edit Document')); ?>" class="mx-3 btn btn-sm align-items-center" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>" data-original-title="<?php echo e(__('Edit')); ?>"><i class="ti ti-pencil text-white"></i></a>
                                            </div>
                                                <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete document')): ?>
                                            <div class="action-btn bg-danger ms-2">
                                            <?php echo Form::open(['method' => 'DELETE', 'route' => ['document-upload.destroy', $document->id],'id'=>'delete-form-'.$document->id]); ?>


                                                <a href="#" class="mx-3 btn btn-sm align-items-center bs-pass-para" data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($document->id); ?>').submit();"><i class="ti ti-trash text-white"></i></a>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/integra.platformbisnis.com/public_html/resources/views/documentUpload/index.blade.php ENDPATH**/ ?>