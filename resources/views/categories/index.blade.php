@extends('layouts.app')

@if (session('success'))
    <div class="alert alert-success">
        {{session('success')}}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{session('error')}}
    </div>
@endif

@section('title','Danh sách danh mục')

@section('content')
    <div class="container">
        <h2>Danh sách danh mục</h2>
        <a href="{{route('categories.create')}}" class="btn btn-primary">Thêm danh mục</a>
        <form method="get" class="mb-3 mt-3">
            <div class="input-group">
                <input type="text" name="search" placeholder="Tìm kiếm..." value="{{request('search')}}" class="form-control">
                <button type="submit" class="btn btn-outline-secondary">Tìm kiếm</button>
            </div>
        </form>
    </div>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên danh mục</th>
                <th>Trạng thái</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $cate)
                <tr>
                    <td>{{$cate->id}}</td>
                    <td>{{$cate->name}}</td>
                    <td>{{ ["Tạm dừng", "Hoạt động", "Đã xóa"][$cate->status] ?? "Không xác định" }}</td>
                    <td>
                        @if ($cate->status !== 2)
                            <a href="{{route('categories.show',$cate->id)}}" class="btn btn-info">Show</a>
                            <a href="{{route('categories.edit',$cate->id)}}" class="btn btn-warning">Sửa</a>
                            <form action="{{ route('categories.destroy', $cate->id) }}" class="d-inline" method="POST" onsubmit="return confirm('Bạn có muốn xóa không?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Xóa</button>
                            </form>   
                        @else       
                        <span class="text-danger">Danh mục đã bị vô hiệu hóa</span>
                        <a href="{{route('categories.backCate',$cate->id)}}"><button class="btn btn-info" onclick="return confirm('Bạn muốn khôi phục?')">Khôi phục</button></a>
                        <a href="{{route('categories.show',$cate->id)}}" class="btn btn-info">Show</a>
                        @endif              
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{$categories->links()}}
@endsection