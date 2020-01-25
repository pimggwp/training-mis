<?php $__env->startSection('content'); ?>
<div id="app">
    <?php if(auth()->check() && (auth::user()->type == 'staff')): ?>
    <main-menu :usernow="<?php echo e(Auth::user()); ?>"></main-menu>
    <?php else: ?>
    <report-user :usernow="<?php echo e(Auth::user()); ?>"></report-user>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\training\resources\views/home.blade.php ENDPATH**/ ?>