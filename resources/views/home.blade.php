@extends('layouts.app')

@section('content')
    <guest-products is_user="{{auth()->check()}}"></guest-products>
@endsection