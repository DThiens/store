@extends('layouts.client')
@section('title')
    {{$title}}
@endsection
@section('sidebar')
    @parent
    <h3>USERS</h3>
@endsection
@section('content')
    <h1>{{$title}}</h1>
    @if (session('msg'))
        <div class="alert alert-success">{{session('msg')}}</div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">Dữ liệu không hợp liệu</div>
    @endif
    <form action="" method="POST">
        <div class="mb-3">
            <label for="">Họ và tên</label>
            <input type="text" class="form-control" name="fullname" placeholder="Họ và tên..."value={{old('fullname')}}>
            @error('fullname')
                <span style="color:red">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="">Email</label>
            <input type="text" class="form-control" name="email" placeholder="Địa chỉ email..."value={{old('email')}}>
            @error('email')
                <span style="color:red">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="">Nhóm</label>
            <select name="group_id" class="form-control">
                <option value="0">Chọn nhóm</option>
                @if (!empty(getAllGroup()))
                    @foreach ($group as $item)
                        <option value="{{$item->id}}"{{old('group_id')==$item->id?'selected':false}}>{{$item->name}}</option>
                    @endforeach
                @endif
            </select>
            @error('group_id')
                <span style="color:red">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="">Trạng thái</label>
            <select name="status" class="form-control">
                <option value="0" {{old('status')==0?'selected':false}}>Chưa kích hoạt</option>
                <option value="1" {{old('status')==1?'selected':false}}>Kích hoạt</option>
            </select>
            @error('status')
                <span style="color:red">{{$message}}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Thêm mới</button>
        <a href="{{route('users.index')}}" class="btn btn-warning">Quay lại</a>
        @csrf
    </form>
@endsection