@extends('layouts.app')


    
@if (session('erros'))
    <div class="alert alert-danger">
        {{session('erros')}}
    </div>
@endif

@section('title','Thêm sản phẩm')

@section('content')
    <div class="cart">
        <div class="card-header">
            <h4>Thêm sản phẩm</h4>
        </div>
        <div class="cart-body">
            <form action="{{route('products.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-lable">Tên sản phẩm</label>
                    <input type="text" name="name" class="form-control">
                    @error('name')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-lable">Giá sản phẩm</label>
                    <input type="text" name="price" class="form-control">
                    @error('price')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-lable">Số lượng sản phẩm</label>
                    <input type="text" name="quantity" class="form-control">
                    @error('quantity')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-lable">Ảnh sản phẩm</label>
                    <input type="file" name="image" class="form-control">
                    @error('image')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-lable">Danh mục sản phẩm</label>
                    <select name="category_id">
                        <option value="">Chọn danh mục</option>
                        @foreach ($categories as $cate)
                            <option value="{{$cate->id}}">{{$cate->name}}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-lable">Mô tả sản phẩm</label>
                    <input type="text" name="description" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-lable">Trạng thái</label>
                    <select name="status" class="form-control">
                        <option value="">Chọn trạng thái</option>
                        <option value="1">Hoạt động</option>
                        <option value="0">Tạm dừng</option>
                    </select>
                    @error('status')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success">Thêm</button>
            </form>
        </div>
    </div>
@endsection