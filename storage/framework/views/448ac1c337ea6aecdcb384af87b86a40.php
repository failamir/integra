<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Job Application')); ?>

<?php $__env->stopSection(); ?>
<?php
    $logo=\App\Models\Utility::get_file('uploads/avatar/');
    $profile=\App\Models\Utility::get_file('uploads/job/profile/');
?>
<?php $__env->startPush('css-page'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/plugins/dragula.min.css')); ?>" id="main-style-link">
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script-page'); ?>
    
    <script src="<?php echo e(asset('assets/js/plugins/dragula.min.js')); ?>"></script>

    <script>
        $(document).on('change', '#jobs', function () {

            var id = $(this).val();

            $.ajax({
                url: "<?php echo e(route('get.job.application')); ?>",
                type: 'POST',
                data: {
                    "id": id,
                    "_token": "<?php echo e(csrf_token()); ?>",
                },
                success: function (data) {
                    var job = JSON.parse(data);
                    // console.log(job)
                    var applicant = job.applicant;
                    var visibility = job.visibility;
                    var question = job.custom_question;

                    (applicant.indexOf("gender") != -1) ? $('.gender').removeClass('d-none') : $(
                        '.gender').addClass('d-none');
                    (applicant.indexOf("dob") != -1) ? $('.dob').removeClass('d-none') : $('.dob')
                        .addClass('d-none');
                    (applicant.indexOf("country") != -1) ? $('.country').removeClass('d-none') : $(
                        '.country').addClass('d-none');

                    (visibility.indexOf("profile") != -1) ? $('.profile').removeClass('d-none') : $(
                        '.profile').addClass('d-none');
                    (visibility.indexOf("resume") != -1) ? $('.resume').removeClass('d-none') : $(
                        '.resume').addClass('d-none');
                    (visibility.indexOf("letter") != -1) ? $('.letter').removeClass('d-none') : $(
                        '.letter').addClass('d-none');

                    $('.question').addClass('d-none');
                    // $('.question').removeAttr('required');

                    if (question.length > 0) {
                        question.forEach(function (id) {
                            $('.question_' + id + '').removeClass('d-none');
                        });
                    }


                }
            });
        });

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('move job application')): ?>
            !function (a) {
            "use strict";

            var t = function () {
                this.$body = a("body")
            };
            t.prototype.init = function () {
                // console.log(t);
                a('[data-plugin="dragula"]').each(function () {

                    //   console.log(t);
                    var t = a(this).data("containers"),

                        n = [];
                    if (t)
                        for (var i = 0; i < t.length; i++) n.push(a("#" + t[i])[0]);
                    else n = [a(this)[0]];
                    var r = a(this).data("handleclass");
                    r ? dragula(n, {
                        moves: function (a, t, n) {
                            return n.classList.contains(r)
                        }
                    }) : dragula(n).on('drop', function (el, target, source, sibling) {
                        var order = [];
                        $("#" + target.id + " > div").each(function () {
                            order[$(this).index()] = $(this).attr('data-id');
                        });

                        var id = $(el).attr('data-id');

                        var old_status = $("#" + source.id).data('status');
                        var new_status = $("#" + target.id).data('status');
                        var stage_id = $(target).attr('data-id');


                        $("#" + source.id).parent().find('.count').text($("#" + source.id +
                            " > div").length);
                        $("#" + target.id).parent().find('.count').text($("#" + target.id +
                            " > div").length);
                        $.ajax({
                            url: '<?php echo e(route('job.application.order')); ?>',
                            type: 'POST',
                            data: {
                                application_id: id,
                                stage_id: stage_id,
                                order: order,
                                new_status: new_status,
                                old_status: old_status,
                                "_token": $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function (data) {
                                show_toastr('success', 'Job-application successfully updated',
                                    'success');
                            },
                            error: function (data) {
                                data = data.responseJSON;
                                show_toastr('error', data.error, 'error')
                            }
                        });
                    });
                })
            }, a.Dragula = new t, a.Dragula.Constructor = t
        }(window.jQuery),
            function (a) {
                "use strict";

                a.Dragula.init()

            }(window.jQuery);
        <?php endif; ?>
    </script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Job Application')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        
        
        

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create job application')): ?>
            <a href="#" data-size="lg" data-url="<?php echo e(route('job-application.create')); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>" data-title="<?php echo e(__('Create New Job Application')); ?>" class="btn btn-sm btn-primary">
                <i class="ti ti-plus"></i>
            </a>
        <?php endif; ?>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-sm-12">
            <div class="mt-2 " id="multiCollapseExample1">
                <div class="card">
                    <div class="card-body">
                        <?php echo e(Form::open(array('route' => array('job-application.index'),'method'=>'get','id'=>'applicarion_filter'))); ?>


                        <div class="row d-flex align-items-center justify-content-end">

                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 mr-2">
                                <div class="btn-box">
                                    <?php echo e(Form::label('start_date',__('Start Date'),['class'=>'form-label'])); ?>

                                    <?php echo e(Form::date('start_date',$filter['start_date'],array('class'=>'month-btn form-control '))); ?>

                                </div>
                            </div>

                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 mr-2">
                                <div class="btn-box">
                                    <?php echo e(Form::label('end_date',__('End Date'),['class'=>'form-label'])); ?>

                                    <?php echo e(Form::date('end_date',$filter['end_date'],array('class'=>'month-btn form-control '))); ?>

                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="btn-box">
                                    <?php echo e(Form::label('job', __('Job'),['class'=>'form-label'])); ?>

                                    <?php echo e(Form::select('job', $jobs,$filter['job'], array('class' => 'form-control select'))); ?>

                                </div>
                            </div>
                            <div class="col-auto float-end ms-2 mt-4">

                                <a href="#" class="btn btn-sm btn-primary" onclick="document.getElementById('applicarion_filter').submit(); return false;" data-bs-toggle="tooltip" data-original-title="<?php echo e(__('apply')); ?>">
                                    <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                                </a>
                                <a href="<?php echo e(route('job-application.index')); ?>" class="btn btn-sm btn-danger" data-bs-toggle="tooltip"
                                   title="<?php echo e(__('Reset')); ?>">
                                    <span class="btn-inner--icon"><i class="ti ti-trash-off text-white-off "></i></span>
                                </a>
                            </div>

                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card overflow-hidden mt-0">
        <div class="container-kanban">
            <?php

                $json = [];
                foreach ($stages as $stage){
                    $json[] = 'task-list-'.$stage->id;
                }
            ?>
            <div class="row kanban-wrapper horizontal-scroll-cards" data-plugin="dragula" data-containers='<?php echo json_encode($json); ?>'>
                <?php $__currentLoopData = $stages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $applications = $stage->applications($filter) ?>

                    <div class="col">
                        <div class="card">

                            <div class="card-header">
                                <div class="float-end">
                                    <span class="btn btn-sm btn-primary btn-icon count">
                                        <?php echo e(count($applications)); ?>

                                    </span>
                                </div>
                                <h4 class="mb-0"><?php echo e($stage->title); ?></h4>
                            </div>

                            <div class="card-body kanban-box" id="task-list-<?php echo e($stage->id); ?>" data-id="<?php echo e($stage->id); ?>">
                                <?php $__currentLoopData = $applications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $application): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="card" data-id="<?php echo e($application->id); ?>">
                                        <div class="pt-3 ps-3">
                                        </div>
                                        <div class="card-header border-0 pb-0 position-relative">
                                            <h5><a href="<?php echo e(route('job-application.show',\Crypt::encrypt($application->id))); ?>"><?php echo e($application->name); ?></a></h5>
                                            <div class="card-header-right">
                                                <?php if(Auth::user()->type != 'client'): ?>
                                                    <div class="btn-group card-option">
                                                        <button type="button" class="btn dropdown-toggle"
                                                                data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                            <i class="ti ti-dots-vertical"></i>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show job application')): ?>

                                                                <a class="dropdown-item" href="<?php echo e(route('job-application.show',\Crypt::encrypt($application->id))); ?>" class="dropdown-item"> <i class="ti ti-bookmark"></i><?php echo e(__('View')); ?></a>

                                                            <?php endif; ?>
                                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete job application')): ?>
                                                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['job-application.destroy', $application->id],'id'=>'delete-form-'.$application->id]); ?>

                                                                <a href="#!" class="dropdown-item bs-pass-para"><i class="ti ti-archive"></i>
                                                                    <span> <?php echo e(__('Delete')); ?> </span>
                                                                </a>
                                                                <?php echo Form::close(); ?>

                                                            <?php endif; ?>


                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <div class="card-body">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <ul class="list-inline mb-0 mt-0">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-12">
                                                            <span class="static-rating static-rating-sm d-block">
                                                            <?php for($i=1; $i<=5; $i++): ?>
                                                                    <?php if($i <= $application->rating): ?>
                                                                        <i class="star fas fa-star voted"></i>
                                                                    <?php else: ?>
                                                                        <i class="star fas fa-star"></i>
                                                                    <?php endif; ?>
                                                                <?php endfor; ?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <small class="text-md"><?php echo e(!empty($application->jobs)?$application->jobs->title:''); ?></small><br>


                                                    <li class="list-inline-item d-inline-flex align-items-center" data-bs-toggle="tooltip" title="<?php echo e(__('Product')); ?>">
                                                        <i class="ti ti-clock me-1" data-ajax-popup="true" data-title="<?php echo e(__('Applied at')); ?>"></i><?php echo e(\Auth::user()->dateFormat($application->created_at)); ?>


                                                    </li>

                                                    <li class="list-inline-item d-inline-flex align-items-center" data-bs-toggle="tooltip" title="<?php echo e(__('Source')); ?>">
                                                    </li>
                                                </ul>
                                                <div class="user-group">




                                                    <img src="<?php echo e(!empty($application->profile) ?$profile . ($application->profile) : $logo."avatar.png"); ?>"
                                                         class="hweb" >


                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <span class="empty-container" data-placeholder="Empty"></span>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/integra.platformbisnis.com/public_html/resources/views/jobApplication/index.blade.php ENDPATH**/ ?>