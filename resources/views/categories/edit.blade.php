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
            <h4>Sửa danh mục</h4>
        </div>
        <div class="cart-body">
            <form action="{{route('categories.update',$category->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="mb-3">
                    <label class="form-lable">Tên danh mục</label>
                    <input type="text" name="name" class="form-control" value="{{$category->name}}">
                    @error('name')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-lable">Trạng thái</label>
                        {{-- <option value="">Chọn danh mục</option> --}}
                        <select name="status" class="form-control">
                            <option value="1" {{ $category->status == 1 ? 'selected' : '' }}>Hoạt động</option>
                            <option value="0" {{ $category->status == 0 ? 'selected' : '' }}>Tạm dừng</option>
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