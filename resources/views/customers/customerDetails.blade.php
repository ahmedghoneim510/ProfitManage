@extends('layouts.master')
@section('title', 'تفاصيل العميل');
@section('css')
    <!-- Internal Data table css -->
    <link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />

@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{__('العملاء')}}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{__('قائمة العملاء')}}</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->


    <div class="row">
        <x-alert type="success" />
        <!--div-->
        <div class="col-xl-12" id="print">
            <form action="{{\Illuminate\Support\Facades\URL::current() }} " method="get" class="d-flex justify-content-between mb-4">
                <select name="year" class="form-control mx-1">
                    <option value="">All</option>
                    <option value="2024" @selected(request('year')=='2024')>2024</option>
                    <option value="2025" @selected(request('year')=='2025')>2025</option>
                    <option value="2026" @selected(request('year')=='2026')>2026</option>
                    <option value="2027" @selected(request('year')=='2027')>2027</option>
                    <option value="2028" @selected(request('year')=='2028')>2028</option>
                    <option value="2029" @selected(request('year')=='2029')>2029</option>
                    <option value="2030" @selected(request('year')=='2030')>2023</option>
                </select>
                <button class="btn btn-dark">فلترة</button>
            </form>
            <div class="card mg-b-20">

                @php
                    $i=1;
                @endphp
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table key-buttons text-md-nowrap">
                            <thead>
                            <tr>
                                <th class="border-bottom-0">الاسم</th>
                                <th class="border-bottom-0">يناير</th>
                                <th class="border-bottom-0">فبراير</th>
                                <th class="border-bottom-0">مارس</th>
                                <th class="border-bottom-0">أبريل</th>
                                <th class="border-bottom-0">مايو</th>
                                <th class="border-bottom-0">يونيو</th>
                                <th class="border-bottom-0">يوليو</th>
                                <th class="border-bottom-0">أغسطس</th>
                                <th class="border-bottom-0">سبتمبر</th>
                                <th class="border-bottom-0">أكتوبر</th>
                                <th class="border-bottom-0">نوفمبر</th>
                                <th class="border-bottom-0">ديسمبر</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{$customer->name}}</td>
                                    @for($i=1;$i<=12;$i++)
                                            @php $total = false;@endphp
                                        @foreach ($customerDetails as $customerDetail)

                                            @if($customerDetail->month == $i)
                                                <td>{{number_format($customerDetail->money,2)}}</td>
                                                @php     $total = true; @endphp
                                           @endif
                                        @endforeach
                                        @if($total === false)
                                            <td>0.00</td>
                                        @endif
                            @endfor
                            </tr>
                            </tbody>
                            <tfoot class="table-dark">
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td colspan="3">مجموع الأرباح</td>
                                    <td colspan="4">{{number_format($total_money,2)}}</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
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
    <!-- Internal Data tables -->
    <script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
    <!--Internal  Datatable js -->
    <script src="{{URL::asset('assets/js/table-data.js')}}"></script>
    <!--Internal  Notify js -->
    <script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>

    <script>
        $('#delete_invoice').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var invoice_id = button.data('invoice_id')
            var modal = $(this)
            modal.find('.modal-body #invoice_id').val(invoice_id);
        })

    </script>



@endsection

