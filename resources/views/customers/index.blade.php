@extends('layouts.master')
@section('title', 'قائمة العملاء');
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
            <div class="col-xl-12">
                <div class="card mg-b-20">
{{--                    <div class="card-header pb-0">--}}
{{--                        <div class="card-header pb-0">--}}
{{--                            <a href="invoices/create" class="modal-effect btn btn-sm btn-primary" style="color:white"><i--}}
{{--                                    class="fas fa-plus"></i>&nbsp;--}}
{{--                                اضافة فاتورة</a>--}}
{{--                            <a href="" class="modal-effect btn btn-sm btn-success" style="color:white"><i--}}
{{--                                    class="fas fa-plus"></i>&nbsp; تصدير الفواتير</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    @php
                        $i=0;
                    @endphp
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example1" class="table key-buttons text-md-nowrap">
                                <thead>
                                <tr>
                                    <th class="border-bottom-0">الرقم</th>
                                    <th class="border-bottom-0">الاسم</th>
                                    <th class="border-bottom-0">المبلغ</th>
                                    <th class="border-bottom-0">النسبة</th>
                                    <th class="border-bottom-0 max-w-sm max-h-sm">الملاحظات</th>
                                    <th class="border-bottom-0">التفاصيل</th>
                                    <th class="border-bottom-0">العمليات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($customers as $customer)
                                    <tr>
                                        <td>{{++$i}}</td>
                                        <td>{{$customer->name}}</td>
                                        <td>{{$customer->money}}</td>
                                        <td>{{$customer->present}}%</td>
                                        <td>{{$customer->notes}}</td>
                                        <td><a
                                                href="{{route('customers.show',$customer->id)}}">عرض</a>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button aria-expanded="false" aria-haspopup="true"
                                                        class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                                                        type="button">العمليات<i class="fas fa-caret-down ml-1"></i></button>
                                                <div class="dropdown-menu tx-13">
                                                    <a class="dropdown-item"
                                                       href="{{route('customers.edit',$customer->id)}}"><i class="fas fa-edit"></i>&nbsp;&nbsp;
                                                        تعديل العميل</a>
                                                    <a class="dropdown-item" href="#" data-invoice_id="{{ $customer->id }}"
                                                       data-toggle="modal" data-target="#delete_invoice">
                                                        <i class="text-danger fas fa-trash-alt"></i>&nbsp;&nbsp;حذف
                                                        الفاتورة</a>
                                                </div>

                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">لا يوجد عملاء</td>
                                    </tr>
                                @endforelse
                                </tbody>
                                <tfoot class="table-dark">
                                    <th class="border-bottom-0"></th>
                                    <th class="border-bottom-0">اجمالى راس المال</th>
                                    <th class="border-bottom-0">{{$total_money}}</th>
                                    <th class="border-bottom-0"></th>
                                    <th class="border-bottom-0">اجمالى النسب</th>
                                    <th class="border-bottom-0">100%</th>
                                    <th class="border-bottom-0"></th>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!--/div-->

        <div class="modal fade" id="delete_invoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">حذف الفاتورة</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <form action="customers/destroy" method="post">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                    </div>
                    <div class="modal-body">
                        هل انت متاكد من عملية الحذف ؟
                        <input type="hidden" name="invoice_id" id="invoice_id" value="">
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
