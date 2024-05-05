<div class="form-group">
    <div class="col m-3">
        <label for="inputName" class="control-label">اسم العميل</label>
        <x-form.input name="name" :value="$customer->name??''"
                      title="يرجي ادخال اسم العميل  " required ></x-form.input >
    </div>
    <div class="col m-3">
        <label>المبلغ</label>
        <x-form.input name="money" :value="$customer->money??''"
                     ></x-form.input >
    </div>
    <div class="form-group col m-3">
        <label >الملاحظات</label>
        <x-form.input name="notes" :value="$customer->notes??''"
                        ></x-form.input >
    </div>

</div>

<div class="d-flex justify-content-center m-1">
    <button type="submit" class="btn btn-primary">حفظ البيانات</button>
</div>
