<!-- Produit Id Field -->
<div class="col-sm-12">
    {!! Form::label('produit_id', 'Produit Id:') !!}
    <p>{{ $acheter->produit_id }}</p>
</div>

<!-- User Id Field -->
<div class="col-sm-12">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $acheter->user_id }}</p>
</div>

<!-- Quantite Field -->
<div class="col-sm-12">
    {!! Form::label('quantite', 'Quantite:') !!}
    <p>{{ $acheter->quantite }}</p>
</div>

<!-- Date Achat Field -->
<div class="col-sm-12">
    {!! Form::label('date_achat', 'Date Achat:') !!}
    <p>{{ $acheter->date_achat }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $acheter->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $acheter->updated_at }}</p>
</div>

