<?php $__env->startSection('content'); ?>
<div id="app">
    <?php if(auth()->check()): ?>
        <sale-report :usernow="<?php echo e(Auth::user()); ?>"></sale-report>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\CoOp-Project\resources\views/page/salereport.blade.php ENDPATH**/ ?>