@extends('layouts.app')
@section('content')
<div id="app">
    <personal-report :usernow="{{ Auth::user() }}"></personal-report>
</div>
@endsection