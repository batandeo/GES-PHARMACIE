<!-- Numero Field -->
<div class="col-sm-12">
    {!! Form::label('numero', 'Numero:') !!}
    <p>{{ $lot->numero }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Date de création:') !!}
    <p>{{ $lot->created_at }}</p>
</div>

<!-- Updated At Field -->
{{--
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $lot->updated_at }}</p>
</div>
--}}

