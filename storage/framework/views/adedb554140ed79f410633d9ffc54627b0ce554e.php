<?php $__env->startSection('content'); ?>
<div id="app">
    <personal-report :usernow="<?php echo e(Auth::user()); ?>"></personal-report>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\training\resources\views/page/personalReport.blade.php ENDPATH**/ ?>