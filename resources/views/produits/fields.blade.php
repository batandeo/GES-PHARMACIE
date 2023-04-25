

<!-- Libelle Field -->
<div class="form-group col-sm-6">
    {!! Form::label('libelle', 'Nom du produit:') !!}
    {!! Form::text('libelle', null, ['class' => 'form-control','required'=>'true']) !!}
</div>

<!-- Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('code', 'Code:') !!}
    {!! Form::text('code', null, ['class' => 'form-control','required'=>'true']) !!}
</div>


<!-- Qte Init Field -->
<div class="form-group col-sm-6">
    {!! Form::label('qte_init', 'Quantité Initiale:') !!}
    <input type="number" value="{{$produit->qte_init}}" name="qte_init" class="form-control" required>
</div>


<!-- Qte Minimal Field -->
{{--<div class="form-group col-sm-6">--}}
{{--    {!! Form::label('qte_minimal', 'Quantité Minimal:') !!}--}}
{{--    <input type="number" value="{{$produit->qte_minimal}}" name="qte_minimal" class="form-control" required>--}}
{{--</div>--}}

<!-- Qte Final Field -->
{{--<div class="form-group col-sm-6">
    {!! Form::label('qte_final', 'Quantité Final:') !!}
    {!! Form::text('qte_final', null, ['class' => 'form-control']) !!}
</div>--}}

<!-- Prix Session Field -->
<div class="form-group col-sm-6">
    {!! Form::label('prix_session', 'Prix Session:') !!}
    <input type="number" value="{{$produit->prix_session}}" name="prix_session" class="form-control" required>
</div>

<!-- Prix Public Field -->
<div class="form-group col-sm-6">
    {!! Form::label('prix_public', 'Prix Public:') !!}
    <input type="number" value="{{$produit->prix_public}}" name="prix_public" class="form-control" required>
</div>

<!-- Date Peremp Field -->
<div class="form-group col-sm-6">
    {!! Form::label('date_peremp', 'Date péremption:') !!}
    {!! Form::text('date_peremp', null, ['class' => 'form-control','id'=>'date_peremp','required'=>'true']) !!}
</div>

<!-- Categorie Id Field -->
<div class="form-group col-6">
    {!! Form::label('categorie_id', 'Categories:') !!}
    <select class="form-control" name="categorie_id">
        @foreach($categories as $cat)

            <option value="{{$cat->id}}" @if($produit->categorie_id == $cat->id) selected @endif>
                {{ $cat->libelle }}
            </option>
        @endforeach
    </select>
</div>

<!-- Categorie Id Field -->
<div class="form-group col-12">
    {!! Form::label('lot_id', 'Lots:') !!}
    <select class="form-control" name="lot_id">
        @foreach($lots as $lot)

            <option value="{{$lot->id}}" @if($produit->lot_id == $lot->id) selected @endif>
                {{ $lot->numero }}
            </option>
        @endforeach
    </select>
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#date_peremp').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Qte Sortie Field -->
{{--<div class="form-group col-sm-6">
    {!! Form::label('qte_sortie', 'Qte Sortie:') !!}
    {!! Form::number('qte_sortie', null, ['class' => 'form-control']) !!}
</div>--}}
