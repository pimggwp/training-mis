@extends('layouts.app')
@section('content')
<div id="app">
    <save-training :usernow="{{ Auth::user() }}"></save-training>
</div>
@endsection
