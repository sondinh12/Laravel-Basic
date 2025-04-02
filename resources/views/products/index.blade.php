@extends('layouts.app')

@if (session('success'))
    <div class="alert alert-success">
        {{session('success')}}
    </div>
@endif

@section('title', 'Danh sách sản phẩm')

@section('content')
    <div class="container">
        <h2>Danh sách sản phẩm</h2>
        <a href="{{route('products.create')}}" class="btn btn-primary">Thêm sản phẩm</a>
        <form method="get" class="mb-3 mt-3">
            <div class="input-group">
                <input type="text" name="search" placeholder="Tìm kiếm..." value="{{request('search')}}"
                    class="form-control">
                <button type="submit" class="btn btn-outline-secondary">Tìm kiếm</button>
            </div>
        </form>
    </div>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Ảnh</th>
                <th>Tên danh mục</th>
                <th>Mô tả</th>
                <th>Trạng thái</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $pro)
                <tr>
                    <td>{{$pro->id}}</td>
                    <td>{{$pro->name}}</td>
                    <td>{{$pro->price}}</td>
                    <td>{{$pro->quantity}}</td>
                    <td>
                        <img src="{{asset('storage/' . $pro->image)}}" alt="Ảnh sản phẩm" width="100px">
                    </td>
                    <td>{{$pro->category->name}}</td>
                    <td>{{$pro->description}}</td>
                    <td>{{ ["Tạm dừng", "Hoạt động", "Đã xóa"][$pro->status] ?? "Không xác định" }}</td>
                    <td>
                        @if ($pro->status !== 2)
                        <a href="{{route('products.show',$pro->id)}}" class="btn btn-info">Show</a>
                        <a href="{{route('products.edit', $pro->id)}}" class="btn btn-warning">Sửa</a>
                        <form action="{{ route('products.destroy', $pro->id) }}" class="d-inline" method="POST"
                            onsubmit="return confirm('Bạn có muốn xóa không?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Xóa</button>
                        </form>
                        @else       
                        <span class="text-danger">Sản phẩm đã bị vô hiệu hóa</span>
                        <a href="{{route('products.backPro',$pro->id)}}"><button class="btn btn-info" onclick="return confirm('Bạn muốn khôi phục?')">Khôi phục</button></a>
                        <a href="{{route('products.show',$pro->id)}}" class="btn btn-info">Show</a>
                        @endif   
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{$products->links()}}
@endsection