<?php $__env->startSection('content'); ?>
<div id="app">
    <main-menu :usernow="<?php echo e(Auth::user()); ?>"></main-menu>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\training\resources\views/home.blade.php ENDPATH**/ ?>