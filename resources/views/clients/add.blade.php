@extends('layouts.client')
@section('title')
    {{$title}}
@endsection
@section('sidebar')
    @parent
    <h3>Home Sidebar</h3>
@endsection

@section('content')
    <h1>Thêm sản phẩm</h1>
    <form action="{{route('post-add')}}" method="POST" id="product-form">
        @error('mgs')
            <div class="alert alert-danger text-center"></div>
        @enderror
        <div class="mb-3">
            <label for="">Tên sản phẩm</label>
            <input type="text" class="form-control" name="product_name" placeholder="Tên sản phẩm..." value="{{old('product_name')}}">
                <span style="color:red" class="error product_name_error"></span>
        </div>
        <div class="mb-3">    
            <label for="">Giá sản phẩm</label>
            <input type="text" class="form-control" name="product_price" placeholder="Giá sản phẩm..." value="{{old('product_price')}}">
                <span style="color:red" class="error product_price_error"></span>
        </div>
        <button type="submit" class="btn btn-primary">Thêm mới</button>
        @csrf
    </form>
@endsection

@section('js')
<script>
    $(document).ready(function(){
        $('#product-form').on('submit',function(e){
            e.preventDefault();
            let productName = $('input[name="product_name"]').val().trim();
            let productPrice = $('input[name="product_price"]').val().trim();
            let actionURL = $(this).attr('action');
            let csrfToken = $(this).find('input[name="_token"]').val();
            console.log(csrfToken);
            $('.error').text('');
            $.ajax({
                url: actionURL,
                type: 'POST',
                data:   {
                    product_name: productName,
                    product_price: productPrice,
                    _token : csrfToken,
                },
                dataType: 'json',
                success: function(response){
                    console.log('response');
                },
                error: function(error){
                    let responseJSON = error.responseJSON.errors;
                    for (let key in responseJSON){
                        $('.'+key+'_error').text(responseJSON[key][0]);
                    }
                }
            })
        })
    });
</script>
@endsection