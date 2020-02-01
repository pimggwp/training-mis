@extends('layouts.app')
@section('content')
<div id="app">
    <main-menu :usernow="{{ Auth::user() }}"></main-menu>
</div>
@endsection
