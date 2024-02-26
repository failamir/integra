<div class="col-md-12">
    <div class="card">
        <div class="col-12">
            <div class="card-body table-border-style">
                <div class="table-responsive">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col"><?php echo e(__('Name')); ?></th>
                                <th scope="col"><?php echo e(__('Stage')); ?></th>
                                <th scope="col"><?php echo e(__('Priority')); ?></th>
                                <th scope="col"><?php echo e(__('End Date')); ?></th>
                                <th scope="col"><?php echo e(__('Assigned To')); ?></th>
                                <th scope="col"><?php echo e(__('Completion')); ?></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody class="list">


                            <?php if(count($tasks) > 0): ?>
                                <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <?php
                                            $checkProject = \Auth::user()->checkProject($task->project_id);
                                        ?>
                                        <td>
                                            <span class="h6 text-sm font-weight-bold mb-0"><a
                                                    href="<?php echo e(route('projects.tasks.index', $task->project->id)); ?>"><?php echo e($task->name); ?></a></span>
                                            <span class="d-flex text-sm text-muted justify-content-between">
                                                <p class="m-0"><?php echo e($task->project->project_name); ?></p>
                                                <span
                                                    class="me-5 badge p-2 px-3 rounded bg-<?php echo e($checkProject == 'Owner' ? 'success' : 'warning'); ?>">
                                                    <?php echo e(__($checkProject)); ?></span>
                                            </span>
                                        </td>
                                        <td><?php echo e($task->stage->name); ?></td>
                                        <td>
                                            <span
                                                class="status_badge badge p-2 px-3 rounded bg-<?php echo e(__(\App\Models\ProjectTask::$priority_color[$task->priority])); ?>"><?php echo e(__(\App\Models\ProjectTask::$priority[$task->priority])); ?></span>
                                        </td>
                                        <td class="<?php echo e(strtotime($task->end_date) < time() ? 'text-danger' : ''); ?>">
                                            <?php echo e(Utility::getDateFormated($task->end_date)); ?></td>
                                        <td>

                                            <div class="avatar-group">
                                                <?php
                                                    $users = [];
                                                    $getUsers = App\Models\ProjectTask::getusers();
                                                    if (!empty($task->assign_to)) {
                                                        foreach (explode(',', $task->assign_to) as $key_user) {
                                                            $user['name'] = $getUsers[$key_user]['name'];
                                                            $user['avatar'] = $getUsers[$key_user]['avatar'];

                                                            $users[] = $user;
                                                        }
                                                        $taskuser = $users;
                                                    } else {
                                                        $taskuser = [];
                                                    }
                                                ?>

                                                <?php if(count($taskuser) > 0): ?>
                                                    <?php $__currentLoopData = $taskuser; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <a href="#" class="avatar rounded-circle avatar-sm">
                                                            <img data-original-title="<?php echo e(!empty($user) ? $user['name'] : ''); ?>"
                                                                <?php if($user['avatar']): ?> src="<?php echo e(asset('/storage/uploads/avatar/' . $user['avatar'])); ?>" <?php else: ?> src="<?php echo e(asset('/storage/uploads/avatar/avatar.png')); ?>" <?php endif; ?>
                                                                title="<?php echo e($user['name']); ?>" class="hweb">
                                                        </a>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php else: ?>
                                                    <?php echo e(__('-')); ?>

                                                <?php endif; ?>
                                            </div>
                                            
                                        </td>
                                        <td>
                                            <div class="align-items-center">
                                                <span
                                                    class="completion"><?php echo e($task->taskProgress($task)['percentage']); ?></span>
                                                <div class="progress">
                                                    <div class="progress-bar bg-<?php echo e($task->taskProgress($task)['color']); ?>"
                                                        role="progressbar"
                                                        style="width: <?php echo e($task->taskProgress($task)['percentage']); ?>;">
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-end w-15">
                                            <div class="actions">
                                                <a class="action-item px-1" data-bs-toggle="tooltip"
                                                    title="<?php echo e(__('Attachment')); ?>"
                                                    data-original-title="<?php echo e(__('Attachment')); ?>">
                                                    <i class="ti ti-paperclip mr-2"></i><?php echo e(count($task->taskFiles)); ?>

                                                </a>
                                                <a class="action-item px-1" data-bs-toggle="tooltip"
                                                    title="<?php echo e(__('Comment')); ?>"
                                                    data-original-title="<?php echo e(__('Comment')); ?>">
                                                    <i
                                                        class="ti ti-brand-hipchat mr-2"></i><?php echo e(count($task->comments)); ?>

                                                </a>
                                                <a class="action-item px-1" data-bs-toggle="tooltip"
                                                    title="<?php echo e(__('Checklist')); ?>"
                                                    data-original-title="<?php echo e(__('Checklist')); ?>">
                                                    <i
                                                        class="ti ti-list-check mr-2"></i><?php echo e($task->countTaskChecklist()); ?>

                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <tr>
                                    <th scope="col" colspan="7">
                                        <h6 class="text-center"><?php echo e(__('No tasks found')); ?></h6>
                                    </th>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /home/integra.platformbisnis.com/public_html/resources/views/project_task/list.blade.php ENDPATH**/ ?>