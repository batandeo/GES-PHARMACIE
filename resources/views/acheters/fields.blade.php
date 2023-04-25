<!-- Date Achat Field -->
<div class="form-group col-sm-6">
    {!! Form::label('date_achat', 'Date Achat:') !!}
    {!! Form::text('date_achat', null, ['class' => 'form-control','id'=>'date_achat']) !!}
</div>


@push('page_scripts')
    <script type="text/javascript">
        $('#date_achat').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush
