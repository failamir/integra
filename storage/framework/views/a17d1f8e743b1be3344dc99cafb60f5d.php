<?php echo e(Form::open(array('url'=>'leave','method'=>'post'))); ?>

    <div class="modal-body">
        
        <?php
            $plan= \App\Models\Utility::getChatGPTSettings();
        ?>
        <?php if($plan->chatgpt == 1): ?>
            <div class="text-end">
                <a href="#" data-size="md" class="btn  btn-primary btn-icon btn-sm" data-ajax-popup-over="true" data-url="<?php echo e(route('generate',['leave'])); ?>"
                  data-bs-placement="top" data-title="<?php echo e(__('Generate content with AI')); ?>">
                    <i class="fas fa-robot"></i> <span><?php echo e(__('Generate with AI')); ?></span>
                </a>
            </div>
        <?php endif; ?>
        
        <?php if(\Auth::user()->type =='company' || \Auth::user()->type =='HR'|| \Auth::user()->type !='Employee'): ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <?php echo e(Form::label('employee_id',__('Employee') ,['class'=>'form-label'])); ?>

                        <?php echo e(Form::select('employee_id',$employees,null,array('class'=>'form-control select','id'=>'employee_id','placeholder'=>__('Select Employee')))); ?>

                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <?php echo e(Form::label('leave_type_id',__('Leave Type') ,['class'=>'form-label'])); ?>

                    <select name="leave_type_id" id="leave_type_id" class="form-control select">
                        <option value=""><?php echo e(__('Select Leave Type')); ?></option>
                        <?php $__currentLoopData = $leavetypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $leave): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($leave->id); ?>"><?php echo e($leave->title); ?> (<p class="float-right pr-5"><?php echo e($leave->days); ?></p>)</option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <?php echo e(Form::label('start_date', __('Start Date'),['class'=>'form-label'])); ?>

                    <?php echo e(Form::date('start_date',null,array('class'=>'form-control'))); ?>



                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?php echo e(Form::label('end_date', __('End Date'),['class'=>'form-label'])); ?>

                    <?php echo e(Form::date('end_date',null,array('class'=>'form-control'))); ?>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <?php echo e(Form::label('leave_reason',__('Leave Reason') ,['class'=>'form-label'])); ?>

                    <?php echo e(Form::textarea('leave_reason',null,array('class'=>'form-control','placeholder'=>__('Leave Reason')))); ?>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-end">
                <a href="#" data-size="md" class="btn btn-primary btn-icon btn-sm text-right" data-ajax-popup-over="true" id="grammarCheck" data-url="<?php echo e(route('grammar',['grammar'])); ?>"
                   data-bs-placement="top" data-title="<?php echo e(__('Grammar check with AI')); ?>">
                    <i class="ti ti-rotate"></i> <span><?php echo e(__('Grammar check with AI')); ?></span>
                </a>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <?php echo e(Form::label('remark',__('Remark'),['class'=>'form-label'])); ?>

                    <?php echo e(Form::textarea('remark',null,array('class'=>'form-control grammer_textarea','placeholder'=>__('Leave Remark')))); ?>

                </div>
            </div>

        </div>
    </div>
    <div class="modal-footer">
        <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
        <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn  btn-primary">
    </div>
<?php echo e(Form::close()); ?>

<?php /**PATH /home/integra.platformbisnis.com/public_html/resources/views/leave/create.blade.php ENDPATH**/ ?>