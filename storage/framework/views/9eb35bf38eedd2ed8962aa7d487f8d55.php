<?php echo e(Form::open(array('url' => 'support','enctype'=>"multipart/form-data"))); ?>

<div class="modal-body">
    
    <?php
        $plan= \App\Models\Utility::getChatGPTSettings();
    ?>
    <?php if($plan->chatgpt == 1): ?>
    <div class="text-end">
        <a href="#" data-size="md" class="btn  btn-primary btn-icon btn-sm" data-ajax-popup-over="true" data-url="<?php echo e(route('generate',['support'])); ?>"
           data-bs-placement="top" data-title="<?php echo e(__('Generate content with AI')); ?>">
            <i class="fas fa-robot"></i> <span><?php echo e(__('Generate with AI')); ?></span>
        </a>
    </div>
    <?php endif; ?>
    
    <div class="row">
        <div class="form-group col-md-12">
            <?php echo e(Form::label('subject', __('Subject'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('subject', '', array('class' => 'form-control ','required'=>'required'))); ?>

        </div>
        <?php if(\Auth::user()->type !='client'): ?>
            <div class="form-group col-md-6">
                <?php echo e(Form::label('user',__('Support for User'),['class'=>'form-label'])); ?>

                <?php echo e(Form::select('user',$users,null,array('class'=>'form-control select'))); ?>

            </div>
        <?php endif; ?>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('priority',__('Priority'),['class'=>'form-label'])); ?>

            <?php echo e(Form::select('priority',$priority,null,array('class'=>'form-control select'))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('status',__('Status'),['class'=>'form-label'])); ?>

            <?php echo e(Form::select('status',$status,null,array('class'=>'form-control select'))); ?>

        </div>

        <div class="form-group col-md-6">
            <?php echo e(Form::label('end_date', __('End Date'),['class'=>'form-label'])); ?>

            <?php echo e(Form::date('end_date', '', array('class' => 'form-control','required'=>'required'))); ?>

        </div>


    </div>
    <div class="row">
        <div class="form-group col-md-12">
            <?php echo e(Form::label('description', __('Description'),['class'=>'form-label'])); ?>

            <?php echo Form::textarea('description', null, ['class'=>'form-control','rows'=>'3']); ?>

        </div>
    </div>

    <div class="form-group col-md-6">
        <?php echo e(Form::label('attachment',__('Attachment'),['class'=>'form-label'])); ?>

        <label for="document" class="form-label">
            <input type="file" class="form-control" name="attachment" id="attachment" data-filename="attachment_create">
        </label>
        <img id="image" class="mt-2" style="width:25%;"/>
    </div>
</div>
<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn btn-primary">
</div>
    <?php echo e(Form::close()); ?>





<script>
    document.getElementById('attachment').onchange = function () {
        var src = URL.createObjectURL(this.files[0])
        document.getElementById('image').src = src
    }
</script>
<?php /**PATH /home/integra.platformbisnis.com/public_html/resources/views/support/create.blade.php ENDPATH**/ ?>