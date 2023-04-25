<!-- Libelle Field -->
<div class="col-sm-6">
    {!! Form::label('libelle', 'Nom du produit:') !!}
    <p>{{ $produit->libelle }}</p>
</div>

<!-- Code Field -->
<div class="col-sm-6">
    {!! Form::label('code', 'Code:') !!}
    <p>{{ $produit->code }}</p>
</div>

<!-- Qte Minimal Field -->
<div class="col-sm-6">
    {!! Form::label('qte_minimal', 'Quantité Minimal:') !!}
    <p>{{ $produit->qte_minimal }}</p>
</div>

<!-- Qte Init Field -->
<div class="col-sm-6">
    {!! Form::label('qte_init', 'Quantité Initiale:') !!}
    <p>{{ $produit->qte_init }}</p>
</div>

<!-- Qte Final Field -->
<div class="col-sm-6">
    {!! Form::label('qte_final', 'Quantité Restante:') !!}
    <p>{{ $produit->qte_final }}</p>
</div>

<!-- Prix Session Field -->
<div class="col-sm-6">
    {!! Form::label('prix_session', 'Prix Session:') !!}
    <p>{{ $produit->prix_session }}</p>
</div>

<!-- Prix Public Field -->
<div class="col-sm-6">
    {!! Form::label('prix_public', 'Prix Public:') !!}
    <p>{{ $produit->prix_public }}</p>
</div>

<!-- Qte Sortie Field -->
<div class="col-sm-6">
    {!! Form::label('qte_sortie', 'Quantité Vendue:') !!}
    <p>{{ $produit->qte_sortie }}</p>
</div>

<!-- Date Peremp Field -->
<div class="col-sm-6">
    {!! Form::label('date_peremp', 'Date Péremption:') !!}
    <p>{{ $produit->date_peremp }}</p>
</div>


<!-- Lot Id Field -->
<div class="col-sm-6">
    {!! Form::label('lot_id', 'Lot:') !!}
    <p>{{ optional($produit->lot)->numero }}</p>
</div>

<!-- Categorie Id Field -->
<div class="col-sm-6">
    {!! Form::label('categorie_id', 'Categorie:') !!}
    <p>{{ optional($produit->categorie)->libelle }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-6">
    {!! Form::label('created_at', 'Date enregistrée:') !!}
    <p>{{ $produit->created_at }}</p>
</div>

<!-- Updated At Field -->
{{--<div class="col-sm-6">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $produit->updated_at }}</p>
</div>--}}

