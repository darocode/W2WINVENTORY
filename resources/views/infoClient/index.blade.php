@extends('layouts.general')

@section('content')
<nav style="display: flex; justify-content: end;">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/client">Clientes</a></li>
        <li class="breadcrumb-item active">Información del cliente</li>
    </ol>
</nav>
<div>

</div>
<!-- Table with hoverable rows -->
<div class="row infoCard"></div>
<!-- End Table with hoverable rows -->
<div class="card">  
    <form action="{{ url('/infoClient/'.$infoClient->id) }}" method="POST">
        <input type="hidden" class="form-control client_id" id="client_id" name="client_id" value="{{ $infoClient->id }}">
        <!--<img src="{{asset('storage/img/'.$infoClient->imageClient)}}" alt="" id="imageClient" name="imageClient">-->
    </form>
    <div class="card-body">
        <!-- SubClient -->
        <!-- Button trigger modal -->
        <h5 class="card-title">Sub clientes<button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="ri-add-line"></i></button></h5>
        <div id="success_message"></div>
        <!-- Modal SubClient Create -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Crear sub cliente</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="formulario" method="POST">
                        <div class="modal-body">
                            <ul id="saveform_errList"></ul>
                            @csrf
                            <div class="col-12">
                                <label for="identifierSubClient" class="form-label">Codigo</label>
                                <input type="text" class="form-control identifierSubClient" id="identifierSubClient" name="identifierSubClient">
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
                                <label for="country_id" class="form-label">Almacenes</label>
                                <select name="warehouse_id" id="warehouse_id" class="form-select warehouse_id">
                                    <option value="">Seleccione una opcion..</option>
                                    @foreach($Warehouse as $warehouse)
                                        <option value="{{$warehouse->id}}">{{$warehouse->direction}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn guardarSub" style="background-color: #5daadd; color: white;">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- End Modal SubClient Create-->
        <!-- Modal SubClient Edit -->
        <div class="modal fade" id="EditSubClientModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Editar sub-cliente</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="formulario" method="POST">
                        <div class="modal-body">
                            <ul id="updateform_errList"></ul>
                            <input type="hidden" id="edit_subClient_id">
                            @csrf
                            <div class="col-12">
                                <label for="identifierSubClient" class="form-label">Codigo</label>
                                <input type="text" class="form-control identifierSubClient" id="edit_identifierSubClient" name="identifierSubClient">
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
                                <label for="country_id" class="form-label">Almacenes</label>
                                <select name="warehouse_id" id="edit_warehouse_id" class="form-select warehouse_id">
                                    <option value="">Seleccione una opcion..</option>
                                    @foreach($Warehouse as $warehouse)
                                        <option value="{{$warehouse->id}}">{{$warehouse->direction}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn editarSub" style="background-color: #5daadd; color: white;">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- End Modal SubClient Edit-->

        <!-- Modal SubClient Delete-->
        <div class="modal fade" id="DeleteSubClientModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Eliminar sub-cliente</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="delete_subClient_id">
                        <h3>¿Esta seguro que desea eliminar este registro?</h3>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-danger eliminarSub">Si, eliminar</button>
                    </div>
                </div>
            </div>
        </div><!-- End Modal SubClient Delete-->

        <!-- Table with hoverable rows SubClient -->
        <table class="table table-hover">
            <input type="search" class="form-control" id="searchSubClient" class="search" name="search" placeholder="Buscar">    
            <thead>
                <tr>
                    <th scope="col">Codigos</th>
                    <th scope="col">Sitios</th>
                    <th scope="col">Almacenes</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody class="subclient" id="dynamic-row">
            </tbody>
        </table>
        <!-- End Table with hoverable rows SubClient -->
        <!-- SubClient End -->
    </div>
</div>
<div class="card" style="margin-top: 4%;">
    <div class="card-body">
        <!-- Site -->
        <!-- Button trigger modal -->
        <h5 class="card-title">Sitios<button type="button" class="btn sitemodel" ><i class="ri-add-line"></i></button></h5>
        <div id="success_messageQ"></div>
        <!-- Modal Site Create -->
        <div class="modal fade" id="SiteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Crear sitio</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="formulario" method="POST">
                        <div class="modal-body">
                            <ul id="saveform_errListQ"></ul>
                            @csrf
                            <div class="col-12">
                                <label for="identifierSite" class="form-label">Codigo</label>
                                <input type="text" class="form-control identifierSite" id="identifierSite" name="identifierSite">
                            </div>
                            <div class="col-12">
                                <label for="nameSite" class="form-label">Sitios</label>
                                <input type="text" class="form-control nameSite" id="nameSite" name="nameSite">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn guardarSit" style="background-color: #5daadd; color: white;">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- End Modal Site Create-->

        <!-- Modal Site Edit -->
        <div class="modal fade" id="EditSiteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Editar sitio</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="formulario" method="POST">
                        <div class="modal-body">
                            <ul id="updateform_errListQ"></ul>
                            <input type="hidden" id="edit_site_idQ">
                            @csrf
                            <div class="col-12">
                                <label for="identifierSite" class="form-label">Codigo</label>
                                <input type="text" class="form-control identifierSite" id="edit_identifierSite" name="identifierSite">
                            </div>
                            <div class="col-12">
                                <label for="nameSite" class="form-label">Sitios</label>
                                <input type="text" class="form-control nameSite" id="edit_nameSite" name="nameSite">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn editarSit" style="background-color: #5daadd; color: white;">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- End Modal Site Edit-->

        <!-- Modal Site Delete-->
        <div class="modal fade" id="DeleteSiteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Eliminar sub-cliente</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="delete_site_id">
                        <h3>¿Esta seguro que desea eliminar este registro?</h3>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-danger eliminarSit">Si, eliminar</button>
                    </div>
                </div>
            </div>
        </div><!-- End Modal Site Delete-->

        <!-- Table with hoverable rows SubClient -->
        <table class="table table-hover">
            <input type="search" class="form-control" id="search" class="search" name="search" placeholder="Buscar">    
            <thead>
                <tr>
                    <th scope="col">Codigos</th>
                    <th scope="col">Sitios</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody class="sites" id="table-row">
            </tbody>
        </table>
        <!-- End Table with hoverable rows SubClient -->
        <!-- Site End -->
    </div>
</div>
    

@endsection

@section('scripts')

<!-- Script Ajax -->
    <script>
        $(document).ready(function(){
            /* CLIENT */
            fetchinfoclient();
            fetchsubclient();
            fetchsite();
            /* funcion para mostrar en una tabla los datos de la tabla */
            function fetchinfoclient()
            {
                var client_id = $('#client_id').val();
                $.ajax({
                    type: "GET",
                    url: "/fetch-info/"+client_id,
                    dataType: "json",
                    success:function(response){
                        console.log(response.clientinfo);
                        $('.infoCard').html("");
                        $.each(response.clientinfo, function(key, item) {
                            $('.infoCard').append('\
                                <form action="{{ url('/infoClient/'.$infoClient->id) }}" method="POST">\
                                   <div class="view_imag"><img src="{{asset('storage/img/'.$infoClient->imageClient)}}" class="img-fluid rounded-start" alt="Imagen Cliente" >\</div>\
                                </form>\
                                <section id="sect_d">\
                                    <div>\
                                        <label for="nameSite" class="form-label">Cliente</label>\
                                        <input type="text" value="'+item.nameClient+'" class="form-control" style="width: 18em;margin-bottom: 10%;" disabled>\
                                        <label for="nameSite" class="form-label">Telefono</label>\
                                        <input type="text" value="'+item.phoneClient+'" class="form-control" style="width:18em;" disabled>\
                                    </div>\
                                    <div>\
                                        <label for="nameSite" class="form-label">Correo electronico</label>\
                                        <input type="text" value="'+item.mailClient+'" class="form-control" style="width: 18em;margin-bottom: 10%;" disabled>\
                                        <label for="nameSite" class="form-label">Tipo cliente</label>\
                                        <input type="text" value="'+item.typeClient+'" class="form-control" style="width:18em;" disabled>\
                                    </div>\
                                </section>\
                            </div>')
                        });
                    }
                });
            }
            /* CLIENT END */

            /* SUBCLIENT */
            fetchinfoclient();
            fetchsubclient();
            fetchsite();
            /* funcion para mostrar en una tabla los datos de la tabla */
            function fetchsubclient()
            {
                var client_id = $('#client_id').val();
                $.ajax({
                    type: "GET",
                    url: "/fetch-subclient/"+client_id,
                    dataType: "json",
                    success:function(response){
                        console.log(response.subclient);
                        $('.subclient').html("");
                        $.each(response.subclient, function(key, item) {
                            $('.subclient').append('<tr>\
                                <td>'+item.identifierSubClient+'</td>\
                                <td>'+item.nameSite+'</td>\
                                <td>'+item.direction+'</td>\
                                <td><button type="button" value="'+item.id+'" class="btn editSubClient" style="background-color: #848688; color: white;"><i class="ri-edit-line"></i></button></a>\
                                    <button type="button" value="'+item.id+'" class="btn btn-danger deleteSubClient"><i class="ri-delete-bin-7-line"></i></button></a></td>\
                                </tr>')
                        });
                    }
                });
            }

            /* evento para crear un registro */
            $(document).on('click','.guardarSub', function(e){
                e.preventDefault();
                //console.log(data);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "/subclient",
                    data: {
                        'client_id': $('.client_id').val(),
                        'identifierSubClient': $('.identifierSubClient').val(), 
                        'site_id': $('.site_id').val(), 
                        'warehouse_id': $('.warehouse_id').val(),
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

                            fetchinfoclient();
                            fetchsubclient();
                            fetchsite();
                        }
                    }
                });
            });

            /* abrir modal de editar sub-cliente*/
            $(document).on('click','.editSubClient', function(e){
                e.preventDefault();
                var subClient_id = $(this).val();
                console.log(subClient_id);
                $('#EditSubClientModal').modal('show')

                $.ajax({
                    type: "GET",
                    url: "/edit-subClient/"+subClient_id,
                    success:function(response){
                        console.log(response);
                        if (response.status == 404) 
                        {
                            $('success_message').html("");
                            $('success_message').addClass('alert alert-danger');
                            $('success_message').text(response.message);
                        }
                        else
                        {
                            $('#edit_identifierSubClient').val(response.subClient.identifierSubClient);
                            $('#edit_subClient_id').val(subClient_id);
                        }
                    }
                });
            });
            
            /* evento para editar */
            $(document).on('click','.editarSub', function(e){
                e.preventDefault();

                var subClient_id = $('#edit_subClient_id').val();
                var data = {
                    'client_id': $('.client_id').val(),
                    'identifierSubClient':$('#edit_identifierSubClient').val(),
                    'site_id':$('#edit_site_id').val(),
                    'warehouse_id':$('#edit_warehouse_id').val(),
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "PUT",
                    url: "/update-subClient/"+subClient_id,
                    data: data,
                    dataType: "json",
                    success:function(response){
                        console.log(response);
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
                            $('#EditSubClientModal').modal('hide');
                            $(".editar").text("Actualizar");

                            fetchinfoclient();
                            fetchsubclient();
                            fetchsite();
                        }
                    }
                });
            });

            /* eliminar un campo de la base de datos */
            $(document).on('click','.deleteSubClient', function(e){
                e.preventDefault();
                var subClient_id = $(this).val();
                //alert(uniMeasurement_id);
                $('#delete_subClient_id').val(subClient_id);
                $('#DeleteSubClientModal').modal('show');
            });

            /* evento para eliminar */
            $(document).on('click','.eliminarSub', function(e){
                e.preventDefault();

                var subClient_id = $('#delete_subClient_id').val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "DELETE",
                    url: "/delete-subClient/"+subClient_id,
                    success:function(response){
                        //console.log(response);
                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text(response.message);
                        $('#DeleteSubClientModal').modal('hide');
                        $(".eliminar").text("Si, Eliminar");

                        fetchinfoclient();
                        fetchsubclient();
                        fetchsite();
                    }
                });
            });
            /* SUBCLIENT END */

            /* SITE */
            fetchinfoclient();
            fetchsubclient();
            fetchsite();
            /* funcion para mostrar en una tabla los datos de la tabla */
            function fetchsite()
            {
                var client_id = $('#client_id').val();
                $.ajax({
                    type: "GET",
                    url: "/fetch-site/"+client_id,
                    dataType: "json",
                    success:function(response){
                        //console.log(response.cities);
                        $('.sites').html("");
                        $.each(response.site, function(key, item) {
                            $('.sites').append('<tr>\
                                <td>'+item.identifierSite+'</td>\
                                <td>'+item.nameSite+'</td>\
                                <td><a href="/site/'+item.id+'/edit"><button type="button" value="'+item.id+'" class="btn" style="background-color: #5daadd;"><i class="bi bi-info-circle"></i></button></a>\
                                    <button type="button" value="'+item.id+'" class="btn editSite" style="background-color: #848688; color: white;"><i class="ri-edit-line"></i></button>\
                                    <button type="button" value="'+item.id+'" class="btn btn-danger deleteSite"><i class="ri-delete-bin-7-line"></i></button></td>\
                                </tr>')
                        });
                    }
                });
            }

            /* abrir modal de crear sitios */
            $(document).on('click','.sitemodel', function(e){
                e.preventDefault();
                
                $('#SiteModal').modal('show');
            });

            /* evento para crear un registro */
            $(document).on('click','.guardarSit', function(e){
                e.preventDefault();
                //console.log(data);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "/site-info",
                    data: {
                        'identifierSite': $('.identifierSite').val(), 
                        'nameSite': $('.nameSite').val(), 
                        'client_id': $('.client_id').val(),
                    },
                    dataType: "json",
                    success:function(response){
                        console.log(response);
                        if(response.status == 400)
                        {
                            $('#saveform_errListQ').html("");
                            $('#saveform_errListQ').addClass('alert alert-danger');
                            $.each(response.errors, function(key, err_values) {
                                $('#saveform_errListQ').append('<li>'+err_values+'</li>')
                            });
                        }
                        else
                        {
                            $('#success_messageQ').html("");
                            $('#success_messageQ').addClass('alert alert-success');
                            $('#success_messageQ').text(response.message);
                            $('#SiteModal').modal('hide');
                            $('#SiteModal').find('input').val("");

                            fetchinfoclient();
                            fetchsubclient();
                            fetchsite();
                        }
                    }
                });
            });

            /* abrir modal de editar site*/
            $(document).on('click','.editSite', function(e){
                e.preventDefault();
                var site_idQ = $(this).val();
                console.log(site_idQ);
                $('#EditSiteModal').modal('show')

                $.ajax({
                    type: "GET",
                    url: "/edit-site/"+site_idQ,
                    success:function(response){
                        console.log(response);
                        if (response.status == 404) 
                        {
                            $('success_messageQ').html("");
                            $('success_messageQ').addClass('alert alert-danger');
                            $('success_messageQ').text(response.message);
                        }
                        else
                        {
                            $('#edit_identifierSite').val(response.site.identifierSite);
                            $('#edit_nameSite').val(response.site.nameSite);
                            $('#edit_site_idQ').val(site_idQ);
                        }
                    }
                });
            });
            
            /* evento para editar */
            $(document).on('click','.editarSit', function(e){
                e.preventDefault();

                var site_idQ = $('#edit_site_idQ').val();
                var data = {
                    'identifierSite':$('#edit_identifierSite').val(),
                    'nameSite':$('#edit_nameSite').val(),
                    'client_id': $('.client_id').val(),
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "PUT",
                    url: "/update-site/"+site_idQ,
                    data: data,
                    dataType: "json",
                    success:function(response){
                        console.log(response);
                        if (response.status == 400) 
                        {
                            //errors
                            $('#updateform_errListQ').html("");
                            $('#updateform_errListQ').addClass('alert alert-danger');
                            $.each(response.errors, function(key, err_values) {
                                $('#updateform_errListQ').append('<li>'+err_values+'</li>')
                            });
                            $(".editar").text("Actualizar");
                        } 
                        else if (response.status == 404) 
                        {
                            $('#updateform_errListQ').html("");
                            $('#success_messageQ').addClass('alert alert-success');
                            $('#success_messageQ').text(response.message);
                            $(".editarSub").text("Actualizar");
                        } 
                        else
                        {
                            $('#updateform_errListQ').html("");
                            $('#success_messageQ').html("");
                            $('#success_messageQ').addClass('alert alert-success');
                            $('#success_messageQ').text(response.message);
                            $('#EditSiteModal').modal('hide');
                            $(".editarSub").text("Actualizar");

                            fetchinfoclient();
                            fetchsubclient();
                            fetchsite();
                        }
                    }
                });
            });

            /* eliminar un campo de la base de datos */
            $(document).on('click','.deleteSite', function(e){
                e.preventDefault();
                var site_idQ = $(this).val();
                //alert(uniMeasurement_id);
                $('#delete_site_id').val(site_idQ);
                $('#DeleteSiteModal').modal('show');
            });

            /* evento para eliminar */
            $(document).on('click','.eliminarSit', function(e){
                e.preventDefault();

                var site_idQ = $('#delete_site_id').val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "DELETE",
                    url: "/delete-site/"+site_idQ,
                    success:function(response){
                        console.log(response);
                        $('#success_messageQ').addClass('alert alert-success');
                        $('#success_messageQ').text(response.message);
                        $('#DeleteSiteModal').modal('hide');
                        $(".eliminarSit").text("Si, Eliminar");

                        fetchinfoclient();
                        fetchsubclient();
                        fetchsite();
                    }
                });
            });
            /* SITE END */
        });
        //Live Search
        $('body').on('keyup', '#searchSubClient',function(){
            let searchQuest = $(this).val();

            $.ajax({
                method: 'POST',
                url: '{{ route("subclientSearch.action") }}',
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
                                <td>'+value.identifierSubClient+'</td>\
                                <td>'+value.nameSite+'</td>\
                                <td>'+value.direction+'</td>\
                                <td><button type="button" value="'+value.id+'" class="btn editSubClient" style="background-color: #848688; color: white;"><i class="ri-edit-line"></i></button></a>\
                                    <button type="button" value="'+value.id+'" class="btn btn-danger deleteSubClient"><i class="ri-delete-bin-7-line"></i></button></a></td>\
                                </tr>'
                    $('#dynamic-row').append(tableRow);
                    });

                }
            });
        })

        //Live Search Sites
        $('body').on('keyup', '#search',function(){
            let searchQuest = $(this).val();

            $.ajax({
                method: 'POST',
                url: '{{ route("siteSearch.siteSearch") }}',
                dataType: 'json',
                data : {
                    '_token' : '{{ csrf_token() }}',
                    searchQuest: searchQuest
                },
                success:function(res){
                    let tableRow = '';
                    $('#table-row').html('');
                    $.each(res, function(index, value){
                        tableRow= '<tr>\
                                <td>'+value.identifierSite+'</td>\
                                <td>'+value.nameSite+'</td>\
                                <td><a href="/site/'+value.id+'/edit"><button type="button" value="'+value.id+'" class="btn" style="background-color: #5daadd;"><i class="bi bi-info-circle"></i></button></a>\
                                    <button type="button" value="'+value.id+'" class="btn editSite" style="background-color: #848688; color: white;"><i class="ri-edit-line"></i></button>\
                                    <button type="button" value="'+value.id+'" class="btn btn-danger deleteSite"><i class="ri-delete-bin-7-line"></i></button></td>\
                                </tr>'
                    $('#table-row').append(tableRow);
                    });

                }
            });
        })
    </script>
@endsection