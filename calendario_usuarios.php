

<!doctype html>
  <html lang="es">

  <head>
    <title>Agendacion de citas</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- css- -->
    <link rel="stylesheet" href="estilos/bootstrap-clockpicker.css">
    <link rel="stylesheet" href="estilos/bootstrap.min.css">
    <link rel="stylesheet" href="estilos/cdn.datatables.net_v_dt_dt-1.13.6_datatables.min.css">
    <link rel="stylesheet" href="fullcalendar/main.css">
    <link rel="shortcut icon" href="imagenes/logo.png" type="image/x-icon">

    <!-- scripts -->
    <script src="js/code.jquery.com_jquery-3.7.1.min.js" ></script>
    <script src="js/popper.min.js" ></script>
    <script src="js/bootstrap-clockpicker.js" ></script>
    <script src="js/bootstrap.min.js" ></script>
    <script src="js/cdn.datatables.net_v_dt_dt-1.13.6_datatables.min.js" ></script>
    <script src="js/momentjs.com_downloads_moment-with-locales.js" ></script>
    <script src="fullcalendar/main.js" ></script>
  </head>

  <body>
  <div class="conteiner" style="margin: 20px 10px 10px">
    <button type="submit" id="BotonRegresar" class="btn btn-success">Regresar</button>
  </div>

    <div class="container-fluid">
      <section class="content-header">
        <h1>Calendario<br>
          <small>Panel de Control</small>
        </h1>
      </section>
      <div class="row">
        <div class="col-12">
          <div id="calendar" style="border: 1px solid #000; padding: 2px"></div>
        </div>
        
          
            <div id="listaeventospredefinidos">
              
              


            </div>
          </div>
          <hr>

        </div>
      </div>
    </div>

    <!-- formulario de eventos -->
    <div class="modal fade" id="FormularioEventos" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">x</span>
            </button>

          
          </div>
          
          <div class="modal-body" >
            <input type="hidden" id="Id">

            <div class="form-row">
              <div class="form-group col-md-12">
                <label>Titulo del evento: </label>
                <input type="text" id="Titulo" class="form-control" placeholder="">
              </div>
            </div>

            <div class="form-row">
              <div class="foor-group col-md-6">
                <label>Fecha de inicio: </label>
                <div class="input-group" data-autoclose="true">
                  <input type="date" id="FechaInicio" class="form-control" value="">

                </div>
              </div>
              <div class="foor-group col-md-6" id="TituloHoraInicio">
                <label>Hora de inicio: </label>
                <div class="input-group" data-autoclose="true">
                  <input type="time" id="HoraInicio" class="form-control" autocomplete="off">
                </div>
              </div>
            </div>

            <div class="form-row">
              <div class="foor-group col-md-6">
                <label>Fecha de fin: </label>
                <div class="input-group" data-autoclose="true">
                  <input type="date" id="FechaFin" class="form-control" value="">

                </div>
              </div>
              <div class="foor-group col-md-6" id="TituloHoraFin">
                <label>Hora de fin: </label>
                <div class="input-group" data-autoclose="true">
                  <input type="time" id="HoraFin" class="form-control" autocomplete="off">
                </div>
              </div>
            </div>


            <div class="form-row">
              <label>Descripcion: </label>
              <textarea id="Descripcion" class="form-control" rows="3"></textarea>
            </div>
            <div class="form-row">
              <label>Color de fondo:</label>
              <input type="color" value="#0fff00" id="ColorFondo" class="form-control" style="height: 36px;">
            </div>
            <div class="form-row">
              <label>Color de texto:</label>
              <input type="color" value="#000000" id="ColorTexto" class="form-control" style="height: 36px;">
            </div>
          </div>


          <div class="modal-footer">
            <button type="button" id="BotonAgregar" class="btn btn-success">Agregar</button>
            <button type="button" id="BotonModificar" class="btn btn-success">Modificar</button>
            <button type="button" id="BotonBorrar" class="btn btn-success">Borrar</button>
            <button type="button"  class="btn btn-success" data-bs-dismiss="modal">Cancelar</button>
          </div>
        </div>
      </div>
    </div>
    <script>

  //script del calendario

