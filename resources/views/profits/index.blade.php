@extends('layouts.master')
@section('title', 'تقارير الارباح');
@section('css')
    <!-- Internal Data table css -->
    <link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">المصروفات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة المصروفات </span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <x-alert type="success"/>
    <x-alert type="info"/>
    @if(session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session('error') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div class="row">
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <div class="card-header pb-0">
                            <h4>قائمة الارباح</h4>
                        </div>
                    </div>
                </div>
                <form action="{{\Illuminate\Support\Facades\URL::current() }} " method="get" class="d-flex justify-content-between mb-4">
                    <select name="year" class="form-control mx-1 m-2">
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
                <div class="card-body">
                    <div class="table-responsive" id="print">
                        <table id="example1" class="table key-buttons text-md-nowrap" >
                            <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">الشهر</th>
                                <th class="border-bottom-0">الارباح</th>
                                <th class="border-bottom-0">مصاريف تشغيل</th>
                                <th class="border-bottom-0">الارباح بعد الخصم</th>
                                <th class="border-bottom-0">العمليات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $months = [1 => 'يناير', 2 => 'فبراير',  3 => 'مارس',  4 => 'أبريل',  5 => 'مايو',  6 => 'يونيو',
                                        7 => 'يوليو', 8 => 'أغسطس', 9 => 'سبتمبر', 10 => 'أكتوبر', 11 => 'نوفمبر', 12 => 'ديسمبر',
                                            ];
                                $currentMonth = \Carbon\Carbon::now()->month;
                            @endphp
                            @php $i=1;
                                $total_expenditure=0;
                            @endphp
                            @forelse($profits as $profit)
                                <tr>
                                    @php
                                     $total_expenditure+= $months_total[$profit->month-1]->total;
                                    @endphp
                                    <td>{{$i++}}</td>
                                    <td>{{$months[$profit->month]}}</td>
                                    <td>{{$profit->money}}</td>
                                    <td>{{$months_total[$profit->month-1]->total}}</td>
                                    <td>{{$profit->money_after_discount}}</td>
                                    <td id="ignore">
                                        <div class="dropdown">
                                            <button aria-expanded="false" aria-haspopup="true"
                                                    class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                                                    type="button">العمليات<i class="fas fa-caret-down ml-1"></i></button>
                                            <div class="dropdown-menu tx-13">
                                                <a class="dropdown-item"
                                                   href="{{route('profits.edit',$profit->id)}}"><i class="fas fa-edit"></i>&nbsp;&nbsp;
                                                    تعديل </a>
                                                <a class="dropdown-item" href="#" data-invoice_id="{{ $profit->id }}"
                                                   data-toggle="modal" data-target="#delete_invoice">
                                                    <i class="text-danger fas fa-trash-alt"></i>&nbsp;&nbsp;حذف
                                                </a>
                                            </div>
                                        </div>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">لا يوجد ارباج</td>
                                </tr>
                            @endforelse
                            </tbody>
                            <tfoot class="table-dark">
                                <tr>
                                    <th class="border-bottom-0">اجمالى الارباح</th>
                                    <th class="border-bottom-0">{{$sum}}</th>
                                    <th class="border-bottom-0">اجمالى المصاريف</th>
                                    <th class="border-bottom-0">{{$total_expenditure}}</th>
                                    <th class="border-bottom-0">اجمالى صافى الارباح</th>
                                    <th class="border-bottom-0">{{$totalprofits}}</th>

                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-start">
            <button class="btn btn-danger mt-3 mr-2" id="print_Button" onclick="printDiv()">
                <i class="mdi mdi-printer ml-1"></i>طباعة
            </button>
        </div>


        {{-- edit section --}}



        <!-- delete -->
        <div class="modal fade" id="delete_invoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">حذف الفاتورة</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <form action="profits/destroy" method="post">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                    </div>
                    <div class="modal-body">
                        هل انت متاكد من عملية الحذف ؟
                        <input type="hidden" name="id" id="invoice_id" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                        <button type="submit" class="btn btn-danger">تاكيد</button>
                    </div>
                    </form>
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
    <script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
    <script src="{{URL::asset('assets/js/modal.js')}}"></script>
    <script>
        $('#delete_invoice').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var invoice_id = button.data('invoice_id')
            var modal = $(this)
            modal.find('.modal-body #invoice_id').val(invoice_id);
        })

    </script>
    <script type="text/javascript">
        function printDiv() {
            var printContents = document.getElementById('print').innerHTML;
            var originalContents = document.body.innerHTML;

            // Hide the 'ignore' td element when printing
            var style = "<style>#ignore { display: none; }</style>";

            var popupWin = window.open('', '_blank', 'width=1200,height=1200');
            popupWin.document.open();
            popupWin.document.write(`
            <html>
                <head>
                    <title>Print</title>
                    <style>
                        /* Add your CSS styles here */
                        body {
                            font-family: Arial, sans-serif;
                            direction: rtl; /* Right-to-left direction for Arabic */
                        }
                        table {
                            border-collapse: collapse;
                            width: 100%;
                        }
                        td {
                            padding: 10px;
                        }

                        ${style}
                    </style>
                </head>
                <body onload="window.print();window.close()">
                    ${printContents}
                    <!-- Debugging information -->
                    <div style="display: none;">
                        Original Contents: ${originalContents}
                    </div>
                </body>
            </html>
        `);
            popupWin.document.close();

            return true;
        }
    </script>


@endsection
