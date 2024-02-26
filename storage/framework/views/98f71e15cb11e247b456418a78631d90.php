<?php
    $logo=\App\Models\Utility::get_file('uploads/logo');
    $company_logo=Utility::getValByName('company_logo');
?>

<?php if(!empty($sales) && count($sales) > 0): ?>
    <div class="card">
        <div class="card-body">
            <div class="row mt-2">
                <div class="col-6">
                    <img src="<?php echo e($logo.'/'.(isset($company_logo) && !empty($company_logo)?$company_logo:'logo-dark.png')); ?>" width="120px;">
                </div>



            </div>
            <div id="printableArea">
                <div class="row mt-3">
                    <div class="col-6">
                        <h1 class="invoice-id h6"><?php echo e($details['pos_id']); ?></h1>
                        <div class="date"><b><?php echo e(__('Date')); ?>: </b><?php echo e($details['date']); ?></div>
                    </div>
                    <div class="col-6 text-end">
                        <div class="text-dark "><b><?php echo e(__('Warehouse Name')); ?>: </b>
                            <?php echo $details['warehouse']['details']; ?>

                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col contacts d-flex justify-content-between pb-4">
                        <div class="invoice-to">
                            <div class="text-dark h6"><b><?php echo e(__('Billed To :')); ?></b></div>
                            <?php echo $details['customer']['details']; ?>

                        </div>
                        <?php if(!empty( $details['customer']['shippdetails'])): ?>
                            <div class="invoice-to">
                                <div class="text-dark h6"><b><?php echo e(__('Shipped To :')); ?></b></div>
                                <?php echo $details['customer']['shippdetails']; ?>

                            </div>
                        <?php endif; ?>
                        <div class="company-details">
                            <div class="text-dark h6"><b><?php echo e(__('From:')); ?></b></div>
                            <?php echo $details['user']['details']; ?>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <table class="table">
                        <thead>
                        <tr>
                            <th class="text-left"><?php echo e(__('Items')); ?></th>
                            <th><?php echo e(__('Quantity')); ?></th>
                            <th class="text-right"><?php echo e(__('Price')); ?></th>
                            <th class="text-right"><?php echo e(__('Tax')); ?></th>
                            <th class="text-right"><?php echo e(__('Tax Amount')); ?></th>
                            <th class="text-right"><?php echo e(__('Total')); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $sales['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <tr>
                                <td class="cart-summary-table text-left">
                                    <?php echo e($value['name']); ?>

                                </td>
                                <td class="cart-summary-table">
                                    <?php echo e($value['quantity']); ?>

                                </td>
                                <td class="text-right cart-summary-table">
                                    <?php echo e($value['price']); ?>

                                </td>
                                <td class="text-right cart-summary-table">
                                    <?php echo $value['product_tax']; ?>

                                </td>


                                <td class="text-right cart-summary-table">
                                    <?php echo e($value['tax_amount']); ?>

                                </td>
                                <td class="text-right cart-summary-table">
                                    <?php echo e($value['subtotal']); ?>

                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <td class=""><?php echo e(__('Sub Total')); ?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-right"><?php echo e($sales['sub_total']); ?></td>
                        </tr>
                        <tr>
                            <td class=""><?php echo e(__('Discount')); ?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-right"><?php echo e($sales['discount']); ?></td>
                        </tr>
                        <tr class="pos-header">
                            <td class=""><?php echo e(__('Total')); ?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-right"><?php echo e($sales['total']); ?></td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <?php if($details['pay'] == 'show'): ?>



                <button class="btn btn-success payment-done-btn rounded mt-2 float-right" data-url="<?php echo e(route('pos.printview')); ?>" data-ajax-popup="true" data-size="sm"
                        data-bs-toggle="tooltip" data-title="<?php echo e(__('POS Invoice')); ?>">
                    <?php echo e(__('Cash Payment')); ?>

                </button>

            <?php endif; ?>
        </div>
    </div>

<?php endif; ?>


<script type="text/javascript" src="<?php echo e(asset('js/html2pdf.bundle.min.js')); ?>"></script>
<script>

    var filename = $('#filename').val()

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

    $(document).on('click', '.payment-done-btn', function (e) {
        e.preventDefault();
        var ele = $(this);

        $.ajax({
            url: "<?php echo e(route('pos.data.store')); ?>",

            method: 'GET',
            data: {
                vc_name: $('#vc_name_hidden').val(),
                warehouse_name: $('#warehouse_name_hidden').val(),
                discount : $('#discount_hidden').val(),
                quotation_id : $('#quotation_id').val(),

            },
            beforeSend: function () {
                ele.remove();
            },
            success: function (data) {
                // console.log(data);
                // return false;
                if (data.code == 200) {
                    $('#carthtml').load(document.URL +  ' #carthtml');
                    show_toastr('success', data.success, 'success')
                }
                // setTimeout(function () {
                //     window.location.reload();
                // }, 1000);
            },
            error: function (data) {
                data = data.responseJSON;
                show_toastr('<?php echo e(__("Error")); ?>', data.error, 'error');
            }

        });
    });
</script>
<?php /**PATH /home/integra.platformbisnis.com/public_html/resources/views/pos/show.blade.php ENDPATH**/ ?>