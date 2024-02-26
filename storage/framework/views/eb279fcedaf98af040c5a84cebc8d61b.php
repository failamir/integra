<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Invoice Detail')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><a href="<?php echo e(route('invoice.index')); ?>"><?php echo e(__('Invoice')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(AUth::user()->invoiceNumberFormat($invoice->invoice_id)); ?></li>
<?php $__env->stopSection(); ?>
<?php
    $settings = Utility::settings();
?>
<?php $__env->startPush('css-page'); ?>
    <style>
        #card-element {
            border: 1px solid #a3afbb !important;
            border-radius: 10px !important;
            padding: 10px !important;
        }
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script-page'); ?>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://js.paystack.co/v1/inline.js"></script>
    <script src="https://api.ravepay.co/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script type="text/javascript">
        <?php if(
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
                        var paystack_callback = "<?php echo e(url('/invoice/paystack')); ?>";

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
                        var flutter_callback = "<?php echo e(url('/invoice/flaterwave')); ?>";
                        var x = getpaidSetup({
                            PBFPubKey: API_publicKey,
                            customer_email: '<?php echo e(Auth::user()->email); ?>',
                            amount: res.total_price,
                            currency: '<?php echo e(App\Models\Utility::getValByName('site_currency')); ?>',
                            txref: nowTim + '__' + Math.floor((Math.random() * 1000000000)) +
                                'fluttpay_online-' + '<?php echo e(date('Y-m-d')); ?>' + '?amount=' + amount,
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
                                        '<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($invoice->id)); ?>';
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

        <?php if(isset($company_payment_setting['razorpay_public_key'])): ?>
            // Razorpay Payment
            $(document).on("click", "#pay_with_razorpay", function() {
                $('#razorpay-payment-form').ajaxForm(function(res) {
                    if (res.flag == 1) {
                        var amount = res.total_price;
                        var razorPay_callback = '<?php echo e(url('/invoice/razorpay')); ?>';
                        var totalAmount = res.total_price * 100;
                        var coupon_id = res.coupon;
                        var options = {
                            "key": "<?php echo e($company_payment_setting['razorpay_public_key']); ?>", // your Razorpay Key Id
                            "amount": totalAmount,
                            "name": 'Plan',
                            "currency": '<?php echo e(App\Models\Utility::getValByName('site_currency')); ?>',
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


        $('.cp_link').on('click', function() {
            var value = $(this).attr('data-link');
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val(value).select();
            document.execCommand("copy");
            $temp.remove();
            show_toastr('success', '<?php echo e(__('Link Copy on Clipboard')); ?>', 'success')
        });
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
                success: function(data) {
                    // console.log(data);
                }
            });
        })
    </script>
<?php $__env->stopPush(); ?>


<?php $__env->startSection('content'); ?>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('send invoice')): ?>
        <?php if($invoice->status != 4): ?>
            <div class="row">
                <div class="col-12">
                    <div class="card ">
                        <div class="card-body">
                            <div class="row timeline-wrapper">
                                <div class="col-md-6 col-lg-4 col-xl-4 create_invoice">
                                    <div class="timeline-icons"><span class="timeline-dots"></span>
                                        <i class="ti ti-plus text-primary"></i>
                                    </div>
                                    <h6 class="text-primary my-3"><?php echo e(__('Create Invoice')); ?></h6>
                                    <p class="text-muted text-sm mb-3"><i
                                            class="ti ti-clock mr-2"></i><?php echo e(__('Created on ')); ?><?php echo e(\Auth::user()->dateFormat($invoice->issue_date)); ?>

                                    </p>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit invoice')): ?>
                                        <a href="<?php echo e(route('invoice.edit', \Crypt::encrypt($invoice->id))); ?>"
                                            class="btn btn-sm btn-primary" data-bs-toggle="tooltip"
                                            data-original-title="<?php echo e(__('Edit')); ?>"><i
                                                class="ti ti-pencil mr-2"></i><?php echo e(__('Edit')); ?></a>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-6 col-lg-4 col-xl-4 send_invoice">
                                    <div class="timeline-icons"><span class="timeline-dots"></span>
                                        <i class="ti ti-mail text-warning"></i>
                                    </div>
                                    <h6 class="text-warning my-3"><?php echo e(__('Send Invoice')); ?></h6>
                                    <p class="text-muted text-sm mb-3">
                                        <?php if($invoice->status != 0): ?>
                                            <i class="ti ti-clock mr-2"></i><?php echo e(__('Sent on')); ?>

                                            <?php echo e(\Auth::user()->dateFormat($invoice->send_date)); ?>

                                        <?php else: ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('send invoice')): ?>
                                                <small><?php echo e(__('Status')); ?> : <?php echo e(__('Not Sent')); ?></small>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </p>

                                    <?php if($invoice->status == 0): ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('send bill')): ?>
                                            <a href="<?php echo e(route('invoice.sent', $invoice->id)); ?>" class="btn btn-sm btn-warning"
                                                data-bs-toggle="tooltip" data-original-title="<?php echo e(__('Mark Sent')); ?>"><i
                                                    class="ti ti-send mr-2"></i><?php echo e(__('Send')); ?></a>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-6 col-lg-4 col-xl-4 create_invoice">
                                    <div class="timeline-icons"><span class="timeline-dots"></span>
                                        <i class="ti ti-report-money text-info"></i>
                                    </div>
                                    <h6 class="text-info my-3"><?php echo e(__('Get Paid')); ?></h6>
                                    <p class="text-muted text-sm mb-3"><?php echo e(__('Status')); ?> : <?php echo e(__('Awaiting payment')); ?> </p>
                                    <?php if($invoice->status != 0): ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create payment invoice')): ?>
                                            <a href="#" data-url="<?php echo e(route('invoice.payment', $invoice->id)); ?>"
                                                data-ajax-popup="true" data-title="<?php echo e(__('Add Payment')); ?>"
                                                class="btn btn-sm btn-info" data-original-title="<?php echo e(__('Add Payment')); ?>"><i
                                                    class="ti ti-report-money mr-2"></i><?php echo e(__('Receive Payment')); ?></a> <br>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <?php if(Gate::check('show invoice')): ?>
        <?php if($invoice->status != 0): ?>
            <div class="row justify-content-between align-items-center mb-3">
                <div class="col-md-12 d-flex align-items-center justify-content-between justify-content-md-end">
                    <?php if(!empty($creditnote)): ?>
                        <div class="all-button-box mx-2 mr-2">
                            <a href="#" class="btn btn-sm btn-primary"
                                data-url="<?php echo e(route('invoice.credit.note', $invoice->id)); ?>" data-ajax-popup="true"
                                data-title="<?php echo e(__('Add Credit Note')); ?>">
                                <?php echo e(__('Add Credit Note')); ?>

                            </a>
                        </div>
                    <?php endif; ?>
                    <?php if($invoice->status != 4): ?>
                        <div class="all-button-box mr-2">
                            <a href="<?php echo e(route('invoice.payment.reminder', $invoice->id)); ?>"
                                class="btn btn-sm btn-primary me-2"><?php echo e(__('Receipt Reminder')); ?></a>
                        </div>
                    <?php endif; ?>
                    <div class="all-button-box mr-2">
                        <a href="<?php echo e(route('invoice.resent', $invoice->id)); ?>"
                            class="btn btn-sm btn-primary me-2"><?php echo e(__('Resend Invoice')); ?></a>
                    </div>
                    <div class="all-button-box">
                        <a href="<?php echo e(route('invoice.pdf', Crypt::encrypt($invoice->id))); ?>" target="_blank"
                            class="btn btn-sm btn-primary"><?php echo e(__('Download')); ?></a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="invoice">
                        <div class="invoice-print">
                            <div class="row invoice-title mt-2">
                                <div class="col-xs-12 col-sm-12 col-nd-6 col-lg-6 col-12">
                                    <h4><?php echo e(__('Invoice')); ?></h4>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-nd-6 col-lg-6 col-12 text-end">
                                    <h4 class="invoice-number">
                                        <?php echo e(AUth::user()->invoiceNumberFormat($invoice->invoice_id)); ?></h4>
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
                                                <?php echo e(\Auth::user()->dateFormat($invoice->issue_date)); ?><br><br>
                                            </small>
                                        </div>
                                        <div>
                                            <small>
                                                <strong><?php echo e(__('Due Date')); ?> :</strong><br>
                                                <?php echo e(\Auth::user()->dateFormat($invoice->due_date)); ?><br><br>
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col">
                                    <small class="font-style">
                                        <strong><?php echo e(__('Billed To')); ?> :</strong><br>
                                        <?php if(!empty($customer->billing_name)): ?>
                                            <?php echo e(!empty($customer->billing_name) ? $customer->billing_name : ''); ?><br>
                                            <?php echo e(!empty($customer->billing_address) ? $customer->billing_address : ''); ?><br>
                                            <?php echo e(!empty($customer->billing_city) ? $customer->billing_city : '' . ', '); ?><br>
                                            <?php echo e(!empty($customer->billing_state) ? $customer->billing_state : '', ', '); ?>,
                                            <?php echo e(!empty($customer->billing_zip) ? $customer->billing_zip : ''); ?><br>
                                            <?php echo e(!empty($customer->billing_country) ? $customer->billing_country : ''); ?><br>
                                            <?php echo e(!empty($customer->billing_phone) ? $customer->billing_phone : ''); ?><br>
                                            <?php if($settings['vat_gst_number_switch'] == 'on'): ?>
                                                <strong><?php echo e(__('Tax Number ')); ?> :
                                                </strong><?php echo e(!empty($customer->tax_number) ? $customer->tax_number : ''); ?>

                                            <?php endif; ?>
                                        <?php else: ?>
                                            -
                                        <?php endif; ?>

                                    </small>
                                </div>

                                <?php if(App\Models\Utility::getValByName('shipping_display') == 'on'): ?>
                                    <div class="col ">
                                        <small>
                                            <strong><?php echo e(__('Shipped To')); ?> :</strong><br>
                                            <?php if(!empty($customer->shipping_name)): ?>
                                                <?php echo e(!empty($customer->shipping_name) ? $customer->shipping_name : ''); ?><br>
                                                <?php echo e(!empty($customer->shipping_address) ? $customer->shipping_address : ''); ?><br>
                                                <?php echo e(!empty($customer->shipping_city) ? $customer->shipping_city : '' . ', '); ?><br>
                                                <?php echo e(!empty($customer->shipping_state) ? $customer->shipping_state : '' . ', '); ?>,
                                                <?php echo e(!empty($customer->shipping_zip) ? $customer->shipping_zip : ''); ?><br>
                                                <?php echo e(!empty($customer->shipping_country) ? $customer->shipping_country : ''); ?><br>
                                                <?php echo e(!empty($customer->shipping_phone) ? $customer->shipping_phone : ''); ?><br>
                                            <?php else: ?>
                                                -
                                            <?php endif; ?>
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
                                                <th class="text-end text-dark" width="12%"><?php echo e(__('Price')); ?><br>
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
                                                    <td><?php echo e($iteam->quantity . ' (' . $productName->unit->name . ')'); ?></td>
                                                    <td><?php echo e(\Auth::user()->priceFormat($iteam->price)); ?></td>
                                                    <td><?php echo e(\Auth::user()->priceFormat($iteam->discount)); ?></td>

                                                    

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
                                                                            $itemTax['price'] = \Auth::user()->priceFormat($taxPrice);

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
                                                                            <td><?php echo e($tax['name'] .' ('.$tax['rate'] .'%)'); ?></td>
                                                                            <td><?php echo e($tax['price']); ?></td>
                                                                        </tr>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </table>
                                                        <?php else: ?>
                                                            -
                                                        <?php endif; ?>
                                                    </td>

                                                    <td><?php echo e(!empty($iteam->description) ? $iteam->description : '-'); ?></td>
                                                    <td class="text-end">
                                                        <?php echo e(\Auth::user()->priceFormat($iteam->price * $iteam->quantity - $iteam->discount + $totalTaxPrice)); ?>

                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <tfoot>
                                                <tr>
                                                    <td></td>
                                                    <td><b><?php echo e(__('Total')); ?></b></td>
                                                    <td><b><?php echo e($totalQuantity); ?></b></td>
                                                    <td><b><?php echo e(\Auth::user()->priceFormat($totalRate)); ?></b></td>
                                                    <td><b><?php echo e(\Auth::user()->priceFormat($totalDiscount)); ?></b></td>
                                                    <td><b><?php echo e(\Auth::user()->priceFormat($totalTaxPrice)); ?></b></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="6"></td>
                                                    <td class="text-end"><b><?php echo e(__('Sub Total')); ?></b></td>
                                                    <td class="text-end">
                                                        <?php echo e(\Auth::user()->priceFormat($invoice->getSubTotal())); ?></td>
                                                </tr>

                                                <tr>
                                                    <td colspan="6"></td>
                                                    <td class="text-end"><b><?php echo e(__('Discount')); ?></b></td>
                                                    <td class="text-end">
                                                        <?php echo e(\Auth::user()->priceFormat($invoice->getTotalDiscount())); ?>

                                                    </td>
                                                </tr>

                                                <?php if(!empty($taxesData)): ?>
                                                    <?php $__currentLoopData = $taxesData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $taxName => $taxPrice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>
                                                            <td colspan="6"></td>
                                                            <td class="text-end"><b><?php echo e($taxName); ?></b></td>
                                                            <td class="text-end">
                                                                <?php echo e(\Auth::user()->priceFormat($taxPrice)); ?></td>
                                                        </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                                <tr>
                                                    <td colspan="6"></td>
                                                    <td class="blue-text text-end"><b><?php echo e(__('Total')); ?></b></td>
                                                    <td class="blue-text text-end">
                                                        <?php echo e(\Auth::user()->priceFormat($invoice->getTotal())); ?></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="6"></td>
                                                    <td class="text-end"><b><?php echo e(__('Paid')); ?></b></td>
                                                    <td class="text-end">
                                                        <?php echo e(\Auth::user()->priceFormat($invoice->getTotal() - $invoice->getDue() - $invoice->invoiceTotalCreditNote())); ?>

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="6"></td>
                                                    <td class="text-end"><b><?php echo e(__('Credit Note')); ?></b></td>
                                                    <td class="text-end">
                                                        <?php echo e(\Auth::user()->priceFormat($invoice->invoiceTotalCreditNote())); ?>

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="6"></td>
                                                    <td class="text-end"><b><?php echo e(__('Due')); ?></b></td>
                                                    <td class="text-end">
                                                        <?php echo e(\Auth::user()->priceFormat($invoice->getDue())); ?></td>
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
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <h5 class=" d-inline-block"><?php echo e(__('Receipt Summary')); ?></h5><br>
                    <?php if($user_plan->storage_limit <= $invoice_user->storage_limit): ?>
                        <small
                            class="text-danger font-bold"><?php echo e(__('Your plan storage limit is over , so you can not see customer uploaded payment receipt')); ?></small><br>
                    <?php endif; ?>

                    <div class="table-responsive mt-3">
                        <table class="table ">
                            <thead>
                                <tr>
                                    <th class="text-dark"><?php echo e(__('Payment Receipt')); ?></th>
                                    <th class="text-dark"><?php echo e(__('Date')); ?></th>
                                    <th class="text-dark"><?php echo e(__('Amount')); ?></th>
                                    <th class="text-dark"><?php echo e(__('Payment Type')); ?></th>
                                    <th class="text-dark"><?php echo e(__('Account')); ?></th>
                                    <th class="text-dark"><?php echo e(__('Reference')); ?></th>
                                    <th class="text-dark"><?php echo e(__('Description')); ?></th>
                                    <th class="text-dark"><?php echo e(__('Receipt')); ?></th>
                                    <th class="text-dark"><?php echo e(__('OrderId')); ?></th>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete payment invoice')): ?>
                                        <th class="text-dark"><?php echo e(__('Action')); ?></th>
                                    <?php endif; ?>
                                </tr>
                            </thead>

                            <?php if(!empty($invoice->payments) && $invoice->bankPayments): ?>
                                <?php
                                    $path = \App\Models\Utility::get_file('uploads/order');
                                ?>

                                <?php $__currentLoopData = $invoice->payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <?php if(!empty($payment->add_receipt)): ?>
                                                <a href="<?php echo e(asset(Storage::url('uploads/payment')) . '/' . $payment->add_receipt); ?>"
                                                    download="" class="btn btn-sm btn-secondary btn-icon rounded-pill"
                                                    target="_blank"><span class="btn-inner--icon"><i
                                                            class="ti ti-download"></i></span></a>
                                            <?php else: ?>
                                                -
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e(\Auth::user()->dateFormat($payment->date)); ?></td>
                                        <td><?php echo e(\Auth::user()->priceFormat($payment->amount)); ?></td>
                                        <td><?php echo e($payment->payment_type); ?></td>
                                        <td><?php echo e(!empty($payment->bankAccount) ? $payment->bankAccount->bank_name . ' ' . $payment->bankAccount->holder_name : '--'); ?>

                                        </td>
                                        <td><?php echo e(!empty($payment->reference) ? $payment->reference : '--'); ?></td>
                                        <td><?php echo e(!empty($payment->description) ? $payment->description : '--'); ?></td>
                                        <?php if($user_plan->storage_limit <= $invoice_user->storage_limit): ?>
                                            <td>
                                                --
                                            </td>
                                        <?php else: ?>
                                            <td>
                                                <?php if(!empty($payment->receipt)): ?>
                                                    <a href="<?php echo e($path . '/' . $payment->receipt); ?>" target="_blank">
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
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete invoice product')): ?>
                                            <td>
                                                <div class="action-btn bg-danger ms-2">
                                                    <?php echo Form::open([
                                                        'method' => 'post',
                                                        'route' => ['invoice.payment.destroy', $invoice->id, $payment->id],
                                                        'id' => 'delete-form-' . $payment->id,
                                                    ]); ?>


                                                    <a href="#" class="mx-3 btn btn-sm align-items-center bs-pass-para"
                                                        data-bs-toggle="tooltip" title="Delete"
                                                        data-original-title="<?php echo e(__('Delete')); ?>"
                                                        data-confirm="<?php echo e(__('Are You Sure?') . '|' . __('This action can not be undone. Do you want to continue?')); ?>"
                                                        data-confirm-yes="document.getElementById('delete-form-<?php echo e($payment->id); ?>').submit();">
                                                        <i class="ti ti-trash text-white"></i>
                                                    </a>
                                                    <?php echo Form::close(); ?>

                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                
                                <?php $__currentLoopData = $invoice->bankPayments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $bankPayment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>-</td>
                                        <td><?php echo e(\Auth::user()->dateFormat($bankPayment->date)); ?></td>
                                        <td><?php echo e(\Auth::user()->priceFormat($bankPayment->amount)); ?></td>
                                        <td><?php echo e(__('Bank Transfer')); ?><br>
                                        </td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>

                                        <?php if($user_plan->storage_limit <= $invoice_user->storage_limit): ?>
                                            <td>
                                                ---
                                            </td>
                                        <?php else: ?>
                                            <td>
                                                <?php if(!empty($bankPayment->receipt)): ?>
                                                    <a href="<?php echo e($path . '/' . $bankPayment->receipt); ?>" target="_blank">
                                                        <i class="ti ti-file"></i> <?php echo e(__('Receipt')); ?>

                                                    </a>
                                                <?php endif; ?>

                                            </td>
                                        <?php endif; ?>
                                        <td><?php echo e(!empty($bankPayment->order_id) ? $bankPayment->order_id : '--'); ?></td>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete invoice product')): ?>
                                            <td>
                                                <?php if($bankPayment->status == 'Pending'): ?>
                                                    <div class="action-btn bg-warning">
                                                        <a href="#"
                                                            data-url="<?php echo e(URL::to('invoice/' . $bankPayment->id . '/action')); ?>"
                                                            data-size="lg" data-ajax-popup="true"
                                                            data-title="<?php echo e(__('Payment Status')); ?>"
                                                            class="mx-3 btn btn-sm align-items-center"
                                                            data-bs-toggle="tooltip" title="<?php echo e(__('Payment Status')); ?>"
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


                                                    <a href="#" class="mx-3 btn btn-sm align-items-center bs-pass-para"
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
                                    <td colspan="<?php echo e(Gate::check('delete invoice product') ? '10' : '9'); ?>"
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
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <h5 class="d-inline-block mb-5"><?php echo e(__('Credit Note Summary')); ?></h5>

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-dark"><?php echo e(__('Date')); ?></th>
                                    <th class="text-dark" class=""><?php echo e(__('Amount')); ?></th>
                                    <th class="text-dark" class=""><?php echo e(__('Description')); ?></th>
                                    <?php if(Gate::check('edit credit note') || Gate::check('delete credit note')): ?>
                                        <th class="text-dark"><?php echo e(__('Action')); ?></th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <?php $__empty_1 = true; $__currentLoopData = $invoice->creditNote; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$creditNote): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e(\Auth::user()->dateFormat($creditNote->date)); ?></td>
                                    <td class=""><?php echo e(\Auth::user()->priceFormat($creditNote->amount)); ?></td>
                                    <td class=""><?php echo e($creditNote->description); ?></td>
                                    <td>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit credit note')): ?>
                                            <div class="action-btn bg-primary ms-2">
                                                <a data-url="<?php echo e(route('invoice.edit.credit.note', [$creditNote->invoice, $creditNote->id])); ?>"
                                                    data-ajax-popup="true" title="<?php echo e(__('Edit')); ?>"
                                                    data-original-title="<?php echo e(__('Credit Note')); ?>" href="#"
                                                    class="mx-3 btn btn-sm align-items-center" data-bs-toggle="tooltip"
                                                    data-original-title="<?php echo e(__('Edit')); ?>">
                                                    <i class="ti ti-pencil text-white"></i>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete credit note')): ?>
                                            <div class="action-btn bg-danger ms-2">
                                                <?php echo Form::open([
                                                    'method' => 'DELETE',
                                                    'route' => ['invoice.delete.credit.note', $creditNote->invoice, $creditNote->id],
                                                    'id' => 'delete-form-' . $creditNote->id,
                                                ]); ?>

                                                <a href="#" class="mx-3 btn btn-sm align-items-center bs-pass-para "
                                                    data-bs-toggle="tooltip" title="Delete"
                                                    data-original-title="<?php echo e(__('Delete')); ?>"
                                                    data-confirm="<?php echo e(__('Are You Sure?') . '|' . __('This action can not be undone. Do you want to continue?')); ?>"
                                                    data-confirm-yes="document.getElementById('delete-form-<?php echo e($creditNote->id); ?>').submit();">
                                                    <i class="ti ti-trash text-white"></i>
                                                </a>
                                                <?php echo Form::close(); ?>

                                            </div>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="4" class="text-center">
                                        <p class="text-dark"><?php echo e(__('No Data Found')); ?></p>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/integra.platformbisnis.com/public_html/resources/views/invoice/view.blade.php ENDPATH**/ ?>