<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('POS Detail')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
    <script>
        $(document).on('click', '#shipping', function () {
            var url = $(this).data('url');
            var is_display = $("#shipping").is(":checked");
            $.ajax({
                url: url,
                type: 'get',
                data: {
                    'is_display': is_display,
                },
                success: function (data) {
                    // console.log(data);
                }
            });
        })
    </script>
<?php $__env->stopPush(); ?>

<?php
    $settings = Utility::settings();
?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><a href="<?php echo e(route('pos.report')); ?>"><?php echo e(__('POS Summary')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(AUth::user()->posNumberFormat($pos->pos_id)); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        <a href="<?php echo e(route('pos.pdf', Crypt::encrypt($pos->id))); ?>" class="btn btn-primary" target="_blank"><?php echo e(__('Download')); ?></a>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mt-2">
                        <div class="col-xs-12 col-sm-12 col-nd-6 col-lg-6 col-12">
                            <h4><?php echo e(__('POS')); ?></h4>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-nd-6 col-lg-6 col-12 text-end">
                            <h4 class="invoice-number"><?php echo e(Auth::user()->posNumberFormat($pos->pos_id)); ?></h4>
                        </div>
                        <div class="col-12">
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-5">
                            <small class="font-style">
                                <strong><?php echo e(__('Billed To')); ?> :</strong><br>
                                <?php if(!empty($customer->billing_name)): ?>
                                    <?php echo e(!empty($customer->billing_name)?$customer->billing_name:''); ?><br>
                                    <?php echo e(!empty($customer->billing_address)?$customer->billing_address:''); ?><br>
                                    <?php echo e(!empty($customer->billing_city)?$customer->billing_city:'' .', '); ?><br>
                                    <?php echo e(!empty($customer->billing_state)?$customer->billing_state:'',', '); ?>,
                                    <?php echo e(!empty($customer->billing_zip)?$customer->billing_zip:''); ?><br>
                                    <?php echo e(!empty($customer->billing_country)?$customer->billing_country:''); ?><br>
                                    <?php echo e(!empty($customer->billing_phone)?$customer->billing_phone:''); ?><br>
                                    <?php if($settings['vat_gst_number_switch'] == 'on'): ?>
                                    <strong><?php echo e(__('Tax Number ')); ?> : </strong><?php echo e(!empty($customer->tax_number)?$customer->tax_number:''); ?>

                                    <?php endif; ?>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </small>
                        </div>
                        <div class="col-4">
                            <?php if(App\Models\Utility::getValByName('shipping_display')=='on'): ?>
                                <small>
                                    <strong><?php echo e(__('Shipped To')); ?> :</strong><br>
                                        <?php if(!empty($customer->shipping_name)): ?>
                                        <?php echo e(!empty($customer->shipping_name)?$customer->shipping_name:''); ?><br>
                                        <?php echo e(!empty($customer->shipping_address)?$customer->shipping_address:''); ?><br>
                                        <?php echo e(!empty($customer->shipping_city)?$customer->shipping_city:'' . ', '); ?><br>
                                        <?php echo e(!empty($customer->shipping_state)?$customer->shipping_state:'' .', '); ?>,
                                        <?php echo e(!empty($customer->shipping_zip)?$customer->shipping_zip:''); ?><br>
                                        <?php echo e(!empty($customer->shipping_country)?$customer->shipping_country:''); ?><br>
                                        <?php echo e(!empty($customer->shipping_phone)?$customer->shipping_phone:''); ?><br>
                                    <?php else: ?>
                                    -
                                    <?php endif; ?>
                                </small>
                            <?php endif; ?>
                        </div>
                        <div class="col-3">
                            <div class="d-flex align-items-center justify-content-end">
                                <div class="me-4">
                                    <small>
                                        <strong><?php echo e(__('Issue Date')); ?> :</strong>
                                        <?php echo e(\Auth::user()->dateFormat($pos->purchase_date)); ?><br><br>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="table-responsive mt-3">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th class="text-dark" >#</th>
                                        <th class="text-dark"><?php echo e(__('Items')); ?></th>
                                        <th class="text-dark"><?php echo e(__('Quantity')); ?></th>
                                        <th class="text-dark"><?php echo e(__('Price')); ?></th>
                                        <th class="text-dark"><?php echo e(__('Tax')); ?></th>
                                        <th class="text-dark"><?php echo e(__('Tax Amount')); ?></th>
                                        <th class="text-dark"><?php echo e(__('Total')); ?></th>
                                    </tr>
                                    </thead>
                                    <?php
                                        $totalQuantity=0;
                                        $totalRate=0;
                                        $totalTaxPrice=0;
                                        $totalDiscount=0;
                                        $taxesData=[];
                                    ?>
                                    <?php $__currentLoopData = $iteams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$iteam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(!empty($iteam->tax)): ?>
                                            <?php
                                                $taxes=App\Models\Utility::tax($iteam->tax);
                                                $totalQuantity+=$iteam->quantity;
                                                $totalRate+=$iteam->price;
                                                $totalDiscount+=$iteam->discount;
                                                foreach($taxes as $taxe){

                                                    $taxDataPrice=App\Models\Utility::taxRate($taxe->rate,$iteam->price,$iteam->quantity);
                                                    if (array_key_exists($taxe->name,$taxesData))
                                                    {
                                                        $taxesData[$taxe->name] = $taxesData[$taxe->name]+$taxDataPrice;
                                                    }
                                                    else
                                                    {
                                                        $taxesData[$taxe->name] = $taxDataPrice;
                                                    }
                                                }
                                            ?>
                                        <?php endif; ?>
                                        <tr>
                                            <td><?php echo e($key+1); ?></td>
                                            <td><?php echo e(!empty($iteam->product())?$iteam->product()->name:''); ?></td>
                                            <td><?php echo e($iteam->quantity); ?></td>
                                            <td><?php echo e(\Auth::user()->priceFormat($iteam->price)); ?></td>
                                            <td>
                                                <?php if(!empty($iteam->tax)): ?>
                                                    <table>
                                                        <?php
                                                            $totalTaxRate = 0;
                                                            $totalTaxPrice = 0;
                                                        ?>
                                                        <?php $__currentLoopData = $taxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php
                                                                $taxPrice=App\Models\Utility::taxRate($tax->rate,$iteam->price,$iteam->quantity);
                                                                $totalTaxPrice+=$taxPrice;
                                                            ?>
                                                            <tr>
                                                                <span class="badge bg-primary"><?php echo e($tax->name .' ('.$tax->rate .'%)'); ?></span> <br>
                                                            </tr>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </table>
                                                <?php else: ?>
                                                    -
                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo e(\Auth::user()->priceFormat($totalTaxPrice)); ?></td>
                                            <td ><?php echo e(\Auth::user()->priceFormat(($iteam->price*$iteam->quantity) + $totalTaxPrice)); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    <tr>
                                        <td><b><?php echo e(__(' Sub Total')); ?></b></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><?php echo e(\Auth::user()->priceFormat($posPayment['amount'])); ?></td>
                                    </tr>
                                    <tr>
                                        <td><b><?php echo e(__('Discount')); ?></b></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><?php echo e(\Auth::user()->priceFormat($posPayment['discount'])); ?></td>
                                    </tr>
                                    <tr class="pos-header">
                                        <td><b><?php echo e(__('Total')); ?></b></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><?php echo e(\Auth::user()->priceFormat($posPayment['discount_amount'])); ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/integra.platformbisnis.com/public_html/resources/views/pos/view.blade.php ENDPATH**/ ?>