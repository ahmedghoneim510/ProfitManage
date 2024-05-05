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
            <div class="card mg-b-20">

                @php
                    $j=1;
                @endphp
                @php
                    $months = [1 => 'يناير', 2 => 'فبراير',  3 => 'مارس',  4 => 'أبريل',  5 => 'مايو',  6 => 'يونيو',
                            7 => 'يوليو', 8 => 'أغسطس', 9 => 'سبتمبر', 10 => 'أكتوبر', 11 => 'نوفمبر', 12 => 'ديسمبر',
                                ];
                    $currentMonth = \Carbon\Carbon::now()->month;
                @endphp
                <div class="card-body">
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
                    <div class="table-responsive">
                        <table id="example1" class="table key-buttons text-md-nowrap">
                            <thead>
                            <tr>
                                <th class="border-bottom-0">{{$expenditure->name}}</th>
                                <th>الشهر</th>
                                <th class="border-bottom-0">التاريخ</th>
                                <th class="border-bottom-0">المبلغ</th>
                            </tr>
                            </thead>
                            <tbody>
                            @for($i=1;$i<=12;$i++)
                            @php $is=false @endphp
                                <tr>
                                    <td>{{$j++}}</td>
                                    <td>{{$months[$i]}}</td>
                                    @foreach ($expenditure_details as $expenditure_detail)
                                        @if( intval($expenditure_detail->month)== $i)
                                            <td>{{$expenditure_detail->date_of_expenditure}}</td>
                                            <td>{{$expenditure_detail->money}}</td>
                                            @php $is=true @endphp
                                        @endif
                                    @endforeach
                                    @if(!$is)
                                        <td>لايوجد</td>
                                        <td>لايوجد</td>
                                    @endif
                                </tr>
                            @endfor

                            </tbody>
                            <tfoot class="table-dark">
                            <tr>
                                <td></td>
                                <td colspan="1">مجموع المصاريف</td>
                                <td colspan="1">{{number_format($sum,2)}}</td>
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

