<?php $__env->startSection('content'); ?>
<div id="app">
    <save-training :usernow="<?php echo e(Auth::user()); ?>"></save-training>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\training\resources\views/page/product.blade.php ENDPATH**/ ?>