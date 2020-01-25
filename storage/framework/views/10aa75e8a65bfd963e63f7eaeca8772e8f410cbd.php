<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title>สหกรณ์โรงเรียนอนุบาลเชียงคำ</title>

    <!-- Scripts -->
    <script src="<?php echo e(asset('js/app.js')); ?>" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/index.css')); ?>" rel="stylesheet">
</head>

<body>
    <div id="app" class="Hello">
        <v-toolbar color="pink accent-3" dark permanent fixed>
            <v-toolbar-title class="txt-title action-container"><img src="/images/elements/logo.png"
                    height="60">ระบบสหกรณ์ร้านค้า</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-toolbar-items class="hidden-sm-and-down">
                <?php if(auth()->guard()->guest()): ?>
                <v-btn class="txt-title" href="/login" flat>LOGIN</v-btn>
                <?php else: ?>
                    <?php if(auth()->check() && (auth::user()->type == 'staff')): ?>
                    <v-btn class="txt-title" href="#" flat><v-icon>perm_identity</v-icon>&nbsp<?php echo e(Auth::user()->firstname); ?>&nbsp<?php echo e(Auth::user()->lastname); ?></v-btn>
                    <?php else: ?>
                    <v-btn class="txt-title" href="/profile" flat><v-icon>perm_identity</v-icon>&nbsp<?php echo e(Auth::user()->firstname); ?>&nbsp<?php echo e(Auth::user()->lastname); ?></v-btn>
                    <?php endif; ?>

                <v-btn class="txt-title" flat href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    <v-icon>power_settings_new</v-icon>&nbsp LOGOUT
                </v-btn>
                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                    <?php echo csrf_field(); ?>
                </form>
                <?php endif; ?>
            </v-toolbar-items>
            <v-menu class="hidden-md-and-up">
                <v-toolbar-side-icon slot="activator"></v-toolbar-side-icon>
                <v-list>
                    <v-list-tile>
                        <v-list-tile-content>
                            <?php if(auth()->guard()->guest()): ?>
                            <v-list-tile-content>
                                <v-list-tile href="/login">LOGIN</v-list-tile>
                            </v-list-tile-content>
                            <?php else: ?>
                                <?php if(auth()->check() && (auth::user()->type == 'staff')): ?>
                                <v-list-tile-title class="txt-title" href="#"><v-icon>perm_identity</v-icon>&nbsp<?php echo e(Auth::user()->firstname); ?>&nbsp<?php echo e(Auth::user()->lastname); ?></v-list-tile-title>
                                <?php else: ?>
                                <v-list-tile-title class="txt-title" href="/profile"><v-icon>perm_identity</v-icon>&nbsp<?php echo e(Auth::user()->firstname); ?>&nbsp<?php echo e(Auth::user()->lastname); ?></v-list-tile-title>
                                <?php endif; ?>
                            <v-list-tile-title class="txt-title" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                            <v-icon>power_settings_new</v-icon>&nbsp LOGOUT
                            </v-list-tile-title>
                            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                <?php echo csrf_field(); ?>
                            </form>
                            <?php endif; ?>
                        </v-list-tile-content>
                    </v-list-tile>
                </v-list>
            </v-menu>
        </v-toolbar>
        <navbar :usernow="<?php echo e(Auth::user()); ?>"></navbar>
            <?php echo $__env->yieldContent('content'); ?>
    </div>
</body>

</html>

<style scope>
.Hello div.application--wrap{
    background-color: white;
}
</style>
<?php /**PATH C:\xampp\htdocs\CoOp-Project\resources\views/layouts/app.blade.php ENDPATH**/ ?>