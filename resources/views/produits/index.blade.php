@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Produits</h1>
                </div>
            {{--    <div class="col-sm-6">
                    <input type="text" class="form-control col-sm-6" id="searchInput" placeholder="Rechercher...">
                </div>--}}
                <div class="col-sm-6">
                    <a class="btn btn-primary float-right"
                       href="{{ route('produits.create') }}">
                        Ajouter
                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="8" x2="12" y2="16">
                            </line><line x1="8" y1="12" x2="16" y2="12"></line>
                        </svg>
                    </a>
                </div>
{{--                <a href="/download-pdf" class="btn btn-primary">Télécharger en PDF</a>--}}
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body p-0">
                @include('produits.table')

                <div class="card-footer clearfix">
                    <div class="float-right">

                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

