<div>
    <form>
    <div class="form-group">
        <label for="exampleFormControlSelect1">نوع المصروف</label>

        <select class="form-control" wire:model.live="expenditureId" id="expenditureId" wire:change="change">
            <option value="">اختار</option>
            @foreach($expenditures as $expenditure)
                <option value="{{$expenditure->id}}">{{$expenditure->name}}</option>
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
        <select class="form-control"  wire:model.live="month" id="month" wire:change="change">
            <option value="">اختار</option>
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
        <select class="form-control" wire:model="year" wire:change="change" id="year">
            <option value="">اختار</option>
            @foreach ($years as $year)
                <option value="{{ $year }}"  @selected($year == $currentYear)>{{ $year }}</option>
            @endforeach
        </select>
    </div>



        <div class="form-group">
            <label for="exampleInputEmail1">المبلغ</label>
            <input type="text" name="money" id="money" class="form-control" wire:model.live="money"   placeholder="يرجى ادخال القيمة">
        </div>

        <button wire:click.prevent="save" type="submit"
                class="form-control btn btn-primary">حفظ</button>
    </form>

</div>
