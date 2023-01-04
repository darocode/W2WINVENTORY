
    <!DOCTYPE html>
    <html>
    <head>
        <title>Calendar Inovastock</title>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        
        <link rel="stylesheet" href="{{ asset('css/calendar.css') }}">
        <link href="{{ asset('W2WInventory/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
        
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="description">
        <meta content="" name="keywords">
        
        <!-- Favicons -->
        <link href="{{ asset('W2WInventory/assets/img/W2WInventoryIcon.png') }}" rel="icon">
        <link href="{{ asset('W2WInventory/assets/img/W2WInventoryIcon.png') }}" rel="apple-touch-icon">

        <!-- Google Fonts -->
        <link href="https://fonts.gstatic.com" rel="preconnect">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

        <!-- Vendor CSS Files -->
        <link href="{{ asset('W2WInventory/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('W2WInventory/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
        <link href="{{ asset('W2WInventory/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
        <link href="{{ asset('W2WInventory/assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
        <link href="{{ asset('W2WInventory/assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
        <link href="{{ asset('W2WInventory/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
        <link href="{{ asset('W2WInventory/assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

        <!-- Template Main CSS File -->
        <link href="{{ asset('W2WInventory/assets/css/style.css') }}" rel="stylesheet">

        <!-- CSRF token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>

    <body>
        <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="{{ url('home') }}" class="logo d-flex align-items-center">
        <img src="{{ asset('W2WInventory/assets/img/W2WInventoryIcon.png') }}" alt="">
        <span class="d-none d-lg-block">W2W Inventory</span> 
        
      </a>
     
    </div><!-- End Logo -->   

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <span class="d-none d-md-block dropdown-toggle ps-2"> {{ Auth::user()->name }}</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6> {{ Auth::user()->name }}</h6>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-person"></i>
                <span>Mi perfil</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{ route('login') }}"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">                
                <i class="bi bi-box-arrow-right"></i>                
                Cerrar sesión
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

        @if(Session::has('message'))

                <div class="alert alert-success alert-dismissible" role="alert">
                        {{ Session::get('message') }}
                </div>

            @endif
    <nav style="display: flex; justify-content: end;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/home">Inicio</a></li>
            <li class="breadcrumb-item active">Calendario</li>
        </ol>
    </nav>
    <div class="container">
        <div id="calendar"></div>

        <!-- Modal -->
        <div class="modal fade" id="evento" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        
                        <h5 id="h5" class="modal-title" id="staticBackdropLabel">Crear evento</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <div class="modal-body">
                            <form action="{{route('event.store') }}"method="post">
                                @csrf
                                <div class="col-12">
                                    <label for="title" class="form-label">Titulo</label>
                                    <input type="text" class="form-control" id="title" name="title[]">
                                    <span id="titleError" class="text-danger"></span>
                                </div>
                                <div class="col-12">
                                    <label for="end_date" class="form-label">Fecha de fin</label>
                                    <input type="date" class="form-control" id="end_date" name="end_date[]">
                                    <span id="titleError" class="text-danger"></span>
                                </div>
                                <div class="col-12" id='event_min'>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input checkinput" type="checkbox" checked id="openOptions">
                                        <label class="form-check-label" for="openOptions">Evento para mi</label>
                                        </div>
                                </div>
                                <div id="varios">
                                        <div class="col-12">
                                            <input type="hidden" id="user_id" name="user_id[]" value="{{ Auth::user()->id }}">  
                                            <span id="titleError" class="text-danger"></span>
                                            <!--table id="emptbl">
                                                <thead>
                                                    <tr>
                                                        <th>Nombre del Usuario</th>
                                                        
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td id="col0">
                                                            <select class="form-select form-select-sm" id="depl"  aria-label=".form-select-sm example" name='user_id[]'>
                                                                <option selected>Open this select menu</option>
                                                                @foreach ($users as $user)
                                                                <option value="{{ $user->id }}">{{ $user->name }}</option> 
                                                                @endforeach
                                                              </select>
                                                        </td>
                                                        
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <table-->
                            </form>
                                        
                                                        <!--<tr>
                                                            <td><button type="button" class="btn btn-sm btn-info" onclick="addRows()">Add</button></td>
                                                            <td><button type="button" class="btn btn-sm btn-danger" onclick="deleteRows()">Remove</button></td>
                                                        </tr>-->
                                                    </table>
                                                    
                                                    
                                                </div>
                                            
                                            
                                        </div>
                        
                        </div>
                    
                    <div class="modal-footer">
                        <input type="button" class="btn btn-success " id="btnGuardar" value="Guardar">

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Vendor JS Files -->
    <script src="{{ asset('W2WInventory/assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('W2WInventory/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('W2WInventory/assets/vendor/chart.js/chart.min.js') }}"></script>
  <script src="{{ asset('W2WInventory/assets/vendor/echarts/echarts.min.js') }}"></script>
  <script src="{{ asset('W2WInventory/assets/vendor/quill/quill.min.js') }}"></script>
  <script src="{{ asset('W2WInventory/assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
  <script src="{{ asset('W2WInventory/assets/vendor/tinymce/tinymce.min.js') }}"></script>
  <script src="{{ asset('W2WInventory/assets/vendor/php-email-form/validate.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('W2WInventory/assets/js/main.js') }}"></script>

  <!-- Ajax Jquery -->
  <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.2/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="{{ asset('js/agenda.js') }}"></script>
    <script>
    $(document).ready(function () {

        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
            }
        });
        let booking = @json($events);
        $('#calendar').fullCalendar({
            header:{
                left:'prev, next today',
                center:'title',
                right: ''
            },
            events: booking,
            selectable: true,
            selectHelper: true,
            select: function(start, end, allDays){
                $('#evento').modal('toggle');
                $('#btnGuardar').click(function(){
                    let title = $('#title').val();
                    let start_date = moment(start).format('YYYY-MM-DD');
                    let end_date = moment(end).format('YYYY-MM-DD');
                    let user_id = $('#user_id').val();
                    let event_id = $('#event_id').val();
                
                    $.ajax({
                        url:"{{ route('event.store') }}",
                            type:"POST",
                            dataType:'json',
                            data:{ title, start_date, end_date, user_id, event_id},
                            success:function(data){
                                $('#evento').modal('hide');
                                $('#calendar').fullCalendar('renderEvent', {
                                    title: data.title,
                                    start_date : data.start,
                                    end_date  : data.end,
                                    user_id : data.user_id,
                                    event_id : data.event_id
                                });
                                location.reload();
                            },
                            error:function(error){
                                if(error.responseJSON.errors){
                                    $('#titleError').html(error.responseJSON.errors.title);
                                }
                            }
                    });

                });
            },
            editable: true,
            eventDrop: function(event) {
                    var id = event.id;
                    var start_date = moment(event.start).format('YYYY-MM-DD');
                    var end_date = moment(event.end).format('YYYY-MM-DD');
                    $.ajax({
                            url:"{{ route('event.update', '') }}" +'/'+ id,
                            type:"PATCH",
                            dataType:'json',
                            data:{ start_date, end_date  },
                            success:function(response)
                            {
                                swal("Evento Actualizado!", "Se ha actualizado el evento!", "success");
                            },
                            error:function(error)
                            {
                                console.log(error)
                            },
                        });
                },
                eventClick: function(event){
                    var id = event.id;
                    if(confirm('Are you sure want to remove it')){
                        $.ajax({
                            url:"{{ route('event.destroy', '') }}" +'/'+ id,
                            type:"DELETE",
                            dataType:'json',
                            success:function(response)
                            {
                                $('#calendar').fullCalendar('removeEvents', response);
                                // swal("Good job!", "Event Deleted!", "success");
                            },
                            error:function(error)
                            {
                                console.log(error)
                            },
                        });
                    }
                },
                selectAllow: function(event)
                {
                    return moment(event.start).utcOffset(false).isSame(moment(event.end).subtract(1, 'second').utcOffset(false), 'day');
                },
            });
            $("#evento").on("hidden.bs.modal", function () {
                $('#btnGuardar').unbind();
            });

    });
    </script>
</body>
</html>