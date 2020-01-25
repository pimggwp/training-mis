<?php $__env->startSection('content'); ?>
<div id="app">
    <?php if(auth()->check()): ?>
    <transaction-gen :usernow="<?php echo e(Auth::user()); ?>"></transaction-gen>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\training\resources\views/page/transactionGen.blade.php ENDPATH**/ ?>