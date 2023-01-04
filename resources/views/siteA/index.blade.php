@extends('layouts.general')

@section('content')
<nav style="display: flex; justify-content: end;">
    <ol class="breadcrumb">
        <form action="{{ url('/site/'.$infoSite->id) }}" method="POST">
            <input type="hidden" class="form-control site_id" id="site_id" name="site_id" value="{{ $infoSite->id }}">
            <input type="hidden" class="form-control client_id" id="client_id" name="client_id" value="{{ $infoSite->client_id }}">
        </form>
        <li class="breadcrumb-item"><a href="/infoClient/{{ $infoSite->client_id }}/edit">Información del cliente</a></li>
        <li class="breadcrumb-item active">Sitios del cliente</li>
    </ol>
</nav>
<!-- Table with hoverable rows SubClient -->
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Codigo</th>
            <th scope="col">Sitio</th>
        </tr>
    </thead>
    <tbody class="siteA">
    </tbody>
</table>
<!-- End Table with hoverable rows SubClient -->
<div class="card">
    <div class="card-body">
        <!-- Button trigger modal -->
        <h5 class="card-title">Almacenes<button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="ri-add-line"></i></button></h5>
        <div id="success_message"></div>
        <!--<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Crear país</button>-->
        <!-- Modal Country Create-->
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
                                <label for="identifierWarehouse" class="form-label">Codigo</label>
                                <input type="text" class="form-control identifierWarehouse" id="identifierWarehouse" name="identifierWarehouse">
                            </div>
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
                            <label for="direction" class="form-label">Dirección</label>
                            <input type="text" class="form-control direction" id="direction" name="direction">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn guardar" style="background-color: #5daadd; color: white;">Guardar</button>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- End Modal Country Create-->

        <!-- Table with hoverable rows -->
        <table class="table table-hover">
            <input type="search" class="form-control" id="search" class="search" name="search" placeholder="Buscar Cliente">  
            <thead>
                <tr>
                <th scope="col">Codigos</th>
                <th scope="col">Paises</th>
                <th scope="col">Ciudades</th>
                <th scope="col">Departamentos</th>
                <th scope="col">Sitios</th>
                <th scope="col">Dirección</th>
                <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody class="almacen" id="dynamic-row">
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
            /* SITE */
            fetchsiteQ();

            /* funcion para mostrar en una tabla los datos de la tabla */
            function fetchsiteQ()
            {
                var site_id = $('#site_id').val();
                $.ajax({
                    type: "GET",
                    url: "/fetch-siteQ/"+site_id,
                    dataType: "json",
                    success:function(response){
                        console.log(response.infoSite);
                        $('.siteA').html("");
                        $.each(response.infoSite, function(key, item) {
                            $('.siteA').append('<tr>\
                                <td>'+item.identifierSite+'</td>\
                                <td>'+item.nameSite+'</td>\
                                </tr>')
                        });
                    }
                });
            }

            /* SITE END */
            
            /* WAREHOUSE */
            fetchwarehouse();

            /* funcion para mostrar en una tabla los datos de la tabla */
            function fetchwarehouse()
            {
                var site_id = $('#site_id').val();
                $.ajax({
                    type: "GET",
                    url: "/fetch-warehouse/"+site_id,
                    dataType: "json",
                    success:function(response){
                        //console.log(response.typeUsers);
                        $('.almacen').html("");
                        $.each(response.warehouse, function(key, item) {
                            $('.almacen').append('<tr>\
                                <td>'+item.identifierWarehouse+'</td>\
                                <td>'+item.nameCountry+'</td>\
                                <td>'+item.nameCity+'</td>\
                                <td>'+item.nameDepartament+'</td>\
                                <td>'+item.nameSite+'</td>\
                                <td>'+item.direction+'</td>\
                                <td><button type="button" value="'+item.id+'" class="btn editCountry" style="background-color: #848688; color: white;"><i class="ri-edit-line"></i></button></a>\
                                    <button type="button" value="'+item.id+'" class="btn btn-danger deletewarehouse"><i class="ri-delete-bin-7-line"></i></button></a></td>\
                                </tr>')
                        });
                    }
                });
            }

            /* eliminar un campo de la base de datos */
            $(document).on('click','.deletewarehouse', function(e){
                e.preventDefault();
                var country_id = $(this).val();
                //alert(uniMeasurement_id);
                $('#delete_country_id').val(country_id);
                $('#DeleteCountryModal').modal('show');

            });

            /* evento para eliminar */
            $(document).on('click','.eliminar', function(e){
                e.preventDefault();
                $(this).text("Eliminando");
                var country_id = $('#delete_country_id').val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "DELETE",
                    url: "/delete-country/"+country_id,
                    success:function(response){
                        //console.log(response);
                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text(response.message);
                        $('#DeleteCountryModal').modal('hide');
                        $(".eliminar").text("Si, Eliminar");

                        fetchcountry();
                    }
                });
            });

            /* abrir modal de editar */
            $(document).on('click','.editCountry', function(e){
                e.preventDefault();
                var country_id = $(this).val();
                //console.log(uniMeasurement_id);
                $('#EditCountryModal').modal('show')

                $.ajax({
                    type: "GET",
                    url: "/edit-country/"+country_id,
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
                            $('#edit_country').val(response.country.nameCountry);
                            $('#edit_country_id').val(country_id);
                        }
                    }
                });
            });

            /* evento para editar */
            $(document).on('click','.editar', function(e){
                e.preventDefault();

                $(this).text("Actualizando");

                var country_id = $('#edit_country_id').val();
                var data = {
                    'nameCountry':$('#edit_country').val()
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "PUT",
                    url: "update-country/"+country_id,
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
                            $('#EditCountryModal').modal('hide');
                            $(".editar").text("Actualizar");

                            fetchcountry();
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
                    url: "/warehouse",
                    data: {
                        'identifierWarehouse': $('.identifierWarehouse').val(), 
                        'country_id': $('.country_id').val(), 
                        'city_id': $('.city_id').val(), 
                        'departament_id': $('.departament_id').val(), 
                        'site_id': $('.site_id').val(), 
                        'direction': $('.direction').val(), 
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

                            fetchwarehouse();
                        }
                    }
                });
            });
        });
        /* WAREHOUSE END*/
         //Live Search
         $('body').on('keyup', '#search',function(){
            let searchQuest = $(this).val();

            $.ajax({
                method: 'POST',
                url: '{{ route("warehouseSiteSearch.action") }}',
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
                                <td>'+value.identifierWarehouse+'</td>\
                                <td>'+value.nameCountry+'</td>\
                                <td>'+value.nameCity+'</td>\
                                <td>'+value.nameDepartament+'</td>\
                                <td>'+value.nameSite+'</td>\
                                <td>'+value.direction+'</td>\
                                <td><button type="button" value="'+value.id+'" class="btn editCountry" style="background-color: #848688; color: white;"><i class="ri-edit-line"></i></button></a>\
                                    <button type="button" value="'+value.id+'" class="btn btn-danger deletewarehouse"><i class="ri-delete-bin-7-line"></i></button></a></td>\
                                </tr>'
                    $('#dynamic-row').append(tableRow);
                    });

                }
            });
        })
    </script>
@endsection