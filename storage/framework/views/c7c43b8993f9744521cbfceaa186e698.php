<?php
    // $logo=asset(Storage::url('uploads/logo/'));
    $logo = \App\Models\Utility::get_file('uploads/logo');
    $company_favicon = Utility::companyData($invoice->created_by, 'company_favicon');
    $setting = DB::table('settings')
        ->where('created_by', $user->creatorId())
        ->pluck('value', 'name')
        ->toArray();
    $settings_data = \App\Models\Utility::settingsById($invoice->created_by);
    $color = !empty($setting['color']) ? $setting['color'] : 'theme-3';

    if(isset($setting['color_flag']) && $setting['color_flag'] == 'true')
    {
        $themeColor = 'custom-color';
    }
    else {
        $themeColor = $color;
    }
    $company_setting = \App\Models\Utility::settingsById($invoice->created_by);
    $getseo = App\Models\Utility::getSeoSetting();
    $metatitle = isset($getseo['meta_title']) ? $getseo['meta_title'] : '';
    $metsdesc = isset($getseo['meta_desc']) ? $getseo['meta_desc'] : '';
    $meta_image = \App\Models\Utility::get_file('uploads/meta/');
    $meta_logo = isset($getseo['meta_image']) ? $getseo['meta_image'] : '';
    $get_cookie = \App\Models\Utility::getCookieSetting();

?>
<!DOCTYPE html>

<html lang="en" dir="<?php echo e($settings_data['SITE_RTL'] == 'on' ? 'rtl' : ''); ?>">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>
        <?php echo e(Utility::companyData($invoice->created_by, 'title_text') ? Utility::companyData($invoice->created_by, 'title_text') : config('app.name', 'ERPGO')); ?>

        - <?php echo e(__('Invoice')); ?></title>

    <meta name="title" content="<?php echo e($metatitle); ?>">
    <meta name="description" content="<?php echo e($metsdesc); ?>">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo e(env('APP_URL')); ?>">
    <meta property="og:title" content="<?php echo e($metatitle); ?>">
    <meta property="og:description" content="<?php echo e($metsdesc); ?>">
    <meta property="og:image" content="<?php echo e($meta_image . $meta_logo); ?>">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?php echo e(env('APP_URL')); ?>">
    <meta property="twitter:title" content="<?php echo e($metatitle); ?>">
    <meta property="twitter:description" content="<?php echo e($metsdesc); ?>">
    <meta property="twitter:image" content="<?php echo e($meta_image . $meta_logo); ?>">

    <link rel="icon"
        href="<?php echo e($logo . '/' . (isset($company_favicon) && !empty($company_favicon) ? $company_favicon : 'favicon.png')); ?>"
        type="image" sizes="16x16">

    <link rel="stylesheet" href="<?php echo e(asset('assets/css/plugins/main.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('assets/css/plugins/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/plugins/animate.min.css')); ?>">


    <!-- font css -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/tabler-icons.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/feather.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/fontawesome.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/material.css')); ?>">

    <!-- vendor css -->
    <?php if($settings_data['SITE_RTL'] == 'on'): ?>
        <link rel="stylesheet" href="<?php echo e(asset('assets/css/style-rtl.css')); ?>">
    <?php endif; ?>
    <?php if($settings_data['cust_darklayout'] == 'on'): ?>
        <link rel="stylesheet" href="<?php echo e(asset('assets/css/style-dark.css')); ?>" id="style">
    <?php else: ?>
        <link rel="stylesheet" href="<?php echo e(asset('assets/css/style.css')); ?>" id="style">
    <?php endif; ?>

    <link rel="stylesheet" href="<?php echo e(asset('assets/css/customizer.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('css/custom.css')); ?>" id="main-style-link">

    <link rel="stylesheet" href="<?php echo e(asset('assets/css/plugins/bootstrap-switch-button.min.css')); ?>">

    <style>
        :root {
            --color-customColor: <?= $color ?>;    
        }
    </style>

    <link rel="stylesheet" href="<?php echo e(asset('css/custom-color.css')); ?>">
    <?php echo $__env->yieldPushContent('css-page'); ?>

    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <style>
        #card-element {
            border: 1px solid #a3afbb !important;
            border-radius: 10px !important;
            padding: 10px !important;
        }
    </style>
</head>

