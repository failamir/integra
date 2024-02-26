<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Employee')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><a href="<?php echo e(route('employee.index')); ?>"><?php echo e(__('Employee')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e($employeesId); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-btn'); ?>
    <?php if(!empty($employee)): ?>
        <div class="float-end mt-3 m-2">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit employee')): ?>

                <a href="<?php echo e(route('employee.edit',\Illuminate\Support\Facades\Crypt::encrypt($employee->id))); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>"class="btn btn-sm btn-primary">
                    <i class="ti ti-pencil"></i>
                </a>

            <?php endif; ?>
        </div>

        <div class="text-end">
            <div class="d-flex justify-content-end drp-languages">
                <ul class="list-unstyled mb-0 m-2">
                    <li class="dropdown dash-h-item status-drp">
                        <a class="dash-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#"
                           role="button" aria-haspopup="false" aria-expanded="false">
                            <span class="drp-text hide-mob text-primary"> <?php echo e(__('Joining Letter')); ?></span>
                            <i class="ti ti-chevron-down drp-arrow nocolor hide-mob"></i>
                        </a>
                        <div class="dropdown-menu dash-h-dropdown">
                            <a href="<?php echo e(route('joiningletter.download.pdf',$employee->id)); ?>" class=" btn-icon dropdown-item" data-bs-toggle="tooltip" data-bs-placement="top"  target="_blanks"><i class="ti ti-download ">&nbsp;</i><?php echo e(__('PDF')); ?></a>

                            <a href="<?php echo e(route('joininglatter.download.doc',$employee->id)); ?>" class=" btn-icon dropdown-item" data-bs-toggle="tooltip" data-bs-placement="top"  target="_blanks"><i class="ti ti-download ">&nbsp;</i><?php echo e(__('DOC')); ?></a>
                        </div>
                    </li>
                </ul>
                <ul class="list-unstyled mb-0 m-2">
                    <li class="dropdown dash-h-item status-drp">
                        <a class="dash-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#"
                           role="button" aria-haspopup="false" aria-expanded="false">
                            <span class="drp-text hide-mob text-primary"> <?php echo e(__('Experience Certificate')); ?></span>
                            <i class="ti ti-chevron-down drp-arrow nocolor hide-mob"></i>
                        </a>
                        <div class="dropdown-menu dash-h-dropdown">
                            <a href="<?php echo e(route('exp.download.pdf',$employee->id)); ?>" class=" btn-icon dropdown-item" data-bs-toggle="tooltip" data-bs-placement="top"  target="_blanks"><i class="ti ti-download ">&nbsp;</i><?php echo e(__('PDF')); ?></a>

                            <a href="<?php echo e(route('exp.download.doc',$employee->id)); ?>" class=" btn-icon dropdown-item" data-bs-toggle="tooltip" data-bs-placement="top"  target="_blanks"><i class="ti ti-download ">&nbsp;</i><?php echo e(__('DOC')); ?></a>
                        </div>
                    </li>
                </ul>
                <ul class="list-unstyled mb-0 m-2">
                    <li class="dropdown dash-h-item status-drp">
                        <a class="dash-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#"
                           role="button" aria-haspopup="false" aria-expanded="false">
                            <span class="drp-text hide-mob text-primary"> <?php echo e(__('NOC')); ?></span>
                            <i class="ti ti-chevron-down drp-arrow nocolor hide-mob"></i>
                        </a>
                        <div class="dropdown-menu dash-h-dropdown">
                            <a href="<?php echo e(route('noc.download.pdf',$employee->id)); ?>" class=" btn-icon dropdown-item" data-bs-toggle="tooltip" data-bs-placement="top"  target="_blanks"><i class="ti ti-download ">&nbsp;</i><?php echo e(__('PDF')); ?></a>

                            <a href="<?php echo e(route('noc.download.doc',$employee->id)); ?>" class=" btn-icon dropdown-item" data-bs-toggle="tooltip" data-bs-placement="top"  target="_blanks"><i class="ti ti-download ">&nbsp;</i><?php echo e(__('DOC')); ?></a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php if(!empty($employee)): ?>
        <div class="row">
            <div class="col-xl-12">
                <div class="row">
                    <div class="col-sm-12 col-md-6">

                        <div class="card ">
                            <div class="card-body employee-detail-body fulls-card">
                                <h5><?php echo e(__('Personal Detail')); ?></h5>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="info text-sm">
                                            <strong class="font-bold"><?php echo e(__('EmployeeId')); ?> : </strong>
                                            <span><?php echo e($employeesId); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info text-sm font-style">
                                            <strong class="font-bold"><?php echo e(__('Name')); ?> :</strong>
                                            <span><?php echo e(!empty($employee)?$employee->name:''); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info text-sm font-style">
                                            <strong class="font-bold"><?php echo e(__('Email')); ?> :</strong>
                                            <span><?php echo e(!empty($employee)?$employee->email:''); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info text-sm">
                                            <strong class="font-bold"><?php echo e(__('Date of Birth')); ?> :</strong>
                                            <span><?php echo e(\Auth::user()->dateFormat(!empty($employee)?$employee->dob:'')); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info text-sm">
                                            <strong class="font-bold"><?php echo e(__('Phone')); ?> :</strong>
                                            <span><?php echo e(!empty($employee)?$employee->phone:''); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info text-sm">
                                            <strong class="font-bold"><?php echo e(__('Address')); ?> :</strong>
                                            <span><?php echo e(!empty($employee)?$employee->address:''); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info text-sm">
                                            <strong class="font-bold"><?php echo e(__('Salary Type')); ?> :</strong>
                                            <span><?php echo e(!empty($employee->salaryType)?$employee->salaryType->name:''); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info text-sm">
                                            <strong class="font-bold"><?php echo e(__('Basic Salary')); ?> :</strong>
                                            <span><?php echo e(!empty($employee)?$employee->salary:''); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">

                        <div class="card ">
                            <div class="card-body employee-detail-body fulls-card">
                                <h5><?php echo e(__('Company Detail')); ?></h5>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="info text-sm">
                                            <strong class="font-bold"><?php echo e(__('Branch')); ?> : </strong>
                                            <span><?php echo e(!empty($employee->branch)?$employee->branch->name:''); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info text-sm font-style">
                                            <strong class="font-bold"><?php echo e(__('Department')); ?> :</strong>
                                            <span><?php echo e(!empty($employee->department)?$employee->department->name:''); ?></span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="info text-sm">
                                            <strong class="font-bold"><?php echo e(__('Designation')); ?> :</strong>
                                            <span><?php echo e(!empty($employee->designation)?$employee->designation->name:''); ?></span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="info text-sm">
                                            <strong class="font-bold"><?php echo e(__('Date Of Joining')); ?> :</strong>
                                            <span><?php echo e(\Auth::user()->dateFormat(!empty($employee)?$employee->company_doj:'')); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12 col-md-6">

                        <div class="card ">
                            <div class="card-body employee-detail-body fulls-card">
                                <h5><?php echo e(__('Document Detail')); ?></h5>
                                <hr>
                                <div class="row">
                                    <?php

                                        $employeedoc = !empty($employee)?$employee->documents()->pluck('document_value',__('document_id')):[];
                                    ?>
                                    <?php if(!$documents->isEmpty()): ?>
                                        <?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="col-md-6">
                                                <div class="info text-sm">
                                                    <strong class="font-bold"><?php echo e($document->name); ?> : </strong>
                                                    <span><a href="<?php echo e((!empty($employeedoc[$document->id])?asset(Storage::url('uploads/document')).'/'.$employeedoc[$document->id]:'')); ?>" target="_blank"><?php echo e((!empty($employeedoc[$document->id])?$employeedoc[$document->id]:'')); ?></a></span>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <div class="text-center">
                                            No Document Type Added.!
                                        </div>
                                    <?php endif; ?>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">

                        <div class="card ">
                            <div class="card-body employee-detail-body fulls-card">
                                <h5><?php echo e(__('Bank Account Detail')); ?></h5>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="info text-sm">
                                            <strong class="font-bold"><?php echo e(__('Account Holder Name')); ?> : </strong>
                                            <span><?php echo e(!empty($employee)?$employee->account_holder_name:''); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info text-sm font-style">
                                            <strong class="font-bold"><?php echo e(__('Account Number')); ?> :</strong>
                                            <span><?php echo e(!empty($employee)?$employee->account_number:''); ?></span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="info text-sm">
                                            <strong class="font-bold"><?php echo e(__('Bank Name')); ?> :</strong>
                                            <span><?php echo e(!empty($employee)?$employee->bank_name:''); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info text-sm">
                                            <strong class="font-bold"><?php echo e(__('Bank Identifier Code')); ?> :</strong>
                                            <span><?php echo e(!empty($employee)?$employee->bank_identifier_code:''); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info text-sm">
                                            <strong class="font-bold"><?php echo e(__('Branch Location')); ?> :</strong>
                                            <span><?php echo e(!empty($employee)?$employee->branch_location:''); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info text-sm">
                                            <strong class="font-bold"><?php echo e(__('Tax Payer Id')); ?> :</strong>
                                            <span><?php echo e(!empty($employee)?$employee->tax_payer_id:''); ?></span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/integra.platformbisnis.com/public_html/resources/views/employee/show.blade.php ENDPATH**/ ?>