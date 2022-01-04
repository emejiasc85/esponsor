@extends('layouts.app')

@section('content')
    <guest-products is_logged="{{auth()->check()}}"></guest-products>
@endsection