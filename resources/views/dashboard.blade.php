@extends('layouts.master')
@section('title','لوحة التحكم');
@section('css')
{{--    <!--  Owl-carousel css-->--}}
    <link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet" />
{{--    <!-- Maps css -->--}}
    <link href="{{URL::asset('assets/plugins/jqvmap/jqvmap.min.css')}}" rel="stylesheet">


@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <div>
                <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">مرحبا</h2>
                <p class="mg-b-0">اهلا بك </p>
            </div>
        </div>
    </div>
    <!-- /breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row row-sm">
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-primary-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">اجمالي الارباح</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 font-weight-bold mb-1 text-white">

                                </h4>
                                <p class="mb-0 tx-12 text-white op-7"> </p>
                            </div>
                            <span class="float-right my-auto mr-auto">
											<i class="fas fa-arrow-circle-up text-white"></i>
											<span class="text-white op-7">{{number_format($totalProfits,2)}} جنية </span>
							</span>
                        </div>
                    </div>
                </div>
                <span id="compositeline" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-danger-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">اجمالى المصروفات</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 font-weight-bold mb-1 text-white">
                                </h4>
                                <p class="mb-0 tx-12 text-white op-7"></p>
                            </div>
                            <span class="float-right my-auto mr-auto">
											<i class="fas fa-arrow-circle-down text-white"></i>
											<span class="text-white op-7"> {{number_format($totalExpenditures,2)}} جنية  </span>
										</span>
                        </div>
                    </div>
                </div>
                <span id="compositeline2" class="pt-1">3,2,4,6,12,14,8,7,14,16,12,7,8,4,3,2,2,5,6,7</span>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-success-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">صافى الارباح</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 font-weight-bold mb-1 text-white">

                                </h4>
                                <p class="mb-0 tx-12 text-white op-7">
                                </p>
                            </div>
                            <span class="float-right my-auto mr-auto">
											<i class="fas fa-arrow-circle-up text-white"></i>
											<span class="text-white op-7"> {{number_format($totalProfitsAfterExpenditures,2)}} جنية   </span>
										</span>
                        </div>
                    </div>
                </div>
                <span id="compositeline3" class="pt-1">5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-warning-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">اجمالى راس المال</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 font-weight-bold mb-1 text-white"> </h4>
                                <p class="mb-0 tx-12 text-white op-7"> </p>
                            </div>
                            <span class="float-right my-auto mr-auto">
											<i class="fas fa-arrow-circle-down text-white"></i>
											<span class="text-white op-7">
                                            {{number_format($total_customers_money,2)}} جنية
                                            </span>
										</span>
                        </div>
                    </div>
                </div>
                <span id="compositeline4" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
            </div>
        </div>
    </div>
    <!-- row closed -->

    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-md-12 col-lg-12 col-xl-6">
            <div class="card">
                <div class="card-header bg-transparent pd-b-0 pd-t-20 bd-b-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title mb-0 ">العملاء</h3>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                </div>
                <div class="card-body " style="display: flex;justify-content: space-around;">
                    <div style="width:75%;" class="justify-content-center">
                        <div class="mb-2 d-flex justify-content-center">
                            <a class="btn btn-primary " href="{{route('customers.index')}}" style="width:100%;">
                                قائمة العملاء
                            </a>
                        </div>
                        <div class="mb-2 d-flex justify-content-center">
                            <a class="btn btn-primary"  href="{{route('customers.create')}}" style="width:100%;">
                                اضافة عميل جديد
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-12 col-xl-6">
            <div class="card">
                <div class="card-header bg-transparent pd-b-0 pd-t-20 bd-b-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mb-0">المصروفات</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                </div>
                <div class="card-body " style="display: flex;justify-content: space-around;">
                    <div style="width:75%;" class="justify-content-center">
                        <div class="mb-2 d-flex justify-content-center">
                            <a class="btn btn-primary ml-4 " href="{{ route('expenditures.index') }}" style="width:100%;">
                                قائمة الاصناف
                            </a>
                            <a class="btn btn-primary " href="{{ route('expenditure-details.index') }}" style="width:100%;">
                                قائمة المصروفات
                            </a>
                        </div>

                        <div class="mb-2 d-flex justify-content-center">
                            <a class="btn btn-primary ml-4"  href="{{ route('expenditure-details.create') }}" style="width:100%;">
                                اضافة مصاريف جديدة
                            </a>
                            <a class="btn btn-primary"  href="{{route('expenditure-details.edit')}}" style="width:100%;">
                                تعديل المصاريف
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- row closed -->
    <div class="row row-sm">
        <div class="col-md-12 col-lg-12 col-xl-6">
            <div class="card">
                <div class="card-header bg-transparent pd-b-0 pd-t-20 bd-b-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mb-0">الأرباح</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                </div>
                <div class="card-body " style="display: flex;justify-content: space-around;">
                    <div style="width:75%;" class="justify-content-center">
                        <div class="mb-2 d-flex justify-content-center">
                            <a class="btn btn-primary " href="{{route('profits.index')}}" style="width:100%;">
                                تقارير الارباح
                            </a>
                        </div>
                        <div class="mb-2 d-flex justify-content-center">
                            <a class="btn btn-primary"  href="{{route('profits.create')}}" style="width:100%;">
                                اضافة ارباح
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-12 col-lg-12 col-xl-6">
            <div class="card">
                <div class="card-header bg-transparent pd-b-0 pd-t-20 bd-b-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mb-0">المستخدمين</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                </div>
                <div class="card-body " style="display: flex;justify-content: space-around;">
                    <div style="width:75%;" class="justify-content-center">
                        <div class="mb-2 d-flex justify-content-center">
                            <a class="btn btn-primary " href="{{route('users.index')}}" style="width:100%;">
                                قائمة المستخدمين
                            </a>
                        </div>

                        <div class="mb-2 d-flex justify-content-center">
                            <a class="btn btn-primary " href="{{route('users.index')}}" style="width:100%;">
                                اضافة مستخدم جديد
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-12 col-lg-12 col-xl-12">
            <div class="card">
                <div class="card-header bg-transparent pd-b-0 pd-t-20 bd-b-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mb-0">الباركود</h4>
                    </div>
                </div>
                <div class="card-body " style="display: flex;justify-content: space-around;">
                    <div style="width:75%;" class="justify-content-center">
                        <div>
                            <a class="btn btn-primary " href="{{route('QrCode')}}" style="width:100%;">
                                الباركود
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>


    </div>



    <!-- /row -->
    </div>
    </div>

    <!-- Container closed -->
