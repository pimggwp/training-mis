<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ระบบบันทึกประวัติการฝึกอบรม</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/index.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app" class="Hello">
        <v-toolbar color="blue lighten-2" dark permanent fixed>
            <v-toolbar-title class="txt-title action-container"><img src="/images/elements/logo.png"
                    height="60"><h2>ระบบบันทึกประวัติการฝึกอบรม</h2></v-toolbar-title>
            <v-spacer></v-spacer>
            <v-toolbar-items class="hidden-sm-and-down">
                @guest
                <v-btn class="txt-title" href="/login" flat>LOGIN</v-btn>
                @else
                    @if(auth()->check() && (auth::user()->type == 'staff'))
                    <v-btn class="txt-title" href="#" flat>
                        <h3><v-icon>perm_identity</v-icon>&nbsp{{ Auth::user()->firstname }}&nbsp{{ Auth::user()->lastname }}</h3>
                    </v-btn>
                    @else
                    <v-btn class="txt-title" href="/profile" flat> <h3><v-icon>perm_identity</v-icon>&nbsp{{ Auth::user()->firstname }}&nbsp{{ Auth::user()->lastname }}</h3></v-btn>
                    @endif

                <v-btn class="txt-title" flat href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    <h3><v-icon>power_settings_new</v-icon>&nbsp LOGOUT</h3>
                </v-btn>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                @endguest
            </v-toolbar-items>
            <v-menu class="hidden-md-and-up">
                <v-toolbar-side-icon slot="activator"></v-toolbar-side-icon>
                <v-list>
                    <v-list-tile>
                        <v-list-tile-content>
                            @guest
                            <v-list-tile-content>
                                <v-list-tile href="/login">LOGIN</v-list-tile>
                            </v-list-tile-content>
                            @else
                                @if(auth()->check() && (auth::user()->type == 'staff'))
                                <v-list-tile-title class="txt-title" href="#"><v-icon>perm_identity</v-icon>&nbsp{{ Auth::user()->firstname }}&nbsp{{ Auth::user()->lastname }}</v-list-tile-title>
                                @else
                                <v-list-tile-title class="txt-title" href="/profile"><v-icon>perm_identity</v-icon>&nbsp{{ Auth::user()->firstname }}&nbsp{{ Auth::user()->lastname }}</v-list-tile-title>
                                @endif
                            <v-list-tile-title class="txt-title" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                            <v-icon>power_settings_new</v-icon>&nbsp LOGOUT
                            </v-list-tile-title>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            @endguest
                        </v-list-tile-content>
                    </v-list-tile>
                </v-list>
            </v-menu>
        </v-toolbar>
        <navbar :usernow="{{ Auth::user()}}"></navbar>
            @yield('content')
    </div>
</body>

</html>

<style scope>
.Hello div.application--wrap{
    background-color: white;
}
</style>
