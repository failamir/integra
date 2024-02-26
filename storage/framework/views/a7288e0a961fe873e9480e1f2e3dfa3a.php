<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Journal Entry Edit')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Double Entry')); ?></li>
    <li class="breadcrumb-item"><?php echo e(__('Journal Entry')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
    <script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jquery.repeater.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jquery-searchbox.js')); ?>"></script>
    <script>
        var selector = "body";
        if ($(selector + " .repeater").length) {
            // var $dragAndDrop = $("body .repeater tbody").sortable({
            //     handle: '.sort-handler'
            // });
            var $repeater = $(selector + ' .repeater').repeater({
                initEmpty: false,
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
                    if (confirm('Are you sure you want to delete this element?')) {
                        $(this).slideUp(deleteElement);
                        $(this).remove();


                        var inputs = $(".debit");
                        var totalDebit = 0;
                        for (var i = 0; i < inputs.length; i++) {
                            totalDebit = parseFloat(totalDebit) + parseFloat($(inputs[i]).val());
                        }
                        $('.totalDebit').html(totalDebit.toFixed(2));


                        var inputs = $(".credit");
                        var totalCredit = 0;
                        for (var i = 0; i < inputs.length; i++) {
                            totalCredit = parseFloat(totalCredit) + parseFloat($(inputs[i]).val());
                        }
                        $('.totalCredit').html(totalCredit.toFixed(2));

                        var id = $(this).find('.id').val();

                        $.ajax({
                            url: '<?php echo e(route('journal.account.destroy')); ?>',
                            type: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': jQuery('#token').val()
                            },
                            data: {
                                'id': id
                            },
                            cache: false,
                            success: function (data) {

                            },
                        });


                    }
                },
                // ready: function (setIndexes) {
                //     $dragAndDrop.on('drop', setIndexes);
                // },
                isFirstItemUndeletable: true
            });
            var value = $(selector + " .repeater").attr('data-value');

            if (typeof value != 'undefined' && value.length != 0) {
                value = JSON.parse(value);
                $repeater.setList(value);
                for (var i = 0; i < value.length; i++) {
                    var credit = value[i]['credit'];
                    var debit = value[i]['debit'];

                    if(credit > 0){
                        $('.credit').trigger('keyup');
                    }else{
                        // $('.debit').trigger('keyup');
                    }
                }
            }

        }

        $(document).on('keyup', '.debit', function () {
            var el = $(this).parent().parent().parent().parent();
            var debit = $(this).val();
            var credit = 0;
            el.find('.credit').val(credit);

            el.find('.amount').html(debit);

            var inputs = $(".debit");
            var totalDebit = 0;
            for (var i = 0; i < inputs.length; i++) {
                totalDebit = parseFloat(totalDebit) + parseFloat($(inputs[i]).val());
            }
            $('.totalDebit').html(totalDebit.toFixed(2));

            el.find('.credit').attr("disabled", true);
            if (debit == '') {
                el.find('.credit').attr("disabled", false);
            }
        })

        $(document).on('keyup', '.credit', function () {
            var el = $(this).parent().parent().parent().parent();
            var credit = $(this).val();
            var debit = 0;
            el.find('.debit').val(debit);
            el.find('.amount').html(credit);

            var inputs = $(".credit");
            var totalCredit = 0;
            for (var i = 0; i < inputs.length; i++) {
                totalCredit = parseFloat(totalCredit) + parseFloat($(inputs[i]).val());
            }
            $('.totalCredit').html(totalCredit.toFixed(2));

            el.find('.debit').attr("disabled", true);
            if (credit == '') {
                el.find('.debit').attr("disabled", false);
            }
        })


        var value = $(selector + " .repeater").attr('data-value');
        var inputs = $(".credit");

        if (typeof value != 'undefined' && value.length != 0) {
            value = JSON.parse(value);
            $repeater.setList(value);
            for (var i = 0; i < value.length; i++) {
                var credit = value[i]['credit'];
                var debit = value[i]['debit'];
                if(credit > 0){
                    $('input[name="accounts['+i+'][credit]"]').trigger('keyup');
                }
                if(debit > 0){
                    $('input[name="accounts['+i+'][debit]"]').trigger('keyup');
                }
            }
        }

    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('action-btn'); ?>
    <?php
                           $user = \App\Models\User::find(\Auth::user()->creatorId());
                    $plan= \App\Models\Plan::getPlan($user->plan);
    ?>
    <?php if($plan->chatgpt == 1): ?>
    <div class="float-end">
        <a href="#" data-size="md" class="btn  btn-primary btn-icon btn-sm" data-ajax-popup-over="true" data-url="<?php echo e(route('generate',['journal entry'])); ?>"
           data-bs-placement="top" data-title="<?php echo e(__('Generate content with AI')); ?>">
            <i class="fas fa-robot"></i> <span><?php echo e(__('Generate with AI')); ?></span>
        </a>
    </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

    <?php echo e(Form::model($journalEntry, array('route' => array('journal-entry.update', $journalEntry->id), 'method' => 'PUT','class'=>'w-100'))); ?>

    <input type="hidden" name="_token" id="token" value="<?php echo e(csrf_token()); ?>">
    <div class="row mt-4">
        <div class="col-xl-12">
            <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="form-group">
                        <?php echo e(Form::label('journal_number', __('Journal Number'),['class'=>'form-label'])); ?>

                        <div class="form-icon-user">
                            <input type="text" class="form-control" value="<?php echo e(\Auth::user()->journalNumberFormat($journalEntry->journal_id)); ?>" readonly>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="form-group">
                        <?php echo e(Form::label('date', __('Transaction Date'),['class'=>'form-label'])); ?>

                        <div class="form-icon-user">
                            <?php echo e(Form::date('date',null,array('class'=>'form-control','required'=>'required'))); ?>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="form-group">
                        <?php echo e(Form::label('reference', __('Reference'),['class'=>'form-label'])); ?>

                        <div class="form-icon-user">
                            <?php echo e(Form::text('reference', null, array('class' => 'form-control'))); ?>

                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8">
                    <div class="form-group">
                        <?php echo e(Form::label('description', __('Description'),['class'=>'form-label'])); ?>

                        <?php echo e(Form::textarea('description', null, array('class' => 'form-control','rows'=>'2'))); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card repeater" data-value='<?php echo json_encode($journalEntry->accounts); ?>'>
                <div class="item-section py-4">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-md-12 d-flex align-items-center justify-content-between justify-content-md-end">
                            <div class="all-button-box">
                                <a href="#" data-repeater-create="" class="btn btn-primary me-4" data-toggle="modal" data-target="#add-bank">
                                    <i class="ti ti-plus"></i> <?php echo e(__('Add Account')); ?>

                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table mb-0" data-repeater-list="accounts" id="sortable-table">
                            <thead>
                            <tr>
                                <th><?php echo e(__('Account')); ?></th>
                                <th><?php echo e(__('Debit')); ?></th>
                                <th><?php echo e(__('Credit')); ?> </th>
                                <th><?php echo e(__('Description')); ?></th>
                                <th class="text-end"><?php echo e(__('Amount')); ?> </th>
                                <th width="2%"></th>
                            </tr>
                            </thead>

                            <tbody class="ui-sortable" data-repeater-item>

                            <tr>
                                <?php echo e(Form::hidden('id',null, array('class' => 'form-control id'))); ?>








                                <td width="25%" class="form-group pt-0">
                                    
                                    <select name="account" class="form-control" required="required">
                                        <?php $__currentLoopData = $chartAccounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chartAccount): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($chartAccount['id']); ?>" class="subAccount"><?php echo e($chartAccount['code_name']); ?></option>
                                            <?php $__currentLoopData = $subAccounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subAccount): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($chartAccount['id'] == $subAccount['account']): ?>
                                                    <option value="<?php echo e($subAccount['id']); ?>" class="ms-5"> &nbsp; &nbsp;&nbsp; <?php echo e($subAccount['code_name']); ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </td>
                                
                                <td>
                                    <div class="form-group price-input">
                                        <?php echo e(Form::text('debit','', array('class' => 'form-control debit','required'=>'required','placeholder'=>__('Debit'),'required'=>'required'))); ?>

                                    </div>
                                </td>
                                <td>
                                    <div class="form-group price-input">
                                        <?php echo e(Form::text('credit','', array('class' => 'form-control credit','required'=>'required','placeholder'=>__('Credit'),'required'=>'required'))); ?>

                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <?php echo e(Form::text('description',null, array('class' => 'form-control','placeholder'=>__('Description')))); ?>

                                    </div>
                                </td>
                                <td class="text-end amount">0.00</td>
                                <td>
                                    <a href="#" class="ti ti-trash text-white text-danger" data-repeater-delete></a>
                                </td>
                            </tr>
                            </tbody>
                            <tfoot>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td></td>
                                <td class="text-end"><strong><?php echo e(__('Total Credit')); ?> (<?php echo e(\Auth::user()->currencySymbol()); ?>)</strong></td>
                                <td class="text-end totalCredit">0.00</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td class="text-end"><strong><?php echo e(__('Total Debit')); ?> (<?php echo e(\Auth::user()->currencySymbol()); ?>)</strong></td>
                                <td class="text-end totalDebit">0.00</td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <input type="button" value="<?php echo e(__('Cancel')); ?>" onclick="location.href = '<?php echo e(route("journal-entry.index")); ?>';" class="btn btn-light">
        <input type="submit" value="<?php echo e(__('Update')); ?>" class="btn btn-primary">
    </div>
    <?php echo e(Form::close()); ?>


<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/integra.platformbisnis.com/public_html/resources/views/journalEntry/edit.blade.php ENDPATH**/ ?>