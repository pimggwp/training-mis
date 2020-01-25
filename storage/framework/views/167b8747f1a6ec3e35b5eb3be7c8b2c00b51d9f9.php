<?php $__env->startSection('content'); ?>
<v-app id="inspire" style="
    background: #FFFFFF;">
    <v-layout row wrap>
        <v-flex d-flex xs12 sm6 md8>
            <carousel></carousel>
        </v-flex>
        <v-flex d-flex xs12 sm6 md4>
            <v-layout class="justify-center">
                <v-flex xs9 sm10 mt-5>
                    <v-card tile flat height="100%">
                        <v-card-title>
                            <img src="https://data.bopp-obec.info/emis/pic_school/1056320084.jpg" alt="" width="20%">
                            &nbsp &nbsp<h2 class="txt-thS">ระบบสหกรณ์ร้านค้า (C1)<br />
                                โรงเรียนอนุบาลเชียงคำ (วัดพระธาตุสบแวน)</h2>
                        </v-card-title>
                        <v-card-text>
                            <form method="POST" action="<?php echo e(route('login')); ?>">
                                <?php echo csrf_field(); ?>
                                <h3 for="code" class="col-md-4 txt-thS mb-2"><?php echo e(__('รหัสสมาชิกสหกรณ์')); ?>

                                </h3>
                                <div class="col-md-6 form-group row">
                                    <input id="code" type="text"
                                        class="form-control <?php echo e($errors->has('code') ? ' is-invalid' : ''); ?>" name="code"
                                        value="<?php echo e(old('code')); ?>" required autofocus>
                                        <?php if($errors->has('code')): ?>
                                        <span class="txt-thS" style="color: red;" role="alert">
                                            <strong>รหัสสมาชิกหรือรหัสผ่านไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง</strong>
                                        </span>
                                        <?php endif; ?>
                                </div>
                                <h3 for="password" class="col-md-4 txt-thS mb-2"><?php echo e(__('Password')); ?></h3>
                                <div class="col-md-6 form-group row">
                                    <input id="password" type="password"
                                        class="form-control <?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" name="password"
                                        required>
                                        <?php if($errors->has('password')): ?>
                                        <span class="txt-thS" style="color: red;" role="alert">
                                            <strong>รหัสสมาชิกหรือรหัสผ่านไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง</strong>
                                        </span>
                                        <?php endif; ?>
                                </div>
                                <div class="col-md-8 offset-md-4 mb-5 pb-4">
                                    <v-btn block class="txt-title" type="submit" color="primary">
                                        <?php echo e(__('เข้าสู่ระบบ')); ?>

                                    </v-btn>
                                </div>
                            </form>
                            <v-layout class="justify-center">
                                <v-flex xs9 sm10 mt-5 pt-5>
                                    <h2 class="txt-thS text-md-center">งานสหกรณ์โรงเรียนอนุบาลเชียงคำ (วัดพระธาตุสบแวน)
                                    </h2>
                                    <h3 class="txt-thS text-md-center">248/1 ถนนพิศาล ตำบลหย่วน อำเภอเชียงคำ
                                        จังหวัดพะเยา 56110</h3>
                                    <h3 class="txt-thS text-md-center">โทรศัพท์ 0-5445-2471 โทรสาร 054452471</h3>
                                </v-flex>
                            </v-layout>
                            </div>
                        </v-card-text>
                </v-flex>
            </v-layout>
        </v-flex>
    </v-layout>
    </v-layout>
</v-app>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.guest', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\training\resources\views/auth/login.blade.php ENDPATH**/ ?>