<?php $__env->startSection('content'); ?>
<div id="app">
    <product :usernow="<?php echo e(Auth::user()); ?>"></product>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\CoOp-Project\resources\views/page/product.blade.php ENDPATH**/ ?>