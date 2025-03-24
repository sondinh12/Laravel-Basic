@extends('layouts.app')


    
@if (session('erros'))
    <div class="alert alert-danger">
        {{session('erros')}}
    </div>
@endif

@section('title','Sửa sản phẩm')

@section('content')
    <div class="cart">
        <div class="card-header">
            <h4>Sửa sản phẩm</h4>
        </div>
        <div class="cart-body">
            <form action="{{route('products.update',$proOld->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="mb-3">
                    <label class="form-lable">Tên sản phẩm</label>
                    <input type="text" name="name" class="form-control" value="{{$proOld->name}}">
                    @error('name')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-lable">Giá sản phẩm</label>
                    <input type="text" name="price" class="form-control" value="{{$proOld->price}}">
                    @error('price')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-lable">Số lượng sản phẩm</label>
                    <input type="text" name="quantity" class="form-control" value="{{$proOld->quantity}}">
                    @error('quantity')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-lable">Ảnh sản phẩm</label>
                    <input type="file" name="image" class="form-control">
                    <img src="{{asset($proOld->image)}}" alt="Ảnh sản phẩm" width="150px">
                    @error('image')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-lable">Danh mục sản phẩm</label>
                    <select name="category_id">
                        <option value="{{$proOld->category_id}}">{{$proOld->cate_name}}</option>
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
                    <input type="text" name="description" class="form-control" value="{{$proOld->description}}">
                </div>
                <div class="mb-3">
                    <label class="form-lable">Trạng thái</label>
                    <select name="status" class="form-control">
                        <option value="1" {{ $proOld->status == 1 ? 'selected' : '' }}>Hoạt động</option>
                        <option value="0" {{ $proOld->status == 0 ? 'selected' : '' }}>Tạm dừng</option>
                    </select>
                    @error('status')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>  
                <button type="submit" class="btn btn-success">Sửa</button>
            </form>
        </div>
    </div>
@endsection