@extends('layouts.general')

@section('content') 
        <div class="card">
            <div class="card-body">
                <!-- Button trigger modal -->
        <h5 class="card-title">Tipo clientes<button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="ri-add-line"></i></button></h5>
                <!--@if(Session::has('message'))

                    <div class="alert alert-success" role="alert">
                        {{ Session::get('message')}}
                    </div>

                @endif-->
                <input type="search" class="form-control" id="search" class="search" name="search" placeholder="Buscar">
                <div id="success_message"></div>
                <!-- Button trigger modal 
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Crear tipo cliente</button>-->
                <!-- Modal TypeClient Create -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Crear tipo cliente</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form id="formulario" method="POST">
                                <div class="modal-body">
                                    <ul id="saveform_errList"></ul>
                                    @csrf
                                    <div class="col-12">
                                        <label for="typeClient" class="form-label">Tipo cliente</label>
                                        <input type="text" class="form-control typeClient" id="inputNanme4" name="typeClient">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    <button type="button" class="btn guardar" style="background-color: #5daadd; color: white;">Guardar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div><!-- End Modal TypeClient Create -->

                <!-- Modal TypeClient Edit -->
                <div class="modal fade" id="EditTypeClientModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Editar tipo cliente</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form id="formulario" method="POST">
                                <div class="modal-body">
                                    <ul id="updateform_errList"></ul>
                                    <input type="hidden" id="edit_tClient_id">
                                    @csrf
                                    <div class="col-12">
                                        <label for="typeClient" class="form-label">Tipo cliente</label>
                                        <input type="text" id="edit_typeClient" class="form-control typeClient" id="inputNanme4" name="typeClient">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    <button type="button" class="btn editar" style="background-color: #5daadd; color: white;">Guardar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div><!-- End Modal TypeClient Edit -->

                <!-- Modal TypeClient Delete -->
                <div class="modal fade" id="DeleteTypeClientModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Eliminar tipo cliente</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" id="delete_tClient_id">
                                <h3>¿Esta seguro que desea eliminar este registro?</h3>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-danger eliminar">Si, eliminar</button>
                            </div>
                        </div>
                    </div>
                </div><!-- End Modal TypeClient Delete -->

                <!-- Table with hoverable rows -->
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Tipo clientes</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="dynamic-row">
                    </tbody>
                </table>
                <!-- End Table with hoverable rows -->

            </div>
        </div>
@endsection


@section('scripts')

<!-- Script Ajax -->
    <script>
        $(document).ready(function(){

            fetchtypeclients();
            /* funcion para mostrar en una tabla los datos de la tabla */
            function fetchtypeclients()
            {
                $.ajax({
                    type: "GET",
                    url: "/fetch-typeclient",
                    dataType: "json",
                    success:function(response){
                        //console.log(response.typeUsers);
                        $('tbody').html("");
                        $.each(response.typeClients, function(key, item) {
                            $('tbody').append('<tr>\
                                <td>'+item.typeClient+'</td>\
                                <td><button type="button" value="'+item.id+'" class="btn edittCli" style="background-color: #848688; color: white;"><i class="ri-edit-line"></i></button></a>\
                                    <button type="button" value="'+item.id+'" class="btn btn-danger deletetCli"><i class="ri-delete-bin-7-line"></i></button></a></td>\
                                </tr>')
                        });
                    }
                });
            }

            /* eliminar un campo de la base de datos*/
            $(document).on('click','.deletetCli', function(e){
                e.preventDefault();
                var tClient_id = $(this).val();
                //alert(uniMeasurement_id);
                $('#delete_tClient_id').val(tClient_id);
                $('#DeleteTypeClientModal').modal('show');

            });

            /* evento para eliminar */
            $(document).on('click','.eliminar', function(e){
                e.preventDefault();
                $(this).text("Eliminando");
                var tClient_id = $('#delete_tClient_id').val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "DELETE",
                    url: "/delete-typeClient/"+tClient_id,
                    success:function(response){
                        //console.log(response);
                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text(response.message);
                        $('#DeleteTypeClientModal').modal('hide');
                        $(".eliminar").text("Si, Eliminar");
                        fetchtypeclients();
                    }
                });
                
            });

            /* abrir modal de editar */
            $(document).on('click','.edittCli', function(e){
                e.preventDefault();
                var tClient_id = $(this).val();
                //console.log(uniMeasurement_id);
                $('#EditTypeClientModal').modal('show')

                $.ajax({
                    type: "GET",
                    url: "/edit-typeClient/"+tClient_id,
                    success:function(response){
                        //console.log(response);
                        if (response.status == 404) 
                        {
                            $('success_message').html("");
                            $('success_message').addClass('alert alert-danger');
                            $('success_message').text(response.message);
                        }
                        else
                        {
                            $('#edit_typeClient').val(response.typeClient.typeClient);
                            $('#edit_tClient_id').val(tClient_id);
                        }
                    }
                });
            });

            /* evento para editar */
            $(document).on('click','.editar', function(e){
                e.preventDefault();

                $(this).text("Actualizando");

                var tyCli_id = $('#edit_tClient_id').val();
                var data = {
                    'typeClient':$('#edit_typeClient').val()
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "PUT",
                    url: "update-typeClient/"+tyCli_id,
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
                            $('#EditTypeClientModal').modal('hide');
                            $(".editar").text("Actualizar");

                            fetchtypeclients();
                        }
                    }
                });
            });

            /* evento para crear un registro */
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
                    url: "/typeClient",
                    data: {
                        'typeClient': $('.typeClient').val(), 
                    },
                    dataType: "json",
                    success:function(response){
                        //console.log(response);
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

                            fetchtypeclients();
                        }
                    }
                });
            });
        });

        //Live Search
        $('body').on('keyup', '#search',function(){
            let searchQuest = $(this).val();

            $.ajax({
                method: 'POST',
                url: '{{ route("typeClientSearch.action") }}',
                dataType: 'json',
                data : {
                    '_token' : '{{ csrf_token() }}',
                    searchQuest: searchQuest
                },
                success:function(res){
                    let tableRow = '';
                    $('#dynamic-row').html('');
                    $.each(res, function(index, value){
                        tableRow= '<tr><td>'+value.typeClient+'</td><td><button type="button" value="'+value.id+'" class="btn edittCli" style="background-color: #848688; color: white;"><i class="ri-edit-line"></i></button></a><button type="button" value="'+value.id+'" class="btn btn-danger deletetCli"><i class="ri-delete-bin-7-line"></i></button></a></td></tr>'
                    $('#dynamic-row').append(tableRow);
                    });

                }
            });
        });
        
        //Pagination 
        $(document).ready(function(){
            $(document).on('click', '.pagination a', function(e){
                e.preventDefault();
                let page = $(this).attr('href').split('page=')[1];
                typeClient(page)
            })

            function typeClient(page){
                $.ajax({
                    url:"typeClient?page="+page,
                    success:function(res){
                        $('.table-data').html(res);
                    }
                })
            }

            typeClient(1);
        });
    </script>
@endsection