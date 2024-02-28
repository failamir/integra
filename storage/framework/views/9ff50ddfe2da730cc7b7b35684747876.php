<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Monthly Attendance')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Monthly Attendance')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
    <script type="text/javascript" src="<?php echo e(asset('js/html2pdf.bundle.min.js')); ?>"></script>
    <script>
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

    <script>

        $(document).ready(function () {
            var b_id = $('#branch_id').val();
            // getDepartment(b_id);
        });
        $(document).on('change', 'select[name=branch_id]', function () {

            var branch_id = $(this).val();
            getDepartment(branch_id);
        });

        function getDepartment(bid) {

            $.ajax({
                url: '<?php echo e(route('report.attendance.getdepartment')); ?>',
                type: 'POST',
                data: {
                    "branch_id": bid,
                    "_token": "<?php echo e(csrf_token()); ?>",
                },

                success: function (data) {
                    //console.log(data);
                    $('#department_id').empty();
                    $("#department_div").html('');
                    $('#department_div').append('<label for="department" class="form-label"><?php echo e(__('Department')); ?></label><select class="form-control" id="department_id" name="department_id[]"  ></select>');
                    $('#department_id').append('<option value=""><?php echo e(__('Select Department')); ?></option>');
                    $('#department_id').append('<option value="0"> <?php echo e(__('All Department')); ?> </option>');
                    $.each(data, function (key, value) {
                        //console.log(key, value);
                        $('#department_id').append('<option value="' + key + '">' + value + '</option>');
                    });
                    // var multipleCancelButton = new Choices('#department_id', {
                    //     removeItemButton: true,
                    // });


                }

            });
        }

        $(document).on('change', '#department_id', function () {
            var department_id = $(this).val();
            getEmployee(department_id);
        });

        function getEmployee(did) {
            $.ajax({
                url: '<?php echo e(route('report.attendance.getemployee')); ?>',
                type: 'POST',
                data: {
                    "department_id": did, "_token": "<?php echo e(csrf_token()); ?>",
                },
                success: function (data) {
                    console.log(data);
                    $('#employee_id').empty();
                    $("#employee_div").html('');
                    // $('#employee_div').append('<select class="form-control" id="employee_id" name="employee_id[]"  multiple></select>');
                    $('#employee_div').append('<label for="employee" class="form-label"><?php echo e(__('Employee')); ?></label><select class="form-control" id="employee_id" name="employee_id[]"  multiple></select>');
                    $('#employee_id').append('<option value=""><?php echo e(__('Select Employee')); ?></option>');
                    $('#employee_id').append('<option value="0"> <?php echo e(__('All Employee')); ?> </option>');

                    $.each(data, function (key, value) {
                        $('#employee_id').append('<option value="' + key + '">' + value + '</option>');
                    });

                    var multipleCancelButton = new Choices('#employee_id', {
                        removeItemButton: true,
                    });
                }
            });
        }
    </script>
<?php $__env->stopPush(); ?>



