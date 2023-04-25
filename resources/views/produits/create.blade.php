@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Create Produit</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::open(['route' => 'produits.store']) !!}

            <div class="card-body">

                <div class="row">
{{--                    @include('produits.fields')--}}


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
                    <input type="number" name="qte_init" class="form-control" required>
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
                    <input type="number" name="prix_session" class="form-control" required>
                </div>

                <!-- Prix Public Field -->
                <div class="form-group col-sm-6">
                    {!! Form::label('prix_public', 'Prix Public:') !!}
                    <input type="number" name="prix_public" class="form-control" required>
                </div>

                <!-- Date Peremp Field -->
                <div class="form-group col-sm-6">
                    {!! Form::label('date_peremp', 'Date péremption:') !!}
                    {!! Form::text('date_peremp', null, ['class' => 'form-control','id'=>'date_peremp','required'=>'true']) !!}
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

            <!-- lot Id Field -->
                        <div class="form-group col-sm-6">
                            {!! Form::label('lot_id', 'Choisir lot:') !!}
                            {!! Form::select('lot_id', $lots, null, ['class' => 'form-control','placeholder' => 'Sélectionnez un lot','required'=>'true']) !!}
                        </div>
                        <!-- categorie Id Field -->
                        <div class="form-group col-sm-6">
                            {!! Form::label('categorie_id', 'Choisir catégorie:') !!}
                            {!! Form::select('categorie_id', $categories, null, ['class' => 'form-control','placeholder' => 'Sélectionnez une catégorie','required'=>'true']) !!}
                        </div>
                </div>

            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('produits.index') }}" class="btn btn-default">Cancel</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
