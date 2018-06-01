@extends('rrhh.layouts.backend')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/rrhh/fullcalendar.css') }}">
<!-- Custom CSS -->
    <style>
    body {
        padding-top: 70px;        
    }
	#calendar {
		max-width: 700px;
	}
	.col-centered{
		float: none;
		margin: 0 auto;
	}
    </style>
@endpush

@section('content')
    <div class="col-12">
        <h1>Calendario AVCA, Sucursal "{{ $sucursal->nombre}}"</h1>
        <p class="lead">Funcionalidad para agregar fechas y períodos feriados</p>
        <div id="calendar" class="col-centered">
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
        {{--  <form class="form-horizontal" method="POST" action="addEvent.php">  --}}
        <form class="form-horizontal" method="POST" action="{{ route('calendar.store') }}">
            @csrf
        
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Agregar Feriado</h4>
            </div>
            <div class="modal-body">
            
                <div class="form-group">
                <label for="title" class="col-sm-2 control-label">Título</label>
                <div class="col-sm-10">
                    <input type="text" name="title" class="form-control" id="title" placeholder="Título">
                </div>
                </div>
                <div class="form-group">
                <label for="color" class="col-sm-2 control-label">Color</label>
                <div class="col-sm-10">
                    <select name="color" class="form-control" id="color">
                        <option value="">Seleccionar</option>
                        <option value="#0071c5">&#9724; Azul oscuro</option>
                        <option value="#40E0D0">&#9724; Turquesa</option>
                        <option value="#008000">&#9724; Verde</option>						  
                        <option value="#FFD700">&#9724; Amarillo</option>
                        <option value="#FF8C00">&#9724; Naranja</option>
                        <option value="#FF0000">&#9724; Rojo</option>
                        <option value="#000">&#9724; Negro</option>
                    </select>
                </div>
                </div>
                <div class="form-group hide">
                <label for="start" class="col-sm-2 control-label">Fecha Inicial</label>
                <div class="col-sm-10">
                    <input type="text" name="start" class="form-control" id="start" readonly>
                </div>
                </div>
                <div class="form-group hide">
                <label for="end" class="col-sm-2 control-label">Fecha Final</label>
                <div class="col-sm-10">
                    <input type="text" name="end" class="form-control" id="end" readonly>
                </div>
                </div>
            
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
        </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
        <form class="form-horizontal" method="POST" action="{{ route('calendar.edit') }}">//editEventTitle.php">
            @csrf
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Modificar Feriado</h4>
            </div>
            <div class="modal-body">
            
                <div class="form-group">
                <label for="title" class="col-sm-2 control-label">Título</label>
                <div class="col-sm-10">
                    <input type="text" name="title" class="form-control" id="title" placeholder="Titulo">
                </div>
                </div>
                <div class="form-group">
                <label for="color" class="col-sm-2 control-label">Color</label>
                <div class="col-sm-10">
                    <select name="color" class="form-control" id="color">
                        <option value="">Seleccionar</option>
                        <option value="#0071c5">&#9724; Azul oscuro</option>
                        <option value="#40E0D0">&#9724; Turquesa</option>
                        <option value="#008000">&#9724; Verde</option>						  
                        <option value="#FFD700">&#9724; Amarillo</option>
                        <option value="#FF8C00">&#9724; Naranja</option>
                        <option value="#FF0000">&#9724; Rojo</option>
                        <option value="#000">&#9724; Negro</option>
                        
                    </select>
                </div>
                </div>
                <div class="form-group"> 
                    <div class="col-sm-offset-2 col-sm-10">
                        <div class="checkbox">
                        <label class="text-danger"><input type="checkbox" name="delete"> Eliminar Feriado</label>
                        </div>
                    </div>
                </div>
                
                <input type="hidden" name="id" class="form-control" id="id">
            
            
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
        </div>
        </div>
    </div>
@endsection

@push('scripts')    
	<script src="{{ asset('js/rrhh/moment.min.js') }}"></script>
	<script src="{{ asset('js/rrhh/fullcalendar/fullcalendar.min.js') }}"></script>
	<script src="{{ asset('js/rrhh/fullcalendar/fullcalendar.js') }}"></script>
	<script src="{{ asset('js/rrhh/fullcalendar/locale/es.js') }}"></script>    
    <script>
        $(document).ready(function() {
            var date = new Date();
            var yyyy = date.getFullYear().toString();
            var mm = (date.getMonth()+1).toString().length == 1 ? "0"+(date.getMonth()+1).toString() : (date.getMonth()+1).toString();
            var dd  = (date.getDate()).toString().length == 1 ? "0"+(date.getDate()).toString() : (date.getDate()).toString();
            
            $('#calendar').fullCalendar({
                header: {
                    language: 'es',
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,basicWeek,basicDay',

                },
                defaultDate: yyyy+"-"+mm+"-"+dd,
                editable: true,
                eventLimit: true, // allow "more" link when too many events
                selectable: true,
                selectHelper: true,
                select: function(start, end) {
                    
                    $('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
                    $('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
                    $('#ModalAdd').modal('show');
                },
                eventRender: function(event, element) {
                    element.bind('dblclick', function() {
                        $('#ModalEdit #id').val(event.id);
                        $('#ModalEdit #title').val(event.title);
                        $('#ModalEdit #color').val(event.color);
                        $('#ModalEdit').modal('show');
                    });
                },
                eventDrop: function(event, delta, revertFunc) { // si changement de position

                    edit(event);

                },
                eventResize: function(event,dayDelta,minuteDelta,revertFunc) { // si changement de longueur

                    edit(event);

                },
                events: [
                <?php foreach($events as $event): 
                
                    $start = explode(" ", $event['start']);
                    $end = explode(" ", $event['end']);
                    if($start[1] == '00:00:00'){
                        $start = $start[0];
                    }else{
                        $start = $event['start'];
                    }
                    if($end[1] == '00:00:00'){
                        $end = $end[0];
                    }else{
                        $end = $event['end'];
                    }
                ?>
                    {
                        id: '<?php echo $event['id']; ?>',
                        title: '<?php echo $event['title']; ?>',
                        start: '<?php echo $start; ?>',
                        end: '<?php echo $end; ?>',
                        color: '<?php echo $event['color']; ?>',
                    },
                <?php endforeach; ?>
                ]
            });
            
            function edit(event){
                start = event.start.format('YYYY-MM-DD HH:mm:ss');
                if(event.end){
                    end = event.end.format('YYYY-MM-DD HH:mm:ss');
                }else{
                    end = start;
                }
                
                id =  event.id;
                
                Event = [];
                Event[0] = id;
                Event[1] = start;
                Event[2] = end;
                
                $.ajax({
                url: '/rrhh/backend/sucursal/editar-evento-calendario',//editEventDate.php',
                type: "POST",
                data: {Event:Event},
                success: function(rep) {
                        if(rep == 'OK'){
                            alert('Evento se ha guardado correctamente');
                        }else{
                            alert('No se pudo guardar. Inténtalo de nuevo.'); 
                        }
                    }
                });
            }
            
        });
    </script>
@endpush
