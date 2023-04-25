{{--
<link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
<link href="https://cdn.datatables.net/buttons/1.2.1/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css">
--}}
<link rel="stylesheet" href="{{ asset('assets/css/views/jquery.dataTables.min.css') }}"/>
<link rel="stylesheet" href="{{ asset('assets/css/views/buttons.dataTables.min.css') }}"/>

<div class="table-responsive p-4"  >
    <table class="table" id="table">
        <thead>
        <tr>
            <th class="p-4">Id</th>
            <th class="p-4">Libelle</th>
{{--            <th class="p-4">Code</th>--}}
            <th class="p-4">Quantité Initiale</th>
            <th class="p-4">Prix Session</th>
            <th class="p-4">Prix Public</th>
            <th class="p-4">Quantité Sortie</th>
            <th class="p-4">Date Peremption</th>
{{--            <th class="p-4">Lot</th>--}}
{{--            <th class="p-4">Categorie</th>--}}
            <th class="p-4">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($produits as $produit)
            <tr>
                <td class="p-4">{{ $produit->id }}</td>
                <td class="p-4">{{ $produit->libelle }}</td>
{{--                <td class="p-4">{{ $produit->code }}</td>--}}
                <td class="p-4">{{ $produit->qte_init }}</td>
                <td class="p-4">{{ $produit->prix_session }}</td>
                <td class="p-4">{{ $produit->prix_public }}</td>
                <td class="p-4">{{ $produit->qte_final }}</td>
                <td class="p-4">{{ $produit->date_peremp }}</td>
{{--                <td>{{ optional($produit->lot)->numero }}</td>--}}
{{--                <td class="p-4">{{ optional($produit->categorie)->libelle }}</td>--}}
                <td class="p-4" width="120">
                    {!! Form::open(['route' => ['produits.destroy', $produit->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('produits.show', [$produit->id]) }}"
                           class='btn btn-primary px-2 btn-xs'>
{{--                            <i class="far fa-eye"></i>--}}
                            <svg viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                        </a>
                        <a href="{{ route('produits.edit', [$produit->id]) }}"
                           class='btn btn-success mx-2 px-2 btn-xs'>
{{--                            <i class="far fa-edit"></i>--}}
                            <svg viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                        </a>
                        {!! Form::button('<svg viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>', ['type' => 'submit', 'class' => 'btn btn-danger px-2 btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<script src="https://code.jquery.com/jquery-1.12.3.js"></script>
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> -->

{{--<script src="https://code.jquery.com/jquery-1.12.3.js"></script>--}}
<script src="{{ asset('assets/css/views/js/jquery-1.12.3.js') }}"></script>
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> -->

{{--<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"></script>--}}
<script src="{{ asset('assets/css/views/js/jquery.dataTables.min.js') }}"></script>
{{--<script src="https://cdn.datatables.net/buttons/1.2.1/js/dataTables.buttons.min.js"></script>--}}
<script src="{{ asset('assets/css/views/js/dataTables.buttons.min.js') }}"></script>
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>--}}
<script src="{{ asset('assets/css/views/js/jszip.min.js') }}"></script>
{{--<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>--}}
<script src="{{ asset('assets/css/views/js/pdfmake.min.js') }}"></script>
{{--<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>--}}
<script src="{{ asset('assets/css/views/js/vfs_fonts.js') }}"></script>
{{--<script src="https://cdn.datatables.net/buttons/1.2.1/js/buttons.html5.min.js"></script>--}}
<script src="{{ asset('assets/css/views/js/buttons.html5.min.js') }}"></script>
<!-- <script src="https://code.jquery.com/jquery-1.12.3.js"></script> -->

<!-- <script src="https://code.jquery.com/jquery-1.12.3.js"></script> -->


<script>
    $(document).ready(function() {
        $.noConflict();
        $('#table').DataTable( {
            dom: 'Bfrtip',

            buttons: [
                {
                    extend: 'copy',
                    text: 'Copy',

                },
                {
                    extend: 'excel',
                    text: 'Excel',

                },
                {
                    extend: 'pdf',
                    text: 'Pdf',
                    orientation: 'landscape',
                    pageSize: 'LEGAL'

                },

            ],
            select: true
        } );
    } );


</script>

<style>
    img.btn-action {
        width: 25px;
    }
    .br {
        border-radius: 6px !important;
    }

    .form-group label {
        color: #8D8D8D;
    }


    .entrep {
        display: none
    }

    /* =======Circular chex box=================== */
    .round {
        position: relative;
    }

    .round label {
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 50%;
        cursor: pointer;
        height: 28px;
        left: 0;
        position: absolute;
        top: 0;
        width: 28px;
    }

    .round label:after {
        border: 2px solid #fff;
        border-top: none;
        border-right: none;
        content: "";
        height: 6px;
        left: 7px;
        opacity: 0;
        position: absolute;
        top: 8px;
        transform: rotate(-45deg);
        width: 12px;
    }

    .round input[type="checkbox"] {
        visibility: hidden;
    }

    .round input[type="checkbox"]:checked+label {
        background-color: #66bb6a;
        border-color: #66bb6a;
    }

    .round input[type="checkbox"]:checked+label:after {
        opacity: 1;
    }

    /* =========================================== */
    #btnSave {
        display: none
    }

    .terrain {
        display: none;
    }

    .blockTitle {
        font-size: 1.5rem;
    }

    td {
        max-width: 40rem !important;
        white-space: wrap !important;
        align-items: center;
    }

    tr {
        white-space: normal !important;
    }

    .modal {
        border: none !important
    }
    .buttons-excel{
        background-color: #346B37!important;
        border-color: #346B37!important;
        border-radius: 5px!important;
        color:#fff!important;
        background-image:none!important
    }
    .buttons-copy{
        background-color: #3C68E2!important;
        border-color: #3C68E2!important;
        border-radius: 5px!important;
        color:#fff!important;
        background-image:none!important
    }
    .buttons-pdf{
        background-color: #E23C3C!important;
        border-color: #E23C3C!important;
        border-radius: 5px!important;
        color:#fff!important;
        background-image:none!important
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background-color: #E28C3C!important;
        border-color: #E28C3C!important;
        border-radius: 5px!important;
        color:#fff!important;
        background-image:none!important
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled{
        background-color: #8A8989!important;
        border-color: #8A8989!important;
        border-radius: 5px!important;
        color:#fff!important;
        background-image:none!important
    }
    .dataTables_info,.dataTables_paginate {
        margin-top: 1rem;
    }
    table.dataTable.no-footer {
        border-bottom: 1px solid #D4D4D4!important;
        border-top: 1px solid #D4D4D4!important;

    }
    thead tr th{
        border-bottom: 1px solid #D4D4D4!important;
    }
</style>
