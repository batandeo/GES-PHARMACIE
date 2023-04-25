@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
<style>
    .row {
        margin-top: 25px;
    }
</style>
<script src="{{ asset('assets/css/bootstrap.min.js') }}"></script>
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    @php
                        $total = 0;
                    @endphp
                    <div class="card-title">
                        <h6 class="card-subtitle text-muted">Montant total de produit par jour</h6>
                    </div>
                    <div class="card-body">
                        @foreach($acheterTodays as $acheterToday)
                            @php
                                $total += optional($acheterToday->produit)->prix_public * $acheterToday->quantite;
                            @endphp
                        @endforeach
                        <div class="d-flex justify-content-around align-items-center">
                            <div class="value-box">
                                <span class="mb-2">
                                    {{$total}}F
                                </span>
                            </div>
                            <div class="iq-iconbox-1 iq-bg-danger">
                                <span class="mb-2">
                                   <span class="mb-2">
                                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                                            <line x1="12" y1="19" x2="12" y2="5"></line>
                                            <polyline points="5 12 12 5 19 12"></polyline>
                                        </svg>
                                 </span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    @php
                        $total_week = 0;
                    @endphp
                    <div class="card-title">
                        <h6 class="card-subtitle text-muted">Montant total de produit par semaine</h6>
                    </div>
                    <div class="card-body">
                        @foreach($acheterWeeks as $acheterWeek)
                            @php
                                $total_week += optional($acheterWeek->produit)->prix_public * $acheterWeek->quantite;
                            @endphp
                        @endforeach
                        <div class="d-flex justify-content-around align-items-center">
                            <div class="value-box">
                                <span class="mb-2">
                                    {{$total_week}}F
                                </span>
                            </div>
                            <div class="iq-iconbox-2 iq-bg-danger">
                                <span class="mb-2">
                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                                        <line x1="12" y1="5" x2="12" y2="19"></line>
                                        <polyline points="19 12 12 19 5 12"></polyline>
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    @php
                        $total_month = 0;
                    @endphp
                    <div class="card-title">
                        <h6 class="card-subtitle text-muted">Montant total de produit par mois</h6>
                    </div>
                    <div class="card-body">
                        @foreach($acheterMonths as $acheterMonth)
                            @php
                                $total_month += optional($acheterMonth->produit)->prix_public * $acheterMonth->quantite;
                            @endphp
                        @endforeach
                        <div class="d-flex justify-content-around align-items-center">
                            <div class="value-box">
                                <span class="mb-2">
                                    {{$total_month}}F
                                </span>
                            </div>
                            <div class="iq-iconbox-3 iq-bg-danger">
                                <span class="mb-2">
                                  <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><line x1="12" y1="19" x2="12" y2="5"></line><polyline points="5 12 12 5 19 12"></polyline></svg>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card card-block card-stretch card-height overflow-hidden">
                    <div class="card-body">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item" style="color: #007bff; font-weight: 600">Les 5 derniers produits les plus vendus </li>
                            </ol>
                        </nav>
                        <div class="row">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#home">Par jour</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#menu1">Par semaine</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#menu2">Par mois</a>
                                </li>
                            </ul>
                            <!-- Tab panes -->

                            <div class="tab-content">
                                <div id="home" class="container tab-pane active"><br>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                            <tr class="table-active">
                                                <th scope="col" class="table-success">Produit</th>
                                                <th scope="col">Nombre de vente</th>
                                                <th scope="col">Quantité vendue</th>
                                                <th scope="col">PU</th>
                                                <th scope="col">Montant totale</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($bestSellers as $bestSeller)
                                                <tr>
                                                    <td class="p-4">{{ $produits->where('id', $bestSeller->produit_id)->first()->libelle }}</td>
                                                    <td class="p-4">{{ $bestSeller->total_sales }} </td>
                                                    <td class="p-4">{{ $produits->where('id', $bestSeller->produit_id)->first()->qte_init - $produits->where('id', $bestSeller->produit_id)->first()->qte_final}} </td>
                                                    <td class="p-4">{{ $produits->where('id', $bestSeller->produit_id)->first()->prix_public }}</td>
                                                    <td class="p-4">{{ $produits->where('id', $bestSeller->produit_id)->first()->prix_public *  ($produits->where('id', $bestSeller->produit_id)->first()->qte_init - $produits->where('id', $bestSeller->produit_id)->first()->qte_final)}}  </td>

                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div id="menu1" class="container tab-pane fade"><br>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                            <tr class="table-active table-active">
                                                <th scope="col">Produit</th>
                                                <th scope="col">Nombre de vente</th>
                                                {{--  <th scope="col">Quantité vendue</th>
                                                  <th scope="col">PU</th>
                                                  <th scope="col">Montant totale</th>--}}
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($bestSellersWeeks as $bestSellersWeek)
                                                <tr>
                                                    <td class="p-4">{{ $produits->where('id', $bestSellersWeek->produit_id)->first()->libelle }}</td>
                                                    <td class="p-4">x{{ $bestSellersWeek->total_sales }} </td>
                                                    {{-- <td class="p-4">{{ $produits->where('id', $bestSellersWeek->produit_id)->first()->qte_init - $produits->where('id', $bestSellersWeek->produit_id)->first()->qte_final}} </td>
                                                     <td class="p-4">{{ $produits->where('id', $bestSellersWeek->produit_id)->first()->prix_public }}</td>
                                                     <td class="p-4">{{ $produits->where('id', $bestSellersWeek->produit_id)->first()->prix_public *  ($produits->where('id', $bestSellersWeek->produit_id)->first()->qte_init - $produits->where('id', $bestSellersWeek->produit_id)->first()->qte_final)}}  </td>--}}

                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div id="menu2" class="container tab-pane fade"><br>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                            <tr class="table-active table-active ">
                                                <th scope="col" class="table-success">Produit</th>
                                                <th scope="col">Nombre de vente</th>
                                                {{--                                                <th scope="col">Quantité vendue</th>--}}
                                                {{--     <th scope="col">PU</th>
                                                     <th scope="col">Montant totale</th>--}}
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($bestSellersMonths as $bestSellersMonth)
                                                <tr>
                                                    <td class="p-4">{{ $produits->where('id', $bestSellersMonth->produit_id)->first()->libelle }}</td>
                                                    <td class="p-4">x{{ $bestSellersMonth->total_sales }} </td>
                                                    {{--                                                    <td class="p-4">{{ $produits->where('id', $bestSellersMonth->produit_id)->first()->qte_init - $produits->where('id', $bestSellersMonth->produit_id)->first()->qte_final}} </td>--}}
                                                    {{-- <td class="p-4">{{ $produits->where('id', $bestSellersMonth->produit_id)->first()->prix_public }}</td>
                                                     <td class="p-4">{{ $produits->where('id', $bestSellersMonth->produit_id)->first()->prix_public *  ($produits->where('id', $bestSellersMonth->produit_id)->first()->qte_init - $produits->where('id', $bestSellersMonth->produit_id)->first()->qte_final)}}  </td>--}}

                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card card-block card-stretch card-height overflow-hidden">

                    <div class="card-body">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item" style="color: #007bff; font-weight: 600">Les 5 derniers produits les moins vendus </li>
                            </ol>
                        </nav>
                        <div class="row">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#home-second">Par jour</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#menu-second">Par semaine</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#menu-last">Par mois</a>
                                </li>
                            </ul>
                            <!-- Tab panes -->

                            <div class="tab-content">
                                <div id="home-second" class="container tab-pane active"><br>
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                            <tr class="table-active">
                                                <th scope="col" class="table-success">Produit</th>
                                                <th scope="col">Nombre de vente</th>
                                                <th scope="col">Quantité vendue</th>
                                                <th scope="col">PU</th>
                                                <th scope="col">Montant totale</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($leastSoldDays as $leastSoldDay)
                                                <tr>
                                                    <td class="p-4">{{ $produits->where('id', $leastSoldDay->produit_id)->first()->libelle }}</td>
                                                    <td class="p-4">{{ $leastSoldDay->total_sales }} </td>
                                                    <td class="p-4">{{ $produits->where('id', $leastSoldDay->produit_id)->first()->qte_init - $produits->where('id', $leastSoldDay->produit_id)->first()->qte_final}} </td>
                                                    <td class="p-4">{{ $produits->where('id', $leastSoldDay->produit_id)->first()->prix_public }}</td>
                                                    <td class="p-4">{{ $produits->where('id', $leastSoldDay->produit_id)->first()->prix_public *  ($produits->where('id', $leastSoldDay->produit_id)->first()->qte_init - $produits->where('id', $leastSoldDay->produit_id)->first()->qte_final)}}  </td>

                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div id="menu-second" class="container tab-pane fade"><br>
                                    <div class="table-responsive">
                                        <table class="table table-hover ">
                                            <thead>
                                            <tr class="table-active table-info">
                                                <th scope="col" class="table-success">Produit</th>
                                                <th scope="col">Nombre de vente</th>
                                                {{--  <th scope="col">Quantité vendue</th>
                                                  <th scope="col">PU</th>
                                                  <th scope="col">Montant totale</th>--}}
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($leastSoldWeeks as $leastSoldWeek)
                                                <tr>
                                                    <td class="p-4">{{ $produits->where('id', $leastSoldWeek->produit_id)->first()->libelle }}</td>
                                                    <td class="p-4">x{{ $leastSoldWeek->total_sales }} </td>
                                                    {{-- <td class="p-4">{{ $produits->where('id', $bestSellersWeek->produit_id)->first()->qte_init - $produits->where('id', $bestSellersWeek->produit_id)->first()->qte_final}} </td>
                                                     <td class="p-4">{{ $produits->where('id', $bestSellersWeek->produit_id)->first()->prix_public }}</td>
                                                     <td class="p-4">{{ $produits->where('id', $bestSellersWeek->produit_id)->first()->prix_public *  ($produits->where('id', $bestSellersWeek->produit_id)->first()->qte_init - $produits->where('id', $bestSellersWeek->produit_id)->first()->qte_final)}}  </td>--}}

                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div id="menu-last" class="container tab-pane fade"><br>
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                            <tr class="table-active table-success ">
                                                <th scope="col" class="table-success">Produit</th>
                                                <th scope="col">Nombre de vente</th>
                                                {{--                                                <th scope="col">Quantité vendue</th>--}}
                                                {{--     <th scope="col">PU</th>
                                                     <th scope="col">Montant totale</th>--}}
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($leastSoldMonths as $leastSoldMonth)
                                                <tr>
                                                    <td class="p-4">{{ $produits->where('id', $leastSoldMonth->produit_id)->first()->libelle }}</td>
                                                    <td class="p-4">x{{ $leastSoldMonth->total_sales }} </td>
                                                    {{--                                                    <td class="p-4">{{ $produits->where('id', $bestSellersMonth->produit_id)->first()->qte_init - $produits->where('id', $bestSellersMonth->produit_id)->first()->qte_final}} </td>--}}
                                                    {{-- <td class="p-4">{{ $produits->where('id', $bestSellersMonth->produit_id)->first()->prix_public }}</td>
                                                     <td class="p-4">{{ $produits->where('id', $bestSellersMonth->produit_id)->first()->prix_public *  ($produits->where('id', $bestSellersMonth->produit_id)->first()->qte_init - $produits->where('id', $bestSellersMonth->produit_id)->first()->qte_final)}}  </td>--}}

                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
