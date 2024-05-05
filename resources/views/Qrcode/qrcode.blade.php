@extends('layouts.master')
@section('title', 'الباركود');

@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الباركود</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ الباركود</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h3>QR Code</h3>
                </div>
                <div class="card-body" style="display: flex;justify-content: center;">
                    <div class="row">
                        <div class="text-center">
                            <h5>QR Code</h5>
                            <div class="qrcode" id="qrcode">
                                {!! QrCode::size(300)->generate($url); !!}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
@endsection
