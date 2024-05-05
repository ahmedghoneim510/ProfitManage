@extends('layouts.master')
@section('title', 'قائمة المصروفات');

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
							<h4 class="content-title mb-0 my-auto">المصروفات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة المصروفات</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
                <x-alert type="success" />
                @if (session()->has('Edit'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session()->get('Edit') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif


                @if (session()->has('delete'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session()->get('delete') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if (session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session()->get('Error') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card mg-b-20">
                            <div class="card-header pb-0">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="d-flex justify-content-between">
                                            <h4 class="card-title>
                                                <i class="mdi mdi-account-multiple"></i> قائمة المصروفات
                                            </h4>

                                        </div>

                                    </div>
                                </div>
                            </div>
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
                            <div class="card-body" id="print">
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
                                        @php $i=false; @endphp
                                        @forelse($monthlySums as $monthlySum)

                                            <tr>
                                                <td>{{$monthlySum[0]}}</td>

                                                <td>{{$monthlySum[1][1]}}</td>
                                                <td>{{$monthlySum[1][2]}}</td>
                                                <td>{{$monthlySum[1][3]}}</td>
                                                <td>{{$monthlySum[1][4]}}</td>
                                                <td>{{$monthlySum[1][5]}}</td>
                                                <td>{{$monthlySum[1][6]}}</td>
                                                <td>{{$monthlySum[1][7]}}</td>
                                                <td>{{$monthlySum[1][8]}}</td>
                                                <td>{{$monthlySum[1][9]}}</td>
                                                <td>{{$monthlySum[1][10]}}</td>
                                                <td>{{$monthlySum[1][11]}}</td>
                                                <td>{{$monthlySum[1][12]}}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="13" class="text-center">لا يوجد مصروفات</td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                        <tfoot class="table-dark">
                                        <tr>
                                            <td>المجموع</td>
                                            <td>{{$totalOfEachMonth[1]}}</td>
                                            <td>{{$totalOfEachMonth[2]}}</td>
                                            <td>{{$totalOfEachMonth[3]}}</td>
                                            <td>{{$totalOfEachMonth[4]}}</td>
                                            <td>{{$totalOfEachMonth[5]}}</td>
                                            <td>{{$totalOfEachMonth[6]}}</td>
                                            <td>{{$totalOfEachMonth[7]}}</td>
                                            <td>{{$totalOfEachMonth[8]}}</td>
                                            <td>{{$totalOfEachMonth[9]}}</td>
                                            <td>{{$totalOfEachMonth[10]}}</td>
                                            <td>{{$totalOfEachMonth[11]}}</td>
                                            <td>{{$totalOfEachMonth[12]}}</td>
                                        </tr>
                                        </tfoot>
                                    </table>

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


    <script>
        $('#edit_product').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var product_name = button.data('name')
            var section_name = button.data('section_name')
            var pro_id = button.data('pro_id')
            var description = button.data('description')
            var modal = $(this)
            modal.find('.modal-body #product_name').val(product_name);
            modal.find('.modal-body #section_name').val(section_name);
            modal.find('.modal-body #description').val(description);
            modal.find('.modal-body #pro_id').val(pro_id);
        })


        $('#modaldemo9').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var pro_id = button.data('pro_id')
            var product_name = button.data('product_name')
            var modal = $(this)

            modal.find('.modal-body #pro_id').val(pro_id);
            modal.find('.modal-body #product_name').val(product_name);
        })

    </script>

@endsection
