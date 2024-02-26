<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Bill Edit')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><a href="<?php echo e(route('bill.index')); ?>"><?php echo e(__('Bill')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Bill Edit')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script-page'); ?>
    <script src="<?php echo e(asset('js/jquery-ui.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jquery.repeater.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jquery-searchbox.js')); ?>"></script>
    <script>
        var selector = "body";
        if ($(selector + " .repeater").length) {
            var $dragAndDrop = $("body .repeater tbody").sortable({
                handle: '.sort-handler'
            });
            var $repeater = $(selector + ' .repeater').repeater({
                initEmpty: true,
                defaultValues: {
                    'status': 1
                },
                show: function () {
                    $(this).slideDown();
                    var file_uploads = $(this).find('input.multi');
                    if (file_uploads.length) {
                        $(this).find('input.multi').MultiFile({
                            max: 3,
                            accept: 'png|jpg|jpeg',
                            max_size: 2048
                        });
                    }

                    // for item SearchBox ( this function is  custom Js )
                    JsSearchBox();

                    if($('.select2').length) {
                        $('.select2').select2();
                    }
                },
                hide: function (deleteElement) {

                    $(this).slideUp(deleteElement);
                    $(this).remove();
                    var inputs = $(".amount");
                    var subTotal = 0;
                    for (var i = 0; i < inputs.length; i++) {
                        subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
                    }
                    $('.subTotal').html(subTotal.toFixed(2));
                    $('.totalAmount').html(subTotal.toFixed(2));

                },
                ready: function (setIndexes) {
                    $dragAndDrop.on('drop', setIndexes);
                },
                isFirstItemUndeletable: true
            });
            var value = $(selector + " .repeater").attr('data-value');
            if (typeof value != 'undefined' && value.length != 0) {
                value = JSON.parse(value);
                $repeater.setList(value);
                for (var i = 0; i < value.length; i++) {
                    var tr = $('#sortable-table .id[value="' + value[i].id + '"]').parent();
                    tr.find('.item').val(value[i].product_id);
                    changeItem(tr.find('.item'));
                }
            }
        }

        $(document).on('change', '#vender', function () {
            $('#vender_detail').removeClass('d-none');
            $('#vender_detail').addClass('d-block');
            $('#vender-box').removeClass('d-block');
            $('#vender-box').addClass('d-none');
            var id = $(this).val();
            var url = $(this).data('url');
            $.ajax({
                url: url,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': jQuery('#token').val()
                },
                data: {
                    'id': id
                },
                cache: false,
                success: function (data) {
                    if (data != '') {
                        $('#vender_detail').html(data);
                    } else {
                        $('#vender-box').removeClass('d-none');
                        $('#vender-box').addClass('d-block');
                        $('#vender_detail').removeClass('d-block');
                        $('#vender_detail').addClass('d-none');
                    }
                },

            });
        });
        $(document).on('click', '#remove', function () {
            $('#vender-box').removeClass('d-none');
            $('#vender-box').addClass('d-block');
            $('#vender_detail').removeClass('d-block');
            $('#vender_detail').addClass('d-none');
        });

        $(document).on('change', '.item', function () {

            changeItem($(this));
        });

        var bill_id = '<?php echo e($bill->id); ?>';

        function changeItem(element) {

            var iteams_id = element.val();
            var url = element.data('url');
            var el = element;

            $.ajax({
                url: url,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': jQuery('#token').val()
                },
                data: {
                    'product_id': iteams_id,
                },
                cache: false,
                success: function (data) {
                    var item = JSON.parse(data);

                    $.ajax({
                        url: '<?php echo e(route('bill.items')); ?>',
                        type: 'GET',
                        headers: {
                            'X-CSRF-TOKEN': jQuery('#token').val()
                        },
                        data: {
                            'bill_id': bill_id,
                            'product_id': iteams_id,
                        },
                        cache: false,
                        success: function (data) {
                            var billItems = JSON.parse(data);

                            if (billItems != null) {
                                var amount = (billItems.price * billItems.quantity);
                                // console.log(billItems)
                                $(el.parent().parent().parent().find('.quantity')).val(billItems.quantity);
                                $(el.parent().parent().parent().find('.price')).val(billItems.price);
                                $(el.parent().parent().parent().find('.discount')).val(billItems.discount);
                                $(el.parent().parent().parent().parent().find('.pro_description')).val(billItems.description);

                            } else {
                                $(el.parent().parent().parent().find('.quantity')).val(1);
                                $(el.parent().parent().parent().find('.price')).val(item.product.purchase_price);
                                $(el.parent().parent().parent().find('.discount')).val(0);
                                $(el.parent().parent().parent().parent().find('.pro_description')).val(item.product.description);
                            }


                            var taxes = '';
                            var tax = [];

                            var totalItemTaxRate = 0;
                            for (var i = 0; i < item.taxes.length; i++) {

                                taxes += '<span class="badge bg-primary p-2 px-3 rounded mt-1 mr-1">' + item.taxes[i].name + ' ' + '(' + item.taxes[i].rate + '%)' + '</span>';
                                tax.push(item.taxes[i].id);
                                totalItemTaxRate += parseFloat(item.taxes[i].rate);

                            }

                            var discount=$(el.parent().parent().parent().find('.discount')).val();

                            if (billItems != null) {
                                var itemTaxPrice = parseFloat((totalItemTaxRate / 100)) * parseFloat((billItems.price * billItems.quantity)- discount);
                            } else {
                                var itemTaxPrice = parseFloat((totalItemTaxRate / 100)) * parseFloat((item.product.purchase_price * 1)- discount);
                            }


                            $(el.parent().parent().parent().find('.itemTaxPrice')).val(itemTaxPrice.toFixed(2));
                            $(el.parent().parent().parent().find('.itemTaxRate')).val(totalItemTaxRate.toFixed(2));
                            $(el.parent().parent().parent().find('.taxes')).html(taxes);
                            $(el.parent().parent().parent().find('.tax')).val(tax);
                            $(el.parent().parent().parent().find('.unit')).html(item.unit);
                            // $(el.parent().parent().find('.discount')).val(0);

                            var inputs = $(".amount");
                            var subTotal = 0;
                            for (var i = 0; i < inputs.length; i++) {
                                subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
                            }



                            var accountinputs = $(".accountamount");
                            var accountSubTotal = 0;
                            for (var i = 0; i < accountinputs.length; i++)
                            {
                                var currentInputValue = parseFloat(accountinputs[i].innerHTML);
                                if (!isNaN(currentInputValue))
                                {
                                    accountSubTotal += currentInputValue;
                                }
                            }
                            
                            // var totalItemPrice = 0;
                            // var inputs_quantity = $(".quantity");
                            // var priceInput = $('.price');
                            // for (var j = 0; j < priceInput.length; j++) {
                            //     totalItemPrice += (parseFloat(priceInput[j].value) * parseFloat(inputs_quantity[j].value));
                            // }

                            var totalItemPrice = 0;
                            var inputs_quantity = $(".quantity");
                            var priceInput = $('.price');
                            var acinputs = $(".accountAmount");
                            for (var j = 0; j < priceInput.length; j++) {
                                var accountAmount = parseFloat(acinputs[j].value);
                                if (isNaN(accountAmount)) {
                                    accountAmount = 0;
                                }

                                var itemTotal = (parseFloat(priceInput[j].value) * parseFloat(inputs_quantity[j].value) + accountAmount);

                                totalItemPrice += itemTotal;
                            }



                            var totalItemTaxPrice = 0;
                            var itemTaxPriceInput = $('.itemTaxPrice');
                            for (var j = 0; j < itemTaxPriceInput.length; j++) {
                                totalItemTaxPrice += parseFloat(itemTaxPriceInput[j].value);
                                if (billItems != null) {
                                    $(el.parent().parent().parent().find('.amount')).html(parseFloat(amount)+parseFloat(itemTaxPrice)-parseFloat(discount));
                                } else {
                                    $(el.parent().parent().parent().find('.amount')).html(parseFloat(item.totalAmount)+parseFloat(itemTaxPrice));
                                }

                            }


                            var totalItemDiscountPrice = 0;
                            var itemDiscountPriceInput = $('.discount');

                            for (var k = 0; k < itemDiscountPriceInput.length; k++) {
                                totalItemDiscountPrice += parseFloat(itemDiscountPriceInput[k].value);
                            }


                            // alert(accountSubTotal)

                            $('.subTotal').html(totalItemPrice.toFixed(2));
                            $('.totalTax').html(totalItemTaxPrice.toFixed(2));
                            $('.totalAmount').html((parseFloat(totalItemPrice) - parseFloat(totalItemDiscountPrice) + parseFloat(totalItemTaxPrice)).toFixed(2));
                            $('.totalDiscount').html(totalItemDiscountPrice.toFixed(2));


                        }
                    });


                },
            });
        }


        $(document).on('keyup', '.quantity', function () {
            var quntityTotalTaxPrice = 0;

            var el = $(this).parent().parent().parent().parent();

            var quantity = $(this).val();
            var price = $(el.find('.price')).val();
            var discount = $(el.find('.discount')).val();
            if(discount.length <= 0)
            {
                discount = 0 ;
            }

            var totalItemPrice = (quantity * price) - discount;

            var amount = (totalItemPrice);


            var totalItemTaxRate = $(el.find('.itemTaxRate')).val();
            var itemTaxPrice = parseFloat((totalItemTaxRate / 100) * (totalItemPrice));
            $(el.find('.itemTaxPrice')).val(itemTaxPrice.toFixed(2));

            $(el.find('.amount')).html(parseFloat(itemTaxPrice)+parseFloat(amount));

            var totalItemTaxPrice = 0;
            var itemTaxPriceInput = $('.itemTaxPrice');
            for (var j = 0; j < itemTaxPriceInput.length; j++) {
                totalItemTaxPrice += parseFloat(itemTaxPriceInput[j].value);
            }


            var totalInputItemPrice = 0;
            var inputs_quantity = $(".quantity");
            var priceInput = $('.price');
            for (var j = 0; j < priceInput.length; j++) {
                totalInputItemPrice += (parseFloat(priceInput[j].value) * parseFloat(inputs_quantity[j].value));
            }

            var totalAccount = 0;
            var accountInput = $('.accountAmount');


            for (var j = 0; j < accountInput.length; j++) {
                // if(typeof accountInput[j].value != 'undefined')
                if(accountInput[j].value!='')
                {
                    var accountInputPrice = accountInput[j].value;
                }
                else {
                    var accountInputPrice = 0;
                }

                totalAccount += (parseFloat(accountInputPrice));

            }



            var inputs = $(".amount");
            var subTotal = 0;
            for (var i = 0; i < inputs.length; i++) {
                subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
            }

            var sumAmount = totalInputItemPrice + totalAccount;

            // console.log(totalAccount)

            $('.subTotal').html(sumAmount.toFixed(2));
            $('.totalTax').html(totalItemTaxPrice.toFixed(2));
            $('.totalAmount').html((parseFloat(subTotal)+totalAccount).toFixed(2));

        })

        $(document).on('keyup change', '.price', function () {
            var el = $(this).parent().parent().parent().parent();
            var price = $(this).val();
            var quantity = $(el.find('.quantity')).val();
            var discount = $(el.find('.discount')).val();
            if(discount.length <= 0)
            {
                discount = 0 ;
            }

            var totalItemPrice = (quantity * price)-discount;

            var amount = (totalItemPrice);

            var totalItemTaxRate = $(el.find('.itemTaxRate')).val();
            var itemTaxPrice = parseFloat((totalItemTaxRate / 100) * (totalItemPrice));
            $(el.find('.itemTaxPrice')).val(itemTaxPrice.toFixed(2));

            $(el.find('.amount')).html(parseFloat(itemTaxPrice)+parseFloat(amount));

            var totalItemTaxPrice = 0;
            var itemTaxPriceInput = $('.itemTaxPrice');
            for (var j = 0; j < itemTaxPriceInput.length; j++) {
                totalItemTaxPrice += parseFloat(itemTaxPriceInput[j].value);
            }


            var totalItemPrice = 0;
            var inputs_quantity = $(".quantity");
            var priceInput = $('.price');
            for (var j = 0; j < priceInput.length; j++) {
                totalItemPrice += (parseFloat(priceInput[j].value) * parseFloat(inputs_quantity[j].value));
            }


            var totalAccount = 0;
            var accountInput = $('.accountAmount');
            for (var j = 0; j < accountInput.length; j++) {
                if(accountInput[j].value!='')
                {
                    var accountInputPrice = accountInput[j].value;
                }
                else {
                    var accountInputPrice = 0;
                }

                totalAccount += (parseFloat(accountInputPrice));
            }
            var inputs = $(".amount");
            var subTotal = 0;
            for (var i = 0; i < inputs.length; i++) {
                subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
            }

            var sumAmount = totalItemPrice + totalAccount;


            $('.subTotal').html(sumAmount.toFixed(2));
            $('.totalTax').html(totalItemTaxPrice.toFixed(2));

            $('.totalAmount').html((parseFloat(subTotal) + totalAccount).toFixed(2));

        })

        $(document).on('keyup change', '.discount', function () {
            var el = $(this).parent().parent().parent();
            var discount = $(this).val();
            if(discount.length <= 0)
            {
                discount = 0 ;
            }
            var price = $(el.find('.price')).val();

            var quantity = $(el.find('.quantity')).val();
            var totalItemPrice = (quantity * price) - discount;

            var amount = (totalItemPrice);

            var totalItemTaxRate = $(el.find('.itemTaxRate')).val();
            var itemTaxPrice = parseFloat((totalItemTaxRate / 100) * (totalItemPrice));
            $(el.find('.itemTaxPrice')).val(itemTaxPrice.toFixed(2));

            $(el.find('.amount')).html(parseFloat(itemTaxPrice)+parseFloat(amount));


            var totalItemTaxPrice = 0;
            var itemTaxPriceInput = $('.itemTaxPrice');
            for (var j = 0; j < itemTaxPriceInput.length; j++) {
                totalItemTaxPrice += parseFloat(itemTaxPriceInput[j].value);
            }


            var totalItemPrice = 0;
            var inputs_quantity = $(".quantity");
            var priceInput = $('.price');
            for (var j = 0; j < priceInput.length; j++) {
                totalItemPrice += (parseFloat(priceInput[j].value) * parseFloat(inputs_quantity[j].value));
            }

            var inputs = $(".amount");
            var subTotal = 0;
            for (var i = 0; i < inputs.length; i++) {
                subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
            }


            var totalItemDiscountPrice = 0;
            var itemDiscountPriceInput = $('.discount');
            for (var k = 0; k < itemDiscountPriceInput.length; k++) {

                totalItemDiscountPrice += parseFloat(itemDiscountPriceInput[k].value);
            }

            var totalAccount = 0;
            var accountInput = $('.accountAmount');
            for (var j = 0; j < accountInput.length; j++) {
                if(accountInput[j].value!='')
                {
                    var accountInputPrice = accountInput[j].value;
                }
                else {
                    var accountInputPrice = 0;
                }

                totalAccount += (parseFloat(accountInputPrice));
            }

            var sumAmount = totalItemPrice + totalAccount;

            console.log(totalItemDiscountPrice)

            $('.subTotal').html(sumAmount.toFixed(2));
            $('.totalTax').html(totalItemTaxPrice.toFixed(2));

            $('.totalAmount').html((parseFloat(subTotal) + totalAccount).toFixed(2));
            $('.totalDiscount').html(totalItemDiscountPrice.toFixed(2));

        })

        $(document).on('keyup change', '.accountAmount', function () {

            var el1 = $(this).parent().parent().parent().parent();
            var el = $(this).parent().parent().parent().parent().parent();

            var quantityDiv = $(el.find('.quantity'));
            var priceDiv = $(el.find('.price'));
            var discountDiv = $(el.find('.discount'));

            var itemSubTotal=0;
            var itemSubTotalDiscount=0;
            for (var p = 0; p < priceDiv.length; p++) {
                var quantity=quantityDiv[p].value;
                var price=priceDiv[p].value;
                var discount=discountDiv[p].value;
                if(discount.length <= 0)
                {
                    discount = 0 ;
                }
                itemSubTotal += (quantity*price);
                itemSubTotalDiscount += (quantity*price) - (discount);


            }


            // var totalItemTaxPrice = 0;
            // var itemTaxPriceInput = $('.itemTaxPrice');
            // for (var j = 0; j < itemTaxPriceInput.length; j++) {
            //
            //     totalItemTaxPrice += parseFloat(itemTaxPriceInput[j].value);
            //
            // }

            var totalItemTaxPrice = 0;
            var itemTaxPriceInput = $('.itemTaxPrice');

            for (var j = 0; j < itemTaxPriceInput.length; j++) {
                var parsedValue = parseFloat(itemTaxPriceInput[j].value);

                if (!isNaN(parsedValue)) {
                    totalItemTaxPrice += parsedValue;
                }
            }


            var amount = $(this).val();
            el1.find('.accountamount').html(amount);
            var totalAccount = 0;
            var accountInput = $('.accountAmount');
            for (var j = 0; j < accountInput.length; j++) {
                totalAccount += (parseFloat(accountInput[j].value) );
            }


            var inputs = $(".accountamount");
            var subTotal = 0;
            for (var i = 0; i < inputs.length; i++) {

                subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
            }


            $('.subTotal').text((totalAccount+itemSubTotal).toFixed(2));
            $('.totalAmount').text((parseFloat((subTotal + itemSubTotalDiscount) + (totalItemTaxPrice))).toFixed(2));


        })


        $(document).on('click', '[data-repeater-create]', function () {
            $('.item :selected').each(function () {
                var id = $(this).val();
                $(".item option[value=" + id + "]").prop("disabled", true);
            });
        })

        $(document).on('click', '[data-repeater-delete]', function () {
            // $('.delete_item').click(function () {
            if (confirm('Are you sure you want to delete this element?')) {
                var el = $(this).parent().parent();
                var id = $(el.find('.id')).val();
                var amount = $(el.find('.amount')).html();
                var account_id = $(el.find('.account_id')).val();

                $.ajax({
                    url: '<?php echo e(route('bill.product.destroy')); ?>',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': jQuery('#token').val()
                    },
                    data: {
                        'id': id,
                        'amount': amount,
                        'account_id':account_id,

                    },
                    cache: false,
                    success: function (data) {

                    },
                });

            }
        });

        $('.accountAmount').trigger('keyup');

    </script>

    <script>
        $(document).on('click', '[data-repeater-delete]', function () {
            $(".price").change();
            $(".discount").change();
        });
    </script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <?php echo e(Form::model($bill, array('route' => array('bill.update', $bill->id), 'method' => 'PUT','class'=>'w-100'))); ?>

        <div class="col-12">
            <input type="hidden" name="_token" id="token" value="<?php echo e(csrf_token()); ?>">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group" id="vender-box">
                                <?php echo e(Form::label('vender_id', __('Vendor'),['class'=>'form-label'])); ?>

                                <?php echo e(Form::select('vender_id', $venders,null, array('class' => 'form-control select','id'=>'vender','data-url'=>route('bill.vender'),'required'=>'required'))); ?>

                            </div>
                            <div id="vender_detail" class="d-none">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php echo e(Form::label('bill_date', __('Bill Date'),['class'=>'form-label'])); ?>

                                        <?php echo e(Form::date('bill_date',null,array('class'=>'form-control','required'=>'required'))); ?>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php echo e(Form::label('due_date', __('Due Date'),['class'=>'form-label'])); ?>

                                        <?php echo e(Form::date('due_date',null,array('class'=>'form-control','required'=>'required'))); ?>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php echo e(Form::label('bill_number', __('Bill Number'),['class'=>'form-label'])); ?>

                                        <input type="text" class="form-control" value="<?php echo e($bill_number); ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php echo e(Form::label('category_id', __('Category'),['class'=>'form-label'])); ?>

                                        <?php echo e(Form::select('category_id', $category,null, array('class' => 'form-control select'))); ?>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php echo e(Form::label('order_number', __('Order Number'),['class'=>'form-label'])); ?>

                                        <?php echo e(Form::number('order_number', null, array('class' => 'form-control'))); ?>

                                    </div>
                                </div>

                                <?php if(!$customFields->isEmpty()): ?>
                                    <div class="col-md-6">
                                        <div class="tab-pane fade show" id="tab-2" role="tabpanel">
                                            <?php echo $__env->make('customFields.formBuilder', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-12">
            <h5 class=" d-inline-block mb-4"><?php echo e(__('Product & Services')); ?></h5>
            <div class="card repeater" data-value='<?php echo json_encode($items); ?>'>
                <div class="item-section py-2">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-md-12 d-flex align-items-center justify-content-between justify-content-md-end">
                            <div class="all-button-box me-2">
                                <a href="#" data-repeater-create="" class="btn btn-primary" data-bs-toggle="modal" data-target="#add-bank">
                                    <i class="ti ti-plus"></i> <?php echo e(__('Add item')); ?>

                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table mb-0" data-repeater-list="items" id="sortable-table">
                            <thead>
                                <tr>
                                <th width="20%"><?php echo e(__('Items')); ?></th>
                                <th><?php echo e(__('Quantity')); ?></th>
                                <th><?php echo e(__('Price')); ?> </th>
                                <th><?php echo e(__('Discount')); ?></th>
                                <th><?php echo e(__('Tax')); ?> (%)</th>
                                <th class="text-end"><?php echo e(__('Amount')); ?>

                                    <br><small class="text-danger font-bold"><?php echo e(__('after tax & discount')); ?></small>
                                </th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody class="ui-sortable" data-repeater-item>
                                <tr>
                                    <?php echo e(Form::hidden('id',null, array('class' => 'form-control id'))); ?>

                                    <?php echo e(Form::hidden('account_id',null, array('class' => 'form-control account_id'))); ?>

                                    <td width="25%" class="form-group pt-0">
                                        <?php echo e(Form::select('items', $product_services,null, array('class' => 'form-control select item','data-url'=>route('bill.product')))); ?>

                                    </td>
                                    <td>
                                        <div class="form-group price-input input-group search-form">
                                            <?php echo e(Form::text('quantity',null, array('class' => 'form-control quantity','placeholder'=>__('Qty')))); ?>

                                            <span class="unit input-group-text bg-transparent"></span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group price-input input-group search-form">
                                            <?php echo e(Form::text('price',null, array('class' => 'form-control price','placeholder'=>__('Price')))); ?>

                                            <span class="input-group-text bg-transparent"><?php echo e(\Auth::user()->currencySymbol()); ?></span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group price-input input-group search-form">
                                            <?php echo e(Form::text('discount',null, array('class' => 'form-control discount','placeholder'=>__('Discount')))); ?>

                                            <span class="input-group-text bg-transparent"><?php echo e(\Auth::user()->currencySymbol()); ?></span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="taxes"></div>
                                                <?php echo e(Form::hidden('tax','', array('class' => 'form-control tax'))); ?>

                                                <?php echo e(Form::hidden('itemTaxPrice','', array('class' => 'form-control itemTaxPrice'))); ?>

                                                <?php echo e(Form::hidden('itemTaxRate','', array('class' => 'form-control itemTaxRate'))); ?>

                                            </div>
                                        </div>
                                    </td>

                                    <td class="text-end amount">
                                        0.00
                                    </td>

                                    <td>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete proposal product')): ?>
                                            <a href="#" class="ti ti-trash text-white repeater-action-btn bg-danger ms-2 bs-pass-para" data-repeater-delete></a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="form-group">
                                        
                                        <select name="chart_account_id" class="form-control">
                                            <?php $__currentLoopData = $chartAccounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $chartAccount): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($key); ?>" class="subAccount"><?php echo e($chartAccount); ?></option>
                                                <?php $__currentLoopData = $subAccounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subAccount): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($key == $subAccount['account']): ?>
                                                        <option value="<?php echo e($subAccount['id']); ?>" class="ms-5"> &nbsp; &nbsp;&nbsp; <?php echo e($subAccount['name']); ?></option>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </td>
                                    <td class="form-group">
                                        <div class="input-group ">
                                            <?php echo e(Form::text('amount',null, array('class' => 'form-control accountAmount','placeholder'=>__('Amount')))); ?>

                                            <span class="input-group-text bg-transparent"><?php echo e(\Auth::user()->currencySymbol()); ?></span>
                                        </div>
                                    </td>

                                    <td colspan="2" class="form-group">
                                            <?php echo e(Form::textarea('description', null, ['class'=>'form-control pro_description','rows'=>'1','placeholder'=>__('Description')])); ?>

                                    </td>
                                    <td></td>
                                    <td class="text-end accountamount">
                                        0.00
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td></td>
                                    <td><strong><?php echo e(__('Sub Total')); ?> (<?php echo e(\Auth::user()->currencySymbol()); ?>)</strong></td>
                                    <td class="text-end subTotal">0.00</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td></td>
                                    <td><strong><?php echo e(__('Discount')); ?> (<?php echo e(\Auth::user()->currencySymbol()); ?>)</strong></td>
                                    <td class="text-end totalDiscount">0.00</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td></td>
                                    <td><strong><?php echo e(__('Tax')); ?> (<?php echo e(\Auth::user()->currencySymbol()); ?>)</strong></td>
                                    <td class="text-end totalTax">0.00</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td class="blue-text"><strong><?php echo e(__('Total Amount')); ?> (<?php echo e(\Auth::user()->currencySymbol()); ?>)</strong></td>
                                    <td class="blue-text text-end totalAmount">0.00</td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <input type="button" value="<?php echo e(__('Cancel')); ?>" onclick="location.href = '<?php echo e(route("bill.index")); ?>';" class="btn btn-light me-3">
            <input type="submit" value="<?php echo e(__('Update')); ?>" class="btn btn-primary">
        </div>
        <?php echo e(Form::close()); ?>

    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/integra.platformbisnis.com/public_html/resources/views/bill/edit.blade.php ENDPATH**/ ?>