@endsection
@section('js')
    <!--Internal  Chart.bundle js -->
    <script src="{{URL::asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>
    <!-- Moment js -->
    <script src="{{URL::asset('assets/plugins/raphael/raphael.min.js')}}"></script>
    <!--Internal  Flot js-->
    <script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.pie.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.resize.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.categories.js')}}"></script>
    <script src="{{URL::asset('assets/js/dashboard.sampledata.js')}}"></script>
    <script src="{{URL::asset('assets/js/chart.flot.sampledata.js')}}"></script>
    <!--Internal Apexchart js-->
    <script src="{{URL::asset('assets/js/apexcharts.js')}}"></script>
    <!-- Internal Map -->
    <script src="{{URL::asset('assets/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
    <script src="{{URL::asset('assets/js/modal-popup.js')}}"></script>
    <!--Internal  index js -->
    <script src="{{URL::asset('assets/js/index.js')}}"></script>
    <script src="{{URL::asset('assets/js/jquery.vmap.sampledata.js')}}"></script>
    <script src="https://cdnjs.com/libraries/Chart.js"></script>
{{--    <script>--}}
{{--        const json = {--}}
{{--            labels: ['مجموع الارباح', 'مجموع المصاريف', 'مجموع صافى الارباح'],--}}
{{--            data: [{{$totalProfits}}, {{$totalExpenditures}}, {{$totalProfitsAfterExpenditures}}]--}}

{{--        };--}}
{{--        console.log(json);--}}
{{--        const ctx = document.getElementById('myChart').getContext('2d');--}}

{{--        const myChart = new Chart(ctx, {--}}
{{--            type: 'bar',--}}
{{--            data: {--}}
{{--                labels: json.labels,--}}
{{--                datasets: [{--}}
{{--                    label: 'الرسوم البيانية',--}}
{{--                    data: json.data,--}}
{{--                    backgroundColor: [--}}
{{--                        'rgba(255, 99, 132, 0.2)',--}}
{{--                        'rgba(54, 162, 235, 0.2)',--}}
{{--                        'rgba(255, 206, 86, 0.2)',--}}

{{--                    ],--}}
{{--                    borderColor: [--}}
{{--                        'rgba(255, 99, 132, 1)',--}}
{{--                        'rgba(54, 162, 235, 1)',--}}
{{--                        'rgba(255, 206, 86, 1)',--}}
{{--                    ],--}}
{{--                    borderWidth: 1--}}
{{--                }]--}}
{{--            },--}}
{{--            options: {--}}
{{--                scales: {--}}
{{--                    y: {--}}
{{--                        beginAtZero: true--}}
{{--                    }--}}
{{--                }--}}
{{--            }--}}
{{--        });--}}
{{--    </script>--}}
@endsection
