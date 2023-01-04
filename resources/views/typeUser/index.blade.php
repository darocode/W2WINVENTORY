@extends('layouts.general')

@section('content')
    <div class="card">
        <div class="card-body">
        <h5 class="card-title">Tipo usuarios<button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="ri-add-line"></i></button></h5>
            <!--@if(Session::has('message'))

                <div class="alert alert-success alert-dismissible" role="alert" id="respuesta">
                        {{ Session::get('message') }}
                </div>

            @endif-->
            <input type="search" class="form-control" id="search" class="search" name="search" placeholder="Buscar">
            <div id="success_message"></div>
            <!-- Button trigger modal 
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Crear tipo usuario</button>-->
            <!-- Modal TypeUser Create-->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Crear tipo usuario</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="formulario" method="POST" >
                            <div class="modal-body">
                                <ul id="saveform_errList"></ul>
                                @csrf
                                    <div class="col-12">
                                        <label for="typeUser" class="form-label">Tipo usuario</label>
                                        <input type="text" class="form-control typeUser" id="inputNanme4" name="typeUser">
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn guardar" style="background-color: #5daadd; color: white;">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!-- End Modal TypeUser Create-->

            <!-- Modal TypeUser Edit-->
            <div class="modal fade" id="EditTypeUserModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Editar tipo usuario</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="formulario" method="POST" >
                            <div class="modal-body">
                                <ul id="updateform_errList"></ul>
                                <input type="hidden" id="edit_tyUser_id">
                                @csrf
                                    <div class="col-12">
                                        <label for="typeUser" class="form-label">Tipo usuario</label>
                                        <input type="text" id="edit_typeUser" class="form-control typeUser" id="inputNanme4" name="typeUser">
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn editar" style="background-color: #5daadd; color: white;">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!-- End Modal TypeUser Edit-->

            <!-- Modal TypeUser Delete-->
            <div class="modal fade" id="DeleteTypeUserModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Eliminar tipo usuario</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="delete_tyUser_id">
                            <h3>¿Esta seguro que desea eliminar este registro?</h3>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-danger eliminar">Si, eliminar</button>
                        </div>
                    </div>
                </div>
            </div><!-- End Modal TypeUser Delete-->
            
            <!-- Table with hoverable rows -->
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Tipo usuarios</th>
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

            fetchtypeuser();

            /* funcion para mostrar en una tabla los datos de la tabla */
            function fetchtypeuser()
            {
                $.ajax({
                    type: "GET",
                    url: "/fetch-typeuser",
                    dataType: "json",
                    success:function(response){
                        //console.log(response.typeUsers);
                        $('tbody').html("");
                        $.each(response.typeUsers, function(key, item) {
                            $('tbody').append('<tr>\
                                <td>'+item.typeUser+'</td>\
                                <td><button type="button" value="'+item.id+'" class="btn editTyU" style="background-color: #848688; color: white;"><i class="ri-edit-line"></i></button>\
                                    <button type="button" value="'+item.id+'" class="btn btn-danger deleteTyU"><i class="ri-delete-bin-7-line"></i></button></td>\
                                </tr>')
                        });
                    }
                });
            }

            /* eliminar un campo de la base de datos */
            $(document).on('click','.deleteTyU', function(e){
                e.preventDefault();
                var tyUser_id = $(this).val();
                //alert(uniMeasurement_id);
                $('#delete_tyUser_id').val(tyUser_id);
                $('#DeleteTypeUserModal').modal('show');

            });

            /* evento para eliminar */
            $(document).on('click','.eliminar', function(e){
                e.preventDefault();
                $(this).text("Eliminando");
                var tyUser_id = $('#delete_tyUser_id').val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "DELETE",
                    url: "/delete-typeUser/"+tyUser_id,
                    success:function(response){
                        //console.log(response);
                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text(response.message);
                        $('#DeleteTypeUserModal').modal('hide');
                        $(".eliminar").text("Si, Eliminar");

                        fetchtypeuser();
                    }
                });
            });

            /* abrir modal de editar */
            $(document).on('click','.editTyU', function(e){
                e.preventDefault();
                var tyUser_id = $(this).val();
                //console.log(uniMeasurement_id);
                $('#EditTypeUserModal').modal('show')

                $.ajax({
                    type: "GET",
                    url: "/edit-typeUser/"+tyUser_id,
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
                            $('#edit_typeUser').val(response.typeUsers.typeUser);
                            $('#edit_tyUser_id').val(tyUser_id);
                        }
                    }
                });
            });

            /* evento para editar */
            $(document).on('click','.editar', function(e){
                e.preventDefault();

                $(this).text("Actualizando");

                var tyUser_id = $('#edit_tyUser_id').val();
                var data = {
                    'typeUser':$('#edit_typeUser').val()
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "PUT",
                    url: "update-typeUser/"+tyUser_id,
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
                            $('#EditTypeUserModal').modal('hide');
                            $(".editar").text("Actualizar");

                            fetchtypeuser();

                        }
                    }

                });
            });
            
            /* evento para crear un registro */
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
                    url: "/typeUserCreate",
                    data: {
                        'typeUser': $('.typeUser').val(), 
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
                            fetchtypeuser();
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
                url: '{{ route("typeUser.action") }}',
                dataType: 'json',
                data : {
                    '_token' : '{{ csrf_token() }}',
                    searchQuest: searchQuest
                },
                success:function(res){
                    let tableRow = '';
                    $('#dynamic-row').html('');
                    $.each(res, function(index, value){
                        tableRow= '<tr><td>'+value.typeUser+'</td><td><button type="button" value="'+value.id+'" class="btn editTyU" style="background-color: #848688; color: white;"><i class="ri-edit-line"></i></button></a><button type="button" value="'+value.id+'" class="btn btn-danger deleteTyU"><i class="ri-delete-bin-7-line"></i></button></a></td></tr>'
                    $('#dynamic-row').append(tableRow);
                    });

                }
            });
        })
    </script>
@endsection