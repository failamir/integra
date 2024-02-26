<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Sales Report')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Sales Report')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>

    <script type="text/javascript" src="<?php echo e(asset('js/html2pdf.bundle.min.js')); ?>"></script>
    <script>
        var filename = $('#filename').val();

        function saveAsPDF() {
            var printContents = document.getElementById('printableArea').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>

    <script>
        $(document).ready(function() {
            $("#filter").click(function() {
                $("#show_filter").toggle();
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            callback();
            function callback() {
                var start_date = $(".startDate").val();
                var end_date = $(".endDate").val();

                $('.start_date').val(start_date);
                $('.end_date').val(end_date);
            }
        });

    </script>

<script>
        $(document).ready(function() {
            var id1 = $('.nav-item .active').attr('href');
            $('.report').val(id1);

            $("ul.nav-pills > li > a").click(function() {
                var report = $(this).attr('href');
                $('.report').val(report);
            });
        });

    </script>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('action-btn'); ?>

    <div class="float-end">
        <a href="#" onclick="saveAsPDF()" class="btn btn-sm btn-primary me-1" data-bs-toggle="tooltip"
            title="<?php echo e(__('Print')); ?>" data-original-title="<?php echo e(__('Print')); ?>"><i class="ti ti-printer"></i></a>
    </div>

    <div class="float-end me-2">
        <?php echo e(Form::open(['route' => ['sales.export']])); ?>

        <input type="hidden" name="start_date" class="start_date">
        <input type="hidden" name="end_date" class="end_date">
        <input type="hidden" name="report" class="report">
        <button type="submit" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="<?php echo e(__('Export')); ?>"
            data-original-title="<?php echo e(__('Export')); ?>"><i class="ti ti-file-export"></i></button>
        <?php echo e(Form::close()); ?>

    </div>

    <div class="float-end me-2" id="filter">
        <button id="filter" class="btn btn-sm btn-primary"><i class="ti ti-filter"></i></button>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="mt-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="mt-2" id="multiCollapseExample1">
                    <div class="card" id="show_filter" style="display:none;">
                        <div class="card-body">
                            <?php echo e(Form::open(['route' => ['report.sales'], 'method' => 'GET', 'id' => 'report_sales'])); ?>

                            <div class="row align-items-center justify-content-end">
                                <div class="col-xl-10">
                                    <div class="row">
                                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                            <div class="btn-box">
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                            <div class="btn-box">
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                            <div class="btn-box">
                                                <?php echo e(Form::label('start_date', __('Start Date'), ['class' => 'form-label'])); ?>

                                                <?php echo e(Form::date('start_date', $filter['startDateRange'], ['class' => 'startDate form-control'])); ?>

                                            </div>
                                        </div>

                                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                            <div class="btn-box">
                                                <?php echo e(Form::label('end_date', __('End Date'), ['class' => 'form-label'])); ?>

                                                <?php echo e(Form::date('end_date', $filter['endDateRange'], ['class' => 'endDate form-control'])); ?>

                                            </div>
                                        </div>
                                        <input type="hidden" name="view" value="horizontal">
                                    </div>
                                </div>
                                <div class="col-auto mt-4">
                                    <div class="row">
                                        <div class="col-auto">
                                            <a href="#" class="btn btn-sm btn-primary"
                                                onclick="document.getElementById('report_sales').submit(); return false;"
                                                data-bs-toggle="tooltip" title="<?php echo e(__('Apply')); ?>"
                                                data-original-title="<?php echo e(__('apply')); ?>">
                                                <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                                            </a>

                                            <a href="<?php echo e(route('report.sales')); ?>" class="btn btn-sm btn-danger "
                                                data-bs-toggle="tooltip" title="<?php echo e(__('Reset')); ?>"
                                                data-original-title="<?php echo e(__('Reset')); ?>">
                                                <span class="btn-inner--icon"><i
                                                        class="ti ti-trash-off text-white-off "></i></span>
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

        <?php
            $authUser = \Auth::user()->creatorId();
            $user = App\Models\User::find($authUser);
        ?>

    </div>

    <div class="row">
        <div class="col-12" id="invoice-container">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between w-100">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="profile-tab3" data-bs-toggle="pill" href="#item" role="tab" aria-controls="pills-item" aria-selected="true"><?php echo e(__('Sales by Item')); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="contact-tab4" data-bs-toggle="pill" href="#customer" role="tab" aria-controls="pills-customer" aria-selected="false"><?php echo e(__('Sales by Customer')); ?></a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="card-body" id="printableArea">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="tab-content" id="myTabContent2">
                                <div class="tab-pane fade fade show active" id="item" role="tabpanel" aria-labelledby="profile-tab3">
                                    <div class="table-responsive">
                                    <table class="table pc-dt-simple" id="item-reort">
                                        <thead>
                                        <tr>
                                            <th width="33%"> <?php echo e(__('Invoice Item')); ?></th>
                                            <th width="33%"> <?php echo e(__('Quantity Sold')); ?></th>
                                            <th width="33%"> <?php echo e(__('Amount')); ?></th>
                                            <th class="text-end"> <?php echo e(__('Average Price')); ?></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $invoiceItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoiceItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($invoiceItem['name']); ?></td>
                                                    <td><?php echo e($invoiceItem['quantity']); ?></td>
                                                    <td><?php echo e(\Auth::user()->priceFormat($invoiceItem['price'])); ?></td>
                                                    <td><?php echo e(\Auth::user()->priceFormat($invoiceItem['avg_price'])); ?></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                                </div>

                                <div class="tab-pane fade fade" id="customer" role="tabpanel" aria-labelledby="profile-tab3">
                                    <div class="table-responsive">
                                    <table class="table pc-dt-simple" id="customer-report">
                                        <thead>
                                        <tr>
                                            <th width="33%"> <?php echo e(__('Customer Name')); ?></th>
                                            <th width="33%"> <?php echo e(__('Invoice Count')); ?></th>
                                            <th width="33%"> <?php echo e(__('Sales')); ?></th>
                                            <th class="text-end"> <?php echo e(__('Sales With Tax')); ?></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $invoiceCustomers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoiceCustomer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($invoiceCustomer['name']); ?></td>
                                                    <td><?php echo e($invoiceCustomer['invoice_count']); ?></td>
                                                    <td><?php echo e(\Auth::user()->priceFormat($invoiceCustomer['price'])); ?></td>
                                                    <td><?php echo e(\Auth::user()->priceFormat($invoiceCustomer['price'] + $invoiceCustomer['total_tax'])); ?></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/integra.platformbisnis.com/public_html/resources/views/report/sales_report.blade.php ENDPATH**/ ?>