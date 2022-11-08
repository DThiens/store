@extends('layouts.client')
@section('title')
    Sản phẩm
@endsection
@section('sidebar')
    @parent
    <h3>Product Sidebar</h3>
@endsection

@section('content')
    <h1>Sản phẩm</h1>
    @if (session('msg'))
        <div class="alert alert-success">{{session('msg')}}</div>
    @endif
@endsection

@section('css')
@endsection