<body class="<?php echo e($themeColor); ?>">
    <header class="header header-transparent" id="header-main">

    </header>

    <div class="main-content container">
        <div class="row justify-content-between align-items-center mb-3">
            <div class="col-md-12 d-flex align-items-center justify-content-between justify-content-md-end">

                <div class="all-button-box mx-2">
                    <a href="<?php echo e(route('invoice.pdf', Crypt::encrypt($invoice->id))); ?>" target="_blank"
                        class="btn btn-primary mt-3">
                        <?php echo e(__('Download')); ?>

                    </a>
                </div>
                <?php if(
                    $invoice->status != 0 &&
                        $invoice->getDue() > 0 &&
                        (!empty($company_payment_setting) &&
                            ($company_payment_setting['is_bank_transfer_enabled'] == 'on' ||
                                $company_payment_setting['is_stripe_enabled'] == 'on' ||
                                $company_payment_setting['is_paypal_enabled'] == 'on' ||
                                $company_payment_setting['is_paystack_enabled'] == 'on' ||
                                $company_payment_setting['is_flutterwave_enabled'] == 'on' ||
                                $company_payment_setting['is_razorpay_enabled'] == 'on' ||
                                $company_payment_setting['is_mercado_enabled'] == 'on' ||
                                $company_payment_setting['is_paytm_enabled'] == 'on' ||
                                $company_payment_setting['is_mollie_enabled'] == 'on' ||
                                $company_payment_setting['is_paypal_enabled'] == 'on' ||
                                $company_payment_setting['is_skrill_enabled'] == 'on' ||
                                $company_payment_setting['is_coingate_enabled'] == 'on' ||
                                $company_payment_setting['is_paymentwall_enabled'] == 'on' ||
                                $company_payment_setting['is_toyyibpay_enabled'] == 'on' ||
                                $company_payment_setting['is_payfast_enabled'] == 'on' ||
                                $company_payment_setting['is_iyzipay_enabled'] == 'on' ||
                                $company_payment_setting['is_sspay_enabled'] == 'on' ||
                                $company_payment_setting['is_paytab_enabled'] == 'on' ||
                                $company_payment_setting['is_benefit_enabled'] == 'on' ||
                                $company_payment_setting['is_cashfree_enabled'] == 'on' ||
                                $company_payment_setting['is_aamarpay_enabled'] == 'on' ||
                                $company_payment_setting['is_yookassa_enabled'] == 'on' ||
                                $company_payment_setting['is_midtrans_enabled'] == 'on' ||
                                $company_payment_setting['is_nepalste_enabled'] == 'on' ||
                                $company_payment_setting['is_xendit_enabled'] == 'on'))): ?>
                    <div class="all-button-box">
                        <a href="#" class="btn btn-primary mt-3" data-bs-toggle="modal"
                            data-bs-target="#paymentModal">
                            <?php echo e(__('Pay Now')); ?>

                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="invoice">
                            <div class="invoice-print">
                                <div class="row invoice-title mt-2">
                                    <div class="col-xs-12 col-sm-12 col-nd-6 col-lg-6 col-12">
                                        <h2><?php echo e(__('Invoice')); ?></h2>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-nd-6 col-lg-6 col-12 text-end">
                                        <h3 class="invoice-number float-right">
                                            <?php echo e($user->invoiceNumberFormat($invoice->invoice_id)); ?></h3>
                                    </div>
                                    <div class="col-12">
                                        <hr>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col text-end">
                                        <div class="d-flex align-items-center justify-content-end">

                                            <div class="me-4">
                                                <small>
                                                    <strong><?php echo e(__('Issue Date')); ?> :</strong><br>
                                                    <?php echo e(Utility::dateFormat($settings, $invoice->issue_date)); ?><br><br>
                                                </small>
                                            </div>
                                            <small>
                                                <strong><?php echo e(__('Due Date')); ?> :</strong><br>
                                                <?php echo e(Utility::dateFormat($settings, $invoice->due_date)); ?><br><br>
                                            </small>

                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <?php if(!empty($customer->billing_name)): ?>
                                        <div class="col">
                                            <small class="font-style">
                                                <strong><?php echo e(__('Billed To')); ?> :</strong><br>
                                                <?php echo e(!empty($customer->billing_name) ? $customer->billing_name : ''); ?><br>
                                                <?php echo e(!empty($customer->billing_phone) ? $customer->billing_phone : ''); ?><br>
                                                <?php echo e(!empty($customer->billing_address) ? $customer->billing_address : ''); ?><br>
                                                <?php echo e(!empty($customer->billing_zip) ? $customer->billing_zip : ''); ?><br>
                                                <?php echo e(!empty($customer->billing_city) ? $customer->billing_city : '' . ', '); ?>

                                                <?php echo e(!empty($customer->billing_state) ? $customer->billing_state : '', ', '); ?>

                                                <?php echo e(!empty($customer->billing_country) ? $customer->billing_country : ''); ?>

                                            </small>
                                        </div>
                                    <?php endif; ?>
                                    <?php if(\Utility::companyData($invoice->created_by, 'shipping_display') == 'on'): ?>
                                        <div class="col">
                                            <small>
                                                <strong><?php echo e(__('Shipped To')); ?> :</strong><br>
                                                <?php echo e(!empty($customer->shipping_name) ? $customer->shipping_name : ''); ?><br>
                                                <?php echo e(!empty($customer->shipping_phone) ? $customer->shipping_phone : ''); ?><br>
                                                <?php echo e(!empty($customer->shipping_address) ? $customer->shipping_address : ''); ?><br>
                                                <?php echo e(!empty($customer->shipping_zip) ? $customer->shipping_zip : ''); ?><br>
                                                <?php echo e(!empty($customer->shipping_city) ? $customer->shipping_city : '' . ', '); ?>

                                                <?php echo e(!empty($customer->shipping_state) ? $customer->shipping_state : '' . ', '); ?>,<?php echo e(!empty($customer->shipping_country) ? $customer->shipping_country : ''); ?>

                                            </small>
                                        </div>
                                    <?php endif; ?>
                                    <div class="col">
                                        <div class="float-end mt-3">
                                            <?php echo DNS2D::getBarcodeHTML(
                                                route('invoice.link.copy', \Illuminate\Support\Facades\Crypt::encrypt($invoice->id)),
                                                'QRCODE',
                                                2,
                                                2,
                                            ); ?>

                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col">
                                        <small>
                                            <strong><?php echo e(__('Status')); ?> :</strong><br>
                                            <?php if($invoice->status == 0): ?>
                                                <span
                                                    class="badge bg-primary"><?php echo e(__(\App\Models\Invoice::$statues[$invoice->status])); ?></span>
                                            <?php elseif($invoice->status == 1): ?>
                                                <span
                                                    class="badge bg-warning"><?php echo e(__(\App\Models\Invoice::$statues[$invoice->status])); ?></span>
                                            <?php elseif($invoice->status == 2): ?>
                                                <span
                                                    class="badge bg-danger"><?php echo e(__(\App\Models\Invoice::$statues[$invoice->status])); ?></span>
                                            <?php elseif($invoice->status == 3): ?>
                                                <span
                                                    class="badge bg-info"><?php echo e(__(\App\Models\Invoice::$statues[$invoice->status])); ?></span>
                                            <?php elseif($invoice->status == 4): ?>
                                                <span
                                                    class="badge bg-primary"><?php echo e(__(\App\Models\Invoice::$statues[$invoice->status])); ?></span>
                                            <?php endif; ?>
                                        </small>
                                    </div>

                                    <?php if(!empty($customFields) && count($invoice->customField) > 0): ?>
                                        <?php $__currentLoopData = $customFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="col text-md-right">
                                                <small>
                                                    <strong><?php echo e($field->name); ?> :</strong><br>
                                                    <?php echo e(!empty($invoice->customField) ? $invoice->customField[$field->id] : '-'); ?>

                                                    <br><br>
                                                </small>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <div class="font-weight-bold"><?php echo e(__('Product Summary')); ?></div>
                                        <small><?php echo e(__('All items here cannot be deleted.')); ?></small>
                                        <div class="table-responsive mt-2">
                                            <table class="table mb-0 table-striped">
                                                <tr>
                                                    <th data-width="40" class="text-dark">#</th>
                                                    <th class="text-dark"><?php echo e(__('Product')); ?></th>
                                                    <th class="text-dark"><?php echo e(__('Quantity')); ?></th>
                                                    <th class="text-dark"><?php echo e(__('Rate')); ?></th>
                                                    <th class="text-dark"><?php echo e(__('Discount')); ?></th>
                                                    <th class="text-dark"><?php echo e(__('Tax')); ?></th>
                                                    <th class="text-dark"><?php echo e(__('Description')); ?></th>
                                                    <th class="text-end text-dark" width="12%">
                                                        <?php echo e(__('Price')); ?><br>
                                                        <small
                                                            class="text-danger font-weight-bold"><?php echo e(__('after tax & discount')); ?></small>
                                                    </th>
                                                </tr>
                                                <?php
                                                    $totalQuantity = 0;
                                                    $totalRate = 0;
                                                    $totalTaxPrice = 0;
                                                    $totalDiscount = 0;
                                                    $taxesData = [];
                                                ?>
                                                <?php $__currentLoopData = $iteams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $iteam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                    <tr>
                                                        <td><?php echo e($key + 1); ?></td>
                                                        <?php
                                                            $productName = $iteam->product;
                                                            $totalRate += $iteam->price;
                                                            $totalQuantity += $iteam->quantity;
                                                            $totalDiscount += $iteam->discount;
                                                        ?>
                                                        <td><?php echo e(!empty($productName) ? $productName->name : ''); ?></td>
                                                        <?php
                                                        $unitName = App\Models\ProductServiceUnit::find($iteam->unit);
                                                ?>
                                                <td><?php echo e($iteam->quantity); ?> <?php echo e(($unitName != null) ?  '('. $unitName->name .')' : ''); ?></td>
                                                        <td><?php echo e(\App\Models\Utility::priceFormat($settings, $iteam->price)); ?>

                                                        </td>
                                                        <td><?php echo e(\App\Models\Utility::priceFormat($settings, $iteam->discount)); ?>

                                                        </td>
                                                        <td>
                                                            <?php if(!empty($iteam->tax)): ?>
                                                                <table>
                                                                    <?php
                                                                        $itemTaxes = [];
                                                                        $getTaxData = Utility::getTaxData();

                                                                        if (!empty($iteam->tax)) {
                                                                            foreach (explode(',', $iteam->tax) as $tax) {
                                                                                $taxPrice = \Utility::taxRate($getTaxData[$tax]['rate'], $iteam->price, $iteam->quantity);
                                                                                $totalTaxPrice += $taxPrice;
                                                                                $itemTax['name'] = $getTaxData[$tax]['name'];
                                                                                $itemTax['rate'] = $getTaxData[$tax]['rate'] . '%';
                                                                                $itemTax['price'] = \App\Models\Utility::priceFormat($settings, $taxPrice);

                                                                                $itemTaxes[] = $itemTax;
                                                                                if (array_key_exists($getTaxData[$tax]['name'], $taxesData)) {
                                                                                    $taxesData[$getTaxData[$tax]['name']] = $taxesData[$getTaxData[$tax]['name']] + $taxPrice;
                                                                                } else {
                                                                                    $taxesData[$getTaxData[$tax]['name']] = $taxPrice;
                                                                                }
                                                                            }
                                                                            $iteam->itemTax = $itemTaxes;
                                                                        } else {
                                                                            $iteam->itemTax = [];
                                                                        }
                                                                    ?>
                                                                    <?php $__currentLoopData = $iteam->itemTax; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <tr>
                                                                            <td><?php echo e($tax['name'] . ' (' . $tax['rate'] . '%)'); ?>

                                                                            </td>
                                                                            <td><?php echo e($tax['price']); ?></td>
                                                                        </tr>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </table>
                                                            <?php else: ?>
                                                                -
                                                            <?php endif; ?>
                                                        </td>

                                                        <td><?php echo e(!empty($iteam->description) ? $iteam->description : '-'); ?>

                                                        </td>
                                                        <td class="text-end">
                                                            <?php echo e(Utility::priceFormat($settings, $iteam->price * $iteam->quantity - $iteam->discount + $totalTaxPrice)); ?>

                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <tfoot>
                                                    <tr>
                                                        <td></td>

                                                        <td><b><?php echo e(__('Total')); ?></b></td>
                                                        <td><b><?php echo e($totalQuantity); ?></b></td>
                                                        <td><?php echo e(Utility::priceFormat($settings, $totalRate)); ?></td>
                                                        <td><b><?php echo e(Utility::priceFormat($settings, $totalDiscount)); ?></b>
                                                        </td>
                                                        <td><b><?php echo e(Utility::priceFormat($settings, $totalTaxPrice)); ?></b>
                                                        </td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="6"></td>
                                                        <td class="text-end"><b><?php echo e(__('Sub Total')); ?></b></td>
                                                        <td class="text-end">
                                                            <?php echo e(Utility::priceFormat($settings, $invoice->getSubTotal())); ?>

                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td colspan="6"></td>
                                                        <td class="text-end"><b><?php echo e(__('Discount')); ?></b></td>
                                                        <td class="text-end">
                                                            <?php echo e(Utility::priceFormat($settings, $invoice->getTotalDiscount())); ?>

                                                        </td>
                                                    </tr>

                                                    <?php if(!empty($taxesData)): ?>
                                                        <?php $__currentLoopData = $taxesData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $taxName => $taxPrice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <tr>
                                                                <td colspan="6"></td>
                                                                <td class="text-end"><b><?php echo e($taxName); ?></b></td>
                                                                <td class="text-end">
                                                                    <?php echo e(Utility::priceFormat($settings, $taxPrice)); ?>

                                                                </td>
                                                            </tr>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                    <tr>
                                                        <td colspan="6"></td>
                                                        <td class="blue-text text-end"><b><?php echo e(__('Total')); ?></b></td>
                                                        <td class="blue-text text-end">
                                                            <?php echo e(Utility::priceFormat($settings, $invoice->getTotal())); ?>

                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="6"></td>
                                                        <td class="text-end"><b><?php echo e(__('Paid')); ?></b></td>
                                                        <td class="text-end">
                                                            <?php echo e(Utility::priceFormat($settings, $invoice->getTotal() - $invoice->getDue() - $invoice->invoiceTotalCreditNote())); ?>

                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="6"></td>
                                                        <td class="text-end"><b><?php echo e(__('Credit Note')); ?></b></td>
                                                        <td class="text-end">
                                                            <?php echo e(Utility::priceFormat($settings, $invoice->invoiceTotalCreditNote())); ?>

                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="6"></td>
                                                        <td class="text-end"><b><?php echo e(__('Due')); ?></b></td>
                                                        <td class="text-end">
                                                            <?php echo e(Utility::priceFormat($settings, $invoice->getDue())); ?>

                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <h5 class="h4 d-inline-block font-weight-400 mb-2"><?php echo e(__('Receipt Summary')); ?></h5><br>
                <?php if($user_plan->storage_limit <= $user->storage_limit): ?>
                    <small
                        class="text-danger font-bold"><?php echo e(__('Your plan storage limit is over , so you can not see customer uploaded payment receipt')); ?></small><br>
                <?php endif; ?>
                <div class="card mt-1">
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th class="text-dark"><?php echo e(__('Date')); ?></th>
                                    <th class="text-dark"><?php echo e(__('Amount')); ?></th>
                                    <th class="text-dark"><?php echo e(__('Payment Type')); ?></th>
                                    <th class="text-dark"><?php echo e(__('Account')); ?></th>
                                    <th class="text-dark"><?php echo e(__('Reference')); ?></th>
                                    <th class="text-dark"><?php echo e(__('Description')); ?></th>
                                    <th class="text-dark"><?php echo e(__('Receipt')); ?></th>
                                    <th class="text-dark"><?php echo e(__('OrderId')); ?></th>
                                </tr>
                                <?php
                                    $path = \App\Models\Utility::get_file('uploads/order');
                                ?>

                                <?php if(!empty($invoice->payments) && $invoice->bankPayments): ?>
                                    <?php $__currentLoopData = $invoice->payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e(Utility::dateFormat($settings, $payment->date)); ?></td>
                                            <td><?php echo e(Utility::priceFormat($settings, $payment->amount)); ?></td>
                                            <td><?php echo e($payment->payment_type); ?></td>
                                            <td><?php echo e(!empty($payment->bankAccount) ? $payment->bankAccount->bank_name . ' ' . $payment->bankAccount->holder_name : '--'); ?>

                                            </td>
                                            <td><?php echo e(!empty($payment->reference) ? $payment->reference : '--'); ?></td>
                                            <td><?php echo e(!empty($payment->description) ? $payment->description : '--'); ?>

                                            </td>

                                            <?php if($user_plan->storage_limit <= $user->storage_limit): ?>
                                                <td>
                                                    --
                                                </td>
                                            <?php else: ?>
                                                <td>
                                                    <?php if(!empty($payment->receipt)): ?>
                                                        <a href="<?php echo e($path . '/' . $payment->receipt); ?>"
                                                            target="_blank">
                                                            <i class="ti ti-file"></i><?php echo e(__('Receipt')); ?></a>
                                                    <?php elseif(!empty($payment->add_receipt)): ?>
                                                        <a href="<?php echo e(asset(Storage::url('uploads/payment')) . '/' . $payment->add_receipt); ?>"
                                                            target="_blank">
                                                            <i class="ti ti-file"></i><?php echo e(__('Receipt')); ?></a>
                                                    <?php else: ?>
                                                        --
                                                    <?php endif; ?>
                                                </td>
                                            <?php endif; ?>
                                            <td><?php echo e(!empty($payment->order_id) ? $payment->order_id : '--'); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                    <?php $__currentLoopData = $invoice->bankPayments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $bankPayment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e(Utility::dateFormat($settings, $bankPayment->date)); ?></td>
                                            <td><?php echo e(Utility::priceFormat($settings, $bankPayment->amount)); ?></td>
                                            <td><?php echo e(__('Bank Transfer')); ?></td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>-</td>

                                            <?php if($user_plan->storage_limit <= $user->storage_limit): ?>
                                                <td>
                                                    --
                                                </td>
                                            <?php else: ?>
                                                <td>
                                                    <?php if($user_plan->storage_limit <= $user->storage_limit): ?>
                                                        <?php if(!empty($bankPayment->receipt)): ?>
                                                            <a href="<?php echo e($path . '/' . $bankPayment->receipt); ?>"
                                                                target="_blank">
                                                                <i class="ti ti-file"></i> <?php echo e(__('Receipt')); ?>

                                                            </a>
                                                        <?php endif; ?>
                                                    <?php else: ?>
                                                        --
                                                    <?php endif; ?>
                                                </td>
                                            <?php endif; ?>
                                            <td><?php echo e(!empty($bankPayment->order_id) ? $bankPayment->order_id : '--'); ?>

                                            </td>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete invoice product')): ?>
                                                <td>
                                                    <?php if($bankPayment->status == 'Pending'): ?>
                                                        <div class="action-btn bg-warning">
                                                            <a href="#"
                                                                data-url="<?php echo e(URL::to('invoice/' . $bankPayment->id . '/action')); ?>"
                                                                data-size="lg" data-ajax-popup="true"
                                                                data-title="<?php echo e(__('Payment Status')); ?>"
                                                                class="mx-3 btn btn-sm align-items-center"
                                                                data-bs-toggle="tooltip"
                                                                title="<?php echo e(__('Payment Status')); ?>"
                                                                data-original-title="<?php echo e(__('Payment Status')); ?>">
                                                                <i class="ti ti-caret-right text-white"></i>
                                                            </a>
                                                        </div>
                                                    <?php endif; ?>
                                                    <div class="action-btn bg-danger ms-2">
                                                        <?php echo Form::open([
                                                            'method' => 'post',
                                                            'route' => ['invoice.payment.destroy', $invoice->id, $bankPayment->id],
                                                            'id' => 'delete-form-' . $bankPayment->id,
                                                        ]); ?>


                                                        <a href="#"
                                                            class="mx-3 btn btn-sm align-items-center bs-pass-para"
                                                            data-bs-toggle="tooltip" title="Delete"
                                                            data-original-title="<?php echo e(__('Delete')); ?>"
                                                            data-confirm="<?php echo e(__('Are You Sure?') . '|' . __('This action can not be undone. Do you want to continue?')); ?>"
                                                            data-confirm-yes="document.getElementById('delete-form-<?php echo e($bankPayment->id); ?>').submit();">
                                                            <i class="ti ti-trash text-white"></i>
                                                        </a>
                                                        <?php echo Form::close(); ?>

                                                </td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="<?php echo e(Gate::check('delete invoice product') ? '9' : '8'); ?>"
                                            class="text-center text-dark">
                                            <p><?php echo e(__('No Data Found')); ?></p>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php if($invoice->getDue() > 0): ?>
            <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog"
                aria-labelledby="paymentModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="paymentModalLabel"><?php echo e(__('Add Payment')); ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="card bg-none card-box">
                                <section class="nav-tabs p-2">
                                    <?php if(
                                        (isset($company_payment_setting['is_stripe_enabled']) && $company_payment_setting['is_stripe_enabled'] == 'on') ||
                                            (isset($company_payment_setting['is_bank_transfer_enabled']) &&
                                                $company_payment_setting['is_bank_transfer_enabled'] == 'on') ||
                                            (isset($company_payment_setting['is_paypal_enabled']) &&
                                                $company_payment_setting['is_paypal_enabled'] == 'on') ||
                                            (isset($company_payment_setting['is_paystack_enabled']) &&
                                                $company_payment_setting['is_paystack_enabled'] == 'on') ||
                                            (isset($company_payment_setting['is_flutterwave_enabled']) &&
                                                $company_payment_setting['is_flutterwave_enabled'] == 'on') ||
                                            (isset($company_payment_setting['is_razorpay_enabled']) &&
                                                $company_payment_setting['is_razorpay_enabled'] == 'on') ||
                                            (isset($company_payment_setting['is_mercado_enabled']) &&
                                                $company_payment_setting['is_mercado_enabled'] == 'on') ||
                                            (isset($company_payment_setting['is_paytm_enabled']) && $company_payment_setting['is_paytm_enabled'] == 'on') ||
                                            (isset($company_payment_setting['is_mollie_enabled']) &&
                                                $company_payment_setting['is_mollie_enabled'] == 'on') ||
                                            (isset($company_payment_setting['is_skrill_enabled']) &&
                                                $company_payment_setting['is_skrill_enabled'] == 'on') ||
                                            (isset($company_payment_setting['is_coingate_enabled']) &&
                                                $company_payment_setting['is_coingate_enabled'] == 'on') ||
                                            (isset($company_payment_setting['is_paymentwall_enabled']) &&
                                                $company_payment_setting['is_paymentwall_enabled'] == 'on') ||
                                            (isset($company_payment_setting['is_toyyibpay_enabled']) &&
                                                $company_payment_setting['is_toyyibpay_enabled'] == 'on') ||
                                            (isset($company_payment_setting['is_payfast_enabled']) &&
                                                $company_payment_setting['is_payfast_enabled'] == 'on') ||
                                            (isset($company_payment_setting['is_iyzipay_enabled']) &&
                                                $company_payment_setting['is_iyzipay_enabled'] == 'on') ||
                                            (isset($company_payment_setting['is_sspay_enabled']) && $company_payment_setting['is_sspay_enabled'] == 'on') ||
                                            (isset($company_payment_setting['is_paytab_enabled']) &&
                                                $company_payment_setting['is_paytab_enabled'] == 'on') ||
                                            (isset($company_payment_setting['is_benefit_enabled']) &&
                                                $company_payment_setting['is_benefit_enabled'] == 'on') ||
                                            (isset($company_payment_setting['is_cashfree_enabled']) &&
                                                $company_payment_setting['is_cashfree_enabled'] == 'on') ||
                                            (isset($company_payment_setting['is_aamarpay_enabled']) &&
                                                $company_payment_setting['is_aamarpay_enabled'] == 'on') ||
                                            (isset($company_payment_setting['is_paytr_enabled']) && $company_payment_setting['is_paytr_enabled'] == 'on') ||
                                            (isset($company_payment_setting['is_yookassa_enabled']) &&
                                                $company_payment_setting['is_yookassa_enabled'] == 'on') ||
                                            (isset($company_payment_setting['is_midtrans_enabled']) &&
                                                $company_payment_setting['is_midtrans_enabled'] == 'on') ||
                                            (isset($company_payment_setting['is_xendit_enabled']) &&
                                                $company_payment_setting['is_xendit_enabled'] == 'on') ||
                                            (isset($company_payment_setting['is_nepalste_enabled']) &&
                                                $company_payment_setting['is_nepalste_enabled'] == 'on')): ?>

                                        <ul class="nav nav-pills  mb-3" role="tablist">
                                            <?php if($company_payment_setting['is_bank_transfer_enabled'] == 'on' && !empty($company_payment_setting['bank_details'])): ?>
                                                <li class="nav-item mb-2">
                                                    <a class="btn btn-outline-primary btn-sm me-1 active"
                                                        data-bs-toggle="tab" href="#bank-transfer-payment"
                                                        role="tab" aria-controls="bank"
                                                        aria-selected="true"><?php echo e(__('Bank Transfer')); ?></a>
                                                </li>
                                            <?php endif; ?>

                                            <?php if(
                                                $company_payment_setting['is_stripe_enabled'] == 'on' &&
                                                    !empty($company_payment_setting['stripe_key']) &&
                                                    !empty($company_payment_setting['stripe_secret'])): ?>
                                                <li class="nav-item mb-2">
                                                    <a class="btn btn-outline-primary btn-sm me-1"
                                                        data-bs-toggle="tab" href="#stripe-payment" role="tab"
                                                        aria-controls="stripe"
                                                        aria-selected="true"><?php echo e(__('Stripe')); ?></a>
                                                </li>
                                            <?php endif; ?>

                                            <?php if(
                                                $company_payment_setting['is_paypal_enabled'] == 'on' &&
                                                    !empty($company_payment_setting['paypal_client_id']) &&
                                                    !empty($company_payment_setting['paypal_secret_key'])): ?>
                                                <li class="nav-item mb-2">
                                                    <a class="btn btn-outline-primary btn-sm me-1 ml-1"
                                                        data-bs-toggle="tab" href="#paypal-payment" role="tab"
                                                        aria-controls="paypal"
                                                        aria-selected="false"><?php echo e(__('Paypal')); ?></a>
                                                </li>
                                            <?php endif; ?>

                                            <?php if(
                                                $company_payment_setting['is_paystack_enabled'] == 'on' &&
                                                    !empty($company_payment_setting['paystack_public_key']) &&
                                                    !empty($company_payment_setting['paystack_secret_key'])): ?>
                                                <li class="nav-item mb-2">
                                                    <a class="btn btn-outline-primary btn-sm me-1 ml-1"
                                                        data-bs-toggle="tab" href="#paystack-payment" role="tab"
                                                        aria-controls="paystack"
                                                        aria-selected="false"><?php echo e(__('Paystack')); ?></a>
                                                </li>
                                            <?php endif; ?>

                                            <?php if(isset($company_payment_setting['is_flutterwave_enabled']) &&
                                                    $company_payment_setting['is_flutterwave_enabled'] == 'on'): ?>
                                                <li class="nav-item mb-2">
                                                    <a class="btn btn-outline-primary btn-sm me-1 ml-1"
                                                        data-bs-toggle="tab" href="#flutterwave-payment"
                                                        role="tab" aria-controls="flutterwave"
                                                        aria-selected="false"><?php echo e(__('Flutterwave')); ?></a>
                                                </li>
                                            <?php endif; ?>

                                            <?php if(isset($company_payment_setting['is_razorpay_enabled']) && $company_payment_setting['is_razorpay_enabled'] == 'on'): ?>
                                                <li class="nav-item mb-2">
                                                    <a class="btn btn-outline-primary btn-sm me-1 ml-1"
                                                        data-bs-toggle="tab" href="#razorpay-payment" role="tab"
                                                        aria-controls="razorpay"
                                                        aria-selected="false"><?php echo e(__('Razorpay')); ?></a>
                                                </li>
                                            <?php endif; ?>


                                            <?php if(isset($company_payment_setting['is_mercado_enabled']) && $company_payment_setting['is_mercado_enabled'] == 'on'): ?>
                                                <li class="nav-item mb-2">
                                                    <a class="btn btn-outline-primary btn-sm me-1 ml-1"
                                                        data-bs-toggle="tab" href="#mercado-payment" role="tab"
                                                        aria-controls="mercado"
                                                        aria-selected="false"><?php echo e(__('Mercado')); ?></a>
                                                </li>
                                            <?php endif; ?>

                                            <?php if(isset($company_payment_setting['is_paytm_enabled']) && $company_payment_setting['is_paytm_enabled'] == 'on'): ?>
                                                <li class="nav-item mb-2">
                                                    <a class="btn btn-outline-primary btn-sm me-1 ml-1"
                                                        data-bs-toggle="tab" href="#paytm-payment" role="tab"
                                                        aria-controls="paytm"
                                                        aria-selected="false"><?php echo e(__('Paytm')); ?></a>
                                                </li>
                                            <?php endif; ?>

                                            <?php if(isset($company_payment_setting['is_mollie_enabled']) && $company_payment_setting['is_mollie_enabled'] == 'on'): ?>
                                                <li class="nav-item mb-2">
                                                    <a class="btn btn-outline-primary btn-sm me-1 ml-1"
                                                        data-bs-toggle="tab" href="#mollie-payment" role="tab"
                                                        aria-controls="mollie"
                                                        aria-selected="false"><?php echo e(__('Mollie')); ?></a>
                                                </li>
                                            <?php endif; ?>

                                            <?php if(isset($company_payment_setting['is_skrill_enabled']) && $company_payment_setting['is_skrill_enabled'] == 'on'): ?>
                                                <li class="nav-item mb-2">
                                                    <a class="btn btn-outline-primary btn-sm me-1 ml-1"
                                                        data-bs-toggle="tab" href="#skrill-payment" role="tab"
                                                        aria-controls="skrill"
                                                        aria-selected="false"><?php echo e(__('Skrill')); ?></a>
                                                </li>
                                            <?php endif; ?>

                                            <?php if(isset($company_payment_setting['is_coingate_enabled']) && $company_payment_setting['is_coingate_enabled'] == 'on'): ?>
                                                <li class="nav-item mb-2">
                                                    <a class="btn btn-outline-primary btn-sm me-1 ml-1"
                                                        data-bs-toggle="tab" href="#coingate-payment" role="tab"
                                                        aria-controls="coingate"
                                                        aria-selected="false"><?php echo e(__('Coingate')); ?></a>
                                                </li>
                                            <?php endif; ?>

                                            <?php if(
                                                $company_payment_setting['is_paymentwall_enabled'] == 'on' &&
                                                    !empty($company_payment_setting['paymentwall_public_key']) &&
                                                    !empty($company_payment_setting['paymentwall_private_key'])): ?>
                                                <li class="nav-item mb-2">
                                                    <a class="btn btn-outline-primary btn-sm me-1 ml-1"
                                                        data-bs-toggle="tab" href="#paymentwall-payment"
                                                        role="tab" aria-controls="paymentwall"
                                                        aria-selected="false"><?php echo e(__('PaymentWall')); ?></a>
                                                </li>
                                            <?php endif; ?>

                                            <?php if(isset($company_payment_setting['is_toyyibpay_enabled']) && $company_payment_setting['is_toyyibpay_enabled'] == 'on'): ?>
                                                <li class="nav-item mb-2">
                                                    <a class="btn btn-outline-primary btn-sm me-1 ml-1"
                                                        data-bs-toggle="tab" href="#toyyibpay-payment" role="tab"
                                                        aria-controls="toyyibpay"
                                                        aria-selected="false"><?php echo e(__('Toyyibpay')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if(isset($company_payment_setting['is_payfast_enabled']) && $company_payment_setting['is_payfast_enabled'] == 'on'): ?>
                                                <li class="nav-item mb-2">
                                                    <a class="btn btn-outline-primary btn-sm me-1 ml-1"
                                                        onclick=get_payfast_status() data-bs-toggle="tab"
                                                        href="#payfast-payment" role="tab"
                                                        aria-controls="payfast"
                                                        aria-selected="false"><?php echo e(__('PayFast')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if(isset($company_payment_setting['is_iyzipay_enabled']) && $company_payment_setting['is_iyzipay_enabled'] == 'on'): ?>
                                                <li class="nav-item mb-2">
                                                    <a class="btn btn-outline-primary btn-sm me-1 ml-1"
                                                        data-bs-toggle="tab" href="#iyzipay-payment" role="tab"
                                                        aria-controls="iyzipay"
                                                        aria-selected="false"><?php echo e(__('Iyzipay')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if(isset($company_payment_setting['is_sspay_enabled']) && $company_payment_setting['is_sspay_enabled'] == 'on'): ?>
                                                <li class="nav-item mb-2">
                                                    <a class="btn btn-outline-primary btn-sm me-1 ml-1"
                                                        data-bs-toggle="tab" href="#sspay-payment" role="tab"
                                                        aria-controls="sspay"
                                                        aria-selected="false"><?php echo e(__('SSPay')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if(isset($company_payment_setting['is_paytab_enabled']) && $company_payment_setting['is_paytab_enabled'] == 'on'): ?>
                                                <li class="nav-item mb-2">
                                                    <a class="btn btn-outline-primary btn-sm me-1 ml-1"
                                                        data-bs-toggle="tab" href="#paytab-payment" role="tab"
                                                        aria-controls="paytab"
                                                        aria-selected="false"><?php echo e(__('PayTab')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if(isset($company_payment_setting['is_benefit_enabled']) && $company_payment_setting['is_benefit_enabled'] == 'on'): ?>
                                                <li class="nav-item mb-2">
                                                    <a class="btn btn-outline-primary btn-sm me-1 ml-1"
                                                        data-bs-toggle="tab" href="#benefit-payment" role="tab"
                                                        aria-controls="benefit"
                                                        aria-selected="false"><?php echo e(__('Benefit')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if(isset($company_payment_setting['is_cashfree_enabled']) && $company_payment_setting['is_cashfree_enabled'] == 'on'): ?>
                                                <li class="nav-item mb-2">
                                                    <a class="btn btn-outline-primary btn-sm me-1 ml-1"
                                                        data-bs-toggle="tab" href="#cashfree-payment" role="tab"
                                                        aria-controls="cashfree"
                                                        aria-selected="false"><?php echo e(__('Cashfree')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if(isset($company_payment_setting['is_aamarpay_enabled']) && $company_payment_setting['is_aamarpay_enabled'] == 'on'): ?>
                                                <li class="nav-item mb-2">
                                                    <a class="btn btn-outline-primary btn-sm me-1 ml-1"
                                                        data-bs-toggle="tab" href="#aamarpay-payment" role="tab"
                                                        aria-controls="aamarpay"
                                                        aria-selected="false"><?php echo e(__('AamarPay')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if(isset($company_payment_setting['is_paytr_enabled']) && $company_payment_setting['is_paytr_enabled'] == 'on'): ?>
                                                <li class="nav-item mb-2">
                                                    <a class="btn btn-outline-primary btn-sm me-1 ml-1"
                                                        data-bs-toggle="tab" href="#paytr-payment" role="tab"
                                                        aria-controls="paytr"
                                                        aria-selected="false"><?php echo e(__('PayTR')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if(isset($company_payment_setting['is_yookassa_enabled']) && $company_payment_setting['is_yookassa_enabled'] == 'on'): ?>
                                                <li class="nav-item mb-2">
                                                    <a class="btn btn-outline-primary btn-sm me-1 ml-1"
                                                        data-bs-toggle="tab" href="#yookassa-payment" role="tab"
                                                        aria-controls="yookassa"
                                                        aria-selected="false"><?php echo e(__('Yookassa')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if(isset($company_payment_setting['is_midtrans_enabled']) && $company_payment_setting['is_midtrans_enabled'] == 'on'): ?>
                                                <li class="nav-item mb-2">
                                                    <a class="btn btn-outline-primary btn-sm me-1 ml-1"
                                                        data-bs-toggle="tab" href="#midtrans-payment" role="tab"
                                                        aria-controls="midtrans"
                                                        aria-selected="false"><?php echo e(__('Midtrans')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if(isset($company_payment_setting['is_xendit_enabled']) && $company_payment_setting['is_xendit_enabled'] == 'on'): ?>
                                                <li class="nav-item mb-2">
                                                    <a class="btn btn-outline-primary btn-sm me-1 ml-1"
                                                        data-bs-toggle="tab" href="#xendit-payment" role="tab"
                                                        aria-controls="xendit"
                                                        aria-selected="false"><?php echo e(__('Xendit')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if(isset($company_payment_setting['is_nepalste_enabled']) && $company_payment_setting['is_nepalste_enabled'] == 'on'): ?>
                                            <li class="nav-item mb-2">
                                                <a class="btn btn-outline-primary btn-sm me-1 ml-1"
                                                    data-bs-toggle="tab" href="#nepalste-payment" role="tab"
                                                    aria-controls="nepalste"
                                                    aria-selected="false"><?php echo e(__('Nepalste')); ?></a>
                                            </li>
                                        <?php endif; ?>
                                        </ul>
                                    <?php endif; ?>

                                    <div class="tab-content">
                                        <?php if(
                                            !empty($company_payment_setting) &&
                                                ($company_payment_setting['is_bank_transfer_enabled'] == 'on' &&
                                                    !empty($company_payment_setting['bank_details']))): ?>
                                            <div class="tab-pane fade active show" id="bank-transfer-payment"
                                                role="tabpanel" aria-labelledby="bank-transfer-payment">
                                                <form class="w3-container w3-display-middle w3-card-4 " method="POST"
                                                    enctype="multipart/form-data"
                                                    action="<?php echo e(route('customer.pay.with.bank')); ?>">

                                                    <?php echo csrf_field(); ?>
                                                    <input type="hidden" name="invoice_id"
                                                        value="<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($invoice->id)); ?>">

                                                    <div class="row">
                                                        <div class="col-6 ">
                                                            <div class="custom-radio">
                                                                <label
                                                                    class="font-16 font-bold"><?php echo e(__('Bank Details')); ?>

                                                                    :</label>
                                                            </div>
                                                            <p class="mb-0 pt-1 text-sm">
                                                                <?php echo $company_payment_setting['bank_details']; ?>

                                                            </p>
                                                        </div>
                                                        <div class="col-6">
                                                            <?php echo e(Form::label('payment_receipt', __('Payment Receipt'), ['class' => 'form-label'])); ?>

                                                            <div class="choose-file form-group">
                                                                <input type="file" name="payment_receipt"
                                                                    id="image" class="form-control">
                                                                <p class="upload_file"></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2">
                                                        <div class="form-group col-md-12">
                                                            <label for="amount"><?php echo e(__('Amount')); ?></label>
                                                            <div class="input-group">
                                                                <span class="input-group-prepend"><span
                                                                        class="input-group-text"><?php echo e($company_setting['site_currency']); ?></span></span>
                                                                <input class="form-control" required="required"
                                                                    min="0" name="amount" type="number"
                                                                    value="<?php echo e($invoice->getDue()); ?>" min="0"
                                                                    step="0.01" max="<?php echo e($invoice->getDue()); ?>"
                                                                    id="amount">
                                                                <?php $__errorArgs = ['amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                    <span class="invalid-amount" role="alert">
                                                                        <strong><?php echo e($message); ?></strong>
                                                                    </span>
                                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group mt-3">
                                                        <button class="btn btn-primary"
                                                            type="submit"><?php echo e(__('Make Payment')); ?></button>
                                                    </div>
                                                </form>
                                            </div>
                                        <?php endif; ?>

                                        <?php if(
                                            !empty($company_payment_setting) &&
                                                ($company_payment_setting['is_stripe_enabled'] == 'on' &&
                                                    !empty($company_payment_setting['stripe_key']) &&
                                                    !empty($company_payment_setting['stripe_secret']))): ?>
                                            <div class="tab-pane fade" id="stripe-payment" role="tabpanel"
                                                aria-labelledby="stripe-payment">
                                                <form method="post"
                                                    action="<?php echo e(route('customer.payment', $invoice->id)); ?>"
                                                    class="require-validation" id="payment-form">
                                                    <?php echo csrf_field(); ?>
                                                    <div class="row">
                                                        <div class="col-sm-8">
                                                            <div class="custom-radio">
                                                                <label
                                                                    class="font-16 font-weight-bold"><?php echo e(__('Credit / Debit Card')); ?></label>
                                                            </div>
                                                            <p class="mb-0 pt-1 text-sm">
                                                                <?php echo e(__('Safe money transfer using your bank account. We support Mastercard, Visa, Discover and American express.')); ?>

                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label
                                                                    for="card-name-on"><?php echo e(__('Name on card')); ?></label>
                                                                <input type="text" name="name"
                                                                    id="card-name-on" class="form-control required">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div id="card-element">
                                                                <div id="card-errors" role="alert"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-12">
                                                            <br>
                                                            <label for="amount"><?php echo e(__('Amount')); ?></label>
                                                            <div class="input-group">
                                                                <span class="input-group-prepend"><span
                                                                        class="input-group-text"><?php echo e($company_setting['site_currency']); ?></span></span>
                                                                <input class="form-control" required="required"
                                                                    min="0" name="amount" type="number"
                                                                    value="<?php echo e($invoice->getDue()); ?>" min="0"
                                                                    step="0.01" max="<?php echo e($invoice->getDue()); ?>"
                                                                    id="amount">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="error" style="display: none;">
                                                                <div class='alert-danger alert'>
                                                                    <?php echo e(__('Please correct the errors and try again.')); ?>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group mt-3">
                                                        <button class="btn btn-primary"
                                                            type="submit"><?php echo e(__('Make Payment')); ?></button>
                                                    </div>
                                                </form>
                                            </div>
                                        <?php endif; ?>

                                        <?php if(
                                            !empty($company_payment_setting) &&
                                                ($company_payment_setting['is_paypal_enabled'] == 'on' &&
                                                    !empty($company_payment_setting['paypal_client_id']) &&
                                                    !empty($company_payment_setting['paypal_secret_key']))): ?>
                                            <div class="tab-pane fade" id="paypal-payment" role="tabpanel"
                                                aria-labelledby="paypal-payment">
                                                <form class="w3-container w3-display-middle w3-card-4 " method="POST"
                                                    id="payment-form"
                                                    action="<?php echo e(route('customer.pay.with.paypal', $invoice->id)); ?>">
                                                    <?php echo csrf_field(); ?>
                                                    <div class="row">
                                                        <div class="form-group col-md-12">
                                                            <label for="amount"><?php echo e(__('Amount')); ?></label>
                                                            <div class="input-group">
                                                                <span class="input-group-prepend"><span
                                                                        class="input-group-text"><?php echo e($company_setting['site_currency']); ?></span></span>
                                                                <input class="form-control" required="required"
                                                                    min="0" name="amount" type="number"
                                                                    value="<?php echo e($invoice->getDue()); ?>" min="0"
                                                                    step="0.01" max="<?php echo e($invoice->getDue()); ?>"
                                                                    id="amount">
                                                                <?php $__errorArgs = ['amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                    <span class="invalid-amount" role="alert">
                                                                        <strong><?php echo e($message); ?></strong>
                                                                    </span>
                                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group mt-3">
                                                        <button class="btn btn-primary" name="submit"
                                                            type="submit"><?php echo e(__('Make Payment')); ?></button>
                                                    </div>
                                                </form>
                                            </div>
                                        <?php endif; ?>

                                        <?php if(isset($company_payment_setting['is_paystack_enabled']) &&
                                                $company_payment_setting['is_paystack_enabled'] == 'on' &&
                                                !empty($company_payment_setting['paystack_public_key']) &&
                                                !empty($company_payment_setting['paystack_secret_key'])): ?>
                                            <div class="tab-pane fade " id="paystack-payment" role="tabpanel"
                                                aria-labelledby="paypal-payment">
                                                <form class="w3-container w3-display-middle w3-card-4" method="POST"
                                                    id="paystack-payment-form"
                                                    action="<?php echo e(route('customer.pay.with.paystack')); ?>">
                                                    <?php echo csrf_field(); ?>
                                                    <input type="hidden" name="invoice_id"
                                                        value="<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($invoice->id)); ?>">
                                                    <div class="form-group col-md-12">
                                                        <label for="amount"><?php echo e(__('Amount')); ?></label>
                                                        <div class="input-group">
                                                            <span class="input-group-prepend"><span
                                                                    class="input-group-text"><?php echo e($company_setting['site_currency']); ?></span></span>
                                                            <input class="form-control" required="required"
                                                                min="0" name="amount" type="number"
                                                                value="<?php echo e($invoice->getDue()); ?>" min="0"
                                                                step="0.01" max="<?php echo e($invoice->getDue()); ?>"
                                                                id="amount">
                                                        </div>
                                                    </div>
                                                    <div class="form-group mt-3">
                                                        <button class="btn btn-primary" name="submit"
                                                            id="pay_with_paystack"
                                                            type="button"><?php echo e(__('Make Payment')); ?></button>
                                                    </div>
                                                </form>
                                            </div>
                                        <?php endif; ?>

                                        <?php if(isset($company_payment_setting['is_flutterwave_enabled']) &&
                                                $company_payment_setting['is_flutterwave_enabled'] == 'on' &&
                                                !empty($company_payment_setting['paystack_public_key']) &&
                                                !empty($company_payment_setting['paystack_secret_key'])): ?>
                                            <div class="tab-pane fade " id="flutterwave-payment" role="tabpanel"
                                                aria-labelledby="paypal-payment">
                                                <form role="form"
                                                    action="<?php echo e(route('customer.pay.with.flaterwave')); ?>"
                                                    method="post" class="require-validation"
                                                    id="flaterwave-payment-form">
                                                    <?php echo csrf_field(); ?>
                                                    <input type="hidden" name="invoice_id"
                                                        value="<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($invoice->id)); ?>">
                                                    <div class="form-group col-md-12">
                                                        <label for="amount"><?php echo e(__('Amount')); ?></label>
                                                        <div class="input-group">
                                                            <span class="input-group-prepend"><span
                                                                    class="input-group-text"><?php echo e($company_setting['site_currency']); ?></span></span>
                                                            <input class="form-control" required="required"
                                                                min="0" name="amount" type="number"
                                                                value="<?php echo e($invoice->getDue()); ?>" min="0"
                                                                step="0.01" max="<?php echo e($invoice->getDue()); ?>"
                                                                id="amount">
                                                        </div>
                                                    </div>
                                                    <div class="form-group mt-3">
                                                        <button class="btn btn-primary" name="submit"
                                                            id="pay_with_flaterwave"
                                                            type="button"><?php echo e(__('Make Payment')); ?></button>
                                                    </div>
                                                </form>
                                            </div>
                                        <?php endif; ?>

                                        <?php if(isset($company_payment_setting['is_razorpay_enabled']) && $company_payment_setting['is_razorpay_enabled'] == 'on'): ?>
                                            <div class="tab-pane fade " id="razorpay-payment" role="tabpanel"
                                                aria-labelledby="paypal-payment">
                                                <form role="form"
                                                    action="<?php echo e(route('customer.pay.with.razorpay')); ?>"
                                                    method="post" class="require-validation"
                                                    id="razorpay-payment-form">
                                                    <?php echo csrf_field(); ?>
                                                    <input type="hidden" name="invoice_id"
                                                        value="<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($invoice->id)); ?>">
                                                    <div class="form-group col-md-12">
                                                        <label for="amount"><?php echo e(__('Amount')); ?></label>
                                                        <div class="input-group">
                                                            <span class="input-group-prepend"><span
                                                                    class="input-group-text"><?php echo e($company_setting['site_currency']); ?></span></span>
                                                            <input class="form-control" required="required"
                                                                min="0" name="amount" type="number"
                                                                value="<?php echo e($invoice->getDue()); ?>" min="0"
                                                                step="0.01" max="<?php echo e($invoice->getDue()); ?>"
                                                                id="amount">
                                                        </div>
                                                    </div>
                                                    <div class="form-group mt-3">
                                                        <button class="btn btn-primary" name="submit"
                                                            id="pay_with_razorpay"
                                                            type="button"><?php echo e(__('Make Payment')); ?></button>
                                                    </div>
                                                </form>
                                            </div>
                                        <?php endif; ?>

                                        <?php if(isset($company_payment_setting['is_mercado_enabled']) && $company_payment_setting['is_mercado_enabled'] == 'on'): ?>
                                            <div class="tab-pane fade " id="mercado-payment" role="tabpanel"
                                                aria-labelledby="mercado-payment">
                                                <form role="form"
                                                    action="<?php echo e(route('customer.pay.with.mercado')); ?>" method="post"
                                                    class="require-validation" id="mercado-payment-form">
                                                    <?php echo csrf_field(); ?>
                                                    <input type="hidden" name="invoice_id"
                                                        value="<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($invoice->id)); ?>">
                                                    <div class="form-group col-md-12">
                                                        <label for="amount"><?php echo e(__('Amount')); ?></label>
                                                        <div class="input-group">
                                                            <span class="input-group-prepend"><span
                                                                    class="input-group-text"><?php echo e($company_setting['site_currency']); ?></span></span>
                                                            <input class="form-control" required="required"
                                                                min="0" name="amount" type="number"
                                                                value="<?php echo e($invoice->getDue()); ?>" min="0"
                                                                step="0.01" max="<?php echo e($invoice->getDue()); ?>"
                                                                id="amount">
                                                        </div>
                                                    </div>
                                                    <div class="form-group mt-3">
                                                        <button class="btn btn-primary" name="submit"
                                                            id="pay_with_mercado"
                                                            type="submit"><?php echo e(__('Make Payment')); ?></button>
                                                    </div>
                                                </form>
                                            </div>
                                        <?php endif; ?>

                                        <?php if(isset($company_payment_setting['is_paytm_enabled']) && $company_payment_setting['is_paytm_enabled'] == 'on'): ?>
                                            <div class="tab-pane fade" id="paytm-payment" role="tabpanel"
                                                aria-labelledby="paytm-payment">
                                                <form role="form" action="<?php echo e(route('customer.pay.with.paytm')); ?>"
                                                    method="post" class="require-validation"
                                                    id="paytm-payment-form">
                                                    <?php echo csrf_field(); ?>
                                                    <input type="hidden" name="invoice_id"
                                                        value="<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($invoice->id)); ?>">
                                                    <div class="form-group col-md-12">
                                                        <label for="amount"><?php echo e(__('Amount')); ?></label>
                                                        <div class="input-group">
                                                            <span class="input-group-prepend"><span
                                                                    class="input-group-text"><?php echo e($company_setting['site_currency']); ?></span></span>
                                                            <input class="form-control" required="required"
                                                                min="0" name="amount" type="number"
                                                                value="<?php echo e($invoice->getDue()); ?>" min="0"
                                                                step="0.01" max="<?php echo e($invoice->getDue()); ?>"
                                                                id="amount">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="flaterwave_coupon"
                                                                class=" text-dark"><?php echo e(__('Mobile Number')); ?></label>
                                                            <input type="text" id="mobile" name="mobile"
                                                                class="form-control mobile" data-from="mobile"
                                                                placeholder="<?php echo e(__('Enter Mobile Number')); ?>"
                                                                required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group mt-3">
                                                        <button class="btn btn-primary" name="submit"
                                                            id="pay_with_paytm"
                                                            type="submit"><?php echo e(__('Make Payment')); ?></button>
                                                    </div>
                                                </form>
                                            </div>
                                        <?php endif; ?>

                                        <?php if(isset($company_payment_setting['is_mollie_enabled']) && $company_payment_setting['is_mollie_enabled'] == 'on'): ?>
                                            <div class="tab-pane fade " id="mollie-payment" role="tabpanel"
                                                aria-labelledby="mollie-payment">
                                                <form role="form"
                                                    action="<?php echo e(route('customer.pay.with.mollie')); ?>" method="post"
                                                    class="require-validation" id="mollie-payment-form">
                                                    <?php echo csrf_field(); ?>
                                                    <input type="hidden" name="invoice_id"
                                                        value="<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($invoice->id)); ?>">
                                                    <div class="form-group col-md-12">
                                                        <label for="amount"><?php echo e(__('Amount')); ?></label>
                                                        <div class="input-group">
                                                            <span class="input-group-prepend"><span
                                                                    class="input-group-text"><?php echo e($company_setting['site_currency']); ?></span></span>
                                                            <input class="form-control" required="required"
                                                                min="0" name="amount" type="number"
                                                                value="<?php echo e($invoice->getDue()); ?>" min="0"
                                                                step="0.01" max="<?php echo e($invoice->getDue()); ?>"
                                                                id="amount">
                                                        </div>
                                                    </div>
                                                    <div class="form-group mt-3">
                                                        <button class="btn btn-primary" name="submit"
                                                            id="pay_with_mollie"
                                                            type="submit"><?php echo e(__('Make Payment')); ?></button>
                                                    </div>
                                                </form>
                                            </div>
                                        <?php endif; ?>

                                        <?php if(isset($company_payment_setting['is_skrill_enabled']) && $company_payment_setting['is_skrill_enabled'] == 'on'): ?>
                                            <div class="tab-pane fade " id="skrill-payment" role="tabpanel"
                                                aria-labelledby="skrill-payment">
                                                <form role="form"
                                                    action="<?php echo e(route('customer.pay.with.skrill')); ?>" method="post"
                                                    class="require-validation" id="skrill-payment-form">
                                                    <?php echo csrf_field(); ?>
                                                    <input type="hidden" name="invoice_id"
                                                        value="<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($invoice->id)); ?>">
                                                    <div class="form-group col-md-12">
                                                        <label for="amount"><?php echo e(__('Amount')); ?></label>
                                                        <div class="input-group">
                                                            <span class="input-group-prepend"><span
                                                                    class="input-group-text"><?php echo e($company_setting['site_currency']); ?></span></span>
                                                            <input class="form-control" required="required"
                                                                min="0" name="amount" type="number"
                                                                value="<?php echo e($invoice->getDue()); ?>" min="0"
                                                                step="0.01" max="<?php echo e($invoice->getDue()); ?>"
                                                                id="amount">
                                                        </div>
                                                    </div>
                                                    <?php
                                                        $skrill_data = [
                                                            'transaction_id' => md5(date('Y-m-d') . strtotime('Y-m-d H:i:s') . 'user_id'),
                                                            'user_id' => 'user_id',
                                                            'amount' => 'amount',
                                                            'currency' => 'currency',
                                                        ];
                                                        session()->put('skrill_data', $skrill_data);
                                                    ?>
                                                    <div class="form-group mt-3">
                                                        <button class="btn btn-primary" name="submit"
                                                            id="pay_with_skrill"
                                                            type="submit"><?php echo e(__('Make Payment')); ?></button>
                                                    </div>
                                                </form>
                                            </div>
                                        <?php endif; ?>

                                        <?php if(isset($company_payment_setting['is_coingate_enabled']) && $company_payment_setting['is_coingate_enabled'] == 'on'): ?>
                                            <div class="tab-pane fade " id="coingate-payment" role="tabpanel"
                                                aria-labelledby="coingate-payment">
                                                <form role="form"
                                                    action="<?php echo e(route('customer.pay.with.coingate')); ?>"
                                                    method="post" class="require-validation"
                                                    id="coingate-payment-form">
                                                    <?php echo csrf_field(); ?>
                                                    <input type="hidden" name="invoice_id"
                                                        value="<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($invoice->id)); ?>">
                                                    <div class="form-group col-md-12">
                                                        <label for="amount"><?php echo e(__('Amount')); ?></label>
                                                        <div class="input-group">
                                                            <span class="input-group-prepend"><span
                                                                    class="input-group-text"><?php echo e($company_setting['site_currency']); ?></span></span>
                                                            <input class="form-control" required="required"
                                                                min="0" name="amount" type="number"
                                                                value="<?php echo e($invoice->getDue()); ?>" min="0"
                                                                step="0.01" max="<?php echo e($invoice->getDue()); ?>"
                                                                id="amount">
                                                        </div>
                                                    </div>
                                                    <div class="form-group mt-3">
                                                        <button class="btn btn-primary" name="submit"
                                                            id="pay_with_coingate"
                                                            type="submit"><?php echo e(__('Make Payment')); ?></button>
                                                    </div>
                                                </form>
                                            </div>
                                        <?php endif; ?>

                                        <?php if(
                                            !empty($company_payment_setting) &&
                                                isset($company_payment_setting['is_paymentwall_enabled']) &&
                                                $company_payment_setting['is_paymentwall_enabled'] == 'on' &&
                                                !empty($company_payment_setting['paymentwall_public_key']) &&
                                                !empty($company_payment_setting['paymentwall_private_key'])): ?>
                                            <div class="tab-pane fade " id="paymentwall-payment" role="tabpanel"
                                                aria-labelledby="paypal-payment">
                                                <form class="w3-container w3-display-middle w3-card-4" method="POST"
                                                    id="paymentwall-payment-form"
                                                    action="<?php echo e(route('invoice.paymentwallpayment')); ?>">
                                                    <?php echo csrf_field(); ?>
                                                    <input type="hidden" name="invoice_id"
                                                        value="<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($invoice->id)); ?>">

                                                    <div class="form-group col-md-12">
                                                        <label for="amount"><?php echo e(__('Amount')); ?></label>
                                                        <div class="input-group">
                                                            <span class="input-group-prepend">

                                                                <span
                                                                    class="input-group-text"><?php echo e($company_setting['site_currency']); ?></span>
                                                            </span>
                                                            <input class="form-control" required="required"
                                                                min="0" name="amount" type="number"
                                                                value="<?php echo e($invoice->getDue()); ?>" min="0"
                                                                step="0.01" max="<?php echo e($invoice->getDue()); ?>"
                                                                id="amount">
                                                        </div>
                                                    </div>

                                                    <div class="form-group mt-3">
                                                        <button class="btn btn-primary" name="submit"
                                                            id="pay_with_coingate"
                                                            type="submit"><?php echo e(__('Make Payment')); ?></button>
                                                    </div>
                                                </form>
                                            </div>
                                        <?php endif; ?>

                                        <?php if(isset($company_payment_setting['is_toyyibpay_enabled']) && $company_payment_setting['is_toyyibpay_enabled'] == 'on'): ?>
                                            <div class="tab-pane fade" id="toyyibpay-payment" role="tabpanel"
                                                aria-labelledby="toyyibpay-payment">
                                                <form role="form"
                                                    action="<?php echo e(route('customer.pay.with.toyyibpay')); ?>"
                                                    method="post" class="require-validation"
                                                    id="toyyibpay-payment-form">
                                                    <?php echo csrf_field(); ?>
                                                    <input type="hidden" name="invoice_id"
                                                        value="<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($invoice->id)); ?>">
                                                    <div class="form-group col-md-12">
                                                        <label for="amount"><?php echo e(__('Amount')); ?></label>
                                                        <div class="input-group">
                                                            <span class="input-group-prepend"><span
                                                                    class="input-group-text"><?php echo e($company_setting['site_currency']); ?></span></span>
                                                            <input class="form-control" required="required"
                                                                min="0" name="amount" type="number"
                                                                value="<?php echo e($invoice->getDue()); ?>" min="0"
                                                                step="0.01" max="<?php echo e($invoice->getDue()); ?>"
                                                                id="amount">
                                                        </div>
                                                    </div>
                                                    <div class="form-group mt-3">
                                                        <button class="btn btn-primary" name="submit"
                                                            id="pay_with_toyyibpay"
                                                            type="submit"><?php echo e(__('Make Payment')); ?></button>
                                                    </div>
                                                </form>
                                            </div>
                                        <?php endif; ?>


                                        <?php if(
                                            !empty($company_payment_setting) &&
                                                isset($company_payment_setting['is_payfast_enabled']) &&
                                                $company_payment_setting['is_payfast_enabled'] == 'on' &&
                                                !empty($company_payment_setting['is_payfast_enabled']) &&
                                                !empty($company_payment_setting['is_payfast_enabled'])): ?>
                                            <div class="tab-pane fade " id="payfast-payment" role="tabpanel"
                                                aria-labelledby="payfast-payment">
                                                <?php
                                                    $pfHost = $company_payment_setting['payfast_mode'] == 'sandbox' ? 'sandbox.payfast.co.za' : 'www.payfast.co.za';
                                                ?>
                                                <form role="form"
                                                    action=<?php echo e('https://' . $pfHost . '/eng/process'); ?> method="post"
                                                    id="payfast-payment-form">
                                                    <?php echo csrf_field(); ?>
                                                    <div class="form-group col-md-12">
                                                        <label for="amount"><?php echo e(__('Amount')); ?></label>
                                                        <div class="input-group">
                                                            <span class="input-group-prepend"><span
                                                                    class="input-group-text"><?php echo e($company_setting['site_currency']); ?></span></span>
                                                            <input class="form-control" required="required"
                                                                min="0" name="amount" type="number"
                                                                value="<?php echo e($invoice->getDue()); ?>" min="0"
                                                                step="0.01" max="<?php echo e($invoice->getDue()); ?>"
                                                                id="pay_fast_amount" onchange=get_payfast_status()>
                                                        </div>
                                                    </div>
                                                    <div id="get-payfast-inputs"></div>
                                                    <div class="form-group mt-3">
                                                        <input type="hidden" name="invoice_id" id="invoice_id"
                                                            value="<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($invoice->id)); ?>">
                                                        <button class="btn btn-primary" name="submit"
                                                            id="pay_with_payfast"
                                                            type="submit"><?php echo e(__('Make Payment')); ?></button>
                                                    </div>
                                                </form>
                                            </div>
                                        <?php endif; ?>

                                        <?php if(isset($company_payment_setting['is_iyzipay_enabled']) && $company_payment_setting['is_iyzipay_enabled'] == 'on'): ?>
                                            <div class="tab-pane fade" id="iyzipay-payment" role="tabpanel"
                                                aria-labelledby="iyzipay-payment">
                                                <form role="form"
                                                    action="<?php echo e(route('customer.pay.with.iyzipay')); ?>" method="post"
                                                    class="require-validation" id="iyzipay-payment-form">
                                                    <?php echo csrf_field(); ?>
                                                    <input type="hidden" name="invoice_id"
                                                        value="<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($invoice->id)); ?>">
                                                    <div class="form-group col-md-12">
                                                        <label for="amount"><?php echo e(__('Amount')); ?></label>
                                                        <div class="input-group">
                                                            <span class="input-group-prepend"><span
                                                                    class="input-group-text"><?php echo e($company_setting['site_currency']); ?></span></span>
                                                            <input class="form-control" required="required"
                                                                min="0" name="amount" type="number"
                                                                value="<?php echo e($invoice->getDue()); ?>" min="0"
                                                                step="0.01" max="<?php echo e($invoice->getDue()); ?>"
                                                                id="amount">
                                                        </div>
                                                    </div>
                                                    <div class="form-group mt-3">
                                                        <button class="btn btn-primary" name="submit"
                                                            id="pay_with_toyyibpay"
                                                            type="submit"><?php echo e(__('Make Payment')); ?></button>
                                                    </div>
                                                </form>
                                            </div>
                                        <?php endif; ?>

                                        <?php if(isset($company_payment_setting['is_sspay_enabled']) && $company_payment_setting['is_sspay_enabled'] == 'on'): ?>
                                            <div class="tab-pane fade" id="sspay-payment" role="tabpanel"
                                                aria-labelledby="sspay-payment">
                                                <form role="form" action="<?php echo e(route('customer.pay.with.sspay')); ?>"
                                                    method="post" class="require-validation"
                                                    id="sspay-payment-form">
                                                    <?php echo csrf_field(); ?>
                                                    <input type="hidden" name="invoice_id"
                                                        value="<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($invoice->id)); ?>">
                                                    <div class="form-group col-md-12">
                                                        <label for="amount"><?php echo e(__('Amount')); ?></label>
                                                        <div class="input-group">
                                                            <span class="input-group-prepend"><span
                                                                    class="input-group-text"><?php echo e($company_setting['site_currency']); ?></span></span>
                                                            <input class="form-control" required="required"
                                                                min="0" name="amount" type="number"
                                                                value="<?php echo e($invoice->getDue()); ?>" min="0"
                                                                step="0.01" max="<?php echo e($invoice->getDue()); ?>"
                                                                id="amount">
                                                        </div>
                                                    </div>
                                                    <div class="form-group mt-3">
                                                        <button class="btn btn-primary" name="submit"
                                                            id="pay_with_sspay"
                                                            type="submit"><?php echo e(__('Make Payment')); ?></button>
                                                    </div>
                                                </form>
                                            </div>
                                        <?php endif; ?>

                                        <?php if(isset($company_payment_setting['is_paytab_enabled']) && $company_payment_setting['is_paytab_enabled'] == 'on'): ?>
                                            <div class="tab-pane fade" id="paytab-payment" role="tabpanel"
                                                aria-labelledby="paytab-payment">
                                                <form role="form"
                                                    action="<?php echo e(route('customer.pay.with.paytab')); ?>" method="post"
                                                    class="require-validation" id="paytab-payment-form">
                                                    <?php echo csrf_field(); ?>
                                                    <input type="hidden" name="invoice_id"
                                                        value="<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($invoice->id)); ?>">
                                                    <div class="form-group col-md-12">
                                                        <label for="amount"><?php echo e(__('Amount')); ?></label>
                                                        <div class="input-group">
                                                            <span class="input-group-prepend"><span
                                                                    class="input-group-text"><?php echo e($company_setting['site_currency']); ?></span></span>
                                                            <input class="form-control" required="required"
                                                                min="0" name="amount" type="number"
                                                                value="<?php echo e($invoice->getDue()); ?>" min="0"
                                                                step="0.01" max="<?php echo e($invoice->getDue()); ?>"
                                                                id="amount">
                                                        </div>
                                                    </div>
                                                    <div class="form-group mt-3">
                                                        <button class="btn btn-primary" name="submit"
                                                            id="pay_with_paytab"
                                                            type="submit"><?php echo e(__('Make Payment')); ?></button>
                                                    </div>
                                                </form>
                                            </div>
                                        <?php endif; ?>

                                        <?php if(isset($company_payment_setting['is_benefit_enabled']) && $company_payment_setting['is_benefit_enabled'] == 'on'): ?>
                                            <div class="tab-pane fade" id="benefit-payment" role="tabpanel"
                                                aria-labelledby="benefit-payment">
                                                <form role="form"
                                                    action="<?php echo e(route('invoice.benefit.initiate')); ?>" method="post"
                                                    class="require-validation" id="benefit-payment-form">
                                                    <?php echo csrf_field(); ?>
                                                    <input type="hidden" name="invoice_id"
                                                        value="<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($invoice->id)); ?>">
                                                    <div class="form-group col-md-12">
                                                        <label for="amount"><?php echo e(__('Amount')); ?></label>
                                                        <div class="input-group">
                                                            <span class="input-group-prepend"><span
                                                                    class="input-group-text"><?php echo e($company_setting['site_currency']); ?></span></span>
                                                            <input class="form-control" required="required"
                                                                min="0" name="amount" type="number"
                                                                value="<?php echo e($invoice->getDue()); ?>" min="0"
                                                                step="0.01" max="<?php echo e($invoice->getDue()); ?>"
                                                                id="amount">
                                                        </div>
                                                    </div>
                                                    <div class="form-group mt-3">
                                                        <button class="btn btn-primary" name="submit"
                                                            id="pay_with_benefit"
                                                            type="submit"><?php echo e(__('Make Payment')); ?></button>
                                                    </div>
                                                </form>
                                            </div>
                                        <?php endif; ?>

                                        <?php if(isset($company_payment_setting['is_cashfree_enabled']) && $company_payment_setting['is_cashfree_enabled'] == 'on'): ?>
                                            <div class="tab-pane fade" id="cashfree-payment" role="tabpanel"
                                                aria-labelledby="cashfree-payment">
                                                <form role="form"
                                                    action="<?php echo e(route('customer.pay.with.cashfree')); ?>"
                                                    method="post" class="require-validation"
                                                    id="cashfree-payment-form">
                                                    <?php echo csrf_field(); ?>
                                                    <input type="hidden" name="invoice_id"
                                                        value="<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($invoice->id)); ?>">
                                                    <div class="form-group col-md-12">
                                                        <label for="amount"><?php echo e(__('Amount')); ?></label>
                                                        <div class="input-group">
                                                            <span class="input-group-prepend"><span
                                                                    class="input-group-text"><?php echo e($company_setting['site_currency']); ?></span></span>
                                                            <input class="form-control" required="required"
                                                                min="0" name="amount" type="number"
                                                                value="<?php echo e($invoice->getDue()); ?>" min="0"
                                                                step="0.01" max="<?php echo e($invoice->getDue()); ?>"
                                                                id="amount">
                                                        </div>
                                                    </div>
                                                    <div class="form-group mt-3">
                                                        <button class="btn btn-primary" name="submit"
                                                            id="pay_with_cashfree"
                                                            type="submit"><?php echo e(__('Make Payment')); ?></button>
                                                    </div>
                                                </form>
                                            </div>
                                        <?php endif; ?>
                                        <?php if(isset($company_payment_setting['is_aamarpay_enabled']) && $company_payment_setting['is_aamarpay_enabled'] == 'on'): ?>
                                            <div class="tab-pane fade" id="aamarpay-payment" role="tabpanel"
                                                aria-labelledby="aamarpay-payment">
                                                <form role="form"
                                                    action="<?php echo e(route('customer.pay.with.aamarpay')); ?>"
                                                    method="post" class="require-validation"
                                                    id="aamarpay-payment-form">
                                                    <?php echo csrf_field(); ?>
                                                    <input type="hidden" name="invoice_id"
                                                        value="<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($invoice->id)); ?>">
                                                    <div class="form-group col-md-12">
                                                        <label for="amount"><?php echo e(__('Amount')); ?></label>
                                                        <div class="input-group">
                                                            <span class="input-group-prepend"><span
                                                                    class="input-group-text"><?php echo e($company_setting['site_currency']); ?></span></span>
                                                            <input class="form-control" required="required"
                                                                min="0" name="amount" type="number"
                                                                value="<?php echo e($invoice->getDue()); ?>" min="0"
                                                                step="0.01" max="<?php echo e($invoice->getDue()); ?>"
                                                                id="amount">
                                                        </div>
                                                    </div>
                                                    <div class="form-group mt-3">
                                                        <button class="btn btn-primary" name="submit"
                                                            id="pay_with_aamarpay"
                                                            type="submit"><?php echo e(__('Make Payment')); ?></button>
                                                    </div>
                                                </form>
                                            </div>
                                        <?php endif; ?>
                                        <?php if(isset($company_payment_setting['is_paytr_enabled']) && $company_payment_setting['is_paytr_enabled'] == 'on'): ?>
                                            <div class="tab-pane fade" id="paytr-payment" role="tabpanel"
                                                aria-labelledby="paytr-payment">
                                                <form role="form"
                                                    action="<?php echo e(route('customer.pay.with.paytr')); ?>" method="post"
                                                    class="require-validation" id="paytr-payment-form">
                                                    <?php echo csrf_field(); ?>
                                                    <input type="hidden" name="invoice_id"
                                                        value="<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($invoice->id)); ?>">
                                                    <div class="form-group col-md-12">
                                                        <label for="amount"><?php echo e(__('Amount')); ?></label>
                                                        <div class="input-group">
                                                            <span class="input-group-prepend"><span
                                                                    class="input-group-text"><?php echo e($company_setting['site_currency']); ?></span></span>
                                                            <input class="form-control" required="required"
                                                                min="0" name="amount" type="number"
                                                                value="<?php echo e($invoice->getDue()); ?>" min="0"
                                                                step="0.01" max="<?php echo e($invoice->getDue()); ?>"
                                                                id="amount">
                                                        </div>
                                                    </div>
                                                    <div class="form-group mt-3">
                                                        <button class="btn btn-primary" name="submit"
                                                            id="pay_with_paytr"
                                                            type="submit"><?php echo e(__('Make Payment')); ?></button>
                                                    </div>
                                                </form>
                                            </div>
                                        <?php endif; ?>
                                        <?php if(isset($company_payment_setting['is_yookassa_enabled']) && $company_payment_setting['is_yookassa_enabled'] == 'on'): ?>
                                            <div class="tab-pane fade" id="yookassa-payment" role="tabpanel"
                                                aria-labelledby="yookassa-payment">
                                                <form role="form"
                                                    action="<?php echo e(route('customer.with.yookassa')); ?>" method="post"
                                                    class="require-validation" id="yookassa-payment-form">
                                                    <?php echo csrf_field(); ?>
                                                    <input type="hidden" name="invoice_id"
                                                        value="<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($invoice->id)); ?>">
                                                    <div class="form-group col-md-12">
                                                        <label for="amount"><?php echo e(__('Amount')); ?></label>
                                                        <div class="input-group">
                                                            <span class="input-group-prepend"><span
                                                                    class="input-group-text"><?php echo e($company_setting['site_currency']); ?></span></span>
                                                            <input class="form-control" required="required"
                                                                min="0" name="amount" type="number"
                                                                value="<?php echo e($invoice->getDue()); ?>" min="0"
                                                                step="0.01" max="<?php echo e($invoice->getDue()); ?>"
                                                                id="amount">
                                                        </div>
                                                    </div>
                                                    <div class="form-group mt-3">
                                                        <button class="btn btn-primary" name="submit"
                                                            id="pay_with_yookassa"
                                                            type="submit"><?php echo e(__('Make Payment')); ?></button>
                                                    </div>
                                                </form>
                                            </div>
                                        <?php endif; ?>
                                        <?php if(isset($company_payment_setting['is_midtrans_enabled']) && $company_payment_setting['is_midtrans_enabled'] == 'on'): ?>
                                            <div class="tab-pane fade" id="midtrans-payment" role="tabpanel"
                                                aria-labelledby="midtrans-payment">
                                                <form role="form"
                                                    action="<?php echo e(route('customer.with.midtrans')); ?>" method="post"
                                                    class="require-validation" id="midtrans-payment-form">
                                                    <?php echo csrf_field(); ?>
                                                    <input type="hidden" name="invoice_id"
                                                        value="<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($invoice->id)); ?>">
                                                    <div class="form-group col-md-12">
                                                        <label for="amount"><?php echo e(__('Amount')); ?></label>
                                                        <div class="input-group">
                                                            <span class="input-group-prepend"><span
                                                                    class="input-group-text"><?php echo e($company_setting['site_currency']); ?></span></span>
                                                            <input class="form-control" required="required"
                                                                min="0" name="amount" type="number"
                                                                value="<?php echo e($invoice->getDue()); ?>" min="0"
                                                                step="0.01" max="<?php echo e($invoice->getDue()); ?>"
                                                                id="amount">
                                                        </div>
                                                    </div>
                                                    <div class="form-group mt-3">
                                                        <button class="btn btn-primary" name="submit"
                                                            id="pay_with_midtrans"
                                                            type="submit"><?php echo e(__('Make Payment')); ?></button>
                                                    </div>
                                                </form>
                                            </div>
                                        <?php endif; ?>

                                        <?php if(isset($company_payment_setting['is_xendit_enabled']) && $company_payment_setting['is_xendit_enabled'] == 'on'): ?>
                                            <div class="tab-pane fade" id="xendit-payment" role="tabpanel"
                                                aria-labelledby="xendit-payment">
                                                <form role="form" action="<?php echo e(route('customer.with.xendit')); ?>"
                                                    method="post" class="require-validation"
                                                    id="xendit-payment-form">
                                                    <?php echo csrf_field(); ?>
                                                    <input type="hidden" name="invoice_id"
                                                        value="<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($invoice->id)); ?>">
                                                    <div class="form-group col-md-12">
                                                        <label for="amount"><?php echo e(__('Amount')); ?></label>
                                                        <div class="input-group">
                                                            <span class="input-group-prepend"><span
                                                                    class="input-group-text"><?php echo e($company_setting['site_currency']); ?></span></span>
                                                            <input class="form-control" required="required"
                                                                min="0" name="amount" type="number"
                                                                value="<?php echo e($invoice->getDue()); ?>" min="0"
                                                                step="0.01" max="<?php echo e($invoice->getDue()); ?>"
                                                                id="amount">
                                                        </div>
                                                    </div>
                                                    <div class="form-group mt-3">
                                                        <button class="btn btn-primary" name="submit"
                                                            id="pay_with_xendit"
                                                            type="submit"><?php echo e(__('Make Payment')); ?></button>
                                                    </div>
                                                </form>
                                            </div>
                                        <?php endif; ?>


                                        <?php if(isset($company_payment_setting['is_nepalste_enabled']) && $company_payment_setting['is_nepalste_enabled'] == 'on'): ?>
                                        <div class="tab-pane fade" id="nepalste-payment" role="tabpanel"
                                            aria-labelledby="nepalste-payment">
                                            <form role="form" action="<?php echo e(route('customer.with.nepalste')); ?>"
                                                method="post" class="require-validation"
                                                id="nepalste-payment-form">
                                                <?php echo csrf_field(); ?>
                                                <input type="hidden" name="invoice_id"
                                                    value="<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($invoice->id)); ?>">
                                                <div class="form-group col-md-12">
                                                    <label for="amount"><?php echo e(__('Amount')); ?></label>
                                                    <div class="input-group">
                                                        <span class="input-group-prepend"><span
                                                                class="input-group-text"><?php echo e($company_setting['site_currency']); ?></span></span>
                                                        <input class="form-control" required="required"
                                                            min="0" name="amount" type="number"
                                                            value="<?php echo e($invoice->getDue()); ?>" min="0"
                                                            step="0.01" max="<?php echo e($invoice->getDue()); ?>"
                                                            id="amount">
                                                    </div>
                                                </div>
                                                <div class="form-group mt-3">
                                                    <button class="btn btn-primary" name="submit"
                                                        id="pay_with_nepalste"
                                                        type="submit"><?php echo e(__('Make Payment')); ?></button>
                                                </div>
                                            </form>
                                        </div>
                                    <?php endif; ?>

                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 99999">
        <div id="liveToast" class="toast text-white  fade" role="alert" aria-live="assertive"
            aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body"> </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>
    <footer id="footer-main">
        <div class="footer-dark">
            <div class="container">
                <div class="row align-items-center justify-content-md-between py-4 mt-4 delimiter-top">
                    <div class="col-md-6">
                        <div class="copyright text-sm font-weight-bold text-center text-md-left">
                            <?php echo e(!empty($companySettings['footer_text']) ? $companySettings['footer_text']->value : ''); ?>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <ul class="nav justify-content-center justify-content-md-end mt-3 mt-md-0">
                            <li class="nav-item">
                                <a class="nav-link" href="#" target="_blank">
                                    <i class="fab fa-dribbble"></i>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" target="_blank">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" target="_blank">
                                    <i class="fab fa-github"></i>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" target="_blank">
                                    <i class="fab fa-facebook"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/plugins/popper.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/plugins/perfect-scrollbar.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/plugins/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/plugins/feather.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/dash.js')); ?>"></script>

    <script src="<?php echo e(asset('assets/js/plugins/bootstrap-switch-button.min.js')); ?>"></script>

    <script src="<?php echo e(asset('assets/js/plugins/sweetalert2.all.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/plugins/simple-datatables.js')); ?>"></script>

    <!-- Apex Chart -->
    <script src="<?php echo e(asset('assets/js/plugins/apexcharts.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/plugins/main.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/plugins/choices.min.js')); ?>"></script>


    <script src="<?php echo e(asset('js/jscolor.js')); ?>"></script>
    <script src="<?php echo e(asset('js/custom.js')); ?>"></script>

    <?php if($message = Session::get('success')): ?>
        <script>
            show_toastr('success', '<?php echo $message; ?>');
        </script>
    <?php endif; ?>
    <?php if($message = Session::get('error')): ?>
        <script>
            show_toastr('error', '<?php echo $message; ?>');
        </script>
    <?php endif; ?>


    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://js.paystack.co/v1/inline.js"></script>
    <script src="https://api.ravepay.co/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"
        integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous">
    </script>




    <script type="text/javascript">
        <?php if(
            $invoice->status != 0 &&
                $invoice->getDue() > 0 &&
                !empty($company_payment_setting) &&
                $company_payment_setting['is_stripe_enabled'] == 'on' &&
                !empty($company_payment_setting['stripe_key']) &&
                !empty($company_payment_setting['stripe_secret'])): ?>
            var stripe = Stripe('<?php echo e($company_payment_setting['stripe_key']); ?>');
            var elements = stripe.elements();

            // Custom styling can be passed to options when creating an Element.
            var style = {
                base: {
                    // Add your base input styles here. For example:
                    fontSize: '14px',
                    color: '#32325d',
                },
            };

            // Create an instance of the card Element.
            var card = elements.create('card', {
                style: style
            });

            // Add an instance of the card Element into the `card-element` <div>.
            card.mount('#card-element');

            // Create a token or display an error when the form is submitted.
            var form = document.getElementById('payment-form');
            form.addEventListener('submit', function(event) {
                event.preventDefault();

                stripe.createToken(card).then(function(result) {
                    if (result.error) {
                        $("#card-errors").html(result.error.message);
                        show_toastr('error', result.error.message, 'error');
                    } else {
                        // Send the token to your server.
                        stripeTokenHandler(result.token);
                    }
                });
            });

            function stripeTokenHandler(token) {
                // Insert the token ID into the form so it gets submitted to the server
                var form = document.getElementById('payment-form');
                var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeToken');
                hiddenInput.setAttribute('value', token.id);
                form.appendChild(hiddenInput);

                // Submit the form
                form.submit();
            }
        <?php endif; ?>

        <?php if(isset($company_payment_setting['paystack_public_key'])): ?>
            $(document).on("click", "#pay_with_paystack", function() {
                $('#paystack-payment-form').ajaxForm(function(res) {
                    var amount = res.total_price;
                    if (res.flag == 1) {
                        var paystack_callback = "<?php echo e(url('/customer/paystack')); ?>";

                        var handler = PaystackPop.setup({
                            key: '<?php echo e($company_payment_setting['paystack_public_key']); ?>',
                            email: res.email,
                            amount: res.total_price * 100,
                            currency: res.currency,
                            ref: 'pay_ref_id' + Math.floor((Math.random() * 1000000000) +
                                1
                            ), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
                            metadata: {
                                custom_fields: [{
                                    display_name: "Email",
                                    variable_name: "email",
                                    value: res.email,
                                }]
                            },

                            callback: function(response) {

                                window.location.href = paystack_callback + '/' + response
                                    .reference + '/' + '<?php echo e(encrypt($invoice->id)); ?>' +
                                    '?amount=' + amount;
                            },
                            onClose: function() {
                                alert('window closed');
                            }
                        });
                        handler.openIframe();
                    } else if (res.flag == 2) {
                        toastrs('Error', res.msg, 'msg');
                    } else {
                        toastrs('Error', res.message, 'msg');
                    }

                }).submit();
            });
        <?php endif; ?>

        <?php if(isset($company_payment_setting['flutterwave_public_key'])): ?>
            //    Flaterwave Payment
            $(document).on("click", "#pay_with_flaterwave", function() {
                $('#flaterwave-payment-form').ajaxForm(function(res) {

                    if (res.flag == 1) {
                        var amount = res.total_price;
                        var API_publicKey = '<?php echo e($company_payment_setting['flutterwave_public_key']); ?>';
                        var nowTim = "<?php echo e(date('d-m-Y-h-i-a')); ?>";
                        var flutter_callback = "<?php echo e(url('/customer/flaterwave')); ?>";
                        var x = getpaidSetup({
                            PBFPubKey: API_publicKey,
                            customer_email: '<?php echo e($user->email); ?>',
                            amount: res.total_price,
                            currency: '<?php echo e($company_setting['site_currency']); ?>',
                            txref: nowTim + '__' + Math.floor((Math.random() * 1000000000)) +
                                'fluttpay_online-' + '<?php echo e(date('Y-m-d')); ?>',
                            meta: [{
                                metaname: "payment_id",
                                metavalue: "id"
                            }],
                            onclose: function() {},
                            callback: function(response) {
                                var txref = response.tx.txRef;
                                if (
                                    response.tx.chargeResponseCode == "00" ||
                                    response.tx.chargeResponseCode == "0"
                                ) {
                                    window.location.href = flutter_callback + '/' + txref +
                                        '/' +
                                        '<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($invoice->id)); ?> ?amount=' +
                                        amount;
                                } else {
                                    // redirect to a failure page.
                                }
                                x
                                    .close(); // use this to close the modal immediately after payment.
                            }
                        });
                    } else if (res.flag == 2) {
                        toastrs('Error', res.msg, 'msg');
                    } else {
                        toastrs('Error', data.message, 'msg');
                    }

                }).submit();
            });
        <?php endif; ?>

        // Razorpay Payment
        <?php if(isset($company_payment_setting['razorpay_public_key'])): ?>
            $(document).on("click", "#pay_with_razorpay", function() {
                $('#razorpay-payment-form').ajaxForm(function(res) {
                    if (res.flag == 1) {
                        var amount = res.total_price;
                        var razorPay_callback = '<?php echo e(url('/customer/razorpay')); ?>';
                        var totalAmount = res.total_price * 100;
                        var coupon_id = res.coupon;
                        var options = {
                            "key": "<?php echo e($company_payment_setting['razorpay_public_key']); ?>", // your Razorpay Key Id
                            "amount": totalAmount,
                            "name": 'Invoice',
                            "currency": '<?php echo e($company_setting['site_currency']); ?>',
                            "description": "",
                            "handler": function(response) {
                                window.location.href = razorPay_callback + '/' + response
                                    .razorpay_payment_id + '/' +
                                    '<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($invoice->id)); ?>' +
                                    '?amount=' + amount;
                            },
                            "theme": {
                                "color": "#528FF0"
                            }
                        };
                        var rzp1 = new Razorpay(options);
                        rzp1.open();
                    } else if (res.flag == 2) {
                        toastrs('Error', res.msg, 'msg');
                    } else {
                        toastrs('Error', data.message, 'msg');
                    }

                }).submit();
            });
        <?php endif; ?>

        //start payfast payment

        <?php if(isset($company_payment_setting['is_payfast_enabled']) &&
                $company_payment_setting['is_payfast_enabled'] == 'on' &&
                !empty($company_payment_setting['payfast_merchant_id']) &&
                !empty($company_payment_setting['payfast_merchant_key'])): ?>
            function get_payfast_status() {
                var invoice_id = $('#invoice_id').val();
                var amount = $('#pay_fast_amount').val();

                $.ajax({
                    url: '<?php echo e(route('invoice.with.payfast')); ?>',
                    method: 'POST',
                    data: {
                        'invoice_id': invoice_id,
                        'amount': amount,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        if (data.success == true) {
                            $('#get-payfast-inputs').append(data.inputs);

                        } else {
                            show_toastr('Error', data.inputs, 'error')
                        }
                    }
                });
            }
        <?php endif; ?>

        <?php if(isset($company_payment_setting['is_payfast_enabled']) && $company_payment_setting['is_payfast_enabled'] == 'on'): ?>
            function get_payfast_status() {
                var invoice_id = $('#invoice_id').val();
                var amount = $('#pay_fast_amount').val();

                $.ajax({
                    url: '<?php echo e(route('invoice.with.payfast')); ?>',
                    method: 'POST',
                    data: {
                        'invoice_id': invoice_id,
                        'amount': amount,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {

                        if (data.success == true) {
                            $('#get-payfast-inputs').append(data.inputs);

                        } else {
                            show_toastr('Error', data.inputs, 'error')
                        }
                    }
                });
            }
        <?php endif; ?>

        //end payfast payment

        
        
        

        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        

        
        
        
    </script>
    <script>
        $(document).on('click', '#shipping', function() {
            var url = $(this).data('url');
            var is_display = $("#shipping").is(":checked");
            $.ajax({
                url: url,
                type: 'get',
                data: {
                    'is_display': is_display,
                },
                success: function(data) {}
            });
        })
    </script>
    <?php if($get_cookie['enable_cookie'] == 'on'): ?>
        <?php echo $__env->make('layouts.cookie_consent', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

</body>

</html>
<?php /**PATH /home/integra.platformbisnis.com/public_html/resources/views/invoice/customer_invoice.blade.php ENDPATH**/ ?>