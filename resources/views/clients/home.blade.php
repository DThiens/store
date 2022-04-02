@extends('layouts.client')
@section('title')
    Trang Chủ
@endsection
@section('sidebar')
    @parent
    <h3>Home Sidebar</h3>
@endsection

@section('content')
    <h1>Trang Chủ</h1>
    @include('clients.contents.slide')
    @include('clients.contents.about')
    <x-forms.button />
    
    <x-alert  type='success' content="Đặt hàng thành công" dataIcon="car" />

    <p><img src="https://i1-vnexpress.vnecdn.net/2022/03/22/55631774a-39-thi-the-trong-con-6892-6413-1647927255.jpg?w=1020&h=0&q=100&dpr=1&fit=crop&s=Gp_M6jNnFVd7YPpKF2ECPA" >
    </p>
    <p><a href="{{route('download-image').'?image='.asset('public/storage/')}}" class="btn btn-primary">Download Ảnh</a></p>
@endsection

@section('css')
<style>
    img{
        max-width: 100%;
        height: auto;
    }
</style>
@endsection