<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        <a href="#" class="btn btn-sm btn-primary" onclick="saveAsPDF()" data-bs-toggle="tooltip" title="<?php echo e(__('Download')); ?>"
           data-original-title="<?php echo e(__('Download')); ?>">
            <span class="btn-inner--icon"><i class="ti ti-download"></i></span>
        </a>





    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-12">
            <div class=" mt-2 " id="multiCollapseExample1">
                <div class="card">
                    <div class="card-body">
                        <?php echo e(Form::open(array('route' => array('report.monthly.attendance'),'method'=>'get','id'=>'report_monthly_attendance'))); ?>

                        <div class="row align-items-center justify-content-end">
                            <div class="col-xl-10">
                                <div class="row">
                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                        <div class="btn-box">
                                            <?php echo e(Form::label('month',__('Month'),['class'=>'form-label'])); ?>

                                            <?php echo e(Form::month('month',isset($_GET['month'])?$_GET['month']:date('Y-m'),array('class'=>'month-btn form-control'))); ?>

                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                        <div class="btn-box">
                                            <?php echo e(Form::label('branch', __('Branch'),['class'=>'form-label'])); ?>



                                            <select class="form-control select" name="branch_id" id="branch_id"  placeholder="Select Branch" required>
                                                <option value=""><?php echo e(__('Select Branch')); ?></option>
                                                <option value="0"><?php echo e(__('All Branch')); ?></option>
                                                <?php $__currentLoopData = $branch; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($branch->id); ?>"><?php echo e($branch->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                        <div class="btn-box" id="department_div">
                                            <?php echo e(Form::label('department', __('Department'),['class'=>'form-label'])); ?>


                                            <select class="form-control select" name="department_id[]" id="department_id" required="required" placeholder="Select Department" >
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                        <div class="btn-box" id="employee_div">
                                            <?php echo e(Form::label('employee', __('Employee'),['class'=>'form-label'])); ?>

                                            <select class="form-control select" name="employee_id[]" id="employee_id" placeholder="Select Employee" >
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="row">
                                    <div class="col-auto mt-4">
                                        <a href="#" class="btn btn-sm btn-primary" onclick="document.getElementById('report_monthly_attendance').submit(); return false;" data-bs-toggle="tooltip" title="<?php echo e(__('Apply')); ?>" data-original-title="<?php echo e(__('apply')); ?>">
                                            <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                                        </a>
                                        <a href="<?php echo e(route('report.monthly.attendance')); ?>" class="btn btn-sm btn-danger " data-bs-toggle="tooltip"  title="<?php echo e(__('Reset')); ?>" data-original-title="<?php echo e(__('Reset')); ?>">
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
        <div class="row">
            <div class="col">
                <input type="hidden" value="<?php echo e($data['branch'] .' '.__('Branch') .' '.$data['curMonth'].' '.__('Attendance Report of').' '. $data['department'].' '.'Department'); ?>" id="filename">
                <div class="card p-4 mb-4">
                    <h6 class="mb-0"><?php echo e(__('Report')); ?> :</h6>
                    <h7 class="text-sm mb-0"><?php echo e(__('Attendance Summary')); ?></h7>
                </div>
            </div>
            <?php if($data['branch']!='All'): ?>
                <div class="col">
                    <div class="card p-4 mb-4">
                        <h6 class=" mb-0"><?php echo e(__('Branch')); ?> :</h6>
                        <h7 class="text-sm mb-0"><?php echo e($data['branch']); ?></h7>
                    </div>
                </div>
            <?php endif; ?>
            <?php if($data['department']!='All'): ?>
                <div class="col">
                    <div class="card p-4 mb-4">
                        <h6 class=" mb-0"><?php echo e(__('Department')); ?> :</h6>
                        <h7 class="text-sm mb-0"><?php echo e($data['department']); ?></h7>
                    </div>
                </div>
            <?php endif; ?>
            <div class="col">
                <div class="card p-4 mb-4">
                    <h6 class=" mb-0"><?php echo e(__('Duration')); ?> :</h6>
                    <h7 class="text-sm mb-0"><?php echo e($data['curMonth']); ?></h7>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-xl-3 col-md-6 col-lg-3">
                <div class="card p-4 mb-4 ">
                    <div class="float-left">
                        <h6 class=" mb-0"><?php echo e(__('Attendance')); ?></h6>
                        <h7 class="text-sm text-sm mb-0 float-start"><?php echo e(__('Total present')); ?>: <?php echo e($data['totalPresent']); ?></h7>
                        <h7 class="text-sm mb-0 float-end"><?php echo e(__('Total leave')); ?> : <?php echo e($data['totalLeave']); ?></h7>
                    </div>

                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-lg-3">
                <div class="card p-4 mb-4">
                    <h6 class=" mb-0"><?php echo e(__('Overtime')); ?></h6>
                    <h7 class="text-sm mb-0"><?php echo e(__('Total overtime in hours')); ?> : <?php echo e(number_format($data['totalOvertime'],2)); ?></h7>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-lg-3">
                <div class="card p-4 mb-4">
                    <h6 class=" mb-0"><?php echo e(__('Early leave')); ?></h6>
                    <h7 class="text-sm mb-0"><?php echo e(__('Total early leave in hours')); ?> : <?php echo e(number_format($data['totalEarlyLeave'],2)); ?></h7>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-lg-3">
                <div class="card p-4 mb-4">
                    <h6 class=" mb-0"><?php echo e(__('Employee late')); ?></h6>
                    <h7 class="text-sm mb-0"><?php echo e(__('Total late in hours')); ?> : <?php echo e(number_format($data['totalLate'],2)); ?></h7>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body table-border-style">
                        <div class="table-responsive py-4 attendance-table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="active"><?php echo e(__('Name')); ?></th>
                                    <?php $__currentLoopData = $dates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $date): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <th><?php echo e($date); ?></th>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tr>
                                </thead>
                                <tbody>

                                <?php $__currentLoopData = $employeesAttendance; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attendance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <tr>
                                        <td><?php echo e($attendance['name']); ?></td>
                                        <?php $__currentLoopData = $attendance['status']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <td>
                                                <?php if($status=='P'): ?>

                                                    <i class="badge bg-success p-2 rounded"><?php echo e(__('P')); ?></i>
                                                <?php elseif($status=='A'): ?>
                                                    <i class="badge bg-danger p-2 rounded"><?php echo e(__('A')); ?></i>
                                                <?php endif; ?>
                                            </td>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/integra.platformbisnis.com/public_html/resources/views/report/monthlyAttendance.blade.php ENDPATH**/ ?>