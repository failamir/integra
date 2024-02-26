<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Cash Flow')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Cash Flow')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
    <script type="text/javascript" src="<?php echo e(asset('js/html2pdf.bundle.min.js')); ?>"></script>
    <script>
        var year = '<?php echo e($currentYear); ?>';
        var filename = $('#filename').val();

        function saveAsPDF() {
            var element = document.getElementById('printableArea');
            var opt = {
                margin: 0.3,
                filename: filename,
                image: {type: 'jpeg', quality: 1},
                html2canvas: {scale: 4, dpi: 72, letterRendering: true},
                jsPDF: {unit: 'in', format: 'A2'}
            };
            html2pdf().set(opt).from(element).save();
        }
    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">

        <a href="#" class="btn btn-sm btn-primary" onclick="saveAsPDF()"data-bs-toggle="tooltip" title="<?php echo e(__('Download')); ?>" data-original-title="<?php echo e(__('Download')); ?>">
            <span class="btn-inner--icon"><i class="ti ti-download"></i></span>
        </a>

    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>


    <div class="row justify-content-center">
        <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <?php echo e(Form::open(['route' => array('report.monthly.cashflow'), 'method' => 'GET', 'id' => 'monthly_cashflow'])); ?>

                        <div class="col-xl-12">

                            <div class="row justify-content-between">
                                <div class="col-xl-3">
                                    <ul class="nav nav-pills my-3" id="pills-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" href="#daily-chart" role="tab"
                                               aria-controls="pills-home" aria-selected="true"><?php echo e(__('Monthly')); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                               href="<?php echo e(route('report.quarterly.cashflow')); ?>"
                                               onclick="window.location.href = '<?php echo e(route('report.quarterly.cashflow')); ?>'" role="tab"
                                               aria-controls="pills-profile" aria-selected="false"><?php echo e(__('Quarterly')); ?></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-xl-9">
                                    <div class="row justify-content-end align-items-center">
                                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                            <div class="btn-box">
                                                <?php echo e(Form::label('year', __('Year'),['class'=>'form-label'])); ?>

                                                <?php echo e(Form::select('year',$yearList,isset($_GET['year'])?$_GET['year']:'', array('class' => 'form-control select'))); ?>

                                            </div>
                                        </div>

                                        <div class="col-auto mt-4">
                                            <a href="#" class="btn btn-sm btn-primary" onclick="document.getElementById('monthly_cashflow').submit(); return false;" data-bs-toggle="tooltip" title="<?php echo e(__('Apply')); ?>" data-original-title="<?php echo e(__('apply')); ?>">
                                                <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                                            </a>
                                            <a href="<?php echo e(route('report.monthly.cashflow')); ?>" class="btn btn-sm btn-danger " data-bs-toggle="tooltip"  title="<?php echo e(__('Reset')); ?>" data-original-title="<?php echo e(__('Reset')); ?>">
                                                <span class="btn-inner--icon"><i class="ti ti-trash-off text-white-off "></i></span>
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php echo e(Form::close()); ?>

                </div>
        </div>
    </div>

    <div id="printableArea">
        <div class="row mt-1">
            <div class="col">
                <input type="hidden" value="<?php echo e(__('Monthly Cashflow').' '.'Report of'.' '.$filter['startDateRange'].' to '.$filter['endDateRange']); ?>" id="filename">
                <div class="card p-4 mb-4">
                    <h7 class="report-text gray-text mb-0"><?php echo e(__('Report')); ?> :</h7>
                    <h6 class="report-text mb-0"><?php echo e(__('Monthly Cashflow')); ?></h6>
                </div>
            </div>
            <div class="col">
                <div class="card p-4 mb-4">
                    <h7 class="report-text gray-text mb-0"><?php echo e(__('Duration')); ?> :</h7>
                    <h6 class="report-text mb-0"><?php echo e($filter['startDateRange'].' to '.$filter['endDateRange']); ?></h6>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body table-border-style">
                        <div class="row">
                            <div class="col-sm-12">
                                <h5 class="pb-3"><?php echo e(__('Income')); ?></h5>
                                <div class="table-responsive mt-3 mb-3">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th width="20%"><?php echo e(__('Category')); ?></th>
                                            <?php $__currentLoopData = $monthList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $month): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <th><?php echo e($month); ?></th>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="13" class="font-bold"><span><?php echo e(__('Revenue : ')); ?></span></td>
                                            </tr>
                                            <?php $__currentLoopData = $incomeArr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i=>$income): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($income['category']); ?></td>
                                                    <?php $__currentLoopData = $income['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <td><?php echo e(\Auth::user()->priceFormat($data)); ?></td>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            <tr>
                                                <td colspan="13" class="font-bold"><span><?php echo e(__('Invoice : ')); ?></span></td>
                                            </tr>
                                            <?php $__currentLoopData = $invoiceArray; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i=>$invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($invoice['category']); ?></td>
                                                    <?php $__currentLoopData = $invoice['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <td><?php echo e(\Auth::user()->priceFormat($data)); ?></td>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            <tr>
                                                <td colspan="13" class="font-bold"><span><?php echo e(__('Total Income =  Revenue + Invoice ')); ?></span></td>
                                            </tr>
                                            <tr>
                                                <td width="20%" class="text-dark"><?php echo e(__('Total Income')); ?></td>
                                                <?php $__currentLoopData = $chartIncomeArr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i=>$income): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <td><?php echo e(\Auth::user()->priceFormat($income)); ?></td>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>

                                <div class="col-sm-12">
                                    <h5><?php echo e(__('Expense')); ?></h5>
                                    <div class="table-responsive mt-4">
                                        <table class="table mb-0">
                                            <thead>
                                                <tr>
                                                <th width="20%"><?php echo e(__('Category')); ?></th>
                                                <?php $__currentLoopData = $monthList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $month): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <th><?php echo e($month); ?></th>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td colspan="13" class="font-bold"><span><?php echo e(__('Payment : ')); ?></span></td>
                                                </tr>
                                                <?php if(!empty($expenseArr)): ?>
                                                    <?php $__currentLoopData = $expenseArr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i=>$expense): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>
                                                            <td><?php echo e($expense['category']); ?></td>
                                                            <?php $__currentLoopData = $expense['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <td><?php echo e(\Auth::user()->priceFormat($data)); ?></td>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                                <tr>
                                                    <td colspan="13" class="font-bold"><span><?php echo e(__('Bill : ')); ?></span></td>
                                                </tr>
                                                <?php if(!empty($billArray)): ?>
                                                    <?php $__currentLoopData = $billArray; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i=>$bill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>
                                                            <td><?php echo e($bill['category']); ?></td>
                                                            <?php $__currentLoopData = $bill['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <td><?php echo e(\Auth::user()->priceFormat($data)); ?></td>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                                <tr>
                                                    <td colspan="13" class="font-bold"><span><?php echo e(__('Total Expense =  Payment + Bill ')); ?></span></td>
                                                </tr>
                                                <tr>
                                                    <td width="20%" class="text-dark"><?php echo e(__('Total Expenses')); ?></td>
                                                    <?php $__currentLoopData = $chartExpenseArr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i=>$expense): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <td><?php echo e(\Auth::user()->priceFormat($expense)); ?></td>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="table-responsive mt-1">
                                        <table class="table mb-0">
                                            <thead>
                                            <tr>
                                                <th colspan="13" class="font-bold"><span><?php echo e(__('Net Profit = Total Income - Total Expense')); ?></span></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td width="20%" class="text-dark"><?php echo e(__('Net Profit')); ?></td>
                                                    <?php $__currentLoopData = $netProfitArray; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i=>$profit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <td><?php echo e(\Auth::user()->priceFormat($profit)); ?></td>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/integra.platformbisnis.com/public_html/resources/views/report/monthly_cashflow.blade.php ENDPATH**/ ?>