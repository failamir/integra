<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Expense Summary')); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Expense Summary')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('theme-script'); ?>
    <script src="<?php echo e(asset('assets/js/plugins/apexcharts.min.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php
    if(isset($_GET['category']) && $_GET['period'] == 'yearly')
    {
        $chartArr = [];

foreach ($chartExpenseArr as $innerArray) {
    foreach ($innerArray as $value) {
        $chartArr[] = $value;
    }
}
    }
    else {
        $chartArr = $chartExpenseArr[0];
    }
?>

<?php $__env->startPush('script-page'); ?>
    <script>
        (function () {
            var chartBarOptions = {
                series: [
                    {
                        name: '<?php echo e(__("Expense")); ?>',
                        data:  <?php echo json_encode($chartArr); ?>,

                    },
                ],

                chart: {
                    height: 300,
                    type: 'area',
                    // type: 'line',
                    dropShadow: {
                        enabled: true,
                        color: '#000',
                        top: 18,
                        left: 7,
                        blur: 10,
                        opacity: 0.2
                    },
                    toolbar: {
                        show: false
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    width: 2,
                    curve: 'smooth'
                },
                title: {
                    text: '',
                    align: 'left'
                },
                xaxis: {
                    categories: <?php echo json_encode($monthList); ?>,
                    title: {
                        text: '<?php echo e(__("Months")); ?>'
                    }
                },
                colors: ['#6fd944', '#6fd944'],

                grid: {
                    strokeDashArray: 4,
                },
                legend: {
                    show: false,
                },
                // markers: {
                //     size: 4,
                //     colors: ['#ffa21d', '#FF3A6E'],
                //     opacity: 0.9,
                //     strokeWidth: 2,
                //     hover: {
                //         size: 7,
                //     }
                // },
                yaxis: {
                    title: {
                        text: '<?php echo e(__("Expense")); ?>'
                    },

                }

            };
            var arChart = new ApexCharts(document.querySelector("#chart-sales"), chartBarOptions);
            arChart.render();
        })();
    </script>
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

    <div class="row">
        <div class="col-sm-12">
            <div class="mt-2 " id="multiCollapseExample1">
                <div class="card">
                    <div class="card-body">
                    <?php echo e(Form::open(array('route' => array('report.expense.summary'),'method' => 'GET','id'=>'report_expense_summary'))); ?>

                        <div class="row align-items-center justify-content-end">
                            <div class="col-xl-10">
                                <div class="row">
                                    <?php if(isset($_GET['period']) && $_GET['period'] == 'yearly'): ?>
                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">

                                    </div>

                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                        <div class="btn-box">
                                            <?php echo e(Form::label('period', __('Income Period'),['class'=>'form-label'])); ?>

                                            <?php echo e(Form::select('period', $periods,isset($_GET['period'])?$_GET['period']:'', array('class' => 'form-control select period','required'=>'required'))); ?>

                                        </div>
                                    </div>
                                    <?php else: ?>
                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                        <div class="btn-box">
                                            <?php echo e(Form::label('period', __('Income Period'),['class'=>'form-label'])); ?>

                                            <?php echo e(Form::select('period', $periods,isset($_GET['period'])?$_GET['period']:'', array('class' => 'form-control select period','required'=>'required'))); ?>

                                        </div>
                                    </div>

                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                        <div class="btn-box">
                                            <?php echo e(Form::label('year', __('Year'),['class'=>'form-label'])); ?>

                                            <?php echo e(Form::select('year',$yearList,isset($_GET['year'])?$_GET['year']:'', array('class' => 'form-control select'))); ?>

                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                        <div class="btn-box">
                                            <?php echo e(Form::label('category', __('Category'),['class'=>'form-label'])); ?>

                                            <?php echo e(Form::select('category',$category,isset($_GET['category'])?$_GET['category']:'', array('class' => 'form-control select'))); ?>

                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                        <div class="btn-box">
                                            <?php echo e(Form::label('vender', __('Vendor'),['class'=>'form-label'])); ?>

                                            <?php echo e(Form::select('vender',$vender,isset($_GET['vender'])?$_GET['vender']:'', array('class' => 'form-control select'))); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="row">
                                    <div class="col-auto mt-4">
                                        <a href="#" class="btn btn-sm btn-primary" onclick="document.getElementById('report_expense_summary').submit(); return false;" data-bs-toggle="tooltip" title="<?php echo e(__('Apply')); ?>" data-original-title="<?php echo e(__('apply')); ?>">
                                            <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                                        </a>
                                        <a href="<?php echo e(route('report.expense.summary')); ?>" class="btn btn-sm btn-danger " data-bs-toggle="tooltip"  title="<?php echo e(__('Reset')); ?>" data-original-title="<?php echo e(__('Reset')); ?>">
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
        <div class="row mt-3">
            <div class="col">
                <input type="hidden" value="<?php echo e($filter['category'].' '.__('Expense Summary').' '.'Report of'.' '.$filter['startDateRange'].' to '.$filter['endDateRange']); ?>" id="filename">
                <div class="card p-4 mb-4">
                    <h7 class="report-text gray-text mb-0"><?php echo e(__('Report')); ?> :</h7>
                    <h6 class="report-text mb-0"><?php echo e(__('Expense Summary')); ?></h6>
                </div>
            </div>
            <?php if($filter['category']!= __('All')): ?>
                <div class="col">
                    <div class="card p-4 mb-4">
                        <h7 class="report-text gray-text mb-0"><?php echo e(__('Category')); ?> :</h7>
                        <h6 class="report-text mb-0"><?php echo e($filter['category']); ?></h6>
                    </div>
                </div>
            <?php endif; ?>
            <?php if($filter['vender']!= __('All')): ?>
                <div class="col">
                    <div class="card p-4 mb-4">
                        <h7 class="report-text gray-text mb-0"><?php echo e(__('Vendor')); ?> :</h7>
                        <h6 class="report-text mb-0"><?php echo e($filter['vender']); ?></h6>
                    </div>
                </div>
            <?php endif; ?>
            <div class="col">
                <div class="card p-4 mb-4">
                    <h7 class="report-text gray-text mb-0"><?php echo e(__('Duration')); ?> :</h7>
                    <?php if(isset($_GET['period']) && $_GET['period'] == 'yearly'): ?>
                    <h6 class="report-text mb-0"><?php echo e(array_key_last($yearList).' to '.array_key_first($yearList)); ?></h6>
                    <?php else: ?>
                    <h6 class="report-text mb-0"><?php echo e($filter['startDateRange'].' to '.$filter['endDateRange']); ?></h6>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    <div class="row">
            <div class="col-12" id="chart-container">
                <div class="card">
                    <div class="card-body">
                        <div class="scrollbar-inner">
                        <div id="chart-sales" data-color="primary" data-height="300" ></div>
                    </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-body table-border-style">
                        
                        <?php if(isset($_GET['category']) && $_GET['period'] == 'quarterly'): ?>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th><?php echo e(__('Category')); ?></th>
                                    <?php $__currentLoopData = $monthList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $month): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <th><?php echo e($month); ?></th>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td colspan="13" class="text-dark"><span><?php echo e(__('Payment :')); ?></span></td>
                                </tr>
                                <?php $__currentLoopData = $expenseArr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i=>$expense): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($expense['category']); ?></td>
                                        <?php $__currentLoopData = $expense['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <td><?php echo e(\Auth::user()->priceFormat($data)); ?></td>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td colspan="13" class="text-dark"><span><?php echo e(__('Bill :')); ?></span></td>
                                </tr>
                                <?php $__currentLoopData = $billArray; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i=>$bill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($bill['category']); ?></td>
                                        <?php $__currentLoopData = $bill['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <td><?php echo e(\Auth::user()->priceFormat($data)); ?></td>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td colspan="13" class="text-dark"><span><?php echo e(__('Expense = Payment + Bill :')); ?></span></td>
                                </tr>
                                <tr>
                                    <td class="text-dark"><h6><?php echo e(__('Total')); ?></h6></td>
                                    <?php $__currentLoopData = $chartExpenseArr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i=>$expense): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $__currentLoopData = $expense; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <td><?php echo e(\Auth::user()->priceFormat($value)); ?></td>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        
                        <?php elseif(isset($_GET['category']) && $_GET['period'] == 'half-yearly'): ?>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th><?php echo e(__('Category')); ?></th>
                                    <?php $__currentLoopData = $monthList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $month): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <th><?php echo e($month); ?></th>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td colspan="13" class="text-dark"><span><?php echo e(__('Payment :')); ?></span></td>
                                </tr>
                                <?php $__currentLoopData = $expenseArr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i=>$expense): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($expense['category']); ?></td>
                                        <?php $__currentLoopData = $expense['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <td><?php echo e(\Auth::user()->priceFormat($data)); ?></td>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td colspan="13" class="text-dark"><span><?php echo e(__('Bill :')); ?></span></td>
                                </tr>
                                <?php $__currentLoopData = $billArray; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i=>$bill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($bill['category']); ?></td>
                                        <?php $__currentLoopData = $bill['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <td><?php echo e(\Auth::user()->priceFormat($data)); ?></td>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td colspan="13" class="text-dark"><span><?php echo e(__('Expense = Payment + Bill :')); ?></span></td>
                                </tr>
                                <tr>
                                    <td class="text-dark"><h6><?php echo e(__('Total')); ?></h6></td>
                                    <?php $__currentLoopData = $chartExpenseArr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i=>$expense): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $__currentLoopData = $expense; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <td><?php echo e(\Auth::user()->priceFormat($value)); ?></td>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        
                        <?php elseif(isset($_GET['category']) && $_GET['period'] == 'yearly'): ?>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th><?php echo e(__('Category')); ?></th>
                                    <?php $__currentLoopData = $monthList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $month): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <th><?php echo e($month); ?></th>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td colspan="13" class="text-dark"><span><?php echo e(__('Payment :')); ?></span></td>
                                </tr>
                                <?php $__currentLoopData = $expenseArr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i=>$expense): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($expense['category']); ?></td>
                                        <?php $__currentLoopData = $expense['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <td><?php echo e(\Auth::user()->priceFormat($data)); ?></td>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td colspan="13" class="text-dark"><span><?php echo e(__('Bill :')); ?></span></td>
                                </tr>
                                <?php $__currentLoopData = $billArray; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i=>$bill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($bill['category']); ?></td>
                                        <?php $__currentLoopData = $bill['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <td><?php echo e(\Auth::user()->priceFormat($data)); ?></td>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td colspan="13" class="text-dark"><span><?php echo e(__('Expense = Payment + Bill :')); ?></span></td>
                                </tr>
                                <tr>
                                    <td class="text-dark"><h6><?php echo e(__('Total')); ?></h6></td>
                                    <?php $__currentLoopData = $chartExpenseArr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i=>$expense): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $__currentLoopData = $expense; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <td><?php echo e(\Auth::user()->priceFormat($value)); ?></td>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <?php else: ?>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th><?php echo e(__('Category')); ?></th>
                                    <?php $__currentLoopData = $monthList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $month): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <th><?php echo e($month); ?></th>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td colspan="13" class="text-dark"><span><?php echo e(__('Payment :')); ?></span></td>
                                </tr>
                                <?php $__currentLoopData = $expenseArr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i=>$expense): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($expense['category']); ?></td>
                                        <?php $__currentLoopData = $expense['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <td><?php echo e(\Auth::user()->priceFormat($data)); ?></td>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td colspan="13" class="text-dark"><span><?php echo e(__('Bill :')); ?></span></td>
                                </tr>
                                <?php $__currentLoopData = $billArray; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i=>$bill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($bill['category']); ?></td>
                                        <?php $__currentLoopData = $bill['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <td><?php echo e(\Auth::user()->priceFormat($data)); ?></td>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td colspan="13" class="text-dark"><span><?php echo e(__('Expense = Payment + Bill :')); ?></span></td>
                                </tr>
                                <tr>
                                    <td class="text-dark"><h6><?php echo e(__('Total')); ?></h6></td>
                                    <?php $__currentLoopData = $chartExpenseArr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i=>$expense): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $__currentLoopData = $expense; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <td><?php echo e(\Auth::user()->priceFormat($value)); ?></td>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
    </div>
</div>


<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/integra.platformbisnis.com/public_html/resources/views/report/expense_summary.blade.php ENDPATH**/ ?>