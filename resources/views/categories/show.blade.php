@extends('layouts.app')


    
@if (session('erros'))
    <div class="alert alert-danger">
        {{session('erros')}}
    </div>
@endif

@section('title','Chi tiết danh mục')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white text-center">
                    <h4>Danh mục sản phẩm</h4>
                </div>
                <div class="card-body">
                    <strong>Tên danh mục:</strong>
                    <p class="text-muted">{{$detailCate->name}}</p>

                    <strong>Trạng thái sản phẩm:</strong>
                    <p class="text-muted">
                        @if ($detailCate->status == 1)
                            Hoạt động
                        @elseif ($detailCate->status == 0)
                            Tạm dừng
                        @elseif ($detailCate->status == 2)
                            Đã xóa
                        @endif
                    </p>

                    <div class="text-center mt-4">
                        <a href="{{ route('categories.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Quay lại
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection