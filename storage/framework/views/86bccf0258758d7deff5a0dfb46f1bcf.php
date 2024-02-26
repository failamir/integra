



















<form class="px-3" method="post" action="<?php echo e(route('test.send.mail')); ?>" id="test_email">
    <?php echo csrf_field(); ?>

    <input type="hidden" name="mail_driver" value="<?php echo e($data['mail_driver']); ?>" />
    <input type="hidden" name="mail_host" value="<?php echo e($data['mail_host']); ?>" />
    <input type="hidden" name="mail_port" value="<?php echo e($data['mail_port']); ?>" />
    <input type="hidden" name="mail_username" value="<?php echo e($data['mail_username']); ?>" />
    <input type="hidden" name="mail_password" value="<?php echo e($data['mail_password']); ?>" />
    <input type="hidden" name="mail_encryption" value="<?php echo e($data['mail_encryption']); ?>" />
    <input type="hidden" name="mail_from_address" value="<?php echo e($data['mail_from_address']); ?>" />
    <input type="hidden" name="mail_from_name" value="<?php echo e($data['mail_from_name']); ?>" />
    <div class="modal-body">
        <div class="row">
            <div class="form-group col-md-12">
                <label for="email" class="form-label"><?php echo e(__('E-Mail Address')); ?></label>
                <input type="text" class="form-control" id="email" name="email" required/>
            </div>
        </div>
    </div>
    <div class="modal-footer">

        <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn btn-secondary btn-light" data-bs-dismiss="modal">
        <input type="submit" value="<?php echo e(__('Send')); ?>" class="btn-create btn btn-primary">

    </div>
</form>


<?php /**PATH /home/integra.platformbisnis.com/public_html/resources/views/settings/test_mail.blade.php ENDPATH**/ ?>