@extends('layouts.app')


    
@if (session('erros'))
    <div class="alert alert-danger">
        {{session('erros')}}
    </div>
@endif

@section('title','Thêm danh mục')

@section('content')
    <div class="cart">
        <div class="card-header">
            <h4>Thêm danh mục</h4>
        </div>
        <div class="cart-body">
            <form action="{{route('categories.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-lable">Tên danh mục</label>
                    <input type="text" name="name" class="form-control">
                    @error('name')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-lable">Trạng thái</label>
                    <select name="status" class="form-control">
                        <option value="">Chọn danh mục</option>
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