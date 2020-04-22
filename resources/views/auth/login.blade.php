@extends('layouts.guest')
@section('content')
<v-app id="inspire" style="
    background: #FFFFFF;">
    <v-layout row wrap class="justify-center">
        <v-flex d-flex xs12 sm6 md4>
            <v-layout class="justify-center">
                <v-flex xs9 sm10 mt-5>
                    <v-card tile flat height="100%">
                        <v-card-title>
                        <img src="/images/elements/logo.png" height="80">
                            &nbsp &nbsp<h1 class="txt-thS">ระบบบันทึกประวัติการฝึกอบรม</h1>
                        </v-card-title>
                        <v-card-text>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <h3 for="code" class="col-md-4 txt-thS mb-2">{{ __('รหัสพนักงาน') }}
                                </h3>
                                <div class="col-md-6 form-group row">
                                    <input id="code" type="text"
                                        class="form-control {{ $errors->has('code') ? ' is-invalid' : '' }}" name="code"
                                        value="{{ old('code') }}" required autofocus>
                                        @if ($errors->has('code'))
                                        <span class="txt-thS" style="color: red;" role="alert">
                                            <strong>รหัสสมาชิกหรือรหัสผ่านไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง</strong>
                                        </span>
                                        @endif
                                </div>
                                <h3 for="password" class="col-md-4 txt-thS mb-2">{{ __('Password') }}</h3>
                                <div class="col-md-6 form-group row">
                                    <input id="password" type="password"
                                        class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                                        required>
                                        @if ($errors->has('password'))
                                        <span class="txt-thS" style="color: red;" role="alert">
                                            <strong>รหัสสมาชิกหรือรหัสผ่านไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง</strong>
                                        </span>
                                        @endif
                                </div>
                                <div class="col-md-8 offset-md-4 mb-5 pb-4">
                                    <v-btn block class="txt-title" type="submit" color="primary">
                                        {{ __('เข้าสู่ระบบ') }}
                                    </v-btn>
                                </div>
                            </form>
                            <v-layout class="justify-center">
                                <v-flex xs9 sm10 mt-5 pt-5>
                                    <h2 class="txt-thS text-md-center">ที่อยู่หน่วยงาน
                                    </h2>
                                    <h3 class="txt-thS text-md-center">130/555 หมู่ 9 ถนนเชียงใหม่-ฮอด ตำบลแม่เหียะ อำเภอเมืองเชียงใหม่ จังหวัด เชียงใหม่ 50100</h3>
                                    <h3 class="txt-thS text-md-center">โทร.053-999888</h3>
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
@endsection
