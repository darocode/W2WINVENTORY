@extends('layouts.general')

@section('content')
    <div class="card">
        <div class="card-body">
            <!-- Button trigger modal -->
            <h5 class="card-title">Clientes<button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="ri-add-line"></i></button></h5>
            <input type="search" class="form-control" id="search" class="search" name="search" placeholder="Buscar Cliente">  
            <div id="success_message"></div>
            <!-- Modal Client Create -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Crear cliente</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('create.client') }}" method="POST" enctype="multipart/form-data" id="form">
                            <div class="modal-body">
                            @csrf
                            <ul id="saveform_errList"></ul>
                                <div class="col-12">
                                    <label for="nameClient" class="form-label">Nombre del cliente</label>
                                    <input type="text" class="form-control nameClient" id="nameClient" name="nameClient">
                                    <span class="text-danger error-text nameClient_error"></span>
                                </div>
                                <div class="col-12">
                                    <label for="phoneClient" class="form-label">Telefono del cliente</label>
                                    <input type="text" class="form-control phoneClient" id="phoneClient" name="phoneClient">
                                    <span class="text-danger error-text phoneClient_error"></span>
                                </div>
                                <div class="col-12">
                                    <label for="mailClient" class="form-label">Correo electronico</label>
                                    <input type="email" class="form-control mailClient" id="mailClient" name="mailClient">
                                    <span class="text-danger error-text mailClient_error"></span>
                                </div>
                                <div class="col-12">
                                    <label for="type_client_id" class="form-label">Tipo cliente</label>
                                    <select name="type_client_id" id="type_client_id" class="form-select type_client_id">
                                        <option value="">Seleccione una opcion..</option>
                                        @foreach($typeClient as $typeC)
                                        <option value="{{$typeC->id}}">{{$typeC->typeClient}}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger error-text type_client_id_error"></span>
                                </div>
                                <div class="col-12">
                                    <label for="imageClient" class="form-label">Foto Imagen</label>
                                    <input type="file" class="form-control imageClient" id="imageClient" name="imageClient">
                                    <span class="text-danger error-text imageClient_error"></span>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn" style="background-color: #5daadd; color: white;">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!-- End Modal Client Create -->

            <!-- Modal Client Edit -->
            <div class="modal fade" id="EditClientModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Editar cliente</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="POST" enctype="multipart/form-data" id="formEdit">
                            <div class="modal-body">
                            @csrf
                            <ul id="updateform_errList"></ul>
                            <input type="hidden" id="edit_client_id">
                                <div class="col-12">
                                    <label for="nameClient" class="form-label">Nombre del cliente</label>
                                    <input type="text" class="form-control nameClient" id="edit_nameClient" name="nameClient">
                                </div>
                                <div class="col-12">
                                    <label for="phoneClient" class="form-label">Telefono del cliente</label>
                                    <input type="text" class="form-control phoneClient" id="edit_phoneClient" name="phoneClient">
                                </div>
                                <div class="col-12">
                                    <label for="mailClient" class="form-label">Correo electronico</label>
                                    <input type="email" class="form-control mailClient" id="edit_mailClient" name="mailClient">
                                </div>
                                <div class="col-12">
                                    <label for="type_client_id" class="form-label">Tipo cliente</label>
                                    <select name="type_client_id" id="edit_type_client_id" class="form-select type_client_id">
                                        <option value="">Seleccione una opcion..</option>
                                        @foreach($typeClient as $typeC)
                                        <option value="{{$typeC->id}}">{{$typeC->typeClient}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!--<div class="col-12">
                                    <label for="imageClient" class="form-label">Foto Imagen</label>
                                    <img src="../storage/img/" class="img-fluid rounded-start" id="edit_imageClient" alt="Imagen Cliente" style="max-width: 7em; min-width: 7em; margin: 0 auto; margin-top: 3px;">
                                    <input type="file" class="form-control imageClient" name="imageClient">
                                    <span class="text-danger error-text imageClient_error"></span>
                                </div>-->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn editar" style="background-color: #5daadd; color: white;">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!-- End Modal Client Edit --> 

            <!-- Modal Client Delete-->
            <div class="modal fade" id="DeleteClientModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Eliminar cliente</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="delete_client_id">
                            <h3>¿Esta seguro que desea eliminar este registro?</h3>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-danger eliminar">Si, eliminar</button>
                        </div>
                    </div>
                </div>
            </div><!-- End Modal Client Delete--> 

            <!-- Modal Client View -->
            <div class="modal fade" id="ViewClientModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Información del cliente</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="formulario" method="POST">
                            <div class="modal-body">
                                <input type="hidden" id="views_client_id">
                                @csrf
                                <div class="col-12">
                                    <label for="nameClient" class="form-label">Nombre del cliente</label>
                                    <input type="text" class="form-control views_nameClient" id="views_nameClient" name="nameClient" disabled>
                                </div>
                                <div class="col-12">
                                    <label for="phoneClient" class="form-label">Telefono del cliente</label>
                                    <input type="text" class="form-control views_phoneClient" id="views_phoneClient" name="phoneClient" disabled>
                                </div>
                                <div class="col-12">
                                    <label for="mailClient" class="form-label">Correo electronico</label>
                                    <input type="email" class="form-control views_mailClient" id="views_mailClient" name="mailClient" disabled>
                                </div>
                                <div class="col-12">
                                    <label for="type_client_id" class="form-label">Tipo cliente</label>
                                    <input type="text" class="form-control views_typeClient" id="views_typeClient" name="type_client_id" disabled>
                                </div>
                                <!--<<div class="col-12">
                                    <label for="imageClient" class="form-label">Foto Imagen</label>
                                    @if('+item.imageClient === null+')
                                        <div class="col-md-4">
                                            <img src="img/card.jpg" class="img-fluid rounded-start imageClient" alt="Imagen Cliente">
                                        </div>
                                    @else
                                        <div class="col-md-4">
                                            <img src="" class="img-fluid rounded-start imageClient" alt="Imagen Cliente" id="views_imageClient">
                                        </div>
                                    @endif
                                </div>
                                div class="col-12">
                                    <label for="user_id" class="form-label">usuario</label>
                                    <input type="text" class="form-control" id="inputNanme4" name="user_id">
                                </div>
                                <div class="col-12">
                                    <label for="sector_master_id" class="form-label">Sector</label>
                                    <input type="text" class="form-control" id="inputNanme4" name="sector_master_id">
                                </div>-->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!-- End Modal Client View --> 

            <!-- Table with hoverable rows -->
            <div class="row clientCard" id="dynamic-row"></div>
            <!-- End Table with hoverable rows -->
        </div>
    </div>
@endsection


@section('scripts')

<!-- Script Ajax -->
    <script>
        $(document).ready(function(){

            fetchclient();
            /* funcion para mostrar en una tabla los datos de la tabla */
            function fetchclient()
            {
                $.ajax({
                    type: "GET",
                    url: "/fetch-client",
                    dataType: "json",
                    success:function(response){
                        console.log(response.client);
                        $('.clientCard').html("");
                        $.each(response.client, function(key, item) {
                            $('.clientCard').append('<div class="card" style="width: 14rem; max-height: 22em;">\
                            <a href="/infoClient/'+item.id+'/edit"><div class="row g-0">\
                                    <img src="../storage/img/'+item.imageClient+'" class="img-fluid rounded-start" alt="Imagen Cliente" style="width: 7em; margin: 0 auto; margin-top: 3px;">\
                                <div class="card-body">\
                                    <h5 class="card-title">'+item.nameClient+'</h5>\
                                    <table>\
                                        <td><button type="button" value="'+item.id+'" class="btn  viewInfoClient" style="margin-top: 5px; background-color: #5daadd;"><i class="bi bi-info-circle"></i></button>\
                                        <button type="button" value="'+item.id+'" class="btn editClient" style="margin-top: 5px; background-color: #848688; color: white;"><i class="ri-edit-line"></i></button>\
                                        <button type="button" value="'+item.id+'" class="btn btn-danger deleteClient" style="margin-top: 5px;"><i class="ri-delete-bin-7-line"></i></button></td>\
                                    </table>\
                                </div>\
                            </div></a>\
                            ')
                        });
                    }
                });
            }
            /* evento para crear un registro */
            $('#form').on('submit', function(e) {
                e.preventDefault();

                //alert('submit form');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var form = this;
                $.ajax({
                    url:$(form).attr('action'),
                    method:$(form).attr('method'),
                    data: new FormData(form),
                    processData: false,
                    dataType:'json',
                    contentType: false,
                    success:function(response){
                        if(response.status == 400){
                            $('#saveform_errList').html("");
                            $('#saveform_errList').addClass('alert alert-danger');
                            $.each(response.errors, function(key, err_values) {
                                $('#saveform_errList').append('<li>'+err_values+'</li>')
                            });
                        }
                        else{
                            $('#success_message').html("");
                            $('#success_message').addClass('alert alert-success');
                            $('#success_message').text(response.message);
                            $('#staticBackdrop').modal('hide');
                            $('#staticBackdrop').find('input').val("");

                            fetchclient();
                        }
                    }
                });
            });

            /* evento para crear un registro 
            $(document).on('click','.guardar', function(e){
                e.preventDefault();
                //console.log(data);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "/client",
                    data: {
                        'nameClient': $('.nameClient').val(),
                        'phoneClient': $('.phoneClient').val(), 
                        'mailClient': $('.mailClient').val(), 
                        'type_client_id': $('.type_client_id').val(), 
                        'imageClient': $('#imageClient').val(),
                    },
                    enctype: 'multipart/form-data',
                    dataType: "json",
                    success:function(response){
                        console.log(response);
                        if(response.status == 400)
                        {
                            $('#saveform_errList').html("");
                            $('#saveform_errList').addClass('alert alert-danger');
                            $.each(response.errors, function(key, err_values) {
                                $('#saveform_errList').append('<li>'+err_values+'</li>')
                            });
                        }
                        else
                        {
                            $('#success_message').html("");
                            $('#success_message').addClass('alert alert-success');
                            $('#success_message').text(response.message);
                            $('#staticBackdrop').modal('hide');
                            $('#staticBackdrop').find('input').val("");

                            fetchclient();
                        }
                    }
                });
            });*/

            /* abrir modal de ver informacion del cliente */
            $(document).on('click','.viewInfoClient', function(e){
                e.preventDefault();
                var client_id = $(this).val();
                console.log(client_id);
                $('#ViewClientModal').modal('show')

                $.ajax({
                    type: "GET",
                    url: "/view-client/"+client_id,
                    success:function(response){
                        //console.log(response.clients);
                        if (response.status == 404) 
                        {
                            $('success_message').html("");
                            $('success_message').addClass('alert alert-danger');
                            $('success_message').text(response.message);
                        }
                        else
                        {
                            $.each(response.clients, function(key, item) {
                                $('#views_mailClient').val(item.mailClient);
                                $('#views_nameClient').val(item.nameClient);
                                $('#views_phoneClient').val(item.phoneClient);
                                $('#views_typeClient').val(item.typeClient);
                                $('#views_client_id').val(client_id);
                            });
                        }
                    }
                });
            });

            /* abrir modal de ver informacion del cliente */
            $(document).on('click','.editClient', function(e){
                e.preventDefault();
                var client_id = $(this).val();
                console.log(client_id);
                $('#EditClientModal').modal('show')

                $.ajax({
                    type: "GET",
                    url: "/edit-client/"+client_id,
                    success:function(response){
                        //console.log(response.clients);
                        if (response.status == 404) 
                        {
                            $('success_message').html("");
                            $('success_message').addClass('alert alert-danger');
                            $('success_message').text(response.message);
                        }
                        else
                        {
                            $.each(response.clients, function(key, item) {
                                $('#edit_mailClient').val(item.mailClient);
                                $('#edit_nameClient').val(item.nameClient);
                                $('#edit_phoneClient').val(item.phoneClient);
                                $('#edit_typeClient').val(item.typeClient);
                                $('#edit_imageClient').val(item.imageClient);
                                $('#edit_client_id').val(client_id);
                            });
                        }
                    }
                });
            });

            /* evento para editar*/
            $(document).on('click','.editar', function(e){
                e.preventDefault();

                $(this).text("Actualizando");

                var client_id = $('#edit_client_id').val();
                var data = {
                    'nameClient':$('#edit_nameClient').val(),
                    'phoneClient':$('#edit_phoneClient').val(),
                    'mailClient':$('#edit_mailClient').val(),
                    'type_client_id':$('#edit_type_client_id').val(),
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "PUT",
                    url: "update-client/"+client_id,
                    data: data,
                    dataType: "json",
                    success:function(response){
                        //console.log(response);
                        if (response.status == 400) 
                        {
                            //errors
                            $('#updateform_errList').html("");
                            $('#updateform_errList').addClass('alert alert-danger');
                            $.each(response.errors, function(key, err_values) {
                                $('#updateform_errList').append('<li>'+err_values+'</li>')
                            });
                            $(".editar").text("Actualizar");
                        } 
                        else if (response.status == 404) 
                        {
                            $('#updateform_errList').html("");
                            $('#success_message').addClass('alert alert-success');
                            $('#success_message').text(response.message);
                            $(".editar").text("Actualizar");
                        } 
                        else
                        {
                            $('#updateform_errList').html("");
                            $('#success_message').html("");
                            $('#success_message').addClass('alert alert-success');
                            $('#success_message').text(response.message);
                            $('#EditClientModal').modal('hide');
                            $(".editar").text("Actualizar");

                            fetchclient();
                        }
                    }
                });
            });

            /* evento para editar un registro 
            $('#formEdit').on('submit', function(e) {
                e.preventDefault();

                $(this).text("Actualizando");
                var client_id = $('#edit_client_id').val();
                //alert('submit form');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var formEdit = this;
                $.ajax({
                    type: "PUT",
                    url: "update-client/"+client_id,
                    data: new FormData(formEdit),
                    processData: false,
                    dataType:'json',
                    contentType: false,
                    beforeSend:function(){
                        $(formEdit).find('span.error-text').text('');
                    },
                    success:function(response){
                        console.log(response);
                        if(response.status == 400){
                            $.each(response.error, function(prefix,val){
                                $(formEdit).find('span.'+prefix+'_error').text(val[0]);
                                $(".editar").text("Actualizar");
                            });
                        }
                        else{
                            $('#updateform_errList').html("");
                            $('#success_message').html("");
                            $('#success_message').addClass('alert alert-success');
                            $('#success_message').text(response.message);
                            $('#EditClientModal').modal('hide');
                            $(".editar").text("Actualizar");

                            fetchclient();
                        }
                    }
                });
            });*/

            /* abrir modal de eliminar */
            $(document).on('click','.deleteClient', function(e){
                e.preventDefault();
                var client_id = $(this).val();
                //alert(uniMeasurement_id);
                $('#delete_client_id').val(client_id);
                $('#DeleteClientModal').modal('show');
                
            });

            /* evento para eliminar */
            $(document).on('click','.eliminar', function(e){
                e.preventDefault();
                $(this).text("Eliminando");
                var client_id = $('#delete_client_id').val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "DELETE",
                    url: "/delete-client/"+client_id,
                    success:function(response){
                        console.log(response);
                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text(response.message);
                        $('#DeleteClientModal').modal('hide');
                        $(".eliminar").text("Si, Eliminar");

                        fetchclient();
                    }
                });
            });
        });
        //Live Search
        $('body').on('keyup', '#search',function(){
            let searchQuest = $(this).val();

            $.ajax({
                method: 'POST',
                url: '{{ route("clientSearch.action") }}',
                dataType: 'json',
                data : {
                    '_token' : '{{ csrf_token() }}',
                    searchQuest: searchQuest
                },
                success:function(res){
                    let tableRow = '';
                    $('#dynamic-row').html('');
                    $.each(res, function(index, value){
                        tableRow= '<div class="card" style="width: 14rem; max-height: 22em;">\
                            <a href="/infoClient/'+value.id+'/edit"><div class="row g-0">\
                                    <img src="../storage/img/'+value.imageClient+'" class="img-fluid rounded-start" alt="Imagen Cliente" style="width: 7em; margin: 0 auto; margin-top: 3px;">\
                                <div class="card-body">\
                                    <h5 class="card-title">'+value.nameClient+'</h5>\
                                    <table>\
                                        <td><button type="button" value="'+value.id+'" class="btn  viewInfoClient" style="margin-top: 5px; background-color: #5daadd;"><i class="bi bi-info-circle"></i></button>\
                                        <button type="button" value="'+value.id+'" class="btn editClient" style="margin-top: 5px; background-color: #848688; color: white;"><i class="ri-edit-line"></i></button>\
                                        <button type="button" value="'+value.id+'" class="btn btn-danger deleteClient" style="margin-top: 5px;"><i class="ri-delete-bin-7-line"></i></button></td>\
                                    </table>\
                                </div>\
                            </div></a>\
                            '
                    $('#dynamic-row').append(tableRow);
                    });

                }
            });
        })

    </script>
@endsection