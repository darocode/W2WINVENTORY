@extends('layouts.general')

@section('content')
    <div class="card">
        <div class="card-body">
        <!-- Button trigger modal -->
        
        <h5 class="card-title">Unidades de medidas<button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="ri-add-line"></i></button></h5>
            <!--@if(Session::has('message'))

                <div class="alert alert-success alert-dismissible" role="alert">
                        {{ Session::get('message') }}
                </div>

            @endif-->
            <input type="search" class="form-control" id="search" class="search" name="search" placeholder="Buscar">
            <div id="success_message"></div>
            <!--<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Crear unidad de medida</button>-->
            <!-- Modal UnityMeasurement Create -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Crear unidad de medida</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="formulario" method="POST">
                            <div class="modal-body">
                            <ul id="saveform_errList"></ul>
                                @csrf
                                    <div class="col-12">
                                        <label for="typeMeasurement" class="form-label">Unidad de medida</label>
                                        <input type="text" class="form-control typeMeasurement" id="inputNanme4" name="typeMeasurement">
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn guardar" style="background-color: #5daadd; color: white;">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!-- End Modal UnityMeasurement Create -->

            <!-- Modal UnityMeasurement Edit -->
            <div class="modal fade" id="EditUniMeasurementModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Editar unidad de medida</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="formulario" method="POST">
                            <div class="modal-body">
                            <ul id="updateform_errList"></ul>
                            <input type="hidden" id="edit_uniMeasurement_id">
                                @csrf
                                    <div class="col-12">
                                        <label for="typeMeasurement" class="form-label">Unidad de medida</label>
                                        <input type="text" id="edit_typeMeasurement" class="form-control typeMeasurement" id="inputNanme4" name="typeMeasurement">
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn editar" style="background-color: #5daadd; color: white;">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!-- End Modal UnityMeasurement Edit -->

            <!-- Modal UnityMeasurement Delete -->
            <div class="modal fade" id="DeleteUniMeasurementModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Eliminar unidad de medida</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="delete_uniMeasurement_id">
                            <h3>¿Esta seguro que desea eliminar este registro?</h3>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-danger eliminar">Si, eliminar</button>
                        </div>
                    </div>
                </div>
            </div><!-- End Modal UnityMeasurement Delete -->
            
            <!-- Table with hoverable rows -->
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Unidades de medidas</th>
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

            fetchunitymeasurement();
            /* funcion para mostrar en una tabla los datos de la tabla */
            function fetchunitymeasurement()
            {
                $.ajax({
                    type: "GET",
                    url: "/fetch-unitymeasurement",
                    dataType: "json",
                    success:function(response){
                        //console.log(response.typeUsers);
                        $('tbody').html("");
                        $.each(response.unityMeasurements, function(key, item) {
                            $('tbody').append('<tr>\
                                <td>'+item.typeMeasurement+'</td>\
                                <td><button type="button" value="'+item.id+'" class="btn editUMe" style="background-color: #848688; color: white;"><i class="ri-edit-line"></i></button>\
                                    <button type="button" value="'+item.id+'" class="btn btn-danger deleteUMe"><i class="ri-delete-bin-7-line"></i></button></td>\
                                </tr>')
                        });
                    }
                });
            }

            /* eliminar un campo de la base de datos */
            $(document).on('click','.deleteUMe', function(e){
                e.preventDefault();
                var uniMeasurement_id = $(this).val();
                //alert(uniMeasurement_id);
                $('#delete_uniMeasurement_id').val(uniMeasurement_id);
                $('#DeleteUniMeasurementModal').modal('show');

            });

            /* evento para eliminar */
            $(document).on('click','.eliminar', function(e){
                e.preventDefault();
                $(this).text("Eliminando");
                var uniMeasurement_id = $('#delete_uniMeasurement_id').val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "DELETE",
                    url: "/delete-unityMeasurement/"+uniMeasurement_id,
                    success:function(response){
                        //console.log(response);
                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text(response.message);
                        $('#DeleteUniMeasurementModal').modal('hide');
                        $(".eliminar").text("Si, Eliminar");
                        fetchunitymeasurement();
                    }
                });
                
            });

            /* abrir modal de editar */
            $(document).on('click','.editUMe', function(e){
                e.preventDefault();
                var uniMeasurement_id = $(this).val();
                //console.log(uniMeasurement_id);
                $('#EditUniMeasurementModal').modal('show')

                $.ajax({
                    type: "GET",
                    url: "/edit-unityMeasurement/"+uniMeasurement_id,
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
                            $('#edit_typeMeasurement').val(response.unityMeasurement.typeMeasurement);
                            $('#edit_uniMeasurement_id').val(uniMeasurement_id);
                        }
                    }
                });
            });

            /* evento para editar */
            $(document).on('click','.editar', function(e){
                e.preventDefault();

                $(this).text("Actualizando");

                var uniMeasu_id = $('#edit_uniMeasurement_id').val();
                var data = {
                    'typeMeasurement':$('#edit_typeMeasurement').val()
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "PUT",
                    url: "update-unityMeasurement/"+uniMeasu_id,
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
                            $('#EditUniMeasurementModal').modal('hide');
                            $(".editar").text("Actualizar");

                            fetchunitymeasurement();
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
                    url: "/unityMeasurement",
                    data: {
                        'typeMeasurement': $('.typeMeasurement').val(), 
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

                            fetchunitymeasurement();
                        }
                    }
                });
            });
        });

        //Busqueda en tiempo real
        $('body').on('keyup', '#search',function(){
            let searchQuest = $(this).val();

            $.ajax({
                method: 'POST',
                url: '{{ route("unitySearch.action") }}',
                dataType: 'json',
                data : {
                    '_token' : '{{ csrf_token() }}',
                    searchQuest: searchQuest
                },
                success:function(res){
                    let tableRow = '';
                    $('#dynamic-row').html('');
                    $.each(res, function(index, value){
                        tableRow= '<tr><td>'+value.typeMeasurement+'</td><td><button type="button" value="'+value.id+'" class="btn editUMe" style="background-color: #848688; color: white;"><i class="ri-edit-line"></i></button></a><button type="button" value="'+value.id+'" class="btn btn-danger deleteUMe"><i class="ri-delete-bin-7-line"></i></button></a></td></tr>'
                    $('#dynamic-row').append(tableRow);
                    });

                }
            });
        })
            
    </script>
@endsection