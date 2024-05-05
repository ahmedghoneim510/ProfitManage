@extends('layouts.master')
@section('title', 'المصروفات');
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
    @if(session()->has('error'))
        <div class="alert alert-danger">
            <p>هذا الحقل موجود من قبل يرجى تعديلة </p>
        </div>
    @endif
    <!-- row -->
    <x-alert type="success"/>
    <div class="row">
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0 justify-content-between">
                    <h3 class=" btn btn-primary-gradient btn-block " style="text-align:center;text-align: center;display: flex;flex-direction: column;">اضافة جديدة</h3>
                </div>
                <div class="card-body">
                    <form method="post" action="{{route('expenditure-details.store')}}">
                        @csrf
                        <div class="form-group">

                            <label for="exampleFormControlSelect1"> نوع المصروف</label>
                            <select class="form-control" name="expenditure_id" id="exampleFormControlSelect1">
                            @foreach($expenditures as $expenditure)

                                    <option value="{{$expenditure->id}}" @selected($expenditure->id==$id)>{{$expenditure->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">الشهر</label>
                            @php
                                $months = [1 => 'يناير', 2 => 'فبراير',  3 => 'مارس',  4 => 'أبريل',  5 => 'مايو',  6 => 'يونيو',
                                        7 => 'يوليو', 8 => 'أغسطس', 9 => 'سبتمبر', 10 => 'أكتوبر', 11 => 'نوفمبر', 12 => 'ديسمبر',
                                            ];
                                $currentMonth = \Carbon\Carbon::now()->month;
                            @endphp
                            <select class="form-control" name="month" id="exampleFormControlSelect1">
                                    @foreach ($months as $monthNumber => $monthName)
                                        <option value="{{ $monthNumber }}" @selected($monthNumber==$currentMonth)>{{ $monthName   }}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect2">السنة</label>
                            @php
                                $years = range(2024, 2030); // Creates an array of years from 2024 to 2030
                                $currentYear = \Carbon\Carbon::now()->year; // Get current year
                            @endphp
                            <select class="form-control" name="year" id="exampleFormControlSelect2">
                                @foreach ($years as $year)
                                    <option value="{{ $year }}"  @selected($year == $currentYear)>{{ $year }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">المبلغ</label>
                            <input type="text" name="money" class="form-control" value="{{ old('money') }}" id="exampleInputEmail1"  placeholder="يرجى ادخال القيمة">

                        </div>
                        @php $currentDate = \Carbon\Carbon::now()->format('d-m-Y');
                        @endphp
                        <div class="form-group">
                            <label for="exampleInputEmail1">التاريخ</label>
                            <input type="text" name="date_of_expenditure" class="form-control" value="{{$currentDate}}" pattern="\d{1,2}-\d{1,2}-\d{4}" placeholder="dd-mm-yyyy" required>

                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" value=" حفظ" class="form-control btn btn-primary">
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
        $('#exampleModal2').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var section_name = button.data('section_name')
            var description = button.data('description')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #section_name').val(section_name);
            modal.find('.modal-body #description').val(description);
        })
    </script>
    <script>
        $('#modaldemo9').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var section_name = button.data('section_name')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #section_name').val(section_name);
        })
    </script>
@endsection
