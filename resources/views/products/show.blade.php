@extends('layouts.app')


    
@if (session('erros'))
    <div class="alert alert-danger">
        {{session('erros')}}
    </div>
@endif

@section('title','Chi tiết sản phẩm')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white text-center">
                    <h4>Chi tiết sản phẩm</h4>
                </div>
                <div class="card-body">
                    <strong>Tên sản phẩm:</strong>
                    <p class="text-muted">{{$detailPro->name}}</p>

                    <strong>Giá:</strong>
                    <p class="text-danger fw-bold">{{ number_format($detailPro->price, 0, ',', '.') }} VNĐ</p>

                    <strong>Số lượng:</strong>
                    <p class="text-muted">{{$detailPro->quantity}}</p>

                    <strong>Ảnh sản phẩm:</strong>
                    <div class="text-center">
                        <img src="{{ asset($detailPro->image) }}" alt="Ảnh sản phẩm" 
                             class="img-fluid rounded shadow-sm" 
                             style="max-height: 300px;">
                    </div>

                    <strong>Tên danh mục:</strong>
                    <p class="text-muted">{{$detailPro->cate_name}}</p>

                    <strong>Mô tả:</strong>
                    <p class="text-muted">{{$detailPro->description}}</p>

                    <strong>Trạng thái sản phẩm:</strong>
                    <p class="text-muted">{{ $detailPro->status == 1 ? 'Hoạt động' : 'Tạm dừng' }}</p>

                    <div class="text-center mt-4">
                        <a href="{{ route('products.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Quay lại
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection