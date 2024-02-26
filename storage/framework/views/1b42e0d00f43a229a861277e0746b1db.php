<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Profit & Loss')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Profit & Loss')); ?></li>
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
        <?php echo e(Form::open(['route' => ['profit.loss.export']])); ?>

        <input type="hidden" name="start_date" class="start_date">
        <input type="hidden" name="end_date" class="end_date">
        <button type="submit" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="<?php echo e(__('Export')); ?>"
            data-original-title="<?php echo e(__('Export')); ?>"><i class="ti ti-file-export"></i></button>
        <?php echo e(Form::close()); ?>

    </div>

    <div class="float-end me-2" id="filter">
        <button id="filter" class="btn btn-sm btn-primary"><i class="ti ti-filter"></i></button>
    </div>

    <div class="float-end me-2">
        <a href="<?php echo e(route('report.profit.loss', 'vertical')); ?>" class="btn btn-sm btn-primary" data-bs-toggle="tooltip"
            title="<?php echo e(__('Verical View')); ?>" data-original-title="<?php echo e(__('Verical View')); ?>"><i
                class="ti ti-separator-horizontal"></i></a>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="mt-2" id="multiCollapseExample1">
                <div class="card" id="show_filter" style="display:none;">
                    <div class="card-body">
                        <?php echo e(Form::open(['route' => ['report.profit.loss'], 'method' => 'GET', 'id' => 'report_profit_loss'])); ?>

                        <div class="col-xl-12">

                            <div class="row justify-content-between">
                                <div class="col-xl-3 mt-4">
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons"
                                        aria-label="Basic radio toggle button group">
                                        <label class="btn btn-primary month-label">
                                            <a href="<?php echo e(route('report.profit.loss', ['horizontal', 'collapse'])); ?>"
                                                class="text-white" id="collapse"> <?php echo e(__('Collapse')); ?> </a>
                                        </label>

                                        <label class="btn btn-primary year-label active">
                                            <a href="<?php echo e(route('report.profit.loss', ['horizontal', 'expand'])); ?>"
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

                                        <input type="hidden" name="view" value="horizontal">

                                        <div class="col-auto mt-4">
                                            <a href="#" class="btn btn-sm btn-primary"
                                                onclick="document.getElementById('report_profit_loss').submit(); return false;"
                                                data-bs-toggle="tooltip" title="<?php echo e(__('Apply')); ?>"
                                                data-original-title="<?php echo e(__('apply')); ?>">
                                                <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                                            </a>

                                            <a href="<?php echo e(route('report.profit.loss', 'horizontal')); ?>"
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
        <div class="col-md-12">
            <div class="card">
                <div class="card-body <?php echo e($collapseView == 'expand' ? 'collapse-view' : ''); ?>">
                    <div class="account-main-title mb-5">
                        <h5><?php echo e('Profit & Loss ' . $user->name . ' as of ' . $filter['startDateRange'] . ' to ' . $filter['endDateRange']); ?>

                            </h4>
                    </div>

                    <?php
                        $totalIncome = 0;
                        $netProfit = 0;
                        $totalCosts = 0;
                        $grossProfit = 0;
                    ?>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="aacount-title d-flex align-items-center justify-content-between border py-2">
                                <h5 class="mb-0 ms-3"><?php echo e(__('Expenses')); ?></h5>
                            </div>
                            <div class="border-start border-end">
                                <?php $__currentLoopData = $totalAccounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $accounts): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($accounts['Type'] == 'Expenses' || $accounts['Type'] == 'Costs of Goods Sold'): ?>
                                        <div class="account-main-inner border-bottom py-2">
                                            <p class="fw-bold mb-2 ms-3"><?php echo e($accounts['Type']); ?></p>

                                            <?php $__currentLoopData = $accounts['account']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $records): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($collapseView == 'collapse'): ?>
                                                    <?php $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php
                                                            if ($record['netAmount'] > 0) {
                                                                $netAmount = $record['netAmount'];
                                                            } else {
                                                                $netAmount = -$record['netAmount'];
                                                            }
                                                        ?>
                                                        <?php if($record['account'] == 'parentTotal'): ?>
                                                            <div
                                                                class="account-inner d-flex align-items-center justify-content-between ps-3">
                                                                <div class="mb-2 ms-2 account-arrow">
                                                                    <div class="">
                                                                        <a
                                                                            href="<?php echo e(route('report.profit.loss', ['horizontal', 'expand'])); ?>"><i
                                                                                class="ti ti-chevron-down account-icon"></i></a>
                                                                    </div>
                                                                    <a href="<?php echo e(route('report.ledger', $record['account_id'])); ?>?account=<?php echo e($record['account_id']); ?>"
                                                                        class="text-primary"><?php echo e(str_replace('Total ', '', $record['account_name'])); ?></a>
                                                                </div>
                                                                <p class="mb-2 ms-3 text-center">
                                                                    <?php echo e($record['account_code']); ?>

                                                                </p>
                                                                <p class="text-primary mb-2 me-3 float-end text-end">
                                                                    <?php echo e(\Auth::user()->priceFormat($$netAmount)); ?>

                                                                </p>
                                                            </div>
                                                        <?php endif; ?>

                                                        <?php if(
                                                            !preg_match('/\btotal\b/i', $record['account_name']) &&
                                                                $record['account'] == '' &&
                                                                $record['account'] != 'subAccount'): ?>
                                                            <div
                                                                class="account-inner d-flex align-items-center justify-content-between">
                                                                <p class="mb-2 ps-3 ms-3"><a
                                                                        href="<?php echo e(route('report.ledger', $record['account_id'])); ?>?account=<?php echo e($record['account_id']); ?>"
                                                                        class="text-primary"><?php echo e($record['account_name']); ?></a>
                                                                </p>

                                                                <p class="mb-2 text-center"><?php echo e($record['account_code']); ?>

                                                                </p>

                                                                <?php if(!preg_match('/\btotal\b/i', $record['account_name'])): ?>
                                                                    <p class="text-primary mb-2 float-end text-end me-3">
                                                                        <?php echo e(\Auth::user()->priceFormat($$netAmount)); ?>

                                                                    </p>
                                                                <?php else: ?>
                                                                    <p
                                                                        class="mb-2 float-end text-end me-3 fw-bold text-dark">
                                                                        <?php echo e(\Auth::user()->priceFormat($$netAmount)); ?>

                                                                    </p>
                                                                <?php endif; ?>


                                                            </div>
                                                        <?php endif; ?>

                                                        <?php
                                                            if ($record['account_name'] === 'Total Income') {
                                                                $totalIncome = $$netAmount;
                                                            }

                                                            if ($record['account_name'] == 'Total Costs of Goods Sold') {
                                                                $totalCosts = $netAmount;
                                                            }
                                                            $grossProfit = $totalIncome - $totalCosts;
                                                        ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php else: ?>
                                                    <?php $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php
                                                            if ($record['netAmount'] > 0) {
                                                                $netAmount = $record['netAmount'];
                                                            } else {
                                                                $netAmount = -$record['netAmount'];
                                                            }
                                                        ?>

                                                        <?php if($record['account'] == 'parent' || $record['account'] == 'parentTotal'): ?>
                                                            <div
                                                                class="account-inner d-flex align-items-center justify-content-between ps-3">
                                                                <?php if($record['account'] == 'parent'): ?>
                                                                    <div class="mb-2 ms-2 account-arrow">
                                                                        <div class="">
                                                                            <a
                                                                                href="<?php echo e(route('report.profit.loss', ['horizontal', 'collapse'])); ?>"><i
                                                                                    class="ti ti-chevron-down account-icon"></i></a>
                                                                        </div>
                                                                        <a href="<?php echo e(route('report.ledger', $record['account_id'])); ?>?account=<?php echo e($record['account_id']); ?>"
                                                                            class="<?php echo e($record['account'] == 'parent' ? 'text-primary' : 'text-dark'); ?> fw-bold"><?php echo e($record['account_name']); ?></a>
                                                                    </div>
                                                                <?php else: ?>
                                                                    <p class="mb-2 ms-2"><a href="#"
                                                                            class="text-dark fw-bold"><?php echo e($record['account_name']); ?></a>
                                                                    </p>
                                                                <?php endif; ?>
                                                                <p class="mb-2 ms-3 text-center">
                                                                    <?php echo e($record['account_code']); ?>

                                                                </p>
                                                                <p class="text-dark fw-bold mb-2 me-3 float-end text-end">
                                                                    <?php echo e(\Auth::user()->priceFormat($netAmount)); ?>

                                                                </p>
                                                            </div>
                                                        <?php endif; ?>

                                                        <?php if(
                                                            (!preg_match('/\btotal\b/i', $record['account_name']) && $record['account'] == '') ||
                                                                $record['account'] == 'subAccount'): ?>
                                                            <div
                                                                class="account-inner d-flex align-items-center justify-content-between ps-3">
                                                                <p class="mb-2 ps-3 ms-4"><a
                                                                        href="<?php echo e(route('report.ledger', $record['account_id'])); ?>?account=<?php echo e($record['account_id']); ?>"
                                                                        class="text-primary"><?php echo e($record['account_name']); ?></a>
                                                                </p>

                                                                <p class="mb-2 text-center"><?php echo e($record['account_code']); ?>

                                                                </p>

                                                                <?php if(!preg_match('/\btotal\b/i', $record['account_name'])): ?>
                                                                    <p class="text-primary mb-2 float-end text-end me-3">
                                                                        <?php echo e(\Auth::user()->priceFormat($netAmount)); ?>

                                                                    </p>
                                                                <?php else: ?>
                                                                    <p
                                                                        class="mb-2 float-end text-end me-3 fw-bold text-dark">
                                                                        <?php echo e(\Auth::user()->priceFormat($netAmount)); ?>

                                                                    </p>
                                                                <?php endif; ?>

                                                                <?php
                                                                    if ($record['account_name'] === 'Total Income') {
                                                                        $totalIncome = $netAmount;
                                                                    }

                                                                    if ($record['account_name'] == 'Total Costs of Goods Sold') {
                                                                        if ($record['netAmount'] > 0) {
                                                                            $totalCosts = $record['netAmount'];
                                                                        } else {
                                                                            $totalCosts = -$record['netAmount'];
                                                                        }
                                                                    }
                                                                    $grossProfit = $totalIncome - $totalCosts;
                                                                ?>
                                                            </div>
                                                        <?php endif; ?>
                                                        <?php
                                                            if ($record['account_name'] === 'Total Income') {
                                                                $totalIncome = $record['netAmount'];
                                                            }

                                                            if ($record['account_name'] == 'Total Costs of Goods Sold') {
                                                                $totalCosts = $netAmount;
                                                            }
                                                            $grossProfit = $totalIncome - $totalCosts;
                                                        ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <div class="account-inner d-flex align-items-center justify-content-between">
                                                <p class="fw-bold mb-2 ms-3 ">
                                                    <?php echo e($record['account_name'] ? $record['account_name'] : ''); ?>

                                                </p>
                                                <p class="fw-bold mb-2 text-end me-3">
                                                    <?php echo e($record['netAmount'] ? \Auth::user()->priceFormat($netAmount) : \Auth::user()->priceFormat(0)); ?>

                                                </p>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="aacount-title d-flex align-items-center justify-content-between border py-2">
                                <h5 class="mb-0 ms-3"><?php echo e(__('Income')); ?></h5>
                            </div>
                            <div class="border-start border-end">
                                <?php $__currentLoopData = $totalAccounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $accounts): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($accounts['Type'] == 'Income'): ?>
                                        <div class="account-main-inner border-bottom py-2">
                                            <p class="fw-bold mb-2 ms-3"><?php echo e($accounts['Type']); ?></p>

                                            <?php $__currentLoopData = $accounts['account']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $records): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($collapseView == 'collapse'): ?>
                                                    <?php $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($record['account'] == 'parentTotal'): ?>
                                                            <div
                                                                class="account-inner d-flex align-items-center justify-content-between ps-3">
                                                                <div class="mb-2 ms-2 account-arrow">
                                                                    <div class="">
                                                                        <a
                                                                            href="<?php echo e(route('report.profit.loss', ['horizontal', 'expand'])); ?>"><i
                                                                                class="ti ti-chevron-down account-icon"></i></a>
                                                                    </div>
                                                                    <a href="<?php echo e(route('report.ledger', $record['account_id'])); ?>?account=<?php echo e($record['account_id']); ?>"
                                                                        class="text-primary"><?php echo e(str_replace('Total ', '', $record['account_name'])); ?></a>
                                                                </div>
                                                                <p class="mb-2 ms-3 text-center">
                                                                    <?php echo e($record['account_code']); ?>

                                                                </p>
                                                                <p class="text-primary mb-2 me-3 float-end text-end">
                                                                    <?php echo e(\Auth::user()->priceFormat($record['netAmount'])); ?>

                                                                </p>
                                                            </div>
                                                        <?php endif; ?>

                                                        <?php if(
                                                            !preg_match('/\btotal\b/i', $record['account_name']) &&
                                                                $record['account'] == '' &&
                                                                $record['account'] != 'subAccount'): ?>
                                                            <div
                                                                class="account-inner d-flex align-items-center justify-content-between">
                                                                <p class="mb-2 ps-3 ms-3"><a
                                                                        href="<?php echo e(route('report.ledger', $record['account_id'])); ?>?account=<?php echo e($record['account_id']); ?>"
                                                                        class="text-primary"><?php echo e($record['account_name']); ?></a>
                                                                </p>

                                                                <p class="mb-2 text-center"><?php echo e($record['account_code']); ?>

                                                                </p>

                                                                <?php if(!preg_match('/\btotal\b/i', $record['account_name'])): ?>
                                                                    <p class="text-primary mb-2 float-end text-end me-3">
                                                                        <?php echo e(\Auth::user()->priceFormat($record['netAmount'])); ?>

                                                                    </p>
                                                                <?php else: ?>
                                                                    <p
                                                                        class="mb-2 float-end text-end me-3 fw-bold text-dark">
                                                                        <?php echo e(\Auth::user()->priceFormat($record['netAmount'])); ?>

                                                                    </p>
                                                                <?php endif; ?>


                                                            </div>
                                                        <?php endif; ?>

                                                        <?php
                                                            if ($record['account_name'] === 'Total Income') {
                                                                $totalIncome = $record['netAmount'];
                                                            }

                                                            if ($record['account_name'] == 'Total Costs of Goods Sold') {
                                                                if ($record['netAmount'] > 0) {
                                                                    $totalCosts = $record['netAmount'];
                                                                } else {
                                                                    $totalCosts = -$record['netAmount'];
                                                                }
                                                            }
                                                            $grossProfit = $totalIncome - $totalCosts;
                                                        ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php else: ?>
                                                    <?php $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($record['account'] == 'parent' || $record['account'] == 'parentTotal'): ?>
                                                            <div
                                                                class="account-inner d-flex align-items-center justify-content-between ps-3">
                                                                <?php if($record['account'] == 'parent'): ?>
                                                                    <div class="mb-2 ms-2 account-arrow">
                                                                        <div class="">
                                                                            <a
                                                                                href="<?php echo e(route('report.profit.loss', ['horizontal', 'collapse'])); ?>"><i
                                                                                    class="ti ti-chevron-down account-icon"></i></a>
                                                                        </div>
                                                                        <a href="<?php echo e(route('report.ledger', $record['account_id'])); ?>?account=<?php echo e($record['account_id']); ?>"
                                                                            class="<?php echo e($record['account'] == 'parent' ? 'text-primary' : 'text-dark'); ?> fw-bold"><?php echo e($record['account_name']); ?></a>
                                                                    </div>
                                                                <?php else: ?>
                                                                    <p class="mb-2 ms-2"><a href="#"
                                                                            class="text-dark fw-bold"><?php echo e($record['account_name']); ?></a>
                                                                    </p>
                                                                <?php endif; ?>
                                                                <p class="mb-2 ms-3 text-center">
                                                                    <?php echo e($record['account_code']); ?>

                                                                </p>
                                                                <p class="text-dark fw-bold mb-2 me-3 float-end text-end">
                                                                    <?php echo e(\Auth::user()->priceFormat($record['netAmount'])); ?>

                                                                </p>
                                                            </div>
                                                        <?php endif; ?>

                                                        <?php if(
                                                            (!preg_match('/\btotal\b/i', $record['account_name']) && $record['account'] == '') ||
                                                                $record['account'] == 'subAccount'): ?>
                                                            <div
                                                                class="account-inner d-flex align-items-center justify-content-between ps-3">
                                                                <p class="mb-2 ps-3 ms-4"><a
                                                                        href="<?php echo e(route('report.ledger', $record['account_id'])); ?>?account=<?php echo e($record['account_id']); ?>"
                                                                        class="text-primary"><?php echo e($record['account_name']); ?></a>
                                                                </p>

                                                                <p class="mb-2 text-center"><?php echo e($record['account_code']); ?>

                                                                </p>

                                                                <?php if(!preg_match('/\btotal\b/i', $record['account_name'])): ?>
                                                                    <p class="text-primary mb-2 float-end text-end me-3">
                                                                        <?php echo e(\Auth::user()->priceFormat($record['netAmount'])); ?>

                                                                    </p>
                                                                <?php else: ?>
                                                                    <p
                                                                        class="mb-2 float-end text-end me-3 fw-bold text-dark">
                                                                        <?php echo e(\Auth::user()->priceFormat($record['netAmount'])); ?>

                                                                    </p>
                                                                <?php endif; ?>

                                                                <?php
                                                                    if ($record['account_name'] === 'Total Income') {
                                                                        $totalIncome = $record['netAmount'];
                                                                    }

                                                                    if ($record['account_name'] == 'Total Costs of Goods Sold') {
                                                                        if ($record['netAmount'] > 0) {
                                                                            $totalCosts = $record['netAmount'];
                                                                        } else {
                                                                            $totalCosts = -$record['netAmount'];
                                                                        }
                                                                    }
                                                                    $grossProfit = $totalIncome - $totalCosts;
                                                                ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            <div class="account-inner d-flex align-items-center justify-content-between">
                                                <p class="fw-bold mb-2 ms-3">
                                                    <?php echo e($record['account_name'] ? $record['account_name'] : ''); ?>

                                                </p>
                                                <p class="fw-bold mb-2 text-end me-3">
                                                    <?php echo e($record['netAmount'] ? \Auth::user()->priceFormat($record['netAmount']) : \Auth::user()->priceFormat(0)); ?>

                                                </p>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/integra.platformbisnis.com/public_html/resources/views/report/profit_loss_horizontal.blade.php ENDPATH**/ ?>