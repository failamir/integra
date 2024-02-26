<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Transaction Summary')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Report')); ?></li>
    <li class="breadcrumb-item"><?php echo e(__('Transaction Summary')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('css-page'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/datatable/buttons.dataTables.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script-page'); ?>
    
    <script type="text/javascript" src="<?php echo e(asset('js/html2pdf.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/datatable/jszip.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/datatable/pdfmake.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/datatable/vfs_fonts.js')); ?>"></script>
    
    
    

    <script>
        var filename = $('#filename').val();

        function saveAsPDF() {
            var element = document.getElementById('printableArea');
            var opt = {
                margin: 0.3,
                filename: filename,
                image: {type: 'jpeg', quality: 1},
                html2canvas: {scale: 4, dpi: 72, letterRendering: true},
                jsPDF: {unit: 'in', format: 'A4'}
            };
            html2pdf().set(opt).from(element).save();

        }
    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        
        
        

        <a href="<?php echo e(route('transaction.export')); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Export')); ?>" class="btn btn-sm btn-primary">
            <i class="ti ti-file-export"></i>
        </a>

        <a href="#" class="btn btn-sm btn-primary" onclick="saveAsPDF()"data-bs-toggle="tooltip" title="<?php echo e(__('Download')); ?>" data-original-title="<?php echo e(__('Download')); ?>">
            <span class="btn-inner--icon"><i class="ti ti-download"></i></span>
        </a>

    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-sm-12">
            <div class="mt-2 " id="multiCollapseExample1">
                <div class="card">
                    <div class="card-body">
                        <?php echo e(Form::open(array('route' => array('transaction.index'),'method'=>'get','id'=>'transaction_report'))); ?>

                        <div class="row align-items-center justify-content-end">
                            <div class="col-xl-10">
                                <div class="row">

                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                        <div class="btn-box">
                                            <?php echo e(Form::label('start_month', __('Start Month'),['class'=>'form-label'])); ?>

                                            <?php echo e(Form::month('start_month',isset($_GET['start_month'])?$_GET['start_month']:date('Y-m', strtotime("-5 month")),array('class'=>'month-btn form-control'))); ?>

                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                        <div class="btn-box">
                                            <?php echo e(Form::label('end_month', __('End Month'),['class'=>'form-label'])); ?>

                                            <?php echo e(Form::month('end_month',isset($_GET['end_month'])?$_GET['end_month']:date('Y-m'),array('class'=>'month-btn form-control'))); ?>

                                        </div>
                                    </div>

                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                        <div class="btn-box">
                                            <?php echo e(Form::label('account', __('Account'),['class'=>'form-label'])); ?>

                                            <?php echo e(Form::select('account', $account,isset($_GET['account'])?$_GET['account']:'', array('class' => 'form-control select'))); ?>

                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                        <div class="btn-box">
                                            <?php echo e(Form::label('category', __('Category'),['class'=>'form-label'])); ?>

                                            <?php echo e(Form::select('category', $category,isset($_GET['category'])?$_GET['category']:'', array('class' => 'form-control select'))); ?>

                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-auto mt-4">
                                <div class="row">
                                    <div class="col-auto">
                                        <a href="#" class="btn btn-sm btn-primary" onclick="document.getElementById('transaction_report').submit(); return false;" data-bs-toggle="tooltip" title="<?php echo e(__('Apply')); ?>" data-original-title="<?php echo e(__('apply')); ?>">
                                            <span class="btn-inner--icon"><i class="ti ti-search"></i></span></a>

                                        <a href="<?php echo e(route('transaction.index')); ?>" class="btn btn-sm btn-danger " data-bs-toggle="tooltip"  title="<?php echo e(__('Reset')); ?>" data-original-title="<?php echo e(__('Reset')); ?>">
                                            <span class="btn-inner--icon"><i class="ti ti-trash-off text-white-off "></i></span>
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <?php echo e(Form::close()); ?>

                </div>
            </div>
        </div>
    </div>

    <div id="printableArea">
        <div class="row">
            <div class="col">
                <input type="hidden" value="<?php echo e($filter['category'].' '.__('Category').' '.__('Transaction').' '.'Report of'.' '.$filter['startDateRange'].' to '.$filter['endDateRange']); ?>" id="filename">
                <div class="card p-4 mb-4">
                    <h6 class="mb-0"><?php echo e(__('Report')); ?> :</h6>
                    <h7 class="text-sm mb-0"><?php echo e(__('Transaction Summary')); ?></h7>
                </div>
            </div>
            <?php if($filter['account']!= __('All')): ?>
                <div class="col">
                    <div class="card p-4 mb-4">
                        <h6 class="mb-0"><?php echo e(__('Account')); ?> :</h6>
                        <h7 class="text-sm mb-0"><?php echo e($filter['account']); ?></h7>
                    </div>
                </div>
            <?php endif; ?>
            <?php if($filter['category']!= __('All')): ?>
                <div class="col">
                    <div class="card p-4 mb-4">
                        <h6 class="mb-0"><?php echo e(__('Category')); ?> :</h6>
                        <h7 class="text-sm mb-0"><?php echo e($filter['category']); ?></h7>
                    </div>
                </div>
            <?php endif; ?>
            <div class="col">
                <div class="card p-4 mb-4">
                    <h6 class="mb-0"><?php echo e(__('Duration')); ?> :</h6>
                    <h7 class="text-sm mb-0"><?php echo e($filter['startDateRange'].' to '.$filter['endDateRange']); ?></h7>
                </div>
            </div>
        </div>
        <div class="row">
            <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-xl-3 col-md-6 col-lg-3">
                    <div class="card p-4 mb-4">
                        <?php if($account->holder_name =='Cash'): ?>
                            <h6 class="mb-0"><?php echo e($account->holder_name); ?></h6>
                        <?php elseif(empty($account->holder_name)): ?>
                            <h6 class="mb-0"><?php echo e(__('Stripe / Paypal')); ?></h6>
                        <?php else: ?>
                            <h6 class="mb-0"><?php echo e($account->holder_name.' - '.$account->bank_name); ?></h6>
                        <?php endif; ?>
                        <h7 class="text-sm mb-0"><?php echo e(\Auth::user()->priceFormat($account->total)); ?></h7>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                            <tr>
                                <th><?php echo e(__('Date')); ?></th>
                                <th><?php echo e(__('Account')); ?></th>
                                <th><?php echo e(__('Type')); ?></th>
                                <th><?php echo e(__('Category')); ?></th>
                                <th><?php echo e(__('Description')); ?></th>
                                <th><?php echo e(__('Amount')); ?></th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e(\Auth::user()->dateFormat($transaction->date)); ?></td>
                                    <td>
                                        <?php if(!empty($transaction->bankAccount) && $transaction->bankAccount->holder_name=='Cash'): ?>
                                            <?php echo e($transaction->bankAccount->holder_name); ?>

                                        <?php else: ?>
                                            <?php echo e(!empty($transaction->bankAccount)?$transaction->bankAccount->bank_name.' '.$transaction->bankAccount->holder_name:'-'); ?>

                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e($transaction->type); ?></td>
                                    <td><?php echo e($transaction->category); ?></td>
                                    <td><?php echo e(!empty($transaction->description)?$transaction->description:'-'); ?></td>
                                    <td><?php echo e(\Auth::user()->priceFormat($transaction->amount)); ?></td>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/integra.platformbisnis.com/public_html/resources/views/transaction/index.blade.php ENDPATH**/ ?>