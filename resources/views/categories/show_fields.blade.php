
<!-- Libelle Field -->
<div class="col-sm-12">
    {!! Form::label('libelle', 'Nom de la catégorie:') !!}
    <p>{{ $categorie->libelle }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Date de création:') !!}
    <p>{{ $categorie->created_at }}</p>
</div>

<!-- Updated At Field -->
{{--<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $categorie->updated_at }}</p>
</div>--}}

