<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Trial Balance')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Trial Balance')); ?></li>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#filter").click(function() {
                $("#show_filter").toggle();
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
        <?php echo e(Form::open(['route' => ['trial.balance.export']])); ?>

        <input type="hidden" name="start_date" class="start_date">
        <input type="hidden" name="end_date" class="end_date">
        <button type="submit" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="<?php echo e(__('Export')); ?>"
            data-original-title="<?php echo e(__('Export')); ?>"><i class="ti ti-file-export"></i></button>
        <?php echo e(Form::close()); ?>

    </div>
    <div class="float-end me-2" id="filter">
        <button id="filter" class="btn btn-sm btn-primary"><i class="ti ti-filter"></i></button>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="mt-2" id="multiCollapseExample1">
                <div class="card" id="show_filter" style="display:none;">
                    <div class="card-body">
                        <?php echo e(Form::open(['route' => ['trial.balance'], 'method' => 'GET', 'id' => 'report_trial_balance'])); ?>

                        <div class="col-xl-12">

                            <div class="row justify-content-between">
                                <div class="col-xl-3 mt-4">
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons"
                                        aria-label="Basic radio toggle button group">
                                        <label class="btn btn-primary month-label">
                                            <a href="<?php echo e(route('trial.balance', ['collapse'])); ?>"
                                                class="text-white" id="collapse"> <?php echo e(__('Collapse')); ?> </a>
                                        </label>

                                        <label class="btn btn-primary year-label active">
                                            <a href="<?php echo e(route('trial.balance', ['expand'])); ?>"
                                                class="text-white"> <?php echo e(__('Expand')); ?> </a>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-xl-9">
                                    <div class="row justify-content-end align-items-center">
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

                                        <div class="col-auto mt-4">
                                            <a href="#" class="btn btn-sm btn-primary"
                                                onclick="document.getElementById('report_trial_balance').submit(); return false;"
                                                data-bs-toggle="tooltip" title="<?php echo e(__('Apply')); ?>"
                                                data-original-title="<?php echo e(__('apply')); ?>">
                                                <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                                            </a>

                                            <a href="<?php echo e(route('trial.balance')); ?>"
                                                class="btn btn-sm btn-danger " data-bs-toggle="tooltip"
                                                title="<?php echo e(__('Reset')); ?>" data-original-title="<?php echo e(__('Reset')); ?>">
                                                <span class="btn-inner--icon"><i
                                                        class="ti ti-trash-off text-white-off "></i></span>
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
    </div>

    <?php
        $authUser = \Auth::user()->creatorId();
        $user = App\Models\User::find($authUser);
    ?>

    <div class="row justify-content-center" id="printableArea">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body <?php echo e($view == 'expand' ? 'collapse-view' : ''); ?>">
                    <div class="account-main-title mb-5">
                        <h5><?php echo e('Trial Balance of ' . $user->name . ' as of ' . $filter['startDateRange'] . ' to ' . $filter['endDateRange']); ?>

                            </h4>
                    </div>
                    <div
                        class="aacount-title d-flex align-items-center justify-content-between border-top border-bottom py-2">
                        <h6 class="mb-0"><?php echo e(__('Account')); ?></h6>
                        <h6 class="mb-0 text-center"><?php echo e(_('Account Code')); ?></h6>
                        <h6 class="mb-0 text-end me-5"><?php echo e(__('Debit')); ?></h6>
                        <h6 class="mb-0 text-end"><?php echo e(__('Credit')); ?></h6>

                    </div>
                    <?php
                        $totalCredit = 0;
                        $totalDebit = 0;
                    ?>
                    <?php $__currentLoopData = $totalAccounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type => $accounts): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="account-main-inner border-bottom py-2">
                            <p class="fw-bold ps-2 mb-2"><?php echo e($type); ?></p>
                            <?php if($view == 'collapse'): ?>
                                <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($record['account'] == 'parentTotal'): ?>
                                        <div class="account-inner d-flex align-items-center justify-content-between ps-3">
                                            <div class="mb-2 account-arrow">
                                                <a href="<?php echo e(route('trial.balance', ['expand'])); ?>"><i
                                                        class="ti ti-chevron-down account-icon"></i></a>
                                                <a href="<?php echo e(route('report.ledger', $record['account_id'])); ?>?account=<?php echo e($record['account_id']); ?>"
                                                    class="text-primary "><?php echo e(str_replace('Total ', '', $record['account_name'])); ?></a>
                                            </div>

                                            <p class="mb-2 text-center"><?php echo e($record['account_code']); ?></p>
                                            <p class="text-primary  mb-2 text-end me-5">
                                                <?php echo e(\Auth::user()->priceFormat($record['totalDebit'])); ?></p>
                                            <p class="text-primary mb-2  float-end text-end">
                                                <?php echo e(\Auth::user()->priceFormat($record['totalCredit'])); ?></p>
                                        </div>
                                    <?php elseif($record['account'] == 'parentTotal' || $record['account'] == ''): ?>
                                        <div class="account-inner d-flex align-items-center justify-content-between ps-3">
                                            <p class="mb-2 ms-3"><a
                                                    href="<?php echo e(route('report.ledger', $record['account_id'])); ?>?account=<?php echo e($record['account_id']); ?>"
                                                    class="text-primary"><?php echo e($record['account_name']); ?></a>
                                            </p>
                                            <p class="mb-2 text-center"><?php echo e($record['account_code']); ?></p>
                                            <p class="text-primary mb-2 text-end me-5">
                                                <?php echo e(\Auth::user()->priceFormat($record['totalDebit'])); ?></p>
                                            <p class="text-primary mb-2 float-end text-end">
                                                <?php echo e(\Auth::user()->priceFormat($record['totalCredit'])); ?></p>
                                        </div>
                                    <?php endif; ?>
                                    <?php
                                        if($record['account'] != 'parent' && $record['account'] != 'subAccount')
                                        {
                                        $totalDebit += $record['totalDebit'];
                                        $totalCredit += $record['totalCredit'];
                                        }
                                    ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($record['account'] == 'parent'): ?>
                                        <div class="account-inner d-flex align-items-center justify-content-between ps-3">
                                            <div class="mb-2 account-arrow">
                                                <a href="<?php echo e(route('trial.balance', ['collapse'])); ?>"><i
                                                        class="ti ti-chevron-down account-icon"></i></a>
                                                <a href="<?php echo e(route('report.ledger', $record['account_id'])); ?>?account=<?php echo e($record['account_id']); ?>"
                                                    class="text-primary fw-bold"><?php echo e(str_replace('Total ', '', $record['account_name'])); ?></a>
                                            </div>

                                            <p class="mb-2 text-center"><?php echo e($record['account_code']); ?></p>
                                            <p class="text-primary fw-bold mb-2 text-end me-5">
                                                <?php echo e(\Auth::user()->priceFormat($record['totalDebit'])); ?></p>
                                            <p class="text-primary mb-2 fw-bold float-end text-end">
                                                <?php echo e(\Auth::user()->priceFormat($record['totalCredit'])); ?></p>
                                        </div>
                                    <?php elseif($record['account'] == 'parentTotal'): ?>
                                        <div class="account-inner d-flex align-items-center justify-content-between ps-3">
                                            <p class="mb-2"><a href="#"
                                                    class="text-dark fw-bold"><?php echo e($record['account_name']); ?></a>
                                            </p>
                                            <p class="mb-2 ms-3 text-center"><?php echo e($record['account_code']); ?></p>
                                            <p class="text-dark fw-bold mb-2 text-end me-5">
                                                <?php echo e(\Auth::user()->priceFormat($record['totalDebit'])); ?></p>
                                            <p class="text-dark fw-bold mb-2 float-end text-end">
                                                <?php echo e(\Auth::user()->priceFormat($record['totalCredit'])); ?></p>
                                        </div>
                                    <?php else: ?>
                                        <div class="account-inner d-flex align-items-center justify-content-between ps-3">
                                            <p class="mb-2 ms-3"><a
                                                    href="<?php echo e(route('report.ledger', $record['account_id'])); ?>?account=<?php echo e($record['account_id']); ?>"
                                                    class="text-primary"><?php echo e($record['account_name']); ?></a>
                                            </p>
                                            <p class="mb-2 text-center"><?php echo e($record['account_code']); ?></p>
                                            <p class="text-primary mb-2 text-end me-5">
                                                <?php echo e(\Auth::user()->priceFormat($record['totalDebit'])); ?></p>
                                            <p class="text-primary mb-2 float-end text-end">
                                                <?php echo e(\Auth::user()->priceFormat($record['totalCredit'])); ?></p>
                                        </div>
                                    <?php endif; ?>
                                    <?php
                                        if($record['account'] != 'parent' && $record['account'] != 'subAccount')
                                        {
                                            $totalDebit += $record['totalDebit'];
                                            $totalCredit += $record['totalCredit'];
                                        }

                                    ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php if($totalAccounts != []): ?>
                        <div
                            class="aacount-title d-flex align-items-center justify-content-between border-top border-bottom py-2 px-2 pe-0">
                            <h6 class="fw-bold mb-0"><?php echo e('Total'); ?></h6>
                            <h6 class="fw-bold mb-0"><?php echo e(''); ?></h6>
                            <h6 class="fw-bold mb-0 text-end me-5"><?php echo e(\Auth::user()->priceFormat($totalDebit)); ?></h6>
                            <h6 class="fw-bold mb-0 text-end"><?php echo e(\Auth::user()->priceFormat($totalCredit)); ?></h6>

                        </div>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('script-page'); ?>
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/integra.platformbisnis.com/public_html/resources/views/report/trial_balance.blade.php ENDPATH**/ ?>