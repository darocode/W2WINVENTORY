@extends('layouts.general')

@section('content')
    <div class="card">
        <div class="card-body">
        <h5 class="card-title">Departamentos<button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="ri-add-line"></i></button></h5>
        <!--@if(Session::has('message'))

                <div class="alert alert-success alert-dismissible" role="alert">
                        {{ Session::get('message') }}
                </div>

            @endif-->
            
            <input type="search" class="form-control" id="search" class="search" name="search" placeholder="Buscar">  
        <!-- Button trigger modal -->
            <div id="success_message"></div>
            <!--<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Crear departamento</button>-->
            <!-- Modal Departament Create -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Crear departamento</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="formulario" method="POST">
                            <div class="modal-body">
                                <ul id="saveform_errList"></ul>
                                @csrf
                                <div class="col-12">
                                    <label for="country_id" class="form-label">Paises</label>
                                    <select name="country_id" id="country_id" class="form-select country_id">
                                        <option value="">Seleccione una opcion..</option>
                                        @foreach($countries as $country)
                                            <option value="{{$country->id}}">{{$country->nameCountry}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="city_id" class="form-label">Ciudades</label>
                                    <select name="city_id" id="city_id" class="form-select city_id">
                                        <option value="">Seleccione una opcion..</option>
                                        @foreach($cities as $city)
                                            <option value="{{$city->id}}">{{$city->nameCity}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="nameDepartament" class="form-label">Departamento</label>
                                    <input type="text" class="form-control nameDepartament" id="inputNanme4" name="nameDepartament">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn guardar" style="background-color: #5daadd; color: white;">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!-- End Modal Departament Create -->

            <!-- Modal Departament Edit -->
            <div class="modal fade" id="EditDepartamentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Editar departamento</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="formulario" method="POST">
                            <div class="modal-body">
                                <ul id="updateform_errList"></ul>
                                <input type="hidden" id="edit_departament_id">
                                @csrf
                                <div class="col-12">
                                    <label for="country_id" class="form-label">Paises</label>
                                    <select name="country_id" id="edit_country_id" class="form-select country_id">
                                        <option value="">Seleccione una opcion..</option>
                                        @foreach($countries as $country)
                                            <option value="{{$country->id}}">{{$country->nameCountry}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="city_id" class="form-label">Ciudades</label>
                                    <select name="city_id" id="edit_city_id" class="form-select city_id">
                                        <option value="">Seleccione una opcion..</option>
                                        @foreach($cities as $city)
                                            <option value="{{$city->id}}">{{$city->nameCity}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="nameDepartament" class="form-label">Departamento</label>
                                    <input type="text" class="form-control nameDepartament" id="edit_nameDepartament" name="nameDepartament">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn editar" style="background-color: #5daadd; color: white;">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!-- End Modal Departament Edit -->

            <!-- Modal Departament Delete-->
            <div class="modal fade" id="DeleteDepartamentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Eliminar ciudad</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="delete_departament_id">
                            <h3>¿Esta seguro que desea eliminar este registro?</h3>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-danger eliminar">Si, eliminar</button>
                        </div>
                    </div>
                </div>
            </div><!-- End Modal Departament Delete-->
        
            <!-- Table with hoverable rows -->
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Paises</th>
                        <th scope="col">Ciudades</th>
                        <th scope="col">Departamentos</th>
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

            fetchdepartament();
            /* funcion para mostrar en una tabla los datos de la tabla */
            function fetchdepartament()
            {
                $.ajax({
                    type: "GET",
                    url: "/fetch-departament",
                    dataType: "json",
                    success:function(response){
                        //console.log(response.cities);
                        $('tbody').html("");
                        $.each(response.departament, function(key, item) {
                            $('tbody').append('<tr>\
                                <td>'+item.nameCountry+'</td>\
                                <td>'+item.nameCity+'</td>\
                                <td>'+item.nameDepartament+'</td>\
                                <td><button type="button" value="'+item.id+'" class="btn editDepartament" style="background-color: #848688; color: white;"><i class="ri-edit-line"></i></button>\
                                    <button type="button" value="'+item.id+'" class="btn btn-danger deleteDepartament"><i class="ri-delete-bin-7-line"></i></button></td>\
                                </tr>')
                        });
                    }
                });
            }

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
                    url: "/departament",
                    data: {
                        'country_id': $('.country_id').val(),
                        'city_id': $('.city_id').val(), 
                        'nameDepartament': $('.nameDepartament').val(), 
                    },
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

                            fetchdepartament();
                        }
                    }
                });
            });

            /* abrir modal de editar */
            $(document).on('click','.editDepartament', function(e){
                e.preventDefault();
                var departament_id = $(this).val();
                //console.log(city_id);
                $('#EditDepartamentModal').modal('show')

                $.ajax({
                    type: "GET",
                    url: "/edit-departament/"+departament_id,
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
                            $('#edit_country_id').val(response.departament.nameCountry);
                            $('#edit_city_id').val(response.departament.nameCity);
                            $('#edit_nameDepartament').val(response.departament.nameDepartament);
                            $('#edit_departament_id').val(departament_id);
                        }
                    }
                });
            });

            /* evento para editar */
            $(document).on('click','.editar', function(e){
                e.preventDefault();

                $(this).text("Actualizando");

                var departament_id = $('#edit_departament_id').val();
                var data = {
                    'country_id':$('#edit_country_id').val(),
                    'city_id':$('#edit_city_id').val(),
                    'nameDepartament':$('#edit_nameDepartament').val()
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "PUT",
                    url: "update-departament/"+departament_id,
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
                            $('#EditDepartamentModal').modal('hide');
                            $(".editar").text("Actualizar");

                            fetchdepartament();
                        }
                    }
                });
            });

            /* abrir modal de eliminar */
            $(document).on('click','.deleteDepartament', function(e){
                e.preventDefault();
                var city_id = $(this).val();
                //alert(uniMeasurement_id);
                $('#delete_departament_id').val(city_id);
                $('#DeleteDepartamentModal').modal('show');
                
            });

            /* evento para eliminar */
            $(document).on('click','.eliminar', function(e){
                e.preventDefault();
                $(this).text("Eliminando");
                var departament_id = $('#delete_departament_id').val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "DELETE",
                    url: "/delete-departament/"+departament_id,
                    success:function(response){
                        console.log(response);
                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text(response.message);
                        $('#DeleteDepartamentModal').modal('hide');
                        $(".eliminar").text("Si, Eliminar");

                        fetchdepartament();
                    }
                });
            });
        });
        //Live Search
        $('body').on('keyup', '#search',function(){
            let searchQuest = $(this).val();

            $.ajax({
                method: 'POST',
                url: '{{ route("departamentSearch.action") }}',
                dataType: 'json',
                data : {
                    '_token' : '{{ csrf_token() }}',
                    searchQuest: searchQuest
                },
                success:function(res){
                    let tableRow = '';
                    $('#dynamic-row').html('');
                    $.each(res, function(index, value){
                        tableRow= '<tr><td>'+value.nameCountry+'</td><td>'+value.nameCity+'</td><td>'+value.nameDepartament+'</td><td><button type="button" value="'+value.id+'" class="btn editDepartament" style="background-color: #848688; color: white;"><i class="ri-edit-line"></i></button><button type="button" value="'+value.id+'" class="btn btn-danger deleteDepartament"><i class="ri-delete-bin-7-line"></i></button></td></tr>'
                    $('#dynamic-row').append(tableRow);
                    });

                }
            });
        })
    </script>
@endsection