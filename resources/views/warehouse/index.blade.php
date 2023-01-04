@extends('layouts.general')

@section('content')
    <div class="card">
        <div class="card-body">
        <!-- Button trigger modal -->
        <h5 class="card-title">Almacenes<button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="ri-add-line"></i></button></h5>
            <!--@if(Session::has('message'))

                <div class="alert alert-success alert-dismissible" role="alert">
                        {{ Session::get('message') }}
                </div>

            @endif-->
            <input type="search" class="form-control" id="search" class="search" name="search" placeholder="Buscar Almacenes">  
            <!--<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Crear Almacen</button>-->
            <div id="success_message"></div>
            <!-- Modal Warehouse Create -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Crear almacen</h5>
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
                                    <label for="departament_id" class="form-label">Departamentos</label>
                                    <select name="departament_id" id="departament_id" class="form-select departament_id">
                                        <option value="">Seleccione una opcion..</option>
                                        @foreach($departaments as $departament)
                                            <option value="{{$departament->id}}">{{$departament->nameDepartament}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="site_id" class="form-label">Sitios</label>
                                    <select name="site_id" id="site_id" class="form-select site_id">
                                        <option value="">Seleccione una opcion..</option>
                                        @foreach($sites as $site)
                                            <option value="{{$site->id}}">{{$site->nameSite}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="direction" class="form-label">Dirección</label>
                                    <input type="text" class="form-control direction" id="direction" name="direction">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn guardar" style="background-color: #5daadd; color: white;">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!-- End Modal Warehouse Create -->

            <!-- Modal Warehouse Edit -->
            <div class="modal fade" id="EditWarehouseModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Editar almacen</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="formulario" method="POST">
                            <div class="modal-body">
                                <ul id="updateform_errList"></ul>
                                <input type="hidden" id="edit_warehouse_id">
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
                                    <label for="departament_id" class="form-label">Departamentos</label>
                                    <select name="departament_id" id="edit_departament_id" class="form-select departament_id">
                                        <option value="">Seleccione una opcion..</option>
                                        @foreach($departaments as $departament)
                                            <option value="{{$departament->id}}">{{$departament->nameDepartament}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="site_id" class="form-label">Sitios</label>
                                    <select name="site_id" id="edit_site_id" class="form-select site_id">
                                        <option value="">Seleccione una opcion..</option>
                                        @foreach($sites as $site)
                                            <option value="{{$site->id}}">{{$site->nameSite}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="direction" class="form-label">Dirección</label>
                                    <input type="text" class="form-control direction" id="edit_direction" name="direction">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn editar" style="background-color: #5daadd; color: white;">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!-- End Modal Warehouse Edit -->

            <!-- Modal Warehouse Delete-->
            <div class="modal fade" id="DeleteWarehouseModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Eliminar almacen</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="delete_warehouse_id">
                            <h3>¿Esta seguro que desea eliminar este registro?</h3>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-danger eliminar">Si, eliminar</button>
                        </div>
                    </div>
                </div>
            </div><!-- End Modal Warehouse Delete-->
            
            <!-- Table with hoverable rows -->
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Paises</th>
                        <th scope="col">Ciudades</th>
                        <th scope="col">Departamentos</th>
                        <th scope="col">Sitios</th>
                        <th scope="col">Direcciones</th>
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

            fetchwarehouse();
            /* funcion para mostrar en una tabla los datos de la tabla */
            function fetchwarehouse()
            {
                $.ajax({
                    type: "GET",
                    url: "/fetch-warehouse",
                    dataType: "json",
                    success:function(response){
                        //console.log(response.cities);
                        $('tbody').html("");
                        $.each(response.Warehouse, function(key, item) {
                            $('tbody').append('<tr>\
                                <td>'+item.nameCountry+'</td>\
                                <td>'+item.nameCity+'</td>\
                                <td>'+item.nameDepartament+'</td>\
                                <td>'+item.nameSite+'</td>\
                                <td>'+item.direction+'</td>\
                                <td><button type="button" value="'+item.id+'" class="btn editWarehouse" style="background-color: #848688; color: white;"><i class="ri-edit-line"></i></button>\
                                    <button type="button" value="'+item.id+'" class="btn btn-danger deleteWarehouse"><i class="ri-delete-bin-7-line"></i></button></td>\
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
                    url: "/warehouse",
                    data: {
                        'country_id': $('.country_id').val(),
                        'city_id': $('.city_id').val(), 
                        'departament_id': $('.departament_id').val(),
                        'site_id': $('.site_id').val(),
                        'direction': $('.direction').val(), 
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

                            fetchwarehouse();
                        }
                    }
                });
            });

            /* abrir modal de editar */
            $(document).on('click','.editWarehouse', function(e){
                e.preventDefault();
                var warehouse_id = $(this).val();
                //console.log(city_id);
                $('#EditWarehouseModal').modal('show')

                $.ajax({
                    type: "GET",
                    url: "/edit-warehouse/"+warehouse_id,
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
                            $('#edit_direction').val(response.warehouse.direction);
                            $('#edit_warehouse_id').val(warehouse_id);
                        }
                    }
                });
            });

            /* evento para editar */
            $(document).on('click','.editar', function(e){
                e.preventDefault();

                $(this).text("Actualizando");

                var warehouse_id = $('#edit_warehouse_id').val();
                var data = {
                    'country_id':$('#edit_country_id').val(),
                    'city_id':$('#edit_city_id').val(),
                    'departament_id':$('#edit_departament_id').val(),
                    'site_id':$('#edit_site_id').val(),
                    'direction':$('#edit_direction').val(),
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "PUT",
                    url: "update-warehouse/"+warehouse_id,
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
                            $('#EditWarehouseModal').modal('hide');
                            $(".editar").text("Actualizar");

                            fetchwarehouse();
                        }
                    }
                });
            });

            /* abrir modal de eliminar */
            $(document).on('click','.deleteWarehouse', function(e){
                e.preventDefault();
                var warehouse_id = $(this).val();
                //alert(uniMeasurement_id);
                $('#delete_warehouse_id').val(warehouse_id);
                $('#DeleteWarehouseModal').modal('show');
                
            });

            /* evento para eliminar */
            $(document).on('click','.eliminar', function(e){
                e.preventDefault();
                $(this).text("Eliminando");
                var warehouse_id = $('#delete_warehouse_id').val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "DELETE",
                    url: "/delete-warehouse/"+warehouse_id,
                    success:function(response){
                        console.log(response);
                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text(response.message);
                        $('#DeleteWarehouseModal').modal('hide');
                        $(".eliminar").text("Si, Eliminar");

                        fetchwarehouse();
                    }
                });
            });
        });
        //Live Search
        $('body').on('keyup', '#search',function(){
            let searchQuest = $(this).val();

            $.ajax({
                method: 'POST',
                url: '{{ route("warehouse.action") }}',
                dataType: 'json',
                data : {
                    '_token' : '{{ csrf_token() }}',
                    searchQuest: searchQuest
                },
                success:function(res){
                    let tableRow = '';
                    $('#dynamic-row').html('');
                    $.each(res, function(index, value){
                        tableRow= '<tr>\
                                <td>'+value.nameCountry+'</td>\
                                <td>'+value.nameCity+'</td>\
                                <td>'+value.nameDepartament+'</td>\
                                <td>'+value.nameSite+'</td>\
                                <td>'+value.direction+'</td>\
                                <td><button type="button" value="'+value.id+'" class="btn editWarehouse" style="background-color: #848688; color: white;"><i class="ri-edit-line"></i></button>\
                                    <button type="button" value="'+value.id+'" class="btn btn-danger deleteWarehouse"><i class="ri-delete-bin-7-line"></i></button></td>\
                                </tr>'
                    $('#dynamic-row').append(tableRow);
                    });

                }
            });
        })
    </script>
@endsection