@extends('layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Vendre un produit</h1>
            </div>
        </div>
    </div>
</section>

<div class="content px-3">
    @include('flash::message')
    <div class="clearfix"></div>
    <div class="card">
        <div class="card-body p-0">
    {{--        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
            <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
            <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
            <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>--}}
            <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
            <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}">
            <link rel="stylesheet" href="{{ asset('assets/css/toastr.min.css') }}">

            <script src="{{ asset('assets/js/select2.min.js') }}"></script>
            <script src="{{ asset('assets/js/toastr.min.js') }}"></script>
            <form id="product-form">
                @csrf
                <div class="p-3 d-flex align-items-center">
                    <div class="form-group w-50">
                        <label class="mb-2">Liste des produits</label>
                        <select id="product-select" name="produit_id"  class="form-control select2" style="height: calc(2.25rem + 2px)!important;" required>
                            <option value="">Sélectionnez un produit</option>
                            @foreach ($produits as $produit)
                            <option value="{{$produit->id}}" data-price="{{ $produit->prix_public }}" data-qte_final="{{$produit->qte_final}}" data-id="{{$produit->id}}">{{ $produit->libelle }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group ml-auto">
                        <label for="montant-client" class="mb-2">Montant du client :</label>
                        <input type="number" class="form-control" id="montant-client" name="montant-client" required>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table" id="product-list">
                        <thead>
                            <tr>
                                <th>Produit</th>
                                <th></th>
                                <th>Prix public (FR CFA)</th>
                                <th>Quantité restante</th>
                                <th>Quantité</th>
                                <th>Montant</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4" align="right"><strong>Total:</strong></td>
                                <td><span id="total-amount">0</span></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="d-flex justify-content-start m-3">
                    <button disabled class="btn btn-primary float-left" data-toggle="modal" type="button" id="recap-button">Valider</button>
                </div>

                <div class="modal" id="myModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Récapitulatif des produits achetés</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <p id="recap-content"></p>
                                <p id="total-price"></p>
                                <p id="rest-to-give"></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                <button type="submit" class="btn btn-primary">Confirmer</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.select2').select2();

        var productList = [];
        var productCount = 0;

        $('#product-select').on('change', function() {
            var selectedOption = $(this).find(':selected');
            var productId = selectedOption.data('id');
            var productPrice = selectedOption.data('price');
            var qteFinal = selectedOption.data('qte_final');
            var productName = selectedOption.text();

            var index = productList.findIndex(product => product.id === productId);
            if (index === -1) {
                productList.push({
                    id: productId,
                    price: productPrice,
                    qte_final: qteFinal,
                    qte: 1,
                    name: productName
                });
            } else {
                var qte = productList[index].qte;
                if (qte < qteFinal) {
                    productList[index].qte += 1;
                } else {
                    toastr.warning('Quantité maximale atteinte pour ce produit !');
                }
            }
            productCount++;

            renderProductList();
        });

        $(document).on('click', '.delete-product', function() {
            var productId = $(this).data('id');
            var index = productList.findIndex(product => product.id === productId);
            productList.splice(index, 1);
            renderProductList();
        });

        $(document).on('input', '.qte-input', function() {
            var qte = $(this).val();
            var productId = $(this).data('id');
            var index = productList.findIndex(product => product.id === productId);
            productList[index].qte = parseInt(qte);
            renderProductList();
        });

        $('#recap-button').on('click', function() {
            var totalAmount = productList.reduce(function(total, product) {
                return total + (product.price * product.qte);
            }, 0);
            var restToGive = parseInt($('#montant-client').val()) - totalAmount;
            if (restToGive < 0) {
                $('#recap-button').attr({
                    'data-target': null
                });
                toastr.error("La somme du client ne peut pas achéter les produits du panier");
                return;
            }
            $('#recap-button').attr({
                'data-target': "#myModal"
            });
            $('#recap-content').html(renderRecapContent());
        });

        $('#montant-client').on('input', function() {
            canEnableValidateButton();
        });

        $('#product-form').on('submit', function(e) {
            e.preventDefault();

            var montantClient = parseInt($('#montant-client').val());

            var totalAmount = productList.reduce(function(total, product) {
                return total + (product.price * product.qte);
            }, 0);

            var restToGive = montantClient - totalAmount;

            if (restToGive >= 0) {
                var formData = $(this).serialize();
                console.log(formData)
                $.ajax({
                    url: '/sell',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        // Code à exécuter en cas de succès
                        toastr.success('Vente effectuée avec succès !');
                        initInput()
                    },
                    error: function(xhr, status, error) {
                        toastr.error('Une erreur est survenue !');
                    }
                });
            } else {
                toastr.warning('Le montant donné est insuffisant !');
            }
        });

        //fonction pour initialiser les champs
        function initInput() {
            const inputMontClient = $('#montant-client');
            productList = []
            renderProductList()
            inputMontClient.val('')
            $('#myModal').modal('hide')
        }

        function canEnableValidateButton() {
            if (productList.length > 0 && parseInt($('#montant-client').val()) > 0) {
                $('#recap-button').attr({
                    disabled: false
                })
            } else {
                $('#recap-button').attr({
                    disabled: true
                })
            }
        }

        function renderProductList() {
            var tbody = $('#product-list tbody');
            tbody.empty();

            var totalAmount = 0;
            productCount = 0;

            productList.forEach(function(product) {
                var amount = product.price * product.qte;
                totalAmount += amount;

                var tr = $('<tr>');
                tr.append($('<td>').append($('<input>').attr({
                    type: 'text',
                    class: 'form-control prod',
                    value: product.name,
                    name: 'product[' + productCount + '][name]',
                    placeholder: 'Nom du produit',
                    id: 'myInput',
                    disabled: true
                })));
                tr.append($('<td>').append($('<input>').attr({
                    type: 'text',
                    class: 'form-control prod hidden',
                    value: product.name,
                    name: 'product[' + productCount + '][name]',
                    placeholder: 'Nom du produit',
                    id: 'myInput',
                    hidden: true
                })));
                tr.append($('<td>').append($('<input>').attr({
                    type: 'text',
                    name: 'product[' + productCount + '][price]',
                    class: 'form-control price',
                    value: product.price,
                    disabled: true
                })));
                tr.append($('<td>').append($('<input>').attr({
                    type: 'text',
                    name: 'product[' + productCount + '][qte_final]',
                    class: 'form-control price',
                    value: product.qte_final,
                    disabled: true
                })));
                tr.append($('<td>').append($('<input>').attr({
                    type: 'number',
                    name: 'product[' + productCount + '][quantity]',
                    class: 'form-control qte-input',
                    'data-id': product.id,
                    value: product.qte,
                    min: 1,
                    max: product.qte_final
                })));
                tr.append($('<td>').text(amount));
                var deleteButton = $('<button>').attr({
                    type: 'button',
                    class: 'btn btn-danger delete-product',
                    'data-id': product.id
                }).text('Supprimer');
                tr.append($('<td>').append(deleteButton));
                tbody.append(tr);
                productCount++;
            });

            $('#total-amount').text('Montant total: ' + totalAmount + ' FR CFA');
            canEnableValidateButton();
        }

        function renderRecapContent() {
            var content = $('<div>');
            var productListDiv = $('<div>').addClass('mb-3');
            var ul = $('<ul>').addClass('list-group');
            var li = $('<li>').addClass('list-group-item d-flex justify-content-between align-items-center active');
            li.append($('<span>').text('Libellé'));
            li.append($('<span>').text('Quantité'));
            li.append($('<span>').text('Montant'));
            ul.append(li);
            productList.forEach(function(product) {
                var amount = product.price * product.qte;
                var li = $('<li>').addClass('list-group-item d-flex justify-content-between align-items-center');
                li.append($('<span>').text(product.name));
                li.append($('<span>').addClass('badge badge-primary badge-pill').text(product.qte));
                li.append($('<span>').addClass('badge badge-success badge-pill').text(amount + ' FR CFA'));
                ul.append(li);
            });
            productListDiv.append(ul);
            content.append(productListDiv);

            var montantClient = parseInt($('#montant-client').val());
            var totalAmount = productList.reduce(function(total, product) {
                return total + (product.price * product.qte);
            }, 0);
            var restToGive = montantClient - totalAmount;

            var totalAmountDiv = $('<div>').addClass('mb-3');
            totalAmountDiv.append($('<h5>').text('Montant total:').addClass('d-inline'));
            totalAmountDiv.append($('<span>').text(totalAmount + ' FR CFA').addClass('float-right'));

            var restToGiveDiv = $('<div>').addClass('mb-3');
            restToGiveDiv.append($('<h5>').text('Reste à donner:').addClass('d-inline'));
            restToGiveDiv.append($('<span>').text(restToGive + ' FR CFA').addClass('float-right'));

            var givenAmountDiv = $('<div>').addClass('mb-3');
            givenAmountDiv.append($('<h5>').text('Montant donné par le client:').addClass('d-inline'));
            givenAmountDiv.append($('<span>').text(montantClient + ' FR CFA').addClass('float-right'));

            content.append(totalAmountDiv);
            content.append(restToGiveDiv);
            content.append(givenAmountDiv);

            return content;
        }
    });
</script>
    <style>
        .select2,.select2 *{
            height: calc(2.25rem + 2px)!important;
        }
    </style>
@endsection
