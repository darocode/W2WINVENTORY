@extends('layouts.general')

@section('content')
    <div class="card">
        <div class="card-body">
        <h5 class="card-title">Ciudades<button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="ri-add-line"></i></button></h5>
            <!--@if(Session::has('message'))

                <div class="alert alert-success alert-dismissible" role="alert">
                        {{ Session::get('message') }}
                </div>

            @endif-->
            <input type="search" class="form-control" id="search" class="search" name="search" placeholder="Buscar">  
            <div id="success_message"></div>
            <!-- Button trigger modal 
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Crear ciudad</button>-->
            <!-- Modal Cities Create -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Crear ciudad</h5>
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
                                    <label for="nameCity" class="form-label">Ciudad</label>
                                    <input type="text" class="form-control nameCity" id="inputNanme4" name="nameCity">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn guardar" style="background-color: #5daadd; color: white;">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!-- End Modal Cities Create-->

            <!-- Modal Cities Edit -->
            <div class="modal fade" id="EditCityModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Editar ciudad</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="formulario" method="POST">
                            <div class="modal-body">
                                <ul id="updateform_errList"></ul>
                                <input type="hidden" id="edit_city_id">
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
                                    <label for="nameCity" class="form-label">Ciudad</label>
                                    <input type="text" class="form-control nameCity" id="edit_nameCity" name="nameCity">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn editar" style="background-color: #5daadd; color: white;">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!-- End Modal Cities Edit-->

            <!-- Modal Cities Delete-->
            <div class="modal fade" id="DeleteCityModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Eliminar ciudad</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="delete_city_id">
                            <h3>¿Esta seguro que desea eliminar este registro?</h3>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-danger eliminar">Si, eliminar</button>
                        </div>
                    </div>
                </div>
            </div><!-- End Modal Cities Edit-->
            
            <!-- Table with hoverable rows -->
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Paises</th>
                        <th scope="col">Ciudades</th>
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

            fetchcity();
            /* funcion para mostrar en una tabla los datos de la tabla */
            function fetchcity()
            {
                $.ajax({
                    type: "GET",
                    url: "/fetch-city",
                    dataType: "json",
                    success:function(response){
                        console.log(response.cities);
                        $('tbody').html("");
                        $.each(response.cities, function(key, item) {
                            $('tbody').append('<tr>\
                                <td>'+item.nameCountry+'</td>\
                                <td>'+item.nameCity+'</td>\
                                <td><button type="button" value="'+item.id+'" class="btn editCity" style="background-color: #848688; color: white;"><i class="ri-edit-line"></i></button>\
                                    <button type="button" value="'+item.id+'" class="btn btn-danger deleteCity"><i class="ri-delete-bin-7-line"></i></button></td>\
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
                    url: "/city",
                    data: {
                        'country_id': $('.country_id').val(),
                        'nameCity': $('.nameCity').val(), 
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

                            fetchcity();
                        }
                    }
                });
            });

            /* abrir modal de editar */
            $(document).on('click','.editCity', function(e){
                e.preventDefault();
                var city_id = $(this).val();
                //console.log(city_id);
                $('#EditCityModal').modal('show')

                $.ajax({
                    type: "GET",
                    url: "/edit-city/"+city_id,
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
                            $('#edit_country_id').val(response.city.nameCountry);
                            $('#edit_nameCity').val(response.city.nameCity);
                            $('#edit_city_id').val(city_id);
                        }
                    }
                });
            });

            /* evento para editar */
            $(document).on('click','.editar', function(e){
                e.preventDefault();

                $(this).text("Actualizando");

                var city_id = $('#edit_city_id').val();
                var data = {
                    'country_id':$('#edit_country_id').val(),
                    'nameCity':$('#edit_nameCity').val(),
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "PUT",
                    url: "update-city/"+city_id,
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
                            $('#EditCityModal').modal('hide');
                            $(".editar").text("Actualizar");

                            fetchcity();
                        }
                    }
                });
            });

            /* abrir modal de eliminar */
            $(document).on('click','.deleteCity', function(e){
                e.preventDefault();
                var city_id = $(this).val();
                //alert(uniMeasurement_id);
                $('#delete_city_id').val(city_id);
                $('#DeleteCityModal').modal('show');

            });

            /* evento para eliminar */
            $(document).on('click','.eliminar', function(e){
                e.preventDefault();
                $(this).text("Eliminando");
                var city_id = $('#delete_city_id').val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "DELETE",
                    url: "/delete-city/"+city_id,
                    success:function(response){
                        console.log(response);
                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text(response.message);
                        $('#DeleteCityModal').modal('hide');
                        $(".eliminar").text("Si, Eliminar");

                        fetchcity();
                    }
                });
            });
        });
        //Live Search
        $('body').on('keyup', '#search',function(){
            let searchQuest = $(this).val();

            $.ajax({
                method: 'POST',
                url: '{{ route("citySearch.action") }}',
                dataType: 'json',
                data : {
                    '_token' : '{{ csrf_token() }}',
                    searchQuest: searchQuest
                },
                success:function(res){
                    let tableRow = '';
                    $('#dynamic-row').html('');
                    $.each(res, function(index, value){
                        tableRow= '<tr><td>'+value.nameCountry+'</td><td>'+value.nameCity+'</td><td><button type="button" value="'+value.id+'" class="btn editCity" style="background-color: #848688; color: white; gap:2px;"><i class="ri-edit-line"></i></button><button type="button" value="'+value.id+'" class="btn btn-danger deleteCity"><i class="ri-delete-bin-7-line"></i></button></td></tr>'
                    $('#dynamic-row').append(tableRow);
                    });

                }
            });
        })
    </script>
@endsection