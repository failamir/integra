<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Settings')); ?>

<?php $__env->stopSection(); ?>
<?php
    use App\Models\Utility;
    use App\Models\WebhookSetting;
    $logo = \App\Models\Utility::get_file('uploads/logo/');

    $logo_light = !empty($setting['company_logo_light']) ? $setting['company_logo_light'] : '';
    $logo_dark = !empty($setting['company_logo_dark']) ? $setting['company_logo_dark'] : '';
    $company_favicon = !empty($setting['company_favicon']) ? $setting['company_favicon'] : '';

    $color = !empty($setting['color']) ? $setting['color'] : 'theme-3';
    $SITE_RTL = isset($setting['SITE_RTL']) ? $setting['SITE_RTL'] : 'off';

    $currantLang = Utility::languages();
    $lang = \App\Models\Utility::getValByName('default_language');
    $webhookSetting = WebhookSetting::where('created_by', '=', \Auth::user()->creatorId())->get();

?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Settings')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css-page'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/summernote/summernote-bs4.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script-page'); ?>
    <script src="<?php echo e(asset('css/summernote/summernote-bs4.js')); ?>"></script>
    <script>
        $('.summernote-simple0').on('summernote.blur', function() {
            $.ajax({
                url: "<?php echo e(route('offerlatter.update', $offerlang)); ?>",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    content: $(this).val()
                },
                type: 'POST',
                success: function(response) {
                    console.log(response)
                    if (response.is_success) {
                        show_toastr('success', response.success, 'success');
                    } else {
                        show_toastr('error', response.error, 'error');
                    }
                },
                error: function(response) {

                    response = response.responseJSON;
                    if (response.is_success) {
                        show_toastr('error', response.error, 'error');
                    } else {
                        show_toastr('error', response.error, 'error');
                    }
                }
            })
        });
        $('.summernote-simple1').on('summernote.blur', function() {
            $.ajax({
                url: "<?php echo e(route('joiningletter.update', $joininglang)); ?>",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    content: $(this).val()
                },
                type: 'POST',
                success: function(response) {
                    console.log(response)
                    if (response.is_success) {
                        show_toastr('success', response.success, 'success');
                    } else {
                        show_toastr('error', response.error, 'error');
                    }
                },
                error: function(response) {

                    response = response.responseJSON;
                    if (response.is_success) {
                        show_toastr('error', response.error, 'error');
                    } else {
                        show_toastr('error', response.error, 'error');
                    }
                }
            })
        });
        $('.summernote-simple2').on('summernote.blur', function() {
            $.ajax({
                url: "<?php echo e(route('experiencecertificate.update', $explang)); ?>",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    content: $(this).val()
                },
                type: 'POST',
                success: function(response) {
                    console.log(response)
                    if (response.is_success) {
                        show_toastr('success', response.success, 'success');
                    } else {
                        show_toastr('error', response.error, 'error');
                    }
                },
                error: function(response) {

                    response = response.responseJSON;
                    if (response.is_success) {
                        show_toastr('error', response.error, 'error');
                    } else {
                        show_toastr('error', response.error, 'error');
                    }
                }
            })
        });
        $('.summernote-simple3').on('summernote.blur', function() {
            $.ajax({
                url: "<?php echo e(route('noc.update', $noclang)); ?>",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    content: $(this).val()
                },
                type: 'POST',
                success: function(response) {
                    console.log(response)
                    if (response.is_success) {
                        show_toastr('success', response.success, 'success');
                    } else {
                        show_toastr('error', response.error, 'error');
                    }
                },
                error: function(response) {

                    response = response.responseJSON;
                    if (response.is_success) {
                        show_toastr('error', response.error, 'error');
                    } else {
                        show_toastr('error', response.error, 'error');
                    }
                }
            })
        });

        //footer notes
        $('.summernote-simple4').on('summernote.blur', function() {

            $.ajax({
                url: "<?php echo e(route('system.settings.footernote')); ?>",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    notes: $(this).val()
                },
                type: 'POST',
                success: function(response) {
                    if (response.is_success) {
                        // show_toastr('Success', response.success,'success');
                    } else {
                        show_toastr('error', response.error, 'error');
                    }
                },
                error: function(response) {
                    response = response.responseJSON;
                    if (response.is_success) {
                        show_toastr('error', response.error, 'error');
                    } else {
                        show_toastr('error', response, 'error');
                    }
                }
            })
        });
    </script>

    <script>
        if ($('#cust-darklayout').length > 0) {
            var custthemedark = document.querySelector("#cust-darklayout");
            custthemedark.addEventListener("click", function() {
                if (custthemedark.checked) {
                    $('#main-style-link').attr('href', '<?php echo e(env('APP_URL')); ?>' + '/public/assets/css/style-dark.css');
                    document.body.style.background = 'linear-gradient(141.55deg, #22242C 3.46%, #22242C 99.86%)';

                    $('.dash-sidebar .main-logo a img').attr('src', '<?php echo e($logo . $logo_light); ?>');

                } else {
                    $('#main-style-link').attr('href', '<?php echo e(env('APP_URL')); ?>' + '/public/assets/css/style.css');
                    document.body.style.setProperty('background', 'linear-gradient(141.55deg, rgba(240, 244, 243, 0) 3.46%, #f0f4f3 99.86%)', 'important');

                    $('.dash-sidebar .main-logo a img').attr('src', '<?php echo e($logo . $logo_dark); ?>');

                }
            });
        }
        if ($('#cust-theme-bg').length > 0) {
            var custthemebg = document.querySelector("#cust-theme-bg");
            custthemebg.addEventListener("click", function() {
                if (custthemebg.checked) {
                    document.querySelector(".dash-sidebar").classList.add("transprent-bg");
                    document
                        .querySelector(".dash-header:not(.dash-mob-header)")
                        .classList.add("transprent-bg");
                } else {
                    document.querySelector(".dash-sidebar").classList.remove("transprent-bg");
                    document
                        .querySelector(".dash-header:not(.dash-mob-header)")
                        .classList.remove("transprent-bg");
                }
            });
        }
    </script>

    <script>
        $(document).on("change", "select[name='invoice_template'], input[name='invoice_color']", function() {
            var template = $("select[name='invoice_template']").val();
            var color = $("input[name='invoice_color']:checked").val();
            $('#invoice_frame').attr('src', '<?php echo e(url('/invoices/preview')); ?>/' + template + '/' + color);
        });

        $(document).on("change", "select[name='proposal_template'], input[name='proposal_color']", function() {
            var template = $("select[name='proposal_template']").val();
            var color = $("input[name='proposal_color']:checked").val();
            $('#proposal_frame').attr('src', '<?php echo e(url('/proposal/preview')); ?>/' + template + '/' + color);
        });

        $(document).on("chnge", "select[name='bill_template'], input[name='bill_color']", function() {
            var template = $("select[name='bill_template']").val();
            var color = $("input[name='bill_color']:checked").val();
            $('#bill_frame').attr('src', '<?php echo e(url('/bill/preview')); ?>/' + template + '/' + color);
        });
    </script>

    <script>
        var scrollSpy = new bootstrap.ScrollSpy(document.body, {
            target: '#useradd-sidenav',
            offset: 300,
        })



        $('.colorPicker').on('click', function(e) {
            $('body').removeClass('custom-color');
            if (/^theme-\d+$/) {
                $('body').removeClassRegex(/^theme-\d+$/);
            }
            $('body').addClass('custom-color');
            $('.themes-color-change').removeClass('active_color');
            $(this).addClass('active_color');
            const input = document.getElementById("color-picker");
            setColor();
            input.addEventListener("input", setColor);

            function setColor() {
                $(':root').css('--color-customColor', input.value);
            }

            $(`input[name='color_flag`).val('true');
        });


        $('.themes-color-change').on('click', function() {

            $(`input[name='color_flag`).val('false');

            var color_val = $(this).data('value');
            $('body').removeClass('custom-color');
            if (/^theme-\d+$/) {
                $('body').removeClassRegex(/^theme-\d+$/);
            }
            $('body').addClass(color_val);
            $('.theme-color').prop('checked', false);
            $('.themes-color-change').removeClass('active_color');
            $('.colorPicker').removeClass('active_color');
            $(this).addClass('active_color');
            $(`input[value=${color_val}]`).prop('checked', true);
        });

        $.fn.removeClassRegex = function(regex) {
            return $(this).removeClass(function(index, classes) {
                return classes.split(/\s+/).filter(function(c) {
                    return regex.test(c);
                }).join(' ');
            });
        };
    </script>

    <script>
        document.getElementById('company_logo_dark').onchange = function() {
            var src = URL.createObjectURL(this.files[0])
            document.getElementById('image').src = src
        }
        document.getElementById('company_logo_light').onchange = function() {
            var src = URL.createObjectURL(this.files[0])
            document.getElementById('image1').src = src
        }
        document.getElementById('company_favicon').onchange = function() {
            var src = URL.createObjectURL(this.files[0])
            document.getElementById('image2').src = src
        }
    </script>

    <script>
        $(document).on('change', '#vat_gst_number_switch', function() {
            if ($(this).is(':checked')) {
                $('.tax_type_div').removeClass('d-none');
            } else {
                $('.tax_type_div').addClass('d-none');
            }
        });
    </script>

    <script type="text/javascript">
        $(document).on("click", '.send_email', function(e) {
            e.preventDefault();
            var title = $(this).attr('data-title');
            var size = 'md';
            var url = $(this).attr('data-url');

            if (typeof url != 'undefined') {
                $("#commonModal .modal-title").html(title);
                $("#commonModal .modal-dialog").addClass('modal-' + size);
                $("#commonModal").modal('show');


                $.post(url, {
                    _token: '<?php echo e(csrf_token()); ?>',
                    mail_driver: $("#mail_driver").val(),
                    mail_host: $("#mail_host").val(),
                    mail_port: $("#mail_port").val(),
                    mail_username: $("#mail_username").val(),
                    mail_password: $("#mail_password").val(),
                    mail_encryption: $("#mail_encryption").val(),
                    mail_from_address: $("#mail_from_address").val(),
                    mail_from_name: $("#mail_from_name").val(),

                }, function(data) {
                    $('#commonModal .body').html(data);
                });
            }
        });
        $(document).on('submit', '#test_email', function(e) {
            e.preventDefault();
            // $("#email_sending").show();
            var post = $(this).serialize();
            var url = $(this).attr('action');
            $.ajax({
                type: "post",
                url: url,
                data: post,
                cache: false,
                beforeSend: function() {
                    $('#test_email .btn-create').attr('disabled', 'disabled');
                },
                success: function(data) {
                    // console.log(data)
                    if (data.success) {
                        show_toastr('success', data.message, 'success');
                    } else {
                        show_toastr('error', data.message, 'error');
                    }
                    // $("#email_sending").hide();
                    $('#commonModal').modal('hide');


                },
                complete: function() {
                    $('#test_email .btn-create').removeAttr('disabled');
                },
            });
        });
    </script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-xl-3">
                    <div class="card sticky-top" style="top:30px">
                        <div class="list-group list-group-flush" id="useradd-sidenav">
                            <a href="#brand-settings"
                                class="list-group-item list-group-item-action border-0"><?php echo e(__('Brand Settings')); ?>

                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>
                            <a href="#system-settings"
                                class="list-group-item list-group-item-action border-0"><?php echo e(__('System Settings')); ?>

                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>
                            <a href="#company-settings"
                                class="list-group-item list-group-item-action border-0"><?php echo e(__('Company Settings')); ?>

                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>
                            <a href="#email-settings"
                                class="list-group-item list-group-item-action border-0"><?php echo e(__('Email Settings')); ?>

                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>
                            <a href="#tracker-settings"
                                class="list-group-item list-group-item-action border-0"><?php echo e(__('Time Tracker Settings')); ?>

                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>
                            <a href="#payment-settings"
                                class="list-group-item list-group-item-action border-0"><?php echo e(__('Payment Settings')); ?>

                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>
                            <a href="#zoom-settings"
                                class="list-group-item list-group-item-action border-0"><?php echo e(__('Zoom Settings')); ?>

                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>
                            <a href="#slack-settings"
                                class="list-group-item list-group-item-action border-0"><?php echo e(__('Slack Settings')); ?>

                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>
                            <a href="#telegram-settings"
                                class="list-group-item list-group-item-action border-0"><?php echo e(__('Telegram Settings')); ?>

                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>
                            <a href="#twilio-settings"
                                class="list-group-item list-group-item-action border-0"><?php echo e(__('Twilio Settings')); ?>

                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>
                            <a href="#email-notification-settings"
                                class="list-group-item list-group-item-action border-0"><?php echo e(__('Email Notification Settings')); ?>

                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>
                            <a href="#offer-letter-settings"
                                class="list-group-item list-group-item-action border-0"><?php echo e(__('Offer Letter Settings')); ?>

                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>
                            <a href="#joining-letter-settings"
                                class="list-group-item list-group-item-action border-0"><?php echo e(__('Joining Letter Settings')); ?>

                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>
                            <a href="#experience-certificate-settings"
                                class="list-group-item list-group-item-action border-0"><?php echo e(__('Experience Certificate Settings')); ?>

                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>
                            <a href="#noc-settings"
                                class="list-group-item list-group-item-action border-0"><?php echo e(__('NOC Settings')); ?>

                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>
                            <a href="#google-calender"
                                class="list-group-item list-group-item-action border-0"><?php echo e(__('Google Calendar Settings')); ?>

                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>
                            <a href="#webhook-settings"
                                class="list-group-item list-group-item-action border-0"><?php echo e(__('Webhook Settings')); ?>

                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>
                            <a href="#ip-restriction-settings"
                                class="list-group-item list-group-item-action border-0"><?php echo e(__('IP Restriction Settings')); ?>

                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-xl-9">

                    <!--Business Setting-->
                    <div id="brand-settings" class="card">
                        <?php echo e(Form::model($setting, ['route' => 'business.setting', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                        <div class="card-header">
                            <h5><?php echo e(__('Brand Settings')); ?></h5>
                            <small class="text-muted"><?php echo e(__('Edit your brand details')); ?></small>
                        </div>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-lg-4 col-sm-6 col-md-6">
                                    <div class="card logo_card">
                                        <div class="card-header">
                                            <h5><?php echo e(__('Logo dark')); ?></h5>
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class=" setting-card">
                                                <div class="logo-content mt-4">
                                                    <img id="image"
                                                        src="<?php echo e($logo . '/' . (isset($logo_dark) && !empty($logo_dark) ? $logo_dark : 'logo-dark.png') . '?timestamp=' . time()); ?>"
                                                        class="big-logo">
                                                </div>
                                                
                                                <?php $__errorArgs = ['company_logo_dark'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <div class="row">
                                                        <span class="invalid-logo" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                                    </div>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6 col-md-6">
                                    <div class="card logo_card">
                                        <div class="card-header">
                                            <h5><?php echo e(__('Logo Light')); ?></h5>
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class="setting-card">
                                                <div class="logo-content mt-4">
                                                    <img id="image1"
                                                        src="<?php echo e($logo . '/' . (isset($logo_light) && !empty($logo_light) ? $logo_light : 'logo-light.png') . '?timestamp=' . time()); ?>"
                                                        class="big-logo img_setting">
                                                </div>
                                                <div class="choose-files mt-5">
                                                    <label for="company_logo_light">
                                                        <div class=" bg-primary dark_logo_update"> <i
                                                                class="ti ti-upload px-1"></i><?php echo e(__('Choose file here')); ?>

                                                        </div>
                                                        <input type="file" class="form-control file setting_logo"
                                                            name="company_logo_light" id="company_logo_light"
                                                            data-filename="dark_logo_update">
                                                    </label>
                                                </div>
                                                <?php $__errorArgs = ['company_logo_light'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <div class="row">
                                                        <span class="invalid-logo" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                                    </div>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6 col-md-6">
                                    <div class="card logo_card">
                                        <div class="card-header">
                                            <h5><?php echo e(__('Favicon')); ?></h5>
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class=" setting-card">
                                                <div class="logo-content mt-4">
                                                    <img id="image2"
                                                        src="<?php echo e((!empty($company_favicon) ? $logo . '/' . $company_favicon : $logo . '/' . 'favicon.png') . '?timestamp=' . time()); ?>"
                                                        width="50px" class="img_setting">
                                                </div>
                                                <div class="choose-files mt-5">
                                                    <label for="company_favicon">
                                                        <div class="bg-primary company_favicon_update"> <i
                                                                class="ti ti-upload px-1"></i><?php echo e(__('Choose file here')); ?>

                                                        </div>
                                                        <input type="file" class="form-control file setting_logo"
                                                            id="company_favicon" name="company_favicon"
                                                            data-filename="company_favicon_update">
                                                    </label>
                                                </div>
                                                <?php $__errorArgs = ['logo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <div class="row">
                                                        <span class="invalid-logo" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                                    </div>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <?php echo e(Form::label('title_text', __('Title Text'), ['class' => 'form-label'])); ?>

                                    <?php echo e(Form::text('title_text', null, ['class' => 'form-control', 'placeholder' => __('Title Text')])); ?>

                                    <?php $__errorArgs = ['title_text'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-title_text" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="col-md-3 form-group">
                                    <?php echo e(Form::label('footer_text', __('Footer Text'), ['class' => 'form-label'])); ?>

                                    <?php echo e(Form::text('footer_text', Utility::getValByName('footer_text'), ['class' => 'form-control', 'placeholder' => __('Enter Footer Text')])); ?>

                                    <?php $__errorArgs = ['footer_text'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-footer_text" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <?php echo e(Form::label('default_language', __('Default Language'), ['class' => 'form-label'])); ?>

                                        <div class="changeLanguage">
                                            <select name="default_language" id="default_language"
                                                class="form-control select">
                                                <?php $__currentLoopData = \App\Models\Utility::languages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option <?php if($lang == $code): ?> selected <?php endif; ?>
                                                        value="<?php echo e($code); ?>">
                                                        <?php echo e(ucFirst($language)); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                        <?php $__errorArgs = ['default_language'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-default_language" role="alert">
                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <div class="custom-control custom-switch">
                                        <label class="mb-1 mt-1" for="SITE_RTL"><?php echo e(__('Enable RTL')); ?></label>
                                        <div class="">
                                            <input type="checkbox" name="SITE_RTL" id="SITE_RTL"
                                                data-toggle="switchbutton" data-onstyle="primary"
                                                <?php echo e($SITE_RTL == 'on' ? 'checked="checked"' : ''); ?>>
                                            <label class="custom-control-label" for="SITE_RTL"></label>
                                        </div>
                                    </div>
                                </div>
                                <h5 class="small-title mt-2"><?php echo e(__('Theme Customizer')); ?></h5>
                                <div class="setting-card setting-logo-box ">
                                    <div class="row">
                                        <div class="col-lg-4 col-xl-4 col-md-4">
                                            <h6 class="mt-1">
                                                <i data-feather="credit-card"
                                                    class="me-2"></i><?php echo e(__('Primary color settings')); ?>

                                            </h6>

                                            <hr class="my-2">
                                            <div class="color-wrp">
                                                <div class="theme-color themes-color">
                                                    <a href="#!"
                                                        class="themes-color-change <?php echo e($color == 'theme-1' ? 'active_color' : ''); ?>"
                                                        data-value="theme-1"></a>
                                                    <input type="radio" class="theme_color d-none" name="color"
                                                        value="theme-1"<?php echo e($color == 'theme-1' ? 'checked' : ''); ?>>
                                                    <a href="#!"
                                                        class="themes-color-change <?php echo e($color == 'theme-2' ? 'active_color' : ''); ?>"
                                                        data-value="theme-2"></a>
                                                    <input type="radio" class="theme_color d-none" name="color"
                                                        value="theme-2"<?php echo e($color == 'theme-2' ? 'checked' : ''); ?>>
                                                    <a href="#!"
                                                        class="themes-color-change <?php echo e($color == 'theme-3' ? 'active_color' : ''); ?>"
                                                        data-value="theme-3"></a>
                                                    <input type="radio" class="theme_color d-none" name="color"
                                                        value="theme-3"<?php echo e($color == 'theme-3' ? 'checked' : ''); ?>>
                                                    <a href="#!"
                                                        class="themes-color-change <?php echo e($color == 'theme-4' ? 'active_color' : ''); ?>"
                                                        data-value="theme-4"></a>
                                                    <input type="radio" class="theme_color d-none" name="color"
                                                        value="theme-4"<?php echo e($color == 'theme-4' ? 'checked' : ''); ?>>
                                                    <a href="#!"
                                                        class="themes-color-change <?php echo e($color == 'theme-5' ? 'active_color' : ''); ?>"
                                                        data-value="theme-5"></a>
                                                    <input type="radio" class="theme_color d-none" name="color"
                                                        value="theme-5"<?php echo e($color == 'theme-5' ? 'checked' : ''); ?>>
                                                    <br>
                                                    <a href="#!"
                                                        class="themes-color-change <?php echo e($color == 'theme-6' ? 'active_color' : ''); ?>"
                                                        data-value="theme-6"></a>
                                                    <input type="radio" class="theme_color d-none" name="color"
                                                        value="theme-6"<?php echo e($color == 'theme-6' ? 'checked' : ''); ?>>
                                                    <a href="#!"
                                                        class="themes-color-change <?php echo e($color == 'theme-7' ? 'active_color' : ''); ?>"
                                                        data-value="theme-7"></a>
                                                    <input type="radio" class="theme_color d-none" name="color"
                                                        value="theme-7"<?php echo e($color == 'theme-7' ? 'checked' : ''); ?>>
                                                    <a href="#!"
                                                        class="themes-color-change <?php echo e($color == 'theme-8' ? 'active_color' : ''); ?>"
                                                        data-value="theme-8"></a>
                                                    <input type="radio" class="theme_color d-none" name="color"
                                                        value="theme-8"<?php echo e($color == 'theme-8' ? 'checked' : ''); ?>>
                                                    <a href="#!"
                                                        class="themes-color-change <?php echo e($color == 'theme-9' ? 'active_color' : ''); ?>"
                                                        data-value="theme-9"></a>
                                                    <input type="radio" class="theme_color d-none" name="color"
                                                        value="theme-9"<?php echo e($color == 'theme-9' ? 'checked' : ''); ?>>
                                                    <a href="#!"
                                                        class="themes-color-change <?php echo e($color == 'theme-10' ? 'active_color' : ''); ?>"
                                                        data-value="theme-10"></a>
                                                    <input type="radio" class="theme_color d-none" name="color"
                                                        value="theme-10"<?php echo e($color == 'theme-10' ? 'checked' : ''); ?>>
                                                </div>
                                                <div class="color-picker-wrp">
                                                    <input type="color" value="<?php echo e($color ? $color : ''); ?>"
                                                        class="colorPicker <?php echo e(isset($setting['color_flag']) && $setting['color_flag'] == 'true' ? 'active_color' : ''); ?> image-input"
                                                        name="custom_color" data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        title="<?php echo e(__('Select Your Own Brand Color')); ?>" id="color-picker">
                                                    <input type="hidden" name="custom-color" id="colorCode">
                                                    <input type='hidden' name="color_flag"
                                                        value=<?php echo e(isset($setting['color_flag']) && $setting['color_flag'] == 'true' ? 'true' : 'false'); ?>>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-xl-4 col-md-4">
                                            <h6 class="mt-1">
                                                <i data-feather="layout" class="me-2"></i><?php echo e(__('Sidebar settings')); ?>

                                            </h6>
                                            <hr class="mt-1" />
                                            <div class="form-check form-switch">
                                                <input type="checkbox" class="form-check-input" id="cust-theme-bg"
                                                    name="cust_theme_bg"
                                                    <?php echo e(!empty($setting['cust_theme_bg']) && $setting['cust_theme_bg'] == 'on' ? 'checked' : ''); ?> />
                                                <label class="form-check-label f-w-600 pl-1"
                                                    for="cust-theme-bg"><?php echo e(__('Transparent layout')); ?></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-xl-4 col-md-4">
                                            <h6 class="mt-1">
                                                <i data-feather="sun" class="me-2"></i><?php echo e(__('Layout settings')); ?>

                                            </h6>
                                            <hr class="mt-1" />
                                            <div class="form-check form-switch mt-2">
                                                <input type="checkbox" class="form-check-input" id="cust-darklayout"
                                                    name="cust_darklayout"
                                                    <?php echo e(!empty($setting['cust_darklayout']) && $setting['cust_darklayout'] == 'on' ? 'checked' : ''); ?> />
                                                <label class="form-check-label f-w-600 pl-1"
                                                    for="cust-darklayout"><?php echo e(__('Dark Layout')); ?></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <div class="form-group">
                                <input class="btn btn-print-invoice btn-primary m-r-10" type="submit"
                                    value="<?php echo e(__('Save Changes')); ?>">
                            </div>
                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>

                    <!--System Settings-->
                    <div id="system-settings" class="card">
                        <div class="card-header">
                            <h5><?php echo e(__('System Settings')); ?></h5>
                            <small class="text-muted"><?php echo e(__('Edit your system details')); ?></small>
                        </div>
                        <?php echo e(Form::model($setting, ['route' => 'system.settings', 'method' => 'post'])); ?>

                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <?php echo e(Form::label('site_currency', __('Currency *'), ['class' => 'form-label'])); ?>

                                    <?php echo e(Form::text('site_currency', $setting['site_currency'], ['class' => 'form-control font-style', 'required', 'placeholder' => __('Enter Currency')])); ?>

                                    <small> <?php echo e(__('Note: Add currency code as per three-letter ISO code.')); ?><br>
                                        <a href="https://stripe.com/docs/currencies"
                                            target="_blank"><?php echo e(__('You can find out how to do that here.')); ?></a></small>
                                    <br>
                                    <?php $__errorArgs = ['site_currency'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-site_currency" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <?php echo e(Form::label('site_currency_symbol', __('Currency Symbol *'), ['class' => 'form-label'])); ?>

                                    <?php echo e(Form::text('site_currency_symbol', null, ['class' => 'form-control'])); ?>

                                    <?php $__errorArgs = ['site_currency_symbol'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-site_currency_symbol" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label"
                                        for="example3cols3Input"><?php echo e(__('Currency Symbol Position')); ?></label>
                                    <div class="row ms-1">
                                        <div class="form-check col-md-6">
                                            <input class="form-check-input" type="radio"
                                                name="site_currency_symbol_position" value="pre"
                                                <?php if(@$setting['site_currency_symbol_position'] == 'pre'): ?> checked <?php endif; ?> id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                <?php echo e(__('Pre')); ?>

                                            </label>
                                        </div>
                                        <div class="form-check col-md-6">
                                            <input class="form-check-input" type="radio"
                                                name="site_currency_symbol_position" value="post"
                                                <?php if(@$setting['site_currency_symbol_position'] == 'post'): ?> checked <?php endif; ?> id="flexCheckChecked">
                                            <label class="form-check-label" for="flexCheckChecked">
                                                <?php echo e(__('Post')); ?>

                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <?php echo e(Form::label('decimal_number', __('Decimal Number Format'), ['class' => 'form-label'])); ?>

                                    <?php echo e(Form::number('decimal_number', null, ['class' => 'form-control'])); ?>

                                    <?php $__errorArgs = ['decimal_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-decimal_number" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="site_date_format" class="form-label"><?php echo e(__('Date Format')); ?></label>
                                    <select type="text" name="site_date_format" class="form-control selectric"
                                        id="site_date_format">
                                        <option value="M j, Y"
                                            <?php if(@$setting['site_date_format'] == 'M j, Y'): ?> selected="selected" <?php endif; ?>>Jan 1,2015</option>
                                        <option value="d-m-Y"
                                            <?php if(@$setting['site_date_format'] == 'd-m-Y'): ?> selected="selected" <?php endif; ?>>dd-mm-yyyy</option>
                                        <option value="m-d-Y"
                                            <?php if(@$setting['site_date_format'] == 'm-d-Y'): ?> selected="selected" <?php endif; ?>>mm-dd-yyyy</option>
                                        <option value="Y-m-d"
                                            <?php if(@$setting['site_date_format'] == 'Y-m-d'): ?> selected="selected" <?php endif; ?>>yyyy-mm-dd</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="site_time_format" class="form-label"><?php echo e(__('Time Format')); ?></label>
                                    <select type="text" name="site_time_format" class="form-control selectric"
                                        id="site_time_format">
                                        <option value="g:i A"
                                            <?php if(@$setting['site_time_format'] == 'g:i A'): ?> selected="selected" <?php endif; ?>>10:30 PM</option>
                                        <option value="g:i a"
                                            <?php if(@$setting['site_time_format'] == 'g:i a'): ?> selected="selected" <?php endif; ?>>10:30 pm</option>
                                        <option value="H:i"
                                            <?php if(@$setting['site_time_format'] == 'H:i'): ?> selected="selected" <?php endif; ?>>22:30</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <?php echo e(Form::label('customer_prefix', __('Customer Prefix'), ['class' => 'form-label'])); ?>

                                    <?php echo e(Form::text('customer_prefix', null, ['class' => 'form-control'])); ?>

                                    <?php $__errorArgs = ['customer_prefix'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-customer_prefix" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <?php echo e(Form::label('vender_prefix', __('Vendor Prefix'), ['class' => 'form-label'])); ?>

                                    <?php echo e(Form::text('vender_prefix', null, ['class' => 'form-control'])); ?>

                                    <?php $__errorArgs = ['vender_prefix'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-vender_prefix" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <?php echo e(Form::label('proposal_prefix', __('Proposal Prefix'), ['class' => 'form-label'])); ?>

                                    <?php echo e(Form::text('proposal_prefix', null, ['class' => 'form-control'])); ?>

                                    <?php $__errorArgs = ['proposal_prefix'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-proposal_prefix" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <?php echo e(Form::label('invoice_prefix', __('Invoice Prefix'), ['class' => 'form-label'])); ?>

                                    <?php echo e(Form::text('invoice_prefix', null, ['class' => 'form-control'])); ?>

                                    <?php $__errorArgs = ['invoice_prefix'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-invoice_prefix" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <?php echo e(Form::label('bill_prefix', __('Bill Prefix'), ['class' => 'form-label'])); ?>

                                    <?php echo e(Form::text('bill_prefix', null, ['class' => 'form-control'])); ?>

                                    <?php $__errorArgs = ['bill_prefix'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-bill_prefix" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <?php echo e(Form::label('quotation_prefix', __('Quotation Prefix'), ['class' => 'form-label'])); ?>

                                    <?php echo e(Form::text('quotation_prefix', null, ['class' => 'form-control'])); ?>

                                    <?php $__errorArgs = ['quotation_prefix'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-quotation_prefix" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <?php echo e(Form::label('purchase_prefix', __('Purchase Prefix'), ['class' => 'form-label'])); ?>

                                    <?php echo e(Form::text('purchase_prefix', null, ['class' => 'form-control'])); ?>

                                    <?php $__errorArgs = ['purchase_prefix'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-purchase_prefix" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <?php echo e(Form::label('pos_prefix', __('Pos Prefix'), ['class' => 'form-label'])); ?>

                                    <?php echo e(Form::text('pos_prefix', null, ['class' => 'form-control'])); ?>

                                    <?php $__errorArgs = ['pos_prefix'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-pos_prefix" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <?php echo e(Form::label('journal_prefix', __('Journal Prefix'), ['class' => 'form-label'])); ?>

                                    <?php echo e(Form::text('journal_prefix', null, ['class' => 'form-control'])); ?>

                                    <?php $__errorArgs = ['journal_prefix'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-journal_prefix" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <?php echo e(Form::label('expense_prefix', __('Expense Prefix'), ['class' => 'form-label'])); ?>

                                    <?php echo e(Form::text('expense_prefix', null, ['class' => 'form-control'])); ?>

                                    <?php $__errorArgs = ['expense_prefix'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-expense_prefix" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <?php echo e(Form::label('shipping_display', __('Display Shipping in Proposal / Invoice / Bill'), ['class' => 'form-label'])); ?>

                                    <div class=" form-switch form-switch-left">
                                        <input type="checkbox" class="form-check-input mt-3" name="shipping_display"
                                            id="email_tempalte_13"
                                            <?php echo e($setting['shipping_display'] == 'on' ? 'checked' : ''); ?>>
                                        <label class="form-check-label" for="email_tempalte_13"></label>
                                    </div>
                                    <?php $__errorArgs = ['shipping_display'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-shipping_display" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-12">
                                    <?php echo e(Form::label('footer_title', __('Proposal/Invoice/Bill/Purchase/POS Footer Title'), ['class' => 'form-label'])); ?>

                                    <?php echo e(Form::text('footer_title', null, ['class' => 'form-control'])); ?>

                                    <?php $__errorArgs = ['footer_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-footer_title" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-12">
                                    <?php echo e(Form::label('footer_notes', __('Proposal/Invoice/Bill/Purchase/POS Footer Note'), ['class' => 'form-label'])); ?>

                                    <textarea class="summernote-simple4 summernote-simple"><?php echo $setting['footer_notes']; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <div class="form-group">
                                <input class="btn btn-print-invoice btn-primary m-r-10" type="submit"
                                    value="<?php echo e(__('Save Changes')); ?>">
                            </div>
                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>

                    <!--Company Settings-->
                    <div id="company-settings" class="card">
                        <div class="card-header">
                            <h5><?php echo e(__('Company Settings')); ?></h5>
                            <small class="text-muted"><?php echo e(__('Edit your company details')); ?></small>
                        </div>
                        <?php echo e(Form::model($setting, ['route' => 'company.settings', 'method' => 'post'])); ?>

                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <?php echo e(Form::label('company_name *', __('Company Name *'), ['class' => 'form-label'])); ?>

                                    <?php echo e(Form::text('company_name', null, ['class' => 'form-control font-style'])); ?>

                                    <?php $__errorArgs = ['company_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-company_name" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <?php echo e(Form::label('company_address', __('Address'), ['class' => 'form-label'])); ?>

                                    <?php echo e(Form::text('company_address', null, ['class' => 'form-control font-style'])); ?>

                                    <?php $__errorArgs = ['company_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-company_address" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <?php echo e(Form::label('company_city', __('City'), ['class' => 'form-label'])); ?>

                                    <?php echo e(Form::text('company_city', null, ['class' => 'form-control font-style'])); ?>

                                    <?php $__errorArgs = ['company_city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-company_city" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <?php echo e(Form::label('company_state', __('State'), ['class' => 'form-label'])); ?>

                                    <?php echo e(Form::text('company_state', null, ['class' => 'form-control font-style'])); ?>

                                    <?php $__errorArgs = ['company_state'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-company_state" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <?php echo e(Form::label('company_zipcode', __('Zip/Post Code'), ['class' => 'form-label'])); ?>

                                    <?php echo e(Form::text('company_zipcode', null, ['class' => 'form-control'])); ?>

                                    <?php $__errorArgs = ['company_zipcode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-company_zipcode" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group  col-md-6">
                                    <?php echo e(Form::label('company_country', __('Country'), ['class' => 'form-label'])); ?>

                                    <?php echo e(Form::text('company_country', null, ['class' => 'form-control font-style'])); ?>

                                    <?php $__errorArgs = ['company_country'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-company_country" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <?php echo e(Form::label('company_telephone', __('Telephone'), ['class' => 'form-label'])); ?>

                                    <?php echo e(Form::text('company_telephone', null, ['class' => 'form-control'])); ?>

                                    <?php $__errorArgs = ['company_telephone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-company_telephone" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <?php echo e(Form::label('registration_number', __('Company Registration Number *'), ['class' => 'form-label'])); ?>

                                    <?php echo e(Form::text('registration_number', null, ['class' => 'form-control'])); ?>

                                    <?php $__errorArgs = ['registration_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-registration_number" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-4">
                                    <?php echo e(Form::label('company_start_time', __('Company Start Time *'), ['class' => 'form-label'])); ?>

                                    <?php echo e(Form::time('company_start_time', null, ['class' => 'form-control'])); ?>

                                    <?php $__errorArgs = ['company_start_time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-company_start_time" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-4">
                                    <?php echo e(Form::label('company_end_time', __('Company End Time *'), ['class' => 'form-label'])); ?>

                                    <?php echo e(Form::time('company_end_time', null, ['class' => 'form-control'])); ?>

                                    <?php $__errorArgs = ['company_end_time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-company_end_time" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>


                                <div class="form-group col-md-4">
                                    <label class="" for="ip_restrict"><?php echo e(__('Ip Restrict')); ?></label>
                                    <div class="custom-control custom-switch mt-2">
                                        <input type="checkbox" class=" form-check-input" data-toggle="switchbutton"
                                            data-onstyle="primary" name="ip_restrict" id="ip_restrict"
                                            <?php echo e($setting['ip_restrict'] == 'on' ? 'checked' : ''); ?>>
                                    </div>
                                </div>

                                <div class="form-group col-md-12 mt-2">
                                    <?php echo e(Form::label('timezone', __('Timezone'), ['class' => 'form-label'])); ?>

                                    <select type="text" name="timezone" class="form-control custom-select"
                                        id="timezone">
                                        <option value=""><?php echo e(__('Select Timezone')); ?></option>
                                        <?php $__currentLoopData = $timezones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $timezone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($k); ?>"
                                                <?php echo e($setting['timezone'] == $k ? 'selected' : ''); ?>><?php echo e($timezone); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="row mt-4">
                                        <div class="col-md-6">
                                            <label for="vat_gst_number_switch"><?php echo e(__('Tax Number')); ?></label>
                                            <div class="form-check form-switch custom-switch-v1 float-end">
                                                <input type="checkbox" name="vat_gst_number_switch"
                                                    class="form-check-input input-primary pointer" value="on"
                                                    id="vat_gst_number_switch"
                                                    <?php echo e($setting['vat_gst_number_switch'] == 'on' ? ' checked ' : ''); ?>>
                                                <label class="form-check-label" for="vat_gst_number_switch"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div
                                    class="form-group col-md-6 tax_type_div <?php echo e($setting['vat_gst_number_switch'] != 'on' ? ' d-none ' : ''); ?>">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check form-check-inline form-group mb-3">
                                                <input type="radio" id="customRadio8" name="tax_type" value="VAT"
                                                    class="form-check-input"
                                                    <?php echo e($setting['tax_type'] == 'VAT' ? 'checked' : ''); ?>>
                                                <label class="form-check-label"
                                                    for="customRadio8"><?php echo e(__('VAT Number')); ?></label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check form-check-inline form-group mb-3">
                                                <input type="radio" id="customRadio7" name="tax_type" value="GST"
                                                    class="form-check-input"
                                                    <?php echo e($setting['tax_type'] == 'GST' ? 'checked' : ''); ?>>
                                                <label class="form-check-label"
                                                    for="customRadio7"><?php echo e(__('GST Number')); ?></label>
                                            </div>
                                        </div>
                                    </div>
                                    <?php echo e(Form::text('vat_number', null, ['class' => 'form-control', 'placeholder' => __('Enter VAT / GST Number')])); ?>

                                </div>

                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <div class="form-group">
                                <input class="btn btn-print-invoice btn-primary m-r-10" type="submit"
                                    value="<?php echo e(__('Save Changes')); ?>">
                            </div>
                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>

                    <!--Email Settings-->
                    <div id="email-settings" class="card">
                        <div class="card-header">
                            <h5><?php echo e(__('Email Settings')); ?></h5>
                        </div>
                        <?php echo e(Form::model($setting, ['route' => 'company.email.settings', 'method' => 'post'])); ?>

                        <div class="card-body">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php echo e(Form::label('mail_driver', __('Mail Driver'), ['class' => 'form-label'])); ?>

                                        <?php echo e(Form::text('mail_driver', isset($setting['mail_driver']) ? $setting['mail_driver'] : '', ['class' => 'form-control', 'placeholder' => __('Enter Mail Driver')])); ?>

                                        <?php $__errorArgs = ['mail_driver'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-mail_driver" role="alert">
                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php echo e(Form::label('mail_host', __('Mail Host'), ['class' => 'form-label'])); ?>

                                        <?php echo e(Form::text('mail_host', isset($setting['mail_host']) ? $setting['mail_host'] : '', ['class' => 'form-control ', 'placeholder' => __('Enter Mail Host')])); ?>

                                        <?php $__errorArgs = ['mail_host'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-mail_driver" role="alert">
                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php echo e(Form::label('mail_port', __('Mail Port'), ['class' => 'form-label'])); ?>

                                        <?php echo e(Form::text('mail_port', isset($setting['mail_port']) ? $setting['mail_port'] : '', ['class' => 'form-control', 'placeholder' => __('Enter Mail Port')])); ?>

                                        <?php $__errorArgs = ['mail_port'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-mail_port" role="alert">
                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php echo e(Form::label('mail_username', __('Mail Username'), ['class' => 'form-label'])); ?>

                                        <?php echo e(Form::text('mail_username', isset($setting['mail_username']) ? $setting['mail_username'] : '', ['class' => 'form-control', 'placeholder' => __('Enter Mail Username')])); ?>

                                        <?php $__errorArgs = ['mail_username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-mail_username" role="alert">
                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php echo e(Form::label('mail_password', __('Mail Password'), ['class' => 'form-label'])); ?>

                                        <?php echo e(Form::text('mail_password', isset($setting['mail_password']) ? $setting['mail_password'] : '', ['class' => 'form-control', 'placeholder' => __('Enter Mail Password')])); ?>

                                        <?php $__errorArgs = ['mail_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-mail_password" role="alert">
                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php echo e(Form::label('mail_encryption', __('Mail Encryption'), ['class' => 'form-label'])); ?>

                                        <?php echo e(Form::text('mail_encryption', isset($setting['mail_encryption']) ? $setting['mail_encryption'] : '', ['class' => 'form-control', 'placeholder' => __('Enter Mail Encryption')])); ?>

                                        <?php $__errorArgs = ['mail_encryption'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-mail_encryption" role="alert">
                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php echo e(Form::label('mail_from_address', __('Mail From Address'), ['class' => 'form-label'])); ?>

                                        <?php echo e(Form::text('mail_from_address', isset($setting['mail_from_address']) ? $setting['mail_from_address'] : '', ['class' => 'form-control', 'placeholder' => __('Enter Mail From Address')])); ?>

                                        <?php $__errorArgs = ['mail_from_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-mail_from_address" role="alert">
                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php echo e(Form::label('mail_from_name', __('Mail From Name'), ['class' => 'form-label'])); ?>

                                        <?php echo e(Form::text('mail_from_name', isset($setting['mail_from_name']) ? $setting['mail_from_name'] : '', ['class' => 'form-control', 'placeholder' => __('Enter Mail From Name')])); ?>

                                        <?php $__errorArgs = ['mail_from_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-mail_from_name" role="alert">
                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="card-footer d-flex justify-content-end">
                                <div class="form-group me-2">
                                    <a href="#" data-url="<?php echo e(route('test.mail')); ?>"
                                        data-title="<?php echo e(__('Send Test Mail')); ?>" class="btn btn-primary send_email ">
                                        <?php echo e(__('Send Test Mail')); ?>

                                    </a>
                                </div>


                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" value="<?php echo e(__('Save Changes')); ?>">
                                </div>
                            </div>
                        </div>

                        <?php echo e(Form::close()); ?>

                    </div>

                    <!--Time-Tracker Settings-->
                    <div id="tracker-settings" class="card">
                        <div class="card-header">
                            <h5><?php echo e(__('Time Tracker Settings')); ?></h5>
                            <small class="text-muted"><?php echo e(__('Edit your Time Tracker settings')); ?></small>
                        </div>
                        <?php echo e(Form::model($setting, ['route' => 'tracker.settings', 'method' => 'post'])); ?>

                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="form-control-label"><?php echo e(__('Application URL')); ?></label> <br>
                                    <small><?php echo e(__('Application URL to log into the app.')); ?></small>
                                    <?php echo e(Form::text('apps_url', URL::to('/'), ['class' => 'form-control', 'placeholder' => __('Application URL'), 'readonly' => 'true'])); ?>

                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-control-label"><?php echo e(__('Tracking Interval')); ?></label> <br>
                                    <small><?php echo e(__('Image Screenshot Take Interval time ( 1 = 1 min)')); ?></small>
                                    <?php echo e(Form::number('interval_time', isset($setting['interval_time']) ? $setting['interval_time'] : '10', ['class' => 'form-control', 'placeholder' => __('Enter Tracking Interval Time')])); ?>

                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <div class="form-group">
                                <input class="btn btn-print-invoice btn-primary m-r-10" type="submit"
                                    value="<?php echo e(__('Save Changes')); ?>">
                            </div>
                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>

                    <!--Payment Settings-->
                    <div class="card" id="payment-settings">
                        <div class="card-header">
                            <h5><?php echo e('Payment Settings'); ?></h5>
                            <small
                                class="text-secondary font-weight-bold"><?php echo e(__('These details will be used to collect invoice payments. Each invoice will have a payment button based on the below configuration.')); ?></small>
                        </div>
                        <?php echo e(Form::model($setting, ['route' => 'company.payment.settings', 'method' => 'POST'])); ?>

                        <?php echo csrf_field(); ?>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="faq justify-content-center">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="accordion accordion-flush setting-accordion"
                                                    id="accordionExample">

                                                    <!-- Bank Transfer -->
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingOne">
                                                            <button class="accordion-button collapsed" type="button"
                                                                data-bs-toggle="collapse" data-bs-target="#collapseBank"
                                                                aria-expanded="false" aria-controls="collapseOne">
                                                                <span class="d-flex align-items-center">
                                                                    <?php echo e(__('Bank Transfer')); ?>

                                                                </span>
                                                                <div class="d-flex align-items-center">
                                                                    <span class="me-2"><?php echo e(__('Enable')); ?>:</span>
                                                                    <div class="form-check form-switch custom-switch-v1">
                                                                        <input type="hidden"
                                                                            name="is_bank_transfer_enabled"
                                                                            value="off">
                                                                        <input type="checkbox"
                                                                            class="form-check-input input-primary"
                                                                            id="customswitchv1-1 is_bank_transfer_enabled"
                                                                            name="is_bank_transfer_enabled"
                                                                            <?php echo e(isset($company_payment_setting['is_bank_transfer_enabled']) && $company_payment_setting['is_bank_transfer_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                    </div>
                                                                </div>
                                                            </button>
                                                        </h2>
                                                        <div id="collapseBank" class="accordion-collapse collapse"
                                                            aria-labelledby="headingOne"
                                                            data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <div class="row gy-4">
                                                                    <div class="col-lg-12">
                                                                        <div class="input-edits">
                                                                            <div class="form-group">
                                                                                <?php echo e(Form::label('bank_details', __('Bank Details'), ['class' => 'col-form-label'])); ?>

                                                                                <?php echo e(Form::textarea('bank_details', isset($company_payment_setting['bank_details']) ? $company_payment_setting['bank_details'] : '', ['class' => 'form-control', 'placeholder' => __('Enter Your Bank Details'), 'rows' => 4])); ?>

                                                                                <small class="text-xs">
                                                                                    <?php echo e(__('Example : Bank : bank name </br> Account Number : 0000 0000 </br>')); ?>

                                                                                </small>
                                                                                <?php if($errors->has('bank_details')): ?>
                                                                                    <span class="invalid-feedback d-block">
                                                                                        <?php echo e($errors->first('bank_details')); ?>

                                                                                    </span>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Stripe -->
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingOne">
                                                            <button class="accordion-button collapsed" type="button"
                                                                data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                                                aria-expanded="false" aria-controls="collapseOne">
                                                                <span class="d-flex align-items-center">
                                                                    <?php echo e(__('Stripe')); ?>

                                                                </span>
                                                                <div class="d-flex align-items-center">
                                                                    <span class="me-2"><?php echo e(__('Enable')); ?>:</span>
                                                                    <div class="form-check form-switch custom-switch-v1">
                                                                        <input type="hidden" name="is_stripe_enabled"
                                                                            value="off">
                                                                        <input type="checkbox"
                                                                            class="form-check-input input-primary"
                                                                            id="customswitchv1-1 is_stripe_enabled"
                                                                            name="is_stripe_enabled"
                                                                            <?php echo e(isset($company_payment_setting['is_stripe_enabled']) && $company_payment_setting['is_stripe_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                    </div>
                                                                </div>
                                                            </button>
                                                        </h2>
                                                        <div id="collapseOne" class="accordion-collapse collapse"
                                                            aria-labelledby="headingOne"
                                                            data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <div class="row gy-4">
                                                                    <div class="col-lg-6">
                                                                        <div class="input-edits">
                                                                            <div class="form-group">
                                                                                <?php echo e(Form::label('stripe_key', __('Stripe Key'), ['class' => 'col-form-label'])); ?>

                                                                                <?php echo e(Form::text('stripe_key', isset($company_payment_setting['stripe_key']) ? $company_payment_setting['stripe_key'] : '', ['class' => 'form-control', 'placeholder' => __('Enter Stripe Key')])); ?>

                                                                                <?php if($errors->has('stripe_key')): ?>
                                                                                    <span class="invalid-feedback d-block">
                                                                                        <?php echo e($errors->first('stripe_key')); ?>

                                                                                    </span>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="input-edits">
                                                                            <div class="form-group">
                                                                                <?php echo e(Form::label('stripe_secret', __('Stripe Secret'), ['class' => 'col-form-label'])); ?>

                                                                                <?php echo e(Form::text('stripe_secret', isset($company_payment_setting['stripe_secret']) ? $company_payment_setting['stripe_secret'] : '', ['class' => 'form-control ', 'placeholder' => __('Enter Stripe Secret')])); ?>

                                                                                <?php if($errors->has('stripe_secret')): ?>
                                                                                    <span class="invalid-feedback d-block">
                                                                                        <?php echo e($errors->first('stripe_secret')); ?>

                                                                                    </span>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Paypal -->
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingTwo">
                                                            <button class="accordion-button collapsed" type="button"
                                                                data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                                aria-expanded="false" aria-controls="collapseTwo">
                                                                <span class="d-flex align-items-center">
                                                                    <?php echo e(__('Paypal')); ?>

                                                                </span>
                                                                <div class="d-flex align-items-center">
                                                                    <span class="me-2"><?php echo e(__('Enable')); ?>:</span>
                                                                    <div class="form-check form-switch custom-switch-v1">
                                                                        <input type="hidden" name="is_paypal_enabled"
                                                                            value="off">
                                                                        <input type="checkbox"
                                                                            class="form-check-input input-primary"
                                                                            id="customswitchv1-1 is_paypal_enabled"
                                                                            name="is_paypal_enabled"
                                                                            <?php echo e(isset($company_payment_setting['is_paypal_enabled']) && $company_payment_setting['is_paypal_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                    </div>
                                                                </div>
                                                            </button>
                                                        </h2>
                                                        <div id="collapseTwo" class="accordion-collapse collapse"
                                                            aria-labelledby="headingTwo"
                                                            data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <div class="d-flex">
                                                                    <div class="mr-2" style="margin-right: 15px;">
                                                                        <div class="border card p-1">
                                                                            <div class="form-check">
                                                                                <label
                                                                                    class="form-check-label text-dark me-2">
                                                                                    <input type="radio"
                                                                                        name="paypal_mode" value="sandbox"
                                                                                        class="form-check-input"
                                                                                        <?php echo e((isset($company_payment_setting['paypal_mode']) && $company_payment_setting['paypal_mode'] == '') || (isset($company_payment_setting['paypal_mode']) && $company_payment_setting['paypal_mode'] == 'sandbox') ? 'checked="checked"' : ''); ?>>
                                                                                    <?php echo e(__('Sandbox')); ?>

                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mr-2" style="margin-right: 15px;">
                                                                        <div class="border card p-1">
                                                                            <div class="form-check">
                                                                                <label
                                                                                    class="form-check-label text-dark me-2">
                                                                                    <input type="radio"
                                                                                        name="paypal_mode" value="live"
                                                                                        class="form-check-input"
                                                                                        <?php echo e(isset($company_payment_setting['paypal_mode']) && $company_payment_setting['paypal_mode'] == 'live' ? 'checked="checked"' : ''); ?>>
                                                                                    <?php echo e(__('Live')); ?>

                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row gy-4">
                                                                    <div class="col-lg-6">
                                                                        <div class="input-edits">
                                                                            <div class="form-group">
                                                                                <label class="col-form-label"
                                                                                    for="paypal_client_id"><?php echo e(__('Client ID')); ?></label>
                                                                                <input type="text"
                                                                                    name="paypal_client_id"
                                                                                    id="paypal_client_id"
                                                                                    class="form-control"
                                                                                    value="<?php echo e(!isset($company_payment_setting['paypal_client_id']) || is_null($company_payment_setting['paypal_client_id']) ? '' : $company_payment_setting['paypal_client_id']); ?>"
                                                                                    placeholder="<?php echo e(__('Client ID')); ?>">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="input-edits">
                                                                            <div class="form-group">
                                                                                <label class="col-form-label"
                                                                                    for="paypal_secret_key"><?php echo e(__('Secret Key')); ?></label>
                                                                                <input type="text"
                                                                                    name="paypal_secret_key"
                                                                                    id="paypal_secret_key"
                                                                                    class="form-control"
                                                                                    value="<?php echo e(isset($company_payment_setting['paypal_secret_key']) ? $company_payment_setting['paypal_secret_key'] : ''); ?>"
                                                                                    placeholder="<?php echo e(__('Secret Key')); ?>">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Paystack -->
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingThree">
                                                            <button class="accordion-button collapsed" type="button"
                                                                data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                                                aria-expanded="false" aria-controls="collapseThree">
                                                                <span class="d-flex align-items-center">
                                                                    <?php echo e(__('Paystack')); ?>

                                                                </span>
                                                                <div class="d-flex align-items-center">
                                                                    <span class="me-2"><?php echo e(__('Enable')); ?>:</span>
                                                                    <div class="form-check form-switch custom-switch-v1">
                                                                        <input type="hidden" name="is_paystack_enabled"
                                                                            value="off">
                                                                        <input type="checkbox"
                                                                            class="form-check-input input-primary"
                                                                            id="customswitchv1-1 is_paystack_enabled"
                                                                            name="is_paystack_enabled"
                                                                            <?php echo e(isset($company_payment_setting['is_paystack_enabled']) && $company_payment_setting['is_paystack_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                    </div>
                                                                </div>
                                                            </button>
                                                        </h2>
                                                        <div id="collapseThree" class="accordion-collapse collapse"
                                                            aria-labelledby="headingThree"
                                                            data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <div class="row gy-4">
                                                                    <div class="col-lg-6">
                                                                        <div class="input-edits">
                                                                            <div class="form-group">
                                                                                <label for="paypal_client_id"
                                                                                    class="col-form-label"><?php echo e(__('Public Key')); ?></label>
                                                                                <input type="text"
                                                                                    name="paystack_public_key"
                                                                                    id="paystack_public_key"
                                                                                    class="form-control"
                                                                                    value="<?php echo e(isset($company_payment_setting['paystack_public_key']) ? $company_payment_setting['paystack_public_key'] : ''); ?>"
                                                                                    placeholder="<?php echo e(__('Public Key')); ?>" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="input-edits">
                                                                            <div class="form-group">
                                                                                <label for="paystack_secret_key"
                                                                                    class="col-form-label"><?php echo e(__('Secret Key')); ?></label>
                                                                                <input type="text"
                                                                                    name="paystack_secret_key"
                                                                                    id="paystack_secret_key"
                                                                                    class="form-control"
                                                                                    value="<?php echo e(isset($company_payment_setting['paystack_secret_key']) ? $company_payment_setting['paystack_secret_key'] : ''); ?>"
                                                                                    placeholder="<?php echo e(__('Secret Key')); ?>" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Flutterwave -->
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingFour">
                                                            <button class="accordion-button collapsed" type="button"
                                                                data-bs-toggle="collapse" data-bs-target="#collapseFour"
                                                                aria-expanded="false" aria-controls="collapseFour">
                                                                <span class="d-flex align-items-center">
                                                                    <?php echo e(__('Flutterwave')); ?>

                                                                </span>
                                                                <div class="d-flex align-items-center">
                                                                    <span class="me-2"><?php echo e(__('Enable')); ?>:</span>
                                                                    <div class="form-check form-switch custom-switch-v1">
                                                                        <input type="hidden"
                                                                            name="is_flutterwave_enabled" value="off">
                                                                        <input type="checkbox"
                                                                            class="form-check-input input-primary"
                                                                            id="customswitchv1-1 is_flutterwave_enabled"
                                                                            name="is_flutterwave_enabled"
                                                                            <?php echo e(isset($company_payment_setting['is_flutterwave_enabled']) && $company_payment_setting['is_flutterwave_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                    </div>
                                                                </div>
                                                            </button>
                                                        </h2>
                                                        <div id="collapseFour" class="accordion-collapse collapse"
                                                            aria-labelledby="headingFour"
                                                            data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <div class="row gy-4">
                                                                    <div class="col-lg-6">
                                                                        <div class="input-edits">
                                                                            <div class="form-group">
                                                                                <label for="paypal_client_id"
                                                                                    class="col-form-label"><?php echo e(__('Public Key')); ?></label>
                                                                                <input type="text"
                                                                                    name="flutterwave_public_key"
                                                                                    id="flutterwave_public_key"
                                                                                    class="form-control"
                                                                                    value="<?php echo e(isset($company_payment_setting['flutterwave_public_key']) ? $company_payment_setting['flutterwave_public_key'] : ''); ?>"
                                                                                    placeholder="Public Key">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="input-edits">
                                                                            <div class="form-group">
                                                                                <label for="paystack_secret_key"
                                                                                    class="col-form-label"><?php echo e(__('Secret Key')); ?></label>
                                                                                <input type="text"
                                                                                    name="flutterwave_secret_key"
                                                                                    id="flutterwave_secret_key"
                                                                                    class="form-control"
                                                                                    value="<?php echo e(isset($company_payment_setting['flutterwave_secret_key']) ? $company_payment_setting['flutterwave_secret_key'] : ''); ?>"
                                                                                    placeholder="Secret Key">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Razorpay -->
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingFive">
                                                            <button class="accordion-button collapsed" type="button"
                                                                data-bs-toggle="collapse" data-bs-target="#collapseFive"
                                                                aria-expanded="false" aria-controls="collapseFive">
                                                                <span class="d-flex align-items-center">
                                                                    <?php echo e(__('Razorpay')); ?>

                                                                </span>
                                                                <div class="d-flex align-items-center">
                                                                    <span class="me-2"><?php echo e(__('Enable')); ?>:</span>
                                                                    <div class="form-check form-switch custom-switch-v1">
                                                                        <input type="hidden" name="is_razorpay_enabled"
                                                                            value="off">
                                                                        <input type="checkbox"
                                                                            class="form-check-input input-primary"
                                                                            id="customswitchv1-1 is_razorpay_enabled"
                                                                            name="is_razorpay_enabled"
                                                                            <?php echo e(isset($company_payment_setting['is_razorpay_enabled']) && $company_payment_setting['is_razorpay_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                    </div>
                                                                </div>
                                                            </button>
                                                        </h2>
                                                        <div id="collapseFive" class="accordion-collapse collapse"
                                                            aria-labelledby="headingFive"
                                                            data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <div class="row gy-4">
                                                                    <div class="col-lg-6">
                                                                        <div class="input-edits">
                                                                            <div class="form-group">
                                                                                <label for="paypal_client_id"
                                                                                    class="col-form-label"><?php echo e(__('Public Key')); ?></label>
                                                                                <input type="text"
                                                                                    name="razorpay_public_key"
                                                                                    id="razorpay_public_key"
                                                                                    class="form-control"
                                                                                    value="<?php echo e(!isset($company_payment_setting['razorpay_public_key']) || is_null($company_payment_setting['razorpay_public_key']) ? '' : $company_payment_setting['razorpay_public_key']); ?>"
                                                                                    placeholder="Public Key">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="input-edits">
                                                                            <div class="form-group">
                                                                                <label for="paystack_secret_key"
                                                                                    class="col-form-label">
                                                                                    <?php echo e(__('Secret Key')); ?></label>
                                                                                <input type="text"
                                                                                    name="razorpay_secret_key"
                                                                                    id="razorpay_secret_key"
                                                                                    class="form-control"
                                                                                    value="<?php echo e(!isset($company_payment_setting['razorpay_secret_key']) || is_null($company_payment_setting['razorpay_secret_key']) ? '' : $company_payment_setting['razorpay_secret_key']); ?>"
                                                                                    placeholder="Secret Key">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Paytm -->
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingSix">
                                                            <button class="accordion-button collapsed" type="button"
                                                                data-bs-toggle="collapse" data-bs-target="#collapseSix"
                                                                aria-expanded="false" aria-controls="collapseSix">
                                                                <span class="d-flex align-items-center">
                                                                    <?php echo e(__('Paytm')); ?>

                                                                </span>
                                                                <div class="d-flex align-items-center">
                                                                    <span class="me-2"><?php echo e(__('Enable')); ?>:</span>
                                                                    <div class="form-check form-switch custom-switch-v1">
                                                                        <input type="hidden" name="is_paytm_enabled"
                                                                            value="off">
                                                                        <input type="checkbox"
                                                                            class="form-check-input input-primary"
                                                                            id="customswitchv1-1 is_paytm_enabled"
                                                                            name="is_paytm_enabled"
                                                                            <?php echo e(isset($company_payment_setting['is_paytm_enabled']) && $company_payment_setting['is_paytm_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                    </div>
                                                                </div>
                                                            </button>
                                                        </h2>
                                                        <div id="collapseSix" class="accordion-collapse collapse"
                                                            aria-labelledby="headingSix"
                                                            data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <div class="col-md-12 pb-4">
                                                                    <label class="paypal-label col-form-label"
                                                                        for="paypal_mode"><?php echo e(__('Paytm Environment')); ?></label>
                                                                    <br>
                                                                    <div class="d-flex">
                                                                        <div class="mr-2" style="margin-right: 15px;">
                                                                            <div class="border card p-1">
                                                                                <div class="form-check">
                                                                                    <label
                                                                                        class="form-check-label text-dark me-2">
                                                                                        <input type="radio"
                                                                                            name="paytm_mode"
                                                                                            value="local"
                                                                                            class="form-check-input"
                                                                                            <?php echo e(!isset($company_payment_setting['paytm_mode']) || $company_payment_setting['paytm_mode'] == '' || $company_payment_setting['paytm_mode'] == 'local' ? 'checked="checked"' : ''); ?>>
                                                                                        <?php echo e(__('Local')); ?>

                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="mr-2">
                                                                            <div class="border card p-1">
                                                                                <div class="form-check">
                                                                                    <label
                                                                                        class="form-check-label text-dark me-2">
                                                                                        <input type="radio"
                                                                                            name="paytm_mode"
                                                                                            value="production"
                                                                                            class="form-check-input"
                                                                                            <?php echo e(isset($company_payment_setting['paytm_mode']) && $company_payment_setting['paytm_mode'] == 'production' ? 'checked="checked"' : ''); ?>>
                                                                                        <?php echo e(__('Production')); ?>

                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row gy-4">
                                                                    <div class="col-lg-4">
                                                                        <div class="input-edits">
                                                                            <div class="form-group">
                                                                                <label for="paytm_public_key"
                                                                                    class="col-form-label"><?php echo e(__('Merchant ID')); ?></label>
                                                                                <input type="text"
                                                                                    name="paytm_merchant_id"
                                                                                    id="paytm_merchant_id"
                                                                                    class="form-control"
                                                                                    value="<?php echo e(isset($company_payment_setting['paytm_merchant_id']) ? $company_payment_setting['paytm_merchant_id'] : ''); ?>"
                                                                                    placeholder="<?php echo e(__('Merchant ID')); ?>" />
                                                                                <?php if($errors->has('paytm_merchant_id')): ?>
                                                                                    <span class="invalid-feedback d-block">
                                                                                        <?php echo e($errors->first('paytm_merchant_id')); ?>

                                                                                    </span>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <div class="input-edits">
                                                                            <div class="form-group">
                                                                                <label for="paytm_secret_key"
                                                                                    class="col-form-label"><?php echo e(__('Merchant Key')); ?></label>
                                                                                <input type="text"
                                                                                    name="paytm_merchant_key"
                                                                                    id="paytm_merchant_key"
                                                                                    class="form-control"
                                                                                    value="<?php echo e(isset($company_payment_setting['paytm_merchant_key']) ? $company_payment_setting['paytm_merchant_key'] : ''); ?>"
                                                                                    placeholder="<?php echo e(__('Merchant Key')); ?>" />
                                                                                <?php if($errors->has('paytm_merchant_key')): ?>
                                                                                    <span class="invalid-feedback d-block">
                                                                                        <?php echo e($errors->first('paytm_merchant_key')); ?>

                                                                                    </span>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <div class="input-edits">
                                                                            <div class="form-group">
                                                                                <label for="paytm_industry_type"
                                                                                    class="col-form-label"><?php echo e(__('Industry Type')); ?></label>
                                                                                <input type="text"
                                                                                    name="paytm_industry_type"
                                                                                    id="paytm_industry_type"
                                                                                    class="form-control"
                                                                                    value="<?php echo e(isset($company_payment_setting['paytm_industry_type']) ? $company_payment_setting['paytm_industry_type'] : ''); ?>"
                                                                                    placeholder="<?php echo e(__('Industry Type')); ?>" />
                                                                                <?php if($errors->has('paytm_industry_type')): ?>
                                                                                    <span class="invalid-feedback d-block">
                                                                                        <?php echo e($errors->first('paytm_industry_type')); ?>

                                                                                    </span>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Mercado Pago -->
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingseven">
                                                            <button class="accordion-button collapsed" type="button"
                                                                data-bs-toggle="collapse" data-bs-target="#collapseseven"
                                                                aria-expanded="false" aria-controls="collapseseven">
                                                                <span class="d-flex align-items-center">
                                                                    <?php echo e(__('Mercado Pago')); ?>

                                                                </span>
                                                                <div class="d-flex align-items-center">
                                                                    <span class="me-2"><?php echo e(__('Enable')); ?>:</span>
                                                                    <div class="form-check form-switch custom-switch-v1">
                                                                        <input type="hidden" name="is_mercado_enabled"
                                                                            value="off">
                                                                        <input type="checkbox"
                                                                            class="form-check-input input-primary"
                                                                            id="customswitchv1-1 is_mercado_enabled"
                                                                            name="is_mercado_enabled"
                                                                            <?php echo e(isset($company_payment_setting['is_mercado_enabled']) && $company_payment_setting['is_mercado_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                    </div>
                                                                </div>
                                                            </button>
                                                        </h2>
                                                        <div id="collapseseven" class="accordion-collapse collapse"
                                                            aria-labelledby="headingseven"
                                                            data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <div class="col-md-12 pb-4">
                                                                    <label class="coingate-label col-form-label"
                                                                        for="mercado_mode"><?php echo e(__('Mercado Mode')); ?></label>
                                                                    <br>
                                                                    <div class="d-flex">
                                                                        <div class="mr-2" style="margin-right: 15px;">
                                                                            <div class="border card p-1">
                                                                                <div class="form-check">
                                                                                    <label
                                                                                        class="form-check-label text-dark me-2">
                                                                                        <input type="radio"
                                                                                            name="mercado_mode"
                                                                                            value="sandbox"
                                                                                            class="form-check-input"
                                                                                            <?php echo e((isset($company_payment_setting['mercado_mode']) && $company_payment_setting['mercado_mode'] == '') || (isset($company_payment_setting['mercado_mode']) && $company_payment_setting['mercado_mode'] == 'sandbox') ? 'checked="checked"' : ''); ?>>
                                                                                        <?php echo e(__('Sandbox')); ?>

                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="mr-2" style="margin-right: 15px;">
                                                                            <div class="border card p-1">
                                                                                <div class="form-check">
                                                                                    <label
                                                                                        class="form-check-label text-dark me-2">
                                                                                        <input type="radio"
                                                                                            name="mercado_mode"
                                                                                            value="live"
                                                                                            class="form-check-input"
                                                                                            <?php echo e(isset($company_payment_setting['mercado_mode']) && $company_payment_setting['mercado_mode'] == 'live' ? 'checked="checked"' : ''); ?>>
                                                                                        <?php echo e(__('Live')); ?>

                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row gy-4">
                                                                    <div class="col-lg-6">
                                                                        <div class="input-edits">
                                                                            <div class="form-group">
                                                                                <label for="mercado_access_token"
                                                                                    class="col-form-label"><?php echo e(__('Access Token')); ?></label>
                                                                                <input type="text"
                                                                                    name="mercado_access_token"
                                                                                    id="mercado_access_token"
                                                                                    class="form-control"
                                                                                    value="<?php echo e(isset($company_payment_setting['mercado_access_token']) ? $company_payment_setting['mercado_access_token'] : ''); ?>"
                                                                                    placeholder="<?php echo e(__('Access Token')); ?>" />
                                                                                <?php if($errors->has('mercado_secret_key')): ?>
                                                                                    <span
                                                                                        class="invalid-feedback d-block">
                                                                                        <?php echo e($errors->first('mercado_access_token')); ?>

                                                                                    </span>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Mollie -->
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingeight">
                                                            <button class="accordion-button collapsed" type="button"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#collapseeight" aria-expanded="false"
                                                                aria-controls="collapseeight">
                                                                <span class="d-flex align-items-center">
                                                                    <?php echo e(__('Mollie')); ?>

                                                                </span>
                                                                <div class="d-flex align-items-center">
                                                                    <span class="me-2"><?php echo e(__('Enable')); ?>:</span>
                                                                    <div class="form-check form-switch custom-switch-v1">
                                                                        <input type="hidden" name="is_mollie_enabled"
                                                                            value="off">
                                                                        <input type="checkbox"
                                                                            class="form-check-input input-primary"
                                                                            id="customswitchv1-1 is_mollie_enabled"
                                                                            name="is_mollie_enabled"
                                                                            <?php echo e(isset($company_payment_setting['is_mollie_enabled']) && $company_payment_setting['is_mollie_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                    </div>
                                                                </div>
                                                            </button>
                                                        </h2>
                                                        <div id="collapseeight" class="accordion-collapse collapse"
                                                            aria-labelledby="headingeight"
                                                            data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <div class="row gy-4">
                                                                    <div class="col-lg-6">
                                                                        <div class="input-edits">
                                                                            <div class="form-group">
                                                                                <label for="mollie_api_key"
                                                                                    class="col-form-label"><?php echo e(__('Mollie Api Key')); ?></label>
                                                                                <input type="text"
                                                                                    name="mollie_api_key"
                                                                                    id="mollie_api_key"
                                                                                    class="form-control"
                                                                                    value="<?php echo e(!isset($company_payment_setting['mollie_api_key']) || is_null($company_payment_setting['mollie_api_key']) ? '' : $company_payment_setting['mollie_api_key']); ?>"
                                                                                    placeholder="Mollie Api Key">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="input-edits">
                                                                            <div class="form-group">
                                                                                <label for="mollie_profile_id"
                                                                                    class="col-form-label"><?php echo e(__('Mollie Profile Id')); ?></label>
                                                                                <input type="text"
                                                                                    name="mollie_profile_id"
                                                                                    id="mollie_profile_id"
                                                                                    class="form-control"
                                                                                    value="<?php echo e(!isset($company_payment_setting['mollie_profile_id']) || is_null($company_payment_setting['mollie_profile_id']) ? '' : $company_payment_setting['mollie_profile_id']); ?>"
                                                                                    placeholder="Mollie Profile Id">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="input-edits">
                                                                            <div class="form-group">
                                                                                <label for="mollie_partner_id"
                                                                                    class="col-form-label"><?php echo e(__('Mollie Partner Id')); ?></label>
                                                                                <input type="text"
                                                                                    name="mollie_partner_id"
                                                                                    id="mollie_partner_id"
                                                                                    class="form-control"
                                                                                    value="<?php echo e(!isset($company_payment_setting['mollie_partner_id']) || is_null($company_payment_setting['mollie_partner_id']) ? '' : $company_payment_setting['mollie_partner_id']); ?>"
                                                                                    placeholder="Mollie Partner Id">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Skrill -->
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingnine">
                                                            <button class="accordion-button collapsed" type="button"
                                                                data-bs-toggle="collapse" data-bs-target="#collapsenine"
                                                                aria-expanded="false" aria-controls="collapsenine">
                                                                <span class="d-flex align-items-center">
                                                                    <?php echo e(__('Skrill')); ?>

                                                                </span>
                                                                <div class="d-flex align-items-center">
                                                                    <span class="me-2"><?php echo e(__('Enable')); ?>:</span>
                                                                    <div class="form-check form-switch custom-switch-v1">
                                                                        <input type="hidden" name="is_skrill_enabled"
                                                                            value="off">
                                                                        <input type="checkbox"
                                                                            class="form-check-input input-primary"
                                                                            id="customswitchv1-1 is_skrill_enabled"
                                                                            name="is_skrill_enabled"
                                                                            <?php echo e(isset($company_payment_setting['is_skrill_enabled']) && $company_payment_setting['is_skrill_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                    </div>
                                                                </div>
                                                            </button>
                                                        </h2>
                                                        <div id="collapsenine" class="accordion-collapse collapse"
                                                            aria-labelledby="headingnine"
                                                            data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <div class="row gy-4">
                                                                    <div class="col-lg-6">
                                                                        <div class="input-edits">
                                                                            <div class="form-group">
                                                                                <label for="mollie_api_key"
                                                                                    class="col-form-label"><?php echo e(__('Skrill Email')); ?></label>
                                                                                <input type="email"
                                                                                    name="skrill_email"
                                                                                    id="skrill_email"
                                                                                    class="form-control"
                                                                                    value="<?php echo e(isset($company_payment_setting['skrill_email']) ? $company_payment_setting['skrill_email'] : ''); ?>"
                                                                                    placeholder="<?php echo e(__('Enter Skrill Email')); ?>" />
                                                                                <?php if($errors->has('skrill_email')): ?>
                                                                                    <span
                                                                                        class="invalid-feedback d-block">
                                                                                        <?php echo e($errors->first('skrill_email')); ?>

                                                                                    </span>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- CoinGate -->
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingten">
                                                            <button class="accordion-button collapsed" type="button"
                                                                data-bs-toggle="collapse" data-bs-target="#collapseten"
                                                                aria-expanded="false" aria-controls="collapseten">
                                                                <span class="d-flex align-items-center">
                                                                    <?php echo e(__('CoinGate')); ?>

                                                                </span>
                                                                <div class="d-flex align-items-center">
                                                                    <span class="me-2"><?php echo e(__('Enable')); ?>:</span>
                                                                    <div class="form-check form-switch custom-switch-v1">
                                                                        <input type="hidden" name="is_coingate_enabled"
                                                                            value="off">
                                                                        <input type="checkbox"
                                                                            class="form-check-input input-primary"
                                                                            id="customswitchv1-1 is_coingate_enabled"
                                                                            name="is_coingate_enabled"
                                                                            <?php echo e(isset($company_payment_setting['is_coingate_enabled']) && $company_payment_setting['is_coingate_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                    </div>
                                                                </div>
                                                            </button>
                                                        </h2>
                                                        <div id="collapseten" class="accordion-collapse collapse"
                                                            aria-labelledby="headingten"
                                                            data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <div class="col-md-12 pb-4">
                                                                    <label class="col-form-label"
                                                                        for="coingate_mode"><?php echo e(__('CoinGate Mode')); ?></label>
                                                                    <br>
                                                                    <div class="d-flex">
                                                                        <div class="mr-2" style="margin-right: 15px;">
                                                                            <div class="border card p-1">
                                                                                <div class="form-check">
                                                                                    <label
                                                                                        class="form-check-label text-dark me-2">
                                                                                        <input type="radio"
                                                                                            name="coingate_mode"
                                                                                            value="sandbox"
                                                                                            class="form-check-input"
                                                                                            <?php echo e(!isset($company_payment_setting['coingate_mode']) || $company_payment_setting['coingate_mode'] == '' || $company_payment_setting['coingate_mode'] == 'sandbox' ? 'checked="checked"' : ''); ?>>
                                                                                        <?php echo e(__('Sandbox')); ?>

                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="mr-2" style="margin-right: 15px;">
                                                                            <div class="border card p-1">
                                                                                <div class="form-check">
                                                                                    <label
                                                                                        class="form-check-label text-dark me-2">
                                                                                        <input type="radio"
                                                                                            name="coingate_mode"
                                                                                            value="live"
                                                                                            class="form-check-input"
                                                                                            <?php echo e(isset($company_payment_setting['coingate_mode']) && $company_payment_setting['coingate_mode'] == 'live' ? 'checked="checked"' : ''); ?>>
                                                                                        <?php echo e(__('Live')); ?>

                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row gy-4">
                                                                    <div class="col-lg-6">
                                                                        <div class="input-edits">
                                                                            <div class="form-group">
                                                                                <label for="coingate_auth_token"
                                                                                    class="col-form-label"><?php echo e(__('CoinGate Auth Token')); ?></label>
                                                                                <input type="text"
                                                                                    name="coingate_auth_token"
                                                                                    id="coingate_auth_token"
                                                                                    class="form-control"
                                                                                    value="<?php echo e(!isset($company_payment_setting['coingate_auth_token']) || is_null($company_payment_setting['coingate_auth_token']) ? '' : $company_payment_setting['coingate_auth_token']); ?>"
                                                                                    placeholder="CoinGate Auth Token">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- PaymentWall -->
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingeleven">
                                                            <button class="accordion-button collapsed" type="button"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#collapseeleven" aria-expanded="false"
                                                                aria-controls="collapseeleven">
                                                                <span class="d-flex align-items-center">
                                                                    <?php echo e(__('PaymentWall')); ?>

                                                                </span>
                                                                <div class="d-flex align-items-center">
                                                                    <span class="me-2"><?php echo e(__('Enable')); ?>:</span>
                                                                    <div class="form-check form-switch custom-switch-v1">
                                                                        <input type="hidden"
                                                                            name="is_paymentwall_enabled"
                                                                            value="off">
                                                                        <input type="checkbox"
                                                                            class="form-check-input input-primary"
                                                                            id="customswitchv1-1 is_paymentwall_enabled"
                                                                            name="is_paymentwall_enabled"
                                                                            <?php echo e(isset($company_payment_setting['is_paymentwall_enabled']) && $company_payment_setting['is_paymentwall_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                    </div>
                                                                </div>
                                                            </button>
                                                        </h2>
                                                        <div id="collapseeleven" class="accordion-collapse collapse"
                                                            aria-labelledby="headingeleven"
                                                            data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <div class="row gy-4">
                                                                    <div class="col-lg-6">
                                                                        <div class="input-edits">
                                                                            <div class="form-group">
                                                                                <label for="paymentwall_public_key"
                                                                                    class="col-form-label"><?php echo e(__('Public Key')); ?></label>
                                                                                <input type="text"
                                                                                    name="paymentwall_public_key"
                                                                                    id="paymentwall_public_key"
                                                                                    class="form-control"
                                                                                    value="<?php echo e(!isset($company_payment_setting['paymentwall_public_key']) || is_null($company_payment_setting['paymentwall_public_key']) ? '' : $company_payment_setting['paymentwall_public_key']); ?>"
                                                                                    placeholder="<?php echo e(__('Public Key')); ?>">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="input-edits">
                                                                            <div class="form-group">
                                                                                <label for="paymentwall_secret_key"
                                                                                    class="col-form-label"><?php echo e(__('Private Key')); ?></label>
                                                                                <input type="text"
                                                                                    name="paymentwall_secret_key"
                                                                                    id="paymentwall_secret_key"
                                                                                    class="form-control"
                                                                                    value="<?php echo e(!isset($company_payment_setting['paymentwall_secret_key']) || is_null($company_payment_setting['paymentwall_secret_key']) ? '' : $company_payment_setting['paymentwall_secret_key']); ?>"
                                                                                    placeholder="<?php echo e(__('Private Key')); ?>">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Toyyibpay -->
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingtwelve">
                                                            <button class="accordion-button collapsed" type="button"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#collapsetwelve" aria-expanded="false"
                                                                aria-controls="collapsetwelve">
                                                                <span class="d-flex align-items-center">
                                                                    <?php echo e(__('Toyyibpay')); ?>

                                                                </span>
                                                                <div class="d-flex align-items-center">
                                                                    <span class="me-2"><?php echo e(__('Enable')); ?>:</span>
                                                                    <div class="form-check form-switch custom-switch-v1">
                                                                        <input type="hidden"
                                                                            name="is_toyyibpay_enabled" value="off">
                                                                        <input type="checkbox"
                                                                            class="form-check-input input-primary"
                                                                            id="customswitchv1-1 is_toyyibpay_enabled"
                                                                            name="is_toyyibpay_enabled"
                                                                            <?php echo e(isset($company_payment_setting['is_toyyibpay_enabled']) && $company_payment_setting['is_toyyibpay_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                    </div>
                                                                </div>
                                                            </button>
                                                        </h2>
                                                        <div id="collapsetwelve" class="accordion-collapse collapse"
                                                            aria-labelledby="headingtwelve"
                                                            data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <div class="row gy-4">
                                                                    <div class="col-lg-6">
                                                                        <div class="input-edits">
                                                                            <div class="form-group">
                                                                                <label for="toyyibpay_category_code"
                                                                                    class="col-form-label"><?php echo e(__('Category Key')); ?></label>
                                                                                <input type="text"
                                                                                    name="toyyibpay_category_code"
                                                                                    id="toyyibpay_category_code"
                                                                                    class="form-control"
                                                                                    value="<?php echo e(!isset($company_payment_setting['toyyibpay_category_code']) || is_null($company_payment_setting['toyyibpay_category_code']) ? '' : $company_payment_setting['toyyibpay_category_code']); ?>"
                                                                                    placeholder="<?php echo e(__('Category Key')); ?>">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="input-edits">
                                                                            <div class="form-group">
                                                                                <label for="toyyibpay_secret_key"
                                                                                    class="col-form-label"><?php echo e(__('Secrect Key')); ?></label>
                                                                                <input type="text"
                                                                                    name="toyyibpay_secret_key"
                                                                                    id="toyyibpay_secret_key"
                                                                                    class="form-control"
                                                                                    value="<?php echo e(!isset($company_payment_setting['toyyibpay_secret_key']) || is_null($company_payment_setting['toyyibpay_secret_key']) ? '' : $company_payment_setting['toyyibpay_secret_key']); ?>"
                                                                                    placeholder="<?php echo e(__('Secrect Key')); ?>">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Payfast -->
                                                    <div class="accordion accordion-flush setting-accordion"
                                                        id="accordionExample">
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header" id="headingOne">
                                                                <button class="accordion-button collapsed"
                                                                    type="button" data-bs-toggle="collapse"
                                                                    data-bs-target="#collapseOne13"
                                                                    aria-expanded="false" aria-controls="collapseOne13">
                                                                    <span class="d-flex align-items-center">
                                                                        <?php echo e(__('PayFast')); ?>

                                                                    </span>
                                                                    <div class="d-flex align-items-center">
                                                                        <span class="me-2"><?php echo e(__('Enable')); ?>:</span>
                                                                        <div
                                                                            class="form-check form-switch custom-switch-v1">
                                                                            <input type="hidden"
                                                                                name="is_payfast_enabled"
                                                                                value="off">
                                                                            <input type="checkbox"
                                                                                class="form-check-input"
                                                                                name="is_payfast_enabled"
                                                                                id="is_payfast_enabled"
                                                                                <?php echo e(isset($company_payment_setting['is_payfast_enabled']) && $company_payment_setting['is_payfast_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                        </div>
                                                                    </div>
                                                                </button>
                                                            </h2>
                                                            <div id="collapseOne13" class="accordion-collapse collapse"
                                                                aria-labelledby="headingOne"
                                                                data-bs-parent="#accordionExample">
                                                                <div class="accordion-body">
                                                                    <div class="row">
                                                                        <label class="paypal-label col-form-label"
                                                                            for="payfast_mode"><?php echo e(__('Payfast Mode')); ?></label>
                                                                        <div class="d-flex">
                                                                            <div class="mr-2"
                                                                                style="margin-right: 15px;">
                                                                                <div class="border card p-3">
                                                                                    <div class="form-check">
                                                                                        <label
                                                                                            class="form-check-labe text-dark <?php echo e(isset($company_payment_setting['payfast_mode']) && $company_payment_setting['payfast_mode'] == 'sandbox' ? 'active' : ''); ?>">
                                                                                            <input type="radio"
                                                                                                name="payfast_mode"
                                                                                                value="sandbox"
                                                                                                class="form-check-input"
                                                                                                <?php echo e(isset($company_payment_setting['payfast_mode']) && $company_payment_setting['payfast_mode'] == 'sandbox' ? 'checked="checked"' : ''); ?>>
                                                                                            <?php echo e(__('Sandbox')); ?>

                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="mr-2"
                                                                                style="margin-right: 15px;">
                                                                                <div class="border card p-3">
                                                                                    <div class="form-check">
                                                                                        <label
                                                                                            class="form-check-labe text-dark">
                                                                                            <input type="radio"
                                                                                                name="payfast_mode"
                                                                                                value="live"
                                                                                                class="form-check-input"
                                                                                                <?php echo e(isset($company_payment_setting['payfast_mode']) && $company_payment_setting['payfast_mode'] == 'live' ? 'checked="checked"' : ''); ?>>

                                                                                            <?php echo e(__('Live')); ?>

                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label for="paytm_public_key"
                                                                                    class="col-form-label"><?php echo e(__('Merchant ID')); ?></label>
                                                                                <input type="text"
                                                                                    name="payfast_merchant_id"
                                                                                    id="payfast_merchant_id"
                                                                                    class="form-control"
                                                                                    value="<?php echo e(!isset($company_payment_setting['payfast_merchant_id']) || is_null($company_payment_setting['payfast_merchant_id']) ? '' : $company_payment_setting['payfast_merchant_id']); ?>"
                                                                                    placeholder="Merchant ID">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label for="paytm_secret_key"
                                                                                    class="col-form-label"><?php echo e(__('Merchant Key')); ?></label>
                                                                                <input type="text"
                                                                                    name="payfast_merchant_key"
                                                                                    id="payfast_merchant_key"
                                                                                    class="form-control"
                                                                                    value="<?php echo e(!isset($company_payment_setting['payfast_merchant_key']) || is_null($company_payment_setting['payfast_merchant_key']) ? '' : $company_payment_setting['payfast_merchant_key']); ?>"
                                                                                    placeholder="Merchant Key">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label for="payfast_signature"
                                                                                    class="col-form-label"><?php echo e(__('Salt Passphrase')); ?></label>
                                                                                <input type="text"
                                                                                    name="payfast_signature"
                                                                                    id="payfast_signature"
                                                                                    class="form-control"
                                                                                    value="<?php echo e(!isset($company_payment_setting['payfast_signature']) || is_null($company_payment_setting['payfast_signature']) ? '' : $company_payment_setting['payfast_signature']); ?>"
                                                                                    placeholder="Industry Type">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Iyzipay -->
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingFourteen">
                                                            <button class="accordion-button collapsed" type="button"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#collapseFourteen" aria-expanded="false"
                                                                aria-controls="collapseFourteen">
                                                                <span class="d-flex align-items-center">
                                                                    <?php echo e(__('Iyzipay')); ?>

                                                                </span>
                                                                <div class="d-flex align-items-center">
                                                                    <span class="me-2">Enable:</span>
                                                                    <div class="form-check form-switch custom-switch-v1">
                                                                        <input type="hidden" name="is_iyzipay_enabled"
                                                                            value="off">
                                                                        <input type="checkbox"
                                                                            class="form-check-input input-primary"
                                                                            id="customswitchv1-1 is_iyzipay_enabled"
                                                                            name="is_iyzipay_enabled"
                                                                            <?php echo e(isset($company_payment_setting['is_iyzipay_enabled']) && $company_payment_setting['is_iyzipay_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                    </div>
                                                                </div>
                                                            </button>
                                                        </h2>
                                                        <div id="collapseFourteen" class="accordion-collapse collapse"
                                                            aria-labelledby="headingFourteen"
                                                            data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <div class="col-md-12 pb-4">
                                                                    
                                                                    
                                                                    
                                                                    <div class="d-flex">
                                                                        <div class="mr-2" style="margin-right: 15px;">
                                                                            <div class="border card p-1">
                                                                                <div class="form-check">
                                                                                    <label
                                                                                        class="form-check-label text-dark">
                                                                                        <input type="radio"
                                                                                            name="iyzipay_mode"
                                                                                            value="sandbox"
                                                                                            class="form-check-input"
                                                                                            <?php echo e((isset($company_payment_setting['iyzipay_mode']) && $company_payment_setting['iyzipay_mode'] == '') || (isset($company_payment_setting['iyzipay_mode']) && $company_payment_setting['iyzipay_mode'] == 'sandbox') ? 'checked="checked"' : ''); ?>>
                                                                                        <?php echo e(__('Sandbox')); ?>

                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="mr-2" style="margin-right: 15px;">
                                                                            <div class="border card p-1">
                                                                                <div class="form-check">
                                                                                    <label
                                                                                        class="form-check-label text-dark">
                                                                                        <input type="radio"
                                                                                            name="iyzipay_mode"
                                                                                            value="live"
                                                                                            class="form-check-input"
                                                                                            <?php echo e(isset($company_payment_setting['iyzipay_mode']) && $company_payment_setting['iyzipay_mode'] == 'live' ? 'checked="checked"' : ''); ?>>
                                                                                        <?php echo e(__('Live')); ?>

                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row gy-4">
                                                                    <div class="col-lg-6">
                                                                        <div class="input-edits">
                                                                            <div class="form-group">
                                                                                <label class="col-form-label"
                                                                                    for="iyzipay_public_key"><?php echo e(__('Public Key')); ?></label>
                                                                                <input type="text"
                                                                                    name="iyzipay_public_key"
                                                                                    id="iyzipay_public_key"
                                                                                    class="form-control"
                                                                                    value="<?php echo e(!isset($company_payment_setting['iyzipay_public_key']) || is_null($company_payment_setting['iyzipay_public_key']) ? '' : $company_payment_setting['iyzipay_public_key']); ?>"
                                                                                    placeholder="<?php echo e(__('Public Key')); ?>">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="input-edits">
                                                                            <div class="form-group">
                                                                                <label class="col-form-label"
                                                                                    for="iyzipay_secret_key"><?php echo e(__('Secret Key')); ?></label>
                                                                                <input type="text"
                                                                                    name="iyzipay_secret_key"
                                                                                    id="iyzipay_secret_key"
                                                                                    class="form-control"
                                                                                    value="<?php echo e(isset($company_payment_setting['iyzipay_secret_key']) ? $company_payment_setting['iyzipay_secret_key'] : ''); ?>"
                                                                                    placeholder="<?php echo e(__('Merchant Key')); ?>">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- SSPAY -->
                                                    <div class="accordion accordion-flush setting-accordion"
                                                        id="accordionExample">
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header" id="headingFourteen">
                                                                <button class="accordion-button collapsed"
                                                                    type="button" data-bs-toggle="collapse"
                                                                    data-bs-target="#collapse15" aria-expanded="false"
                                                                    aria-controls="collapse15">
                                                                    <span class="d-flex align-items-center">
                                                                        <?php echo e(__('SSpay')); ?>

                                                                    </span>
                                                                    <div class="d-flex align-items-center">
                                                                        <span class="me-2"><?php echo e(__('Enable')); ?>:</span>
                                                                        <div
                                                                            class="form-check form-switch custom-switch-v1">
                                                                            <input type="hidden"
                                                                                name="is_sspay_enabled" value="off">
                                                                            <input type="checkbox"
                                                                                class="form-check-input input-primary"
                                                                                id="customswitchv1-1 is_sspay_enabled"
                                                                                name="is_sspay_enabled"
                                                                                <?php echo e(isset($company_payment_setting['is_sspay_enabled']) && $company_payment_setting['is_sspay_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                        </div>
                                                                    </div>
                                                                </button>
                                                            </h2>
                                                            <div id="collapse15" class="accordion-collapse collapse"
                                                                aria-labelledby="headingFourteen"
                                                                data-bs-parent="#accordionExample">
                                                                <div class="accordion-body">
                                                                    <div class="row gy-4">
                                                                        <div class="col-lg-6">
                                                                            <div class="input-edits">
                                                                                <div class="form-group">
                                                                                    <label class="col-form-label"
                                                                                        for="sspay_category_code"><?php echo e(__('Category Code')); ?></label>
                                                                                    <input type="text"
                                                                                        name="sspay_category_code"
                                                                                        id="sspay_category_code"
                                                                                        class="form-control"
                                                                                        value="<?php echo e(!isset($company_payment_setting['sspay_category_code']) || is_null($company_payment_setting['sspay_category_code']) ? '' : $company_payment_setting['sspay_category_code']); ?>"
                                                                                        placeholder="<?php echo e(__('Category Code')); ?>">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="input-edits">
                                                                                <div class="form-group">
                                                                                    <label class="col-form-label"
                                                                                        for="sspay_secret_key"><?php echo e(__('Secret Key')); ?></label>
                                                                                    <input type="text"
                                                                                        name="sspay_secret_key"
                                                                                        id="sspay_secret_key"
                                                                                        class="form-control"
                                                                                        value="<?php echo e(isset($company_payment_setting['sspay_secret_key']) ? $company_payment_setting['sspay_secret_key'] : ''); ?>"
                                                                                        placeholder="<?php echo e(__('Secret Key')); ?>">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Paytab -->
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingTwenty">
                                                            <button class="accordion-button collapsed" type="button"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#collapseTwenty" aria-expanded="true"
                                                                aria-controls="collapseTwenty">
                                                                <span class="d-flex align-items-center">
                                                                    <?php echo e(__('PayTab')); ?>

                                                                </span>
                                                                <div class="d-flex align-items-center">
                                                                    <span class="me-2"><?php echo e(__('Enable:')); ?></span>
                                                                    <div
                                                                        class="form-check form-switch d-inline-block custom-switch-v1">
                                                                        <input type="hidden" name="is_paytab_enabled"
                                                                            value="off">
                                                                        <input type="checkbox" class="form-check-input"
                                                                            name="is_paytab_enabled"
                                                                            id="is_paytab_enabled"
                                                                            <?php echo e(isset($company_payment_setting['is_paytab_enabled']) && $company_payment_setting['is_paytab_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                        <label class="custom-control-label form-label"
                                                                            for="is_paytab_enabled"></label>
                                                                    </div>
                                                                </div>
                                                            </button>
                                                        </h2>
                                                        <div id="collapseTwenty"
                                                            class="accordion-collapse collapse"aria-labelledby="headingTwenty"
                                                            data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="paytab_profile_id"
                                                                                class="col-form-label"><?php echo e(__('Profile Id')); ?></label>
                                                                            <input type="text"
                                                                                name="paytab_profile_id"
                                                                                id="paytab_profile_id"
                                                                                class="form-control"
                                                                                value="<?php echo e(isset($company_payment_setting['paytab_profile_id']) ? $company_payment_setting['paytab_profile_id'] : ''); ?>"
                                                                                placeholder="<?php echo e(__('Profile Id')); ?>">
                                                                        </div>
                                                                        <?php if($errors->has('paytab_profile_id')): ?>
                                                                            <span class="invalid-feedback d-block">
                                                                                <?php echo e($errors->first('paytab_profile_id')); ?>

                                                                            </span>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="paytab_server_key"
                                                                                class="col-form-label"><?php echo e(__('Server Key')); ?></label>
                                                                            <input type="text"
                                                                                name="paytab_server_key"
                                                                                id="paytab_server_key"
                                                                                class="form-control"
                                                                                value="<?php echo e(isset($company_payment_setting['paytab_server_key']) ? $company_payment_setting['paytab_server_key'] : ''); ?>"
                                                                                placeholder="<?php echo e(__('Server Key')); ?>">
                                                                        </div>
                                                                        <?php if($errors->has('paytab_server_key')): ?>
                                                                            <span class="invalid-feedback d-block">
                                                                                <?php echo e($errors->first('paytab_server_key')); ?>

                                                                            </span>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="paytab_region"
                                                                                class="form-label"><?php echo e(__('Region')); ?></label>
                                                                            <input type="text" name="paytab_region"
                                                                                id="paytab_region"
                                                                                class="form-control form-control-label"
                                                                                value="<?php echo e(isset($company_payment_setting['paytab_region']) ? $company_payment_setting['paytab_region'] : ''); ?>"
                                                                                placeholder="<?php echo e(__('Region')); ?>" /><br>
                                                                            <?php if($errors->has('paytab_region')): ?>
                                                                                <span class="invalid-feedback d-block">
                                                                                    <?php echo e($errors->first('paytab_region')); ?>

                                                                                </span>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!--Benefit----->
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingTwentyOne">
                                                            <button class="accordion-button collapsed" type="button"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#collapseTwentyOne"
                                                                aria-expanded="false" aria-controls="collapseTwentyOne">
                                                                <span class="d-flex align-items-center">
                                                                    <?php echo e(__('Benefit')); ?>

                                                                </span>
                                                                <div class="d-flex align-items-center">
                                                                    <span class="me-2"><?php echo e(__('Enable')); ?>:</span>
                                                                    <div class="form-check form-switch custom-switch-v1">
                                                                        <input type="hidden" name="is_benefit_enabled"
                                                                            value="off">
                                                                        <input type="checkbox"
                                                                            class="form-check-input input-primary"
                                                                            name="is_benefit_enabled"
                                                                            id="is_benefit_enabled"
                                                                            <?php echo e(isset($company_payment_setting['is_benefit_enabled']) && $company_payment_setting['is_benefit_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                        <label class="form-check-label"
                                                                            for="is_benefit_enabled"></label>
                                                                    </div>
                                                                </div>
                                                            </button>
                                                        </h2>
                                                        <div id="collapseTwentyOne" class="accordion-collapse collapse"
                                                            aria-labelledby="headingTwentyOne"
                                                            data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <div class="row gy-4">

                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <?php echo e(Form::label('benefit_api_key', __('Benefit Key'), ['class' => 'col-form-label'])); ?>

                                                                            <?php echo e(Form::text('benefit_api_key', isset($company_payment_setting['benefit_api_key']) ? $company_payment_setting['benefit_api_key'] : '', ['class' => 'form-control', 'placeholder' => __('Enter Benefit Key')])); ?>

                                                                            <?php $__errorArgs = ['benefit_api_key'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                                <span class="invalid-benefit_api_key"
                                                                                    role="alert">
                                                                                    <strong
                                                                                        class="text-danger"><?php echo e($message); ?></strong>
                                                                                </span>
                                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <?php echo e(Form::label('benefit_secret_key', __('Benefit Secret Key'), ['class' => 'col-form-label'])); ?>

                                                                            <?php echo e(Form::text('benefit_secret_key', isset($company_payment_setting['benefit_secret_key']) ? $company_payment_setting['benefit_secret_key'] : '', ['class' => 'form-control ', 'placeholder' => __('Enter Benefit Secret key')])); ?>

                                                                            <?php $__errorArgs = ['benefit_secret_key'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                                <span class="invalid-benefit_secret_key"
                                                                                    role="alert">
                                                                                    <strong
                                                                                        class="text-danger"><?php echo e($message); ?></strong>
                                                                                </span>
                                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!--Cashfree----->
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingTwentyTwo">
                                                            <button class="accordion-button collapsed" type="button"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#collapseTwentyTwo"
                                                                aria-expanded="false" aria-controls="collapseTwentyTwo">
                                                                <span class="d-flex align-items-center">
                                                                    <?php echo e(__('Cashfree')); ?>

                                                                </span>
                                                                <div class="d-flex align-items-center">
                                                                    <span class="me-2"><?php echo e(__('Enable')); ?>:</span>
                                                                    <div class="form-check form-switch custom-switch-v1">
                                                                        <input type="hidden" name="is_cashfree_enabled"
                                                                            value="off">
                                                                        <input type="checkbox"
                                                                            class="form-check-input input-primary"
                                                                            name="is_cashfree_enabled"
                                                                            id="is_cashfree_enabled"
                                                                            <?php echo e(isset($company_payment_setting['is_cashfree_enabled']) && $company_payment_setting['is_cashfree_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                        <label class="form-check-label"
                                                                            for="is_cashfree_enabled"></label>
                                                                    </div>
                                                                </div>
                                                            </button>
                                                        </h2>
                                                        <div id="collapseTwentyTwo" class="accordion-collapse collapse"
                                                            aria-labelledby="headingTwentyTwo"
                                                            data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <div class="row gy-4">
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <?php echo e(Form::label('cashfree_api_key', __('Cashfree Key'), ['class' => 'col-form-label'])); ?>

                                                                            <?php echo e(Form::text('cashfree_api_key', isset($company_payment_setting['cashfree_api_key']) ? $company_payment_setting['cashfree_api_key'] : '', ['class' => 'form-control', 'placeholder' => __('Enter Cashfree Key')])); ?>

                                                                            <?php $__errorArgs = ['cashfree_api_key'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                                <span class="invalid-cashfree_api_key"
                                                                                    role="alert">
                                                                                    <strong
                                                                                        class="text-danger"><?php echo e($message); ?></strong>
                                                                                </span>
                                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <?php echo e(Form::label('cashfree_secret_key', __('Cashfree Secret Key'), ['class' => 'col-form-label'])); ?>

                                                                            <?php echo e(Form::text('cashfree_secret_key', isset($company_payment_setting['cashfree_secret_key']) ? $company_payment_setting['cashfree_secret_key'] : '', ['class' => 'form-control ', 'placeholder' => __('Enter Cashfree Secret key')])); ?>

                                                                            <?php $__errorArgs = ['cashfree_secret_key'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                                <span class="invalid-cashfree_secret_key"
                                                                                    role="alert">
                                                                                    <strong
                                                                                        class="text-danger"><?php echo e($message); ?></strong>
                                                                                </span>
                                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!--Aamarpay----->
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingTwenty-One">
                                                            <button class="accordion-button" type="button"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#collapseTwenty-One"
                                                                aria-expanded="true" aria-controls="collapseTwenty-One">
                                                                <span class="d-flex align-items-center">
                                                                    <?php echo e(__('Aamarpay')); ?>

                                                                </span>
                                                                <div class="d-flex align-items-center">
                                                                    <span class="me-2"><?php echo e(__('Enable')); ?>:</span>
                                                                    <div class="form-check form-switch custom-switch-v1">
                                                                        <input type="hidden" name="is_aamarpay_enabled"
                                                                            value="off">
                                                                        <input type="checkbox"
                                                                            class="form-check-input input-primary"
                                                                            name="is_aamarpay_enabled"
                                                                            id="is_aamarpay_enabled"
                                                                            <?php echo e(isset($company_payment_setting['is_aamarpay_enabled']) && $company_payment_setting['is_aamarpay_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                        <label class="form-check-label"
                                                                            for="is_aamarpay_enabled"></label>
                                                                    </div>
                                                                </div>
                                                            </button>
                                                        </h2>
                                                        <div id="collapseTwenty-One" class="accordion-collapse collapse"
                                                            aria-labelledby="headingTwenty-One"
                                                            data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <div class="row pt-2">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <?php echo e(Form::label('aamarpay_store_id', __('Store Id'), ['class' => 'form-label'])); ?>

                                                                            <?php echo e(Form::text('aamarpay_store_id', isset($company_payment_setting['aamarpay_store_id']) ? $company_payment_setting['aamarpay_store_id'] : '', ['class' => 'form-control', 'placeholder' => __('Enter Store Id')])); ?><br>
                                                                            <?php if($errors->has('aamarpay_store_id')): ?>
                                                                                <span class="invalid-feedback d-block">
                                                                                    <?php echo e($errors->first('aamarpay_store_id')); ?>

                                                                                </span>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <?php echo e(Form::label('aamarpay_signature_key', __('Signature Key'), ['class' => 'form-label'])); ?>

                                                                            <?php echo e(Form::text('aamarpay_signature_key', isset($company_payment_setting['aamarpay_signature_key']) ? $company_payment_setting['aamarpay_signature_key'] : '', ['class' => 'form-control', 'placeholder' => __('Enter Signature Key')])); ?><br>
                                                                            <?php if($errors->has('aamarpay_signature_key')): ?>
                                                                                <span class="invalid-feedback d-block">
                                                                                    <?php echo e($errors->first('aamarpay_signature_key')); ?>

                                                                                </span>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <?php echo e(Form::label('aamarpay_description', __('Description'), ['class' => 'form-label'])); ?>

                                                                            <?php echo e(Form::text('aamarpay_description', isset($company_payment_setting['aamarpay_description']) ? $company_payment_setting['aamarpay_description'] : '', ['class' => 'form-control', 'placeholder' => __('Enter Description')])); ?><br>
                                                                            <?php if($errors->has('aamarpay_description')): ?>
                                                                                <span class="invalid-feedback d-block">
                                                                                    <?php echo e($errors->first('aamarpay_description')); ?>

                                                                                </span>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!--PayTR----->
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingTwenty-Two">
                                                            <button class="accordion-button" type="button"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#collapseTwentyfive"
                                                                aria-expanded="true" aria-controls="collapseTwentyfive">
                                                                <span class="d-flex align-items-center">
                                                                    <?php echo e(__('PayTR')); ?>

                                                                </span>
                                                                <div class="d-flex align-items-center">
                                                                    <label class="form-check-label m-1"
                                                                        for="is_paytr_enabled"><?php echo e(__('Enable')); ?></label>
                                                                    <div class="form-check form-switch custom-switch-v1">
                                                                        <input type="hidden" name="is_paytr_enabled"
                                                                            value="off">
                                                                        <input type="checkbox"
                                                                            class="form-check-input input-primary"
                                                                            name="is_paytr_enabled"
                                                                            id="is_paytr_enabled"
                                                                            <?php echo e(isset($company_payment_setting['is_paytr_enabled']) && $company_payment_setting['is_paytr_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                    </div>
                                                                </div>
                                                            </button>
                                                        </h2>
                                                        <div id="collapseTwentyfive" class="accordion-collapse collapse"
                                                            aria-labelledby="headingTwenty-Two"
                                                            data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <div class="row pt-2">
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <?php echo e(Form::label('paytr_merchant_id', __('Merchant Id'), ['class' => 'form-label'])); ?>

                                                                            <?php echo e(Form::text('paytr_merchant_id', isset($company_payment_setting['paytr_merchant_id']) ? $company_payment_setting['paytr_merchant_id'] : '', ['class' => 'form-control', 'placeholder' => __('Merchant Id')])); ?><br>
                                                                            <?php if($errors->has('paytr_merchant_id')): ?>
                                                                                <span class="invalid-feedback d-block">
                                                                                    <?php echo e($errors->first('paytr_merchant_id')); ?>

                                                                                </span>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <?php echo e(Form::label('paytr_merchant_key', __('Merchant Key'), ['class' => 'form-label'])); ?>

                                                                            <?php echo e(Form::text('paytr_merchant_key', isset($company_payment_setting['paytr_merchant_key']) ? $company_payment_setting['paytr_merchant_key'] : '', ['class' => 'form-control', 'placeholder' => __('Merchant Key')])); ?><br>
                                                                            <?php if($errors->has('paytr_merchant_key')): ?>
                                                                                <span class="invalid-feedback d-block">
                                                                                    <?php echo e($errors->first('paytr_merchant_key')); ?>

                                                                                </span>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <?php echo e(Form::label('paytr_merchant_salt', __('Merchant Salt'), ['class' => 'form-label'])); ?>

                                                                            <?php echo e(Form::text('paytr_merchant_salt', isset($company_payment_setting['paytr_merchant_salt']) ? $company_payment_setting['paytr_merchant_salt'] : '', ['class' => 'form-control', 'placeholder' => __('Merchant Salt')])); ?><br>
                                                                            <?php if($errors->has('paytr_merchant_salt')): ?>
                                                                                <span class="invalid-feedback d-block">
                                                                                    <?php echo e($errors->first('paytr_merchant_salt')); ?>

                                                                                </span>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!--Yookassa----->
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingTwenty-Three">
                                                            <button class="accordion-button" type="button"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#collapseTwentysix" aria-expanded="true"
                                                                aria-controls="collapseTwentysix">
                                                                <span class="d-flex align-items-center">
                                                                    <?php echo e(__('Yookassa')); ?>

                                                                </span>
                                                                <div class="d-flex align-items-center">
                                                                    <label class="form-check-label m-1"
                                                                        for="is_yookassa_enabled"><?php echo e(__('Enable')); ?></label>
                                                                    <div class="form-check form-switch custom-switch-v1">
                                                                        <input type="hidden" name="is_yookassa_enabled"
                                                                            value="off">
                                                                        <input type="checkbox"
                                                                            class="form-check-input input-primary"
                                                                            name="is_yookassa_enabled"
                                                                            id="is_yookassa_enabled"
                                                                            <?php echo e(isset($company_payment_setting['is_yookassa_enabled']) && $company_payment_setting['is_yookassa_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                    </div>
                                                                </div>
                                                            </button>
                                                        </h2>
                                                        <div id="collapseTwentysix" class="accordion-collapse collapse"
                                                            aria-labelledby="headingTwenty-Three"
                                                            data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <div class="row pt-2">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <?php echo e(Form::label('yookassa_shop_id', __('Shop ID Key'), ['class' => 'form-label'])); ?>

                                                                            <?php echo e(Form::text('yookassa_shop_id', isset($company_payment_setting['yookassa_shop_id']) ? $company_payment_setting['yookassa_shop_id'] : '', ['class' => 'form-control', 'placeholder' => __('Merchant Id')])); ?><br>
                                                                            <?php if($errors->has('yookassa_shop_id')): ?>
                                                                                <span class="invalid-feedback d-block">
                                                                                    <?php echo e($errors->first('yookassa_shop_id')); ?>

                                                                                </span>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <?php echo e(Form::label('yookassa_secret', __('Secret Key'), ['class' => 'form-label'])); ?>

                                                                            <?php echo e(Form::text('yookassa_secret', isset($company_payment_setting['yookassa_secret']) ? $company_payment_setting['yookassa_secret'] : '', ['class' => 'form-control', 'placeholder' => __('Merchant Key')])); ?><br>
                                                                            <?php if($errors->has('yookassa_secret')): ?>
                                                                                <span class="invalid-feedback d-block">
                                                                                    <?php echo e($errors->first('yookassa_secret')); ?>

                                                                                </span>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!--Midtrans----->
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingTwenty-four">
                                                            <button class="accordion-button" type="button"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#collapseTwentyseven"
                                                                aria-expanded="true"
                                                                aria-controls="collapseTwentyseven">
                                                                <span class="d-flex align-items-center">
                                                                    <?php echo e(__('Midtrans')); ?>

                                                                </span>
                                                                <div class="d-flex align-items-center">
                                                                    <label class="form-check-label m-1"
                                                                        for="is_midtrans_enabled"><?php echo e(__('Enable')); ?></label>
                                                                    <div class="form-check form-switch custom-switch-v1">
                                                                        <input type="hidden" name="is_midtrans_enabled"
                                                                            value="off">
                                                                        <input type="checkbox"
                                                                            class="form-check-input input-primary"
                                                                            name="is_midtrans_enabled"
                                                                            id="is_midtrans_enabled"
                                                                            <?php echo e(isset($company_payment_setting['is_midtrans_enabled']) && $company_payment_setting['is_midtrans_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                    </div>
                                                                </div>
                                                            </button>
                                                        </h2>
                                                        <div id="collapseTwentyseven"
                                                            class="accordion-collapse collapse"
                                                            aria-labelledby="headingTwenty-four"
                                                            data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <div class="col-md-12 pb-4">
                                                                    <label class="midtrans-label col-form-label"
                                                                        for="midtrans_mode"><?php echo e(__('Midtrans Mode')); ?></label>
                                                                    <br>
                                                                    <div class="d-flex">
                                                                        <div class="mr-2" style="margin-right: 15px;">
                                                                            <div class="border card p-1">
                                                                                <div class="form-check">
                                                                                    <label
                                                                                        class="form-check-label text-dark">
                                                                                        <input type="radio"
                                                                                            name="midtrans_mode"
                                                                                            value="sandbox"
                                                                                            class="form-check-input"
                                                                                            <?php echo e((isset($company_payment_setting['midtrans_mode']) && $company_payment_setting['midtrans_mode'] == '') || (isset($company_payment_setting['midtrans_mode']) && $company_payment_setting['midtrans_mode'] == 'sandbox') ? 'checked="checked"' : ''); ?>>
                                                                                        <?php echo e(__('Sandbox')); ?>

                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="mr-2" style="margin-right: 15px;">
                                                                            <div class="border card p-1">
                                                                                <div class="form-check">
                                                                                    <label
                                                                                        class="form-check-label text-dark">
                                                                                        <input type="radio"
                                                                                            name="midtrans_mode"
                                                                                            value="live"
                                                                                            class="form-check-input"
                                                                                            <?php echo e(isset($company_payment_setting['midtrans_mode']) && $company_payment_setting['midtrans_mode'] == 'live' ? 'checked="checked"' : ''); ?>>
                                                                                        <?php echo e(__('Live')); ?>

                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row pt-2">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <?php echo e(Form::label('midtrans_secret', __('Secret Key'), ['class' => 'form-label'])); ?>

                                                                            <?php echo e(Form::text('midtrans_secret', isset($company_payment_setting['midtrans_secret']) ? $company_payment_setting['midtrans_secret'] : '', ['class' => 'form-control', 'placeholder' => __('Merchant Id')])); ?><br>
                                                                            <?php if($errors->has('midtrans_secret')): ?>
                                                                                <span class="invalid-feedback d-block">
                                                                                    <?php echo e($errors->first('midtrans_secret')); ?>

                                                                                </span>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!--Xendit----->
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingTwenty-five">
                                                            <button class="accordion-button" type="button"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#collapseTwentyeight"
                                                                aria-expanded="true"
                                                                aria-controls="collapseTwentyeight">
                                                                <span class="d-flex align-items-center">
                                                                    <?php echo e(__('Xendit')); ?>

                                                                </span>
                                                                <div class="d-flex align-items-center">
                                                                    <label class="form-check-label m-1"
                                                                        for="is_xendit_enabled"><?php echo e(__('Enable')); ?></label>
                                                                    <div class="form-check form-switch custom-switch-v1">
                                                                        <input type="hidden" name="is_xendit_enabled"
                                                                            value="off">
                                                                        <input type="checkbox"
                                                                            class="form-check-input input-primary"
                                                                            name="is_xendit_enabled"
                                                                            id="is_xendit_enabled"
                                                                            <?php echo e(isset($company_payment_setting['is_xendit_enabled']) && $company_payment_setting['is_xendit_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                    </div>
                                                                </div>
                                                            </button>
                                                        </h2>
                                                        <div id="collapseTwentyeight"
                                                            class="accordion-collapse collapse"
                                                            aria-labelledby="headingTwenty-five"
                                                            data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <div class="row pt-2">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <?php echo e(Form::label('xendit_api', __('API Key'), ['class' => 'form-label'])); ?>

                                                                            <?php echo e(Form::text('xendit_api', isset($company_payment_setting['xendit_api']) ? $company_payment_setting['xendit_api'] : '', ['class' => 'form-control', 'placeholder' => __('API Key')])); ?><br>
                                                                            <?php if($errors->has('xendit_api')): ?>
                                                                                <span class="invalid-feedback d-block">
                                                                                    <?php echo e($errors->first('xendit_api')); ?>

                                                                                </span>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <?php echo e(Form::label('xendit_token', __('Token'), ['class' => 'form-label'])); ?>

                                                                            <?php echo e(Form::text('xendit_token', isset($company_payment_setting['xendit_token']) ? $company_payment_setting['xendit_token'] : '', ['class' => 'form-control', 'placeholder' => __('Token')])); ?><br>
                                                                            <?php if($errors->has('xendit_token')): ?>
                                                                                <span class="invalid-feedback d-block">
                                                                                    <?php echo e($errors->first('xendit_token')); ?>

                                                                                </span>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!--Nepalste----->
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingTwenty-six">
                                                            <button class="accordion-button" type="button"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#collapseTwentynine"
                                                                aria-expanded="true" aria-controls="collapseTwentynine">
                                                                <span class="d-flex align-items-center">
                                                                    <?php echo e(__('Nepalste')); ?>

                                                                </span>
                                                                <div class="d-flex align-items-center">
                                                                    <label class="form-check-label m-1"
                                                                        for="is_nepalste_enabled"><?php echo e(__('Enable')); ?></label>
                                                                    <div class="form-check form-switch custom-switch-v1">
                                                                        <input type="hidden" name="is_nepalste_enabled"
                                                                            value="off">
                                                                        <input type="checkbox"
                                                                            class="form-check-input input-primary"
                                                                            name="is_nepalste_enabled"
                                                                            id="is_nepalste_enabled"
                                                                            <?php echo e(isset($company_payment_setting['is_nepalste_enabled']) && $company_payment_setting['is_nepalste_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                    </div>
                                                                </div>
                                                            </button>
                                                        </h2>
                                                        <div id="collapseTwentynine" class="accordion-collapse collapse"
                                                            aria-labelledby="headingTwenty-six"
                                                            data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <div class="row pt-2">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <?php echo e(Form::label('nepalste_public_key', __('Public Key'), ['class' => 'form-label'])); ?>

                                                                            <?php echo e(Form::text('nepalste_public_key', isset($company_payment_setting['nepalste_public_key']) ? $company_payment_setting['nepalste_public_key'] : '', ['class' => 'form-control', 'placeholder' => __('API Key')])); ?><br>
                                                                            <?php if($errors->has('nepalste_public_key')): ?>
                                                                                <span class="invalid-feedback d-block">
                                                                                    <?php echo e($errors->first('nepalste_public_key')); ?>

                                                                                </span>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <?php echo e(Form::label('nepalste_secret_key', __('Secret Key'), ['class' => 'form-label'])); ?>

                                                                            <?php echo e(Form::text('nepalste_secret_key', isset($company_payment_setting['nepalste_secret_key']) ? $company_payment_setting['nepalste_secret_key'] : '', ['class' => 'form-control', 'placeholder' => __('Token')])); ?><br>
                                                                            <?php if($errors->has('nepalste_secret_key')): ?>
                                                                                <span class="invalid-feedback d-block">
                                                                                    <?php echo e($errors->first('nepalste_secret_key')); ?>

                                                                                </span>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <div class="form-group">
                                <input class="btn btn-print-invoice  btn-primary m-r-10" type="submit"
                                    value="<?php echo e(__('Save Changes')); ?>">
                            </div>
                        </div>
                        </form>
                    </div>

                    <!--Zoom - Metting Settings-->
                    <div id="zoom-settings" class="card">
                        <div class="card-header">
                            <h5><?php echo e(__('Zoom Settings')); ?></h5>
                            <small class="text-muted"><?php echo e(__('Edit your Zoom settings')); ?></small>
                        </div>
                        <?php echo e(Form::model($setting, ['route' => 'zoom.settings', 'method' => 'post'])); ?>

                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="form-control-label"><?php echo e(__('Zoom Account ID')); ?></label> <br>
                                    <?php echo e(Form::text('zoom_account_id', isset($setting['zoom_account_id']) ? $setting['zoom_account_id'] : '', ['class' => 'form-control', 'placeholder' => __('Enter Zoom Accound Id')])); ?>

                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-control-label"><?php echo e(__('Zoom Client ID')); ?></label> <br>
                                    <?php echo e(Form::text('zoom_client_id', isset($setting['zoom_client_id']) ? $setting['zoom_client_id'] : '', ['class' => 'form-control', 'placeholder' => __('Enter Zoom Client Id')])); ?>

                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-control-label"><?php echo e(__('Zoom Client Secret Key')); ?></label> <br>
                                    <?php echo e(Form::text('zoom_client_secret', isset($setting['zoom_client_secret']) ? $setting['zoom_client_secret'] : '', ['class' => 'form-control', 'placeholder' => __('Enter Zoom Client Secret Key')])); ?>

                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <div class="form-group">
                                <input class="btn btn-print-invoice btn-primary m-r-10" type="submit"
                                    value="<?php echo e(__('Save Changes')); ?>">
                            </div>
                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>

                    <!--Slack Settings-->
                    <div id="slack-settings" class="card">
                        <div class="card-header">
                            <h5><?php echo e(__('Slack Settings')); ?></h5>
                            <small class="text-muted"><?php echo e(__('Edit your Slack settings')); ?></small>
                        </div>
                        <?php echo e(Form::open(['route' => 'slack.settings', 'id' => 'slack-setting', 'method' => 'post', 'class' => 'd-contents'])); ?>

                        <div class="card-body">
                            <div class="form-group col-md-12">
                                <label class="form-label"><?php echo e(__('Slack Webhook URL')); ?></label> <br>
                                <?php echo e(Form::text('slack_webhook', isset($setting['slack_webhook']) ? $setting['slack_webhook'] : '', ['class' => 'form-control w-100', 'placeholder' => __('Enter Slack Webhook URL'), 'required' => 'required'])); ?>

                            </div>
                            <div class="col-md-12 mt-5 mb-2">
                                <h5 class="small-title"><?php echo e(__('Module Settings')); ?></h5>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Lead')); ?></span>
                                                <?php echo e(Form::checkbox('lead_notification', '1', isset($setting['lead_notification']) && $setting['lead_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'lead_notification'])); ?>

                                                <label class="form-check-label" for="lead_notification"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Deal')); ?></span>
                                                <?php echo e(Form::checkbox('deal_notification', '1', isset($setting['deal_notification']) && $setting['deal_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'deal_notification'])); ?>

                                                <label class="form-check-label" for="deal_notification"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-md-3">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('Lead to Deal Conversion')); ?></span>
                                                <?php echo e(Form::checkbox('leadtodeal_notification', '1', isset($setting['leadtodeal_notification']) && $setting['leadtodeal_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'leadtodeal_notification'])); ?>

                                                <label class="form-check-label" for="leadtodeal_notification"></label>

                                            </div>

                                        </li>
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Contract')); ?></span>
                                                <?php echo e(Form::checkbox('contract_notification', '1', isset($setting['contract_notification']) && $setting['contract_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'contract_notification'])); ?>

                                                <label class="form-check-label" for="contract_notification"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-md-3">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Project')); ?></span>
                                                <?php echo e(Form::checkbox('project_notification', '1', isset($setting['project_notification']) && $setting['project_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'project_notification'])); ?>

                                                <label class="form-check-label" for="project_notification"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Task')); ?></span>
                                                <?php echo e(Form::checkbox('task_notification', '1', isset($setting['task_notification']) && $setting['task_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'task_notification'])); ?>

                                                <label class="form-check-label" for="task_notification"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-md-3">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('Task Stage Updated')); ?></span>
                                                <?php echo e(Form::checkbox('taskmove_notification', '1', isset($setting['taskmove_notification']) && $setting['taskmove_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'taskmove_notification'])); ?>

                                                <label class="form-check-label" for="taskmove_notification"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Task Comment')); ?></span>
                                                <?php echo e(Form::checkbox('taskcomment_notification', '1', isset($setting['taskcomment_notification']) && $setting['taskcomment_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'taskcomment_notification'])); ?>

                                                <label class="form-check-label" for="taskcomment_notification"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                            <div class="row mt-2">
                                <div class="col-md-3">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Monthly Payslip')); ?></span>
                                                <?php echo e(Form::checkbox('payslip_notification', '1', isset($setting['payslip_notification']) && $setting['payslip_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'payslip_notification'])); ?>

                                                <label class="form-check-label" for="payslip_notification"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Award')); ?></span>
                                                <?php echo e(Form::checkbox('award_notification', '1', isset($setting['award_notification']) && $setting['award_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'award_notification'])); ?>

                                                <label class="form-check-label" for="award_notification"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-md-3">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Announcement')); ?></span>
                                                <?php echo e(Form::checkbox('announcement_notification', '1', isset($setting['announcement_notification']) && $setting['announcement_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'announcement_notification'])); ?>

                                                <label class="form-check-label" for="announcement_notification"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Holiday')); ?></span>
                                                <?php echo e(Form::checkbox('holiday_notification', '1', isset($setting['holiday_notification']) && $setting['holiday_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'holiday_notification'])); ?>

                                                <label class="form-check-label" for="holiday_notification"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-md-3">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Support Ticket')); ?></span>
                                                <?php echo e(Form::checkbox('support_notification', '1', isset($setting['support_notification']) && $setting['support_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'support_notification'])); ?>

                                                <label class="form-check-label" for="support_notification"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Event')); ?></span>
                                                <?php echo e(Form::checkbox('event_notification', '1', isset($setting['event_notification']) && $setting['event_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'event_notification'])); ?>

                                                <label class="form-check-label" for="event_notification"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-md-3">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Meeting')); ?></span>
                                                <?php echo e(Form::checkbox('meeting_notification', '1', isset($setting['meeting_notification']) && $setting['meeting_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'meeting_notification'])); ?>

                                                <label class="form-check-label" for="meeting_notification"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Company Policy')); ?></span>
                                                <?php echo e(Form::checkbox('policy_notification', '1', isset($setting['policy_notification']) && $setting['policy_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'policy_notification'])); ?>

                                                <label class="form-check-label" for="policy_notification"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                            <div class="row mt-2">
                                <div class="col-md-3">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Invoice')); ?></span>
                                                <?php echo e(Form::checkbox('invoice_notification', '1', isset($setting['invoice_notification']) && $setting['invoice_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'invoice_notification'])); ?>

                                                <label class="form-check-label" for="invoice_notification"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Revenue')); ?></span>
                                                <?php echo e(Form::checkbox('revenue_notification', '1', isset($setting['revenue_notification']) && $setting['revenue_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'revenue_notification'])); ?>

                                                <label class="form-check-label" for="revenue_notification"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-md-3">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Bill')); ?></span>
                                                <?php echo e(Form::checkbox('bill_notification', '1', isset($setting['bill_notification']) && $setting['bill_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'bill_notification'])); ?>

                                                <label class="form-check-label" for="bill_notification"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Invoice Payment')); ?></span>
                                                <?php echo e(Form::checkbox('payment_notification', '1', isset($setting['payment_notification']) && $setting['payment_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'payment_notification'])); ?>

                                                <label class="form-check-label" for="payment_notification"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-md-3">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Budget')); ?></span>
                                                <?php echo e(Form::checkbox('budget_notification', '1', isset($setting['budget_notification']) && $setting['budget_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'budget_notification'])); ?>

                                                <label class="form-check-label" for="budget_notification"></label>
                                            </div>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <div class="form-group">
                                <input class="btn btn-print-invoice btn-primary m-r-10" type="submit"
                                    value="<?php echo e(__('Save Changes')); ?>">
                            </div>
                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>

                    <!--Telegram Settings-->
                    <div id="telegram-settings" class="card">
                        <div class="card-header">
                            <h5><?php echo e(__('Telegram Settings')); ?></h5>
                            <small class="text-muted"><?php echo e(__('Edit your Telegram settings')); ?></small>
                        </div>
                        <?php echo e(Form::open(['route' => 'telegram.settings', 'id' => 'telegram-setting', 'method' => 'post', 'class' => 'd-contents'])); ?>


                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="form-label"><?php echo e(__('Telegram AccessToken')); ?></label> <br>
                                    <?php echo e(Form::text('telegram_accestoken', isset($setting['telegram_accestoken']) ? $setting['telegram_accestoken'] : '', ['class' => 'form-control', 'placeholder' => __('Enter Telegram AccessToken')])); ?>

                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label "><?php echo e(__('Telegram ChatID')); ?></label> <br>
                                    <?php echo e(Form::text('telegram_chatid', isset($setting['telegram_chatid']) ? $setting['telegram_chatid'] : '', ['class' => 'form-control', 'placeholder' => __('Enter Telegram ChatID')])); ?>

                                </div>
                            </div>
                            <div class="col-md-12 mt-5 mb-2">
                                <h5 class="small-title"><?php echo e(__('Module Settings')); ?></h5>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Lead')); ?></span>
                                                <?php echo e(Form::checkbox('telegram_lead_notification', '1', isset($setting['telegram_lead_notification']) && $setting['telegram_lead_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'telegram_lead_notification'])); ?>

                                                <label class="form-check-label"
                                                    for="telegram_lead_notification"></label>

                                            </div>

                                        </li>
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Deal')); ?></span>
                                                <?php echo e(Form::checkbox('telegram_deal_notification', '1', isset($setting['telegram_deal_notification']) && $setting['telegram_deal_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'telegram_deal_notification'])); ?>

                                                <label class="form-check-label"
                                                    for="telegram_deal_notification"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-md-3">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('Lead to Deal Conversion')); ?></span>
                                                <?php echo e(Form::checkbox('telegram_leadtodeal_notification', '1', isset($setting['telegram_leadtodeal_notification']) && $setting['telegram_leadtodeal_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'telegram_leadtodeal_notification'])); ?>

                                                <label class="form-check-label"
                                                    for="telegram_leadtodeal_notification"></label>

                                            </div>

                                        </li>
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Contract')); ?></span>
                                                <?php echo e(Form::checkbox('telegram_contract_notification', '1', isset($setting['telegram_contract_notification']) && $setting['telegram_contract_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'telegram_contract_notification'])); ?>

                                                <label class="form-check-label"
                                                    for="telegram_contract_notification"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-md-3">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Project')); ?></span>
                                                <?php echo e(Form::checkbox('telegram_project_notification', '1', isset($setting['telegram_project_notification']) && $setting['telegram_project_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'telegram_project_notification'])); ?>

                                                <label class="form-check-label"
                                                    for="telegram_project_notification"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Task')); ?></span>
                                                <?php echo e(Form::checkbox('telegram_task_notification', '1', isset($setting['telegram_task_notification']) && $setting['telegram_task_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'telegram_task_notification'])); ?>

                                                <label class="form-check-label"
                                                    for="telegram_task_notification"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-md-3">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('Task Stage Updated')); ?></span>
                                                <?php echo e(Form::checkbox('telegram_taskmove_notification', '1', isset($setting['telegram_taskmove_notification']) && $setting['telegram_taskmove_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'telegram_taskmove_notification'])); ?>

                                                <label class="form-check-label"
                                                    for="telegram_taskmove_notification"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Task Comment')); ?></span>
                                                <?php echo e(Form::checkbox('telegram_taskcomment_notification', '1', isset($setting['telegram_taskcomment_notification']) && $setting['telegram_taskcomment_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'telegram_taskcomment_notification'])); ?>

                                                <label class="form-check-label"
                                                    for="telegram_taskcomment_notification"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                            <div class="row mt-2">
                                <div class="col-md-3">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Monthly Payslip')); ?></span>
                                                <?php echo e(Form::checkbox('telegram_payslip_notification', '1', isset($setting['telegram_payslip_notification']) && $setting['telegram_payslip_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'telegram_payslip_notification'])); ?>

                                                <label class="form-check-label"
                                                    for="telegram_payslip_notification"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Award')); ?></span>
                                                <?php echo e(Form::checkbox('telegram_award_notification', '1', isset($setting['telegram_award_notification']) && $setting['telegram_award_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'telegram_award_notification'])); ?>

                                                <label class="form-check-label"
                                                    for="telegram_award_notification"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-md-3">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Announcement')); ?></span>
                                                <?php echo e(Form::checkbox('telegram_announcement_notification', '1', isset($setting['telegram_announcement_notification']) && $setting['telegram_announcement_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'telegram_announcement_notification'])); ?>

                                                <label class="form-check-label"
                                                    for="telegram_announcement_notification"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Holiday')); ?></span>
                                                <?php echo e(Form::checkbox('telegram_holiday_notification', '1', isset($setting['telegram_holiday_notification']) && $setting['telegram_holiday_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'telegram_holiday_notification'])); ?>

                                                <label class="form-check-label"
                                                    for="telegram_holiday_notification"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-md-3">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Support Ticket')); ?></span>
                                                <?php echo e(Form::checkbox('telegram_support_notification', '1', isset($setting['telegram_support_notification']) && $setting['telegram_support_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'telegram_support_notification'])); ?>

                                                <label class="form-check-label"
                                                    for="telegram_support_notification"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Event')); ?></span>
                                                <?php echo e(Form::checkbox('telegram_event_notification', '1', isset($setting['telegram_event_notification']) && $setting['telegram_event_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'telegram_event_notification'])); ?>

                                                <label class="form-check-label"
                                                    for="telegram_event_notification"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-md-3">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Meeting')); ?></span>
                                                <?php echo e(Form::checkbox('telegram_meeting_notification', '1', isset($setting['telegram_meeting_notification']) && $setting['telegram_meeting_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'telegram_meeting_notification'])); ?>

                                                <label class="form-check-label"
                                                    for="telegram_meeting_notification"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Company Policy')); ?></span>
                                                <?php echo e(Form::checkbox('telegram_policy_notification', '1', isset($setting['telegram_policy_notification']) && $setting['telegram_policy_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'telegram_policy_notification'])); ?>

                                                <label class="form-check-label"
                                                    for="telegram_policy_notification"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                            <div class="row mt-2">
                                <div class="col-md-3">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Invoice')); ?></span>
                                                <?php echo e(Form::checkbox('telegram_invoice_notification', '1', isset($setting['telegram_invoice_notification']) && $setting['telegram_invoice_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'telegram_invoice_notification'])); ?>

                                                <label class="form-check-label"
                                                    for="telegram_invoice_notification"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Revenue')); ?></span>
                                                <?php echo e(Form::checkbox('telegram_revenue_notification', '1', isset($setting['telegram_revenue_notification']) && $setting['telegram_revenue_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'telegram_revenue_notification'])); ?>

                                                <label class="form-check-label"
                                                    for="telegram_revenue_notification"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-md-3">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Bill')); ?></span>
                                                <?php echo e(Form::checkbox('telegram_bill_notification', '1', isset($setting['telegram_bill_notification']) && $setting['telegram_bill_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'telegram_bill_notification'])); ?>

                                                <label class="form-check-label"
                                                    for="telegram_bill_notification"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Invoice Payment')); ?></span>
                                                <?php echo e(Form::checkbox('telegram_payment_notification', '1', isset($setting['telegram_payment_notification']) && $setting['telegram_payment_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'telegram_payment_notification'])); ?>

                                                <label class="form-check-label"
                                                    for="telegram_payment_notification"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-md-3">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Budget')); ?></span>
                                                <?php echo e(Form::checkbox('telegram_budget_notification', '1', isset($setting['telegram_budget_notification']) && $setting['telegram_budget_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'telegram_budget_notification'])); ?>

                                                <label class="form-check-label"
                                                    for="telegram_budget_notification"></label>
                                            </div>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <div class="form-group">
                                <input class="btn btn-print-invoice btn-primary m-r-10" type="submit"
                                    value="<?php echo e(__('Save Changes')); ?>">
                            </div>
                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>

                    <!--Twilio Settings-->
                    <div id="twilio-settings" class="card">
                        <div class="card-header">
                            <h5><?php echo e(__('Twilio Settings')); ?></h5>
                            <small class="text-muted"><?php echo e(__('Edit your Twilio settings')); ?></small>
                        </div>
                        <?php echo e(Form::model($setting, ['route' => 'twilio.setting', 'method' => 'post'])); ?>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php echo e(Form::label('twilio_sid', __('Twilio SID '), ['class' => 'form-label'])); ?>

                                        <?php echo e(Form::text('twilio_sid', isset($setting['twilio_sid']) ? $setting['twilio_sid'] : '', ['class' => 'form-control w-100', 'placeholder' => __('Enter Twilio SID'), 'required' => 'required'])); ?>

                                        <?php $__errorArgs = ['twilio_sid'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-twilio_sid" role="alert">
                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php echo e(Form::label('twilio_token', __('Twilio Token'), ['class' => 'form-label'])); ?>

                                        <?php echo e(Form::text('twilio_token', isset($setting['twilio_token']) ? $setting['twilio_token'] : '', ['class' => 'form-control w-100', 'placeholder' => __('Enter Twilio Token'), 'required' => 'required'])); ?>

                                        <?php $__errorArgs = ['twilio_token'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-twilio_token" role="alert">
                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php echo e(Form::label('twilio_from', __('Twilio From'), ['class' => 'form-label'])); ?>

                                        <?php echo e(Form::text('twilio_from', isset($setting['twilio_from']) ? $setting['twilio_from'] : '', ['class' => 'form-control w-100', 'placeholder' => __('Enter Twilio From'), 'required' => 'required'])); ?>

                                        <?php $__errorArgs = ['twilio_from'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-twilio_from" role="alert">
                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-4 mb-2">
                                    <h5 class="small-title"><?php echo e(__('Module Settings')); ?></h5>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Customer')); ?></span>
                                                <?php echo e(Form::checkbox('twilio_customer_notification', '1', isset($setting['twilio_customer_notification']) && $setting['twilio_customer_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'twilio_customer_notification'])); ?>

                                                <label class="form-check-label"
                                                    for="twilio_customer_notification"></label>
                                            </div>

                                        </li>
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Vendor')); ?></span>
                                                <?php echo e(Form::checkbox('twilio_vender_notification', '1', isset($setting['twilio_vender_notification']) && $setting['twilio_vender_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'twilio_vender_notification'])); ?>

                                                <label class="form-check-label"
                                                    for="twilio_vender_notification"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Invoice')); ?></span>
                                                <?php echo e(Form::checkbox('twilio_invoice_notification', '1', isset($setting['twilio_invoice_notification']) && $setting['twilio_invoice_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'twilio_invoice_notification'])); ?>

                                                <label class="form-check-label"
                                                    for="twilio_invoice_notification"></label>
                                            </div>
                                        </li>

                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Revenue')); ?></span>
                                                <?php echo e(Form::checkbox('twilio_revenue_notification', '1', isset($setting['twilio_revenue_notification']) && $setting['twilio_revenue_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'twilio_revenue_notification'])); ?>

                                                <label class="form-check-label"
                                                    for="twilio_revenue_notification"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Bill')); ?></span>
                                                <?php echo e(Form::checkbox('twilio_bill_notification', '1', isset($setting['twilio_bill_notification']) && $setting['twilio_bill_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'twilio_bill_notification'])); ?>

                                                <label class="form-check-label" for="twilio_bill_notification"></label>
                                            </div>
                                        </li>

                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Proposal')); ?></span>
                                                <?php echo e(Form::checkbox('twilio_proposal_notification', '1', isset($setting['twilio_proposal_notification']) && $setting['twilio_proposal_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'twilio_proposal_notification'])); ?>

                                                <label class="form-check-label"
                                                    for="twilio_proposal_notification"></label>
                                            </div>
                                        </li>

                                    </ul>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Payment')); ?></span>
                                                <?php echo e(Form::checkbox('twilio_payment_notification', '1', isset($setting['twilio_payment_notification']) && $setting['twilio_payment_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'twilio_payment_notification'])); ?>

                                                <label class="form-check-label"
                                                    for="twilio_payment_notification"></label>
                                            </div>
                                        </li>

                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('Invoice Reminder')); ?></span>
                                                <?php echo e(Form::checkbox('twilio_reminder_notification', '1', isset($setting['twilio_reminder_notification']) && $setting['twilio_reminder_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'twilio_reminder_notification'])); ?>

                                                <label class="form-check-label"
                                                    for="twilio_reminder_notification"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <div class="form-group">
                                <input class="btn btn-print-invoice btn-primary m-r-10" type="submit"
                                    value="<?php echo e(__('Save Changes')); ?>">
                            </div>
                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>

                    <!--Email Notification Settings-->
                    <div id="email-notification-settings" class="card">
                        <div class="col-md-12">
                            <div class="card-header">
                                <h5><?php echo e(__('Email Notification Settings')); ?></h5>
                                <small class="text-muted"><?php echo e(__('Edit email notification settings')); ?></small>
                            </div>
                            <?php echo e(Form::model($setting, ['route' => ['status.email.language'], 'method' => 'post'])); ?>

                            <?php echo csrf_field(); ?>
                            <div class="card-body">
                                <div class="row">
                                    <?php $__currentLoopData = $EmailTemplates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $EmailTemplate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-lg-4 col-md-6 col-sm-6 form-group">
                                            <div class="list-group">
                                                <div class="list-group-item form-switch form-switch-right">
                                                    <label class="form-label"
                                                        style="margin-left:5%;"><?php echo e($EmailTemplate->name); ?></label>
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    

                                                    <input class="form-check-input" name='<?php echo e($EmailTemplate->id); ?>'
                                                        id="email_tempalte_<?php echo e($EmailTemplate->template->id); ?>"
                                                        type="checkbox"
                                                        <?php if($EmailTemplate->template->is_active == 1): ?> checked="checked" <?php endif; ?>
                                                        type="checkbox" value="1"
                                                        data-url="<?php echo e(route('status.email.language', [$EmailTemplate->template->id])); ?>" />
                                                    <label class="form-check-label"
                                                        for="email_tempalte_<?php echo e($EmailTemplate->template->id); ?>"></label>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>

                            </div>
                            <div class="card-footer text-end">
                                <div class="form-group">
                                    <input class="btn btn-print-invoice btn-primary m-r-10" type="submit"
                                        value="<?php echo e(__('Save Changes')); ?>">
                                </div>
                            </div>
                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>

                    <!--Start HRM letter Settings-->

                    <div id="offer-letter-settings" class="card">
                        <div class="col-md-12">
                            <div class="card-header d-flex justify-content-between">
                                <h5><?php echo e(__('Offer Letter Settings')); ?></h5>
                                <div class="d-flex justify-content-end drp-languages">
                                    <ul class="list-unstyled mb-0 m-2">
                                        <li class="dropdown dash-h-item drp-language" style="margin-top: -7px;">
                                            <a class="dash-head-link dropdown-toggle arrow-none me-0"
                                                data-bs-toggle="dropdown" href="#" role="button"
                                                aria-haspopup="false" aria-expanded="false" id="dropdownLanguage">
                                                <span class="drp-text hide-mob text-primary me-2">
                                                    <?php echo e(ucfirst($offerlangName->full_name)); ?>

                                                </span>
                                                <i class="ti ti-chevron-down drp-arrow nocolor"></i>
                                            </a>
                                            <div class="dropdown-menu dash-h-dropdown dropdown-menu-end"
                                                aria-labelledby="dropdownLanguage">
                                                <?php $__currentLoopData = $currantLang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $offerlangs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <a href="<?php echo e(route('get.offerlatter.language', ['noclangs' => $noclang, 'explangs' => $explang, 'offerlangs' => $code, 'joininglangs' => $joininglang])); ?>"
                                                        class="dropdown-item ms-1 <?php echo e($offerlangs == $code ? 'text-primary' : ''); ?>"><?php echo e(ucFirst($offerlangs)); ?>

                                                    </a>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </li>
                                    </ul>


                                </div>
                            </div>
                            <div class="card-body">
                                <h5 class="font-weight-bold pb-3"><?php echo e(__('Placeholders')); ?></h5>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="card">
                                        <div class="card-header card-body">
                                            <div class="row text-xs">
                                                <div class="row">
                                                    <p class="col-4"><?php echo e(__('Applicant Name')); ?> : <span
                                                            class="pull-end text-primary">{applicant_name}</span></p>
                                                    <p class="col-4"><?php echo e(__('Company Name')); ?> : <span
                                                            class="pull-right text-primary">{app_name}</span></p>
                                                    <p class="col-4"><?php echo e(__('Job title')); ?> : <span
                                                            class="pull-right text-primary">{job_title}</span></p>
                                                    <p class="col-4"><?php echo e(__('Job type')); ?> : <span
                                                            class="pull-right text-primary">{job_type}</span></p>
                                                    <p class="col-4"><?php echo e(__('Proposed Start Date')); ?> : <span
                                                            class="pull-right text-primary">{start_date}</span></p>
                                                    <p class="col-4"><?php echo e(__('Working Location')); ?> : <span
                                                            class="pull-right text-primary">{workplace_location}</span>
                                                    </p>
                                                    <p class="col-4"><?php echo e(__('Days Of Week')); ?> : <span
                                                            class="pull-right text-primary">{days_of_week}</span></p>
                                                    <p class="col-4"><?php echo e(__('Salary')); ?> : <span
                                                            class="pull-right text-primary">{salary}</span></p>
                                                    <p class="col-4"><?php echo e(__('Salary Type')); ?> : <span
                                                            class="pull-right text-primary">{salary_type}</span></p>
                                                    <p class="col-4"><?php echo e(__('Salary Duration')); ?> : <span
                                                            class="pull-end text-primary">{salary_duration}</span></p>
                                                    <p class="col-4"><?php echo e(__('Offer Expiration Date')); ?> : <span
                                                            class="pull-right text-primary">{offer_expiration_date}</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body table-border-style ">

                                <?php echo e(Form::open(['route' => ['offerlatter.update', $offerlang], 'method' => 'post'])); ?>

                                <div class="form-group col-12">
                                    <?php echo e(Form::label('content', __(' Format'), ['class' => 'form-label text-dark'])); ?>

                                    <textarea name="content" class="summernote-simple0 summernote-simple"><?php echo isset($currOfferletterLang->content) ? $currOfferletterLang->content : ''; ?></textarea>

                                </div>
                                
                                
                                

                                <?php echo e(Form::close()); ?>

                            </div>
                        </div>
                    </div>

                    <div id="joining-letter-settings" class="card">
                        <div class="col-md-12">
                            <div class="card-header d-flex justify-content-between">
                                <h5><?php echo e(__('Joining Letter Settings')); ?></h5>
                                <div class="d-flex justify-content-end drp-languages">
                                    <ul class="list-unstyled mb-0 m-2">
                                        <li class="dropdown dash-h-item drp-language" style="margin-top: -7px;">
                                            <a class="dash-head-link dropdown-toggle arrow-none me-0"
                                                data-bs-toggle="dropdown" href="#" role="button"
                                                aria-haspopup="false" aria-expanded="false" id="dropdownLanguage1">
                                                <span class="drp-text hide-mob text-primary me-2">
                                                    <?php echo e(ucfirst($joininglangName->full_name)); ?>

                                                </span>
                                                <i class="ti ti-chevron-down drp-arrow nocolor"></i>
                                            </a>
                                            <div class="dropdown-menu dash-h-dropdown dropdown-menu-end"
                                                aria-labelledby="dropdownLanguage1">
                                                <?php $__currentLoopData = $currantLang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $joininglangs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <a href="<?php echo e(route('get.joiningletter.language', ['noclangs' => $noclang, 'explangs' => $explang, 'offerlangs' => $offerlang, 'joininglangs' => $code])); ?>"
                                                        class="dropdown-item <?php echo e($joininglangs == $code ? 'text-primary' : ''); ?>"><?php echo e(ucFirst($joininglangs)); ?></a>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </li>

                                    </ul>

                                </div>

                            </div>
                            <div class="card-body ">
                                <h5 class="font-weight-bold pb-3"><?php echo e(__('Placeholders')); ?></h5>

                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="card">
                                        <div class="card-header card-body">
                                            <div class="row text-xs">
                                                <div class="row">
                                                    <p class="col-4"><?php echo e(__('Applicant Name')); ?> : <span
                                                            class="pull-end text-primary">{date}</span></p>
                                                    <p class="col-4"><?php echo e(__('Company Name')); ?> : <span
                                                            class="pull-right text-primary">{app_name}</span></p>
                                                    <p class="col-4"><?php echo e(__('Employee Name')); ?> : <span
                                                            class="pull-right text-primary">{employee_name}</span></p>
                                                    <p class="col-4"><?php echo e(__('Address')); ?> : <span
                                                            class="pull-right text-primary">{address}</span></p>
                                                    <p class="col-4"><?php echo e(__('Designation')); ?> : <span
                                                            class="pull-right text-primary">{designation}</span></p>
                                                    <p class="col-4"><?php echo e(__('Start Date')); ?> : <span
                                                            class="pull-right text-primary">{start_date}</span></p>
                                                    <p class="col-4"><?php echo e(__('Branch')); ?> : <span
                                                            class="pull-right text-primary">{branch}</span></p>
                                                    <p class="col-4"><?php echo e(__('Start Time')); ?> : <span
                                                            class="pull-end text-primary">{start_time}</span></p>
                                                    <p class="col-4"><?php echo e(__('End Time')); ?> : <span
                                                            class="pull-right text-primary">{end_time}</span></p>
                                                    <p class="col-4"><?php echo e(__('Number of Hours')); ?> : <span
                                                            class="pull-right text-primary">{total_hours}</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body table-border-style ">

                                <?php echo e(Form::open(['route' => ['joiningletter.update', $joininglang], 'method' => 'post'])); ?>

                                <div class="form-group col-12">
                                    <?php echo e(Form::label('content', __(' Format'), ['class' => 'form-label text-dark'])); ?>

                                    <textarea name="content" class="summernote-simple1 summernote-simple"><?php echo isset($currjoiningletterLang->content) ? $currjoiningletterLang->content : ''; ?></textarea>

                                </div>
                                <?php echo e(Form::close()); ?>

                            </div>
                        </div>
                    </div>

                    <div id="experience-certificate-settings" class="card">
                        <div class="col-md-12">
                            <div class="card-header d-flex justify-content-between">
                                <h5><?php echo e(__('Experience Certificate Settings')); ?></h5>
                                <div class="d-flex justify-content-end drp-languages">
                                    <ul class="list-unstyled mb-0 m-2">
                                        <li class="dropdown dash-h-item drp-language" style="margin-top: -7px;">
                                            <a class="dash-head-link dropdown-toggle arrow-none me-0"
                                                data-bs-toggle="dropdown" href="#" role="button"
                                                aria-haspopup="false" aria-expanded="false" id="dropdownLanguage1">
                                                <span class="drp-text hide-mob text-primary me-2">
                                                    <?php echo e(ucfirst($explangName->full_name)); ?>

                                                </span>
                                                <i class="ti ti-chevron-down drp-arrow nocolor"></i>
                                            </a>
                                            <div class="dropdown-menu dash-h-dropdown dropdown-menu-end"
                                                aria-labelledby="dropdownLanguage1">
                                                <?php $__currentLoopData = $currantLang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $explangs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <a href="<?php echo e(route('get.experiencecertificate.language', ['noclangs' => $noclang, 'explangs' => $code, 'offerlangs' => $offerlang, 'joininglangs' => $joininglang])); ?>"
                                                        class="dropdown-item <?php echo e($explangs == $code ? 'text-primary' : ''); ?>"><?php echo e(ucFirst($explangs)); ?></a>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </li>

                                    </ul>

                                </div>

                            </div>
                            <div class="card-body ">
                                <h5 class="font-weight-bold pb-3"><?php echo e(__('Placeholders')); ?></h5>

                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="card">
                                        <div class="card-header card-body">
                                            <div class="row text-xs">
                                                <div class="row">
                                                    <p class="col-4"><?php echo e(__('Company Name')); ?> : <span
                                                            class="pull-right text-primary">{app_name}</span></p>
                                                    <p class="col-4"><?php echo e(__('Employee Name')); ?> : <span
                                                            class="pull-right text-primary">{employee_name}</span></p>
                                                    <p class="col-4"><?php echo e(__('Date of Issuance')); ?> : <span
                                                            class="pull-right text-primary">{date}</span></p>
                                                    <p class="col-4"><?php echo e(__('Designation')); ?> : <span
                                                            class="pull-right text-primary">{designation}</span></p>
                                                    <p class="col-4"><?php echo e(__('Start Date')); ?> : <span
                                                            class="pull-right text-primary">{start_date}</span></p>
                                                    <p class="col-4"><?php echo e(__('Branch')); ?> : <span
                                                            class="pull-right text-primary">{branch}</span></p>
                                                    <p class="col-4"><?php echo e(__('Start Time')); ?> : <span
                                                            class="pull-end text-primary">{start_time}</span></p>
                                                    <p class="col-4"><?php echo e(__('End Time')); ?> : <span
                                                            class="pull-right text-primary">{end_time}</span></p>
                                                    <p class="col-4"><?php echo e(__('Number of Hours')); ?> : <span
                                                            class="pull-right text-primary">{total_hours}</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body table-border-style ">

                                <?php echo e(Form::open(['route' => ['experiencecertificate.update', $explang], 'method' => 'post'])); ?>

                                <div class="form-group col-12">
                                    <?php echo e(Form::label('content', __(' Format'), ['class' => 'form-label text-dark'])); ?>

                                    <textarea name="content" class="summernote-simple2 summernote-simple"><?php echo isset($curr_exp_cetificate_Lang->content) ? $curr_exp_cetificate_Lang->content : ''; ?></textarea>

                                </div>
                                <?php echo e(Form::close()); ?>

                            </div>
                        </div>
                    </div>

                    <div id="noc-settings" class="card">
                        <div class="col-md-12">
                            <div class="card-header d-flex justify-content-between">
                                <h5><?php echo e(__('NOC Settings')); ?></h5>
                                <div class="d-flex justify-content-end drp-languages">
                                    <ul class="list-unstyled mb-0 m-2">
                                        <li class="dropdown dash-h-item drp-language" style="margin-top: -7px;">
                                            <a class="dash-head-link dropdown-toggle arrow-none me-0"
                                                data-bs-toggle="dropdown" href="#" role="button"
                                                aria-haspopup="false" aria-expanded="false" id="dropdownLanguage1">
                                                <span class="drp-text hide-mob text-primary me-2">
                                                    <?php echo e(ucfirst($noclangName->full_name)); ?>

                                                </span>
                                                <i class="ti ti-chevron-down drp-arrow nocolor"></i>
                                            </a>
                                            <div class="dropdown-menu dash-h-dropdown dropdown-menu-end"
                                                aria-labelledby="dropdownLanguage1">
                                                <?php $__currentLoopData = $currantLang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $noclangs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <a href="<?php echo e(route('get.noc.language', ['noclangs' => $code, 'explangs' => $explang, 'offerlangs' => $offerlang, 'joininglangs' => $joininglang])); ?>"
                                                        class="dropdown-item <?php echo e($noclangs == $code ? 'text-primary' : ''); ?>"><?php echo e(ucfirst($noclangs)); ?></a>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </li>

                                    </ul>

                                </div>
                            </div>
                            <div class="card-body ">
                                <h5 class="font-weight-bold pb-3"><?php echo e(__('Placeholders')); ?></h5>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="card">
                                        <div class="card-header card-body">
                                            <div class="row text-xs">
                                                <div class="row">
                                                    <p class="col-4"><?php echo e(__('Date')); ?> : <span
                                                            class="pull-end text-primary">{date}</span></p>
                                                    <p class="col-4"><?php echo e(__('Company Name')); ?> : <span
                                                            class="pull-right text-primary">{app_name}</span></p>
                                                    <p class="col-4"><?php echo e(__('Employee Name')); ?> : <span
                                                            class="pull-right text-primary">{employee_name}</span></p>
                                                    <p class="col-4"><?php echo e(__('Designation')); ?> : <span
                                                            class="pull-right text-primary">{designation}</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body table-border-style ">
                                <?php echo e(Form::open(['route' => ['noc.update', $noclang], 'method' => 'post'])); ?>

                                <div class="form-group col-12">
                                    <?php echo e(Form::label('content', __(' Format'), ['class' => 'form-label text-dark'])); ?>

                                    <textarea name="content" class="summernote-simple3 summernote-simple"><?php echo isset($currnocLang->content) ? $currnocLang->content : ''; ?></textarea>

                                </div>

                                <?php echo e(Form::close()); ?>

                            </div>
                        </div>
                    </div>

                    <!--End HRM letter Settings-->

                    <div id="google-calender" class="card">
                        <div class="col-md-12">
                            <?php echo e(Form::open(['url' => route('google.calender.settings'), 'enctype' => 'multipart/form-data'])); ?>

                            <div class="card-header">
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="mb-2"><?php echo e(__('Google Calendar Settings')); ?></h5>
                                    </div>
                                    <div class="col switch-width text-end">
                                        <div class="form-group mb-0">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" name="google_calendar_enable"
                                                    id="google_calendar_enable" data-toggle="switchbutton"
                                                    data-onstyle="primary"
                                                    <?php echo e($setting['google_calendar_enable'] == 'on' ? 'checked' : ''); ?>>
                                                <label class="custom-control-label"
                                                    for="google_calendar_enable"></label>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                        <?php echo e(Form::label('Google calendar id', __('Google Calendar Id'), ['class' => 'col-form-label'])); ?>

                                        <?php echo e(Form::text('google_clender_id', !empty($setting['google_clender_id']) ? $setting['google_clender_id'] : '', ['class' => 'form-control ', 'placeholder' => 'Google Calendar Id', 'required' => 'required'])); ?>

                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                        <?php echo e(Form::label('Google calendar json file', __('Google Calendar json File'), ['class' => 'col-form-label'])); ?>

                                        <input type="file" class="form-control" name="google_calender_json_file"
                                            id="file">
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <button class="btn-submit btn btn-primary" type="submit">
                                    <?php echo e(__('Save Changes')); ?>

                                </button>
                            </div>
                            <?php echo e(Form::close()); ?>

                        </div>
                    </div>

                    <div id="webhook-settings" class="card">
                        <div class="col-md-12">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="mb-2"><?php echo e(__('Webhook Settings')); ?></h5>
                                    </div>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create webhook')): ?>
                                        <div class="col-6 text-end">
                                            <a href="#" data-size="lg" data-url="<?php echo e(route('webhook.create')); ?>"
                                                data-ajax-popup="true" data-bs-toggle="tooltip"
                                                title="<?php echo e(__('Create')); ?>" data-title="<?php echo e(__('Create New Webhook')); ?>"
                                                class="btn btn-sm btn-primary">
                                                <i class="ti ti-plus"></i>
                                            </a>

                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="card-body table-border-style">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th><?php echo e(__('Module')); ?></th>
                                                <th><?php echo e(__('Url')); ?></th>
                                                <th><?php echo e(__('Method')); ?></th>
                                                <th><?php echo e(__('Action')); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody class="font-style">
                                            <?php $__empty_1 = true; $__currentLoopData = $webhookSetting; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $webhooksetting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <tr>
                                                    <td><?php echo e(ucwords($webhooksetting->module)); ?></td>
                                                    <td><?php echo e($webhooksetting->url); ?></td>
                                                    <td><?php echo e(ucwords($webhooksetting->method)); ?></td>
                                                    <td class="Action">
                                                        <span>
                                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit webhook')): ?>
                                                                <div class="action-btn bg-primary ms-2">
                                                                    <a href="#"
                                                                        class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                                        data-url="<?php echo e(URL::to('webhook-settings/' . $webhooksetting->id . '/edit')); ?>"
                                                                        data-ajax-popup="true" data-bs-toggle="tooltip"
                                                                        title="<?php echo e(__('Edit')); ?>"
                                                                        data-title="<?php echo e(__('Webhook Edit')); ?>">
                                                                        <i class="ti ti-pencil text-white"></i>
                                                                    </a>
                                                                </div>
                                                            <?php endif; ?>
                                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete webhook')): ?>
                                                                <div class="action-btn bg-danger ms-2">
                                                                    <?php echo Form::open([
                                                                        'method' => 'DELETE',
                                                                        'route' => ['webhook.destroy', $webhooksetting->id],
                                                                        'id' => 'delete-form-' . $webhooksetting->id,
                                                                    ]); ?>

                                                                    <a href="#"
                                                                        class="mx-3 btn btn-sm  align-items-center bs-pass-para"
                                                                        data-bs-toggle="tooltip"
                                                                        title="<?php echo e(__('Delete')); ?>">
                                                                        <i class="ti ti-trash text-white text-white"></i>
                                                                    </a>
                                                                    <?php echo Form::close(); ?>

                                                                </div>
                                                            <?php endif; ?>
                                                        </span>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                <tr class="text-center">
                                                    <td colspan="4"><?php echo e(__('No Data Found.!')); ?></td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="ip-restriction-settings" class="card">
                        <div class="col-md-12">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="mb-2"><?php echo e(__('IP Restriction Settings')); ?></h5>
                                    </div>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create webhook')): ?>
                                        <div class="col-6 text-end">
                                            <a data-size="md" data-url="<?php echo e(route('create.ip')); ?>" data-ajax-popup="true"
                                                data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>"
                                                data-title="<?php echo e(__('Create New IP')); ?>" class="btn btn-sm btn-primary">
                                                <i class="ti ti-plus text-white"></i>
                                            </a>

                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="card-body table-border-style">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="w-75"><?php echo e(__('IP')); ?></th>
                                                <th><?php echo e(__('Action')); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody class="font-style">
                                            <?php $__empty_1 = true; $__currentLoopData = $ips; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <tr>
                                                    <td><?php echo e($ip->ip); ?></td>

                                                    <td class="Action">
                                                        <span>
                                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit webhook')): ?>
                                                                <div class="action-btn bg-primary ms-2">
                                                                    <a class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                                        data-url="<?php echo e(route('edit.ip', $ip->id)); ?>"
                                                                        data-ajax-popup="true" data-bs-toggle="tooltip"
                                                                        title="<?php echo e(__('Edit')); ?>"
                                                                        data-title="<?php echo e(__('IP Edit')); ?>">
                                                                        <i class="ti ti-pencil text-white"></i>
                                                                    </a>
                                                                </div>
                                                            <?php endif; ?>
                                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete webhook')): ?>
                                                                <div class="action-btn bg-danger ms-2">
                                                                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['destroy.ip', $ip->id], 'id' => 'delete-form-' . $ip->id]); ?>

                                                                    <a class="mx-3 btn btn-sm  align-items-center bs-pass-para"
                                                                        data-bs-toggle="tooltip"
                                                                        title="<?php echo e(__('Delete')); ?>">
                                                                        <i class="ti ti-trash text-white text-white"></i>
                                                                    </a>
                                                                    <?php echo Form::close(); ?>

                                                                </div>
                                                            <?php endif; ?>
                                                        </span>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                <tr class="text-center">
                                                    <td colspan="4"><?php echo e(__('No Data Found.!')); ?></td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/imac/Sites/localhost/integra/resources/views/settings/company.blade.php ENDPATH**/ ?>