document.addEventListener("DOMContentLoaded", function() {
  new FullCalendar.Draggable(document.getElementById('listaeventospredefinidos'), {
    itemSelector: '.fc-event',
    eventData: function(eventEl){
      return{
        title: eventEl.innerText.trim()
      }
    }
  });

      var calendarEl = document.getElementById('calendar');
      var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'es',
        headerToolbar: {
          left: 'dayGridMonth,timeGridWeek,timeGridDay',
          center: 'title',
          right: 'today prev,next'
        },
        droppable: true,
        editable: true,
        height: 800,

        events: 'config/datos_eventos.php?accion=listar',
        dateClick: function(info){
          limpiarformulario();
          $("#BotonAgregar").show();
          $("#BotonModificar").hide();
          $("#BotonBorrar").hide();

          if (info.allDay) {
            $("#FechaInicio").val(info.dateStr);
            $("#FechaFin").val(info.dateStr);
          } else {
            let fechaHora = info.dateStr.split("T");
            $('#FechaInicio').val(fechaHora[0]);
            $('#FechaFin').val(fechaHora[0]);
            $('#HoraInicio').val(fechaHora[1].substring(0,5));
          }
          $("#FormularioEventos").modal('show');
        },
        eventClick: function(info) {
          $("#BotonAgregar").hide();
          $("#BotonModificar").show();
          $("#BotonBorrar").show();

          $('#Id').val(info.event.id);
          $('#Titulo').val(info.event.title);
          $('#Descripcion').val(info.event.extendedProps.descripcion);
          $('#FechaInicio').val(moment(info.event.start).format("YYYY-MM-DD"));
          $('#FechaFin').val(moment(info.event.end).format("YYYY-MM-DD"));
          $('#HoraInicio').val(moment(info.event.start).format("HH:mm"));
          $('#HoraFin').val(moment(info.event.end).format("HH:mm"));
          $('#ColorFondo').val(info.event.backgroundColor);
          $('#ColorTexto').val(info.event.textColor);

          $("#FormularioEventos").modal('show');
        },
        
        eventResize: function(info){
          $('#Id').val(info.event.id);
          $('#Titulo').val(info.event.title);
          $('#Descripcion').val(info.event.extendedProps.descripcion);
          $('#FechaInicio').val(moment(info.event.start).format("YYYY-MM-DD"));
          $('#FechaFin').val(moment(info.event.end).format("YYYY-MM-DD"));
          $('#HoraInicio').val(moment(info.event.start).format("HH:mm"));
          $('#HoraFin').val(moment(info.event.end).format("HH:mm"));
          $('#ColorFondo').val(info.event.backgroundColor);
          $('#ColorTexto').val(info.event.textColor);
          let registro = recuperarDatosFormulario();
          modificarRegistro(registro);
        },
        eventDrop: function(info){
          $('#Id').val(info.event.id);
          $('#Titulo').val(info.event.title);
          $('#Descripcion').val(info.event.extendedProps.descripcion);
          $('#FechaInicio').val(moment(info.event.start).format("YYYY-MM-DD"));
          $('#FechaFin').val(moment(info.event.end).format("YYYY-MM-DD"));
          $('#HoraInicio').val(moment(info.event.start).format("HH:mm"));
          $('#HoraFin').val(moment(info.event.end).format("HH:mm"));
          $('#ColorFondo').val(info.event.backgroundColor);
          $('#ColorTexto').val(info.event.textColor);
          let registro = recuperarDatosFormulario();
          modificarRegistro(registro);
        },
        drop: function(info){
          limpiarformulario();
          $('#ColorFondo').val(info.draggedEl.dataset.colorfondo);
          $('#ColorTexto').val(info.draggedEl.dataset.colortexto);
          $('#Titulo').val(info.draggedEl.dataset.titulo);
          let fechaHora = info.dateStr.split("T");
          $('#FechaInicio').val(fechaHora[0]);
          $('#FechaFin').val(fechaHora[0]);
          if (info.allDay) {
            $('#HoraInicio').val(info.draggedEl.dataset.horainicio);
            $('#HoraFin').val(info.draggedEl.dataset.horafin);
          }else{
            $('#HoraInicio').val(fechahora[1].substring(0,5));
            $('#HoraFin').val(moment(fechahora[1].substring(0,5)).add(1,'hours'));
          }
          let registro = recuperarDatosFormulario();
          agregrarEventoPredefinido(registro);
        }
      });
      calendar.render();

      //eventos de botones de la app

      $('#BotonRegresar').click(function(){
        window.location = 'home_usuarios.php'
      });

      $('#BotonAgregar').click(function(){
        let registro = recuperarDatosFormulario();
        agregrarRegistro(registro);
        $('#FormularioEventos').modal('hide');
      });

      $('#BotonModificar').click(function(){
        let registro = recuperarDatosFormulario();
        modificarRegistro(registro);
        $('#FormularioEventos').modal('hide');
      });
      
      $('#BotonBorrar').click(function(){
        let registro = recuperarDatosFormulario();
        borrarRegistro(registro);
        $('#FormularioEventos').modal('hide');
      });

      
      $('#BotonEventosPredefinidos').click(function(){
        window.location = "eventos_predefinidos.html";
      });

      //funciones para comunicarse con el server AJAX!
      function agregrarRegistro(registro) {
        $.ajax({
          type: 'POST',
          url: 'config/datos_eventos.php?accion=agregar',
          data: registro,
          success: function(msg){
            calendar.refetchEvents();
          },
          error: function(error){
            alert("Hubo un error al agregar el evento: " + error);
          }
        });
      }

      function modificarRegistro(registro) {
        $.ajax({
          type: 'POST',
          url: 'config/datos_eventos.php?accion=modificar',
          data: registro,
          success: function(msg) {
            calendar.refetchEvents();
          },
          error: function(error) {
            console.log("Error al modificar un evento:", error);
            alert("Hay un problema al modificar un evento:" + error);
          }
        });
      }

      function borrarRegistro(registro) {
        $.ajax({
          type: 'POST',
          url: 'config/datos_eventos.php?accion=borrar',
          data: registro,
          success: function(msg){
            calendar.refetchEvents();
          },
          error: function(error){
            alert("Hubo un error al borrar el evento: " + error);
          }
        });
      }

      function agregrarEventoPredefinido(registro) {
        $.ajax({
          type: 'POST',
          url: 'config/datos_eventos.php?accion=agregar',
          data: registro,
          success: function(msg){
            calendar.removeAllEvents();
            calendar.refetchEvents();
          },
          error: function(error){
            alert("Hubo un error al agregar el evento predefinido: " + error);
          }
        });
      }


      //funciones que interactuan con el formulario eventos
      function limpiarformulario(){
        $('#Id').val('');
        $('#Titulo').val('');
        $('#Descripcion').val('');
        $('#FechaFin').val('');
        $('#FechaInicio').val('');
        $('#HoraFin').val('');
        $('#HoraInicio').val('');
        $('#ColorFondo').val('#0fff00');
        $('#ColorTexto').val('#000000');
      }

      function recuperarDatosFormulario() {
        console.log('#Id:', $('#Id').val());
        console.log('#Titulo:', $('#Titulo').val());
        console.log('#Descripcion:', $('#Descripcion').val());
        let registro = {
          id: $('#Id').val(),
          titulo: $('#Titulo').val(),
          descripcion: $('#Descripcion').val(),
          inicio: $('#FechaInicio').val() + ' ' + $('#HoraInicio').val(),            
          fin: $('#FechaFin').val() + ' ' + $('#HoraFin').val(),
          colorfondo: $('#ColorFondo').val(),
          colortexto: $('#ColorTexto').val()
        };
        return registro;
      }

    });
    </script>

  </body>

  </html>