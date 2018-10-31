@extends('admin.layout')

@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Administrador de Roles</h2>
                      <ul class="nav navbar-right panel_toolbox">
                          <li>
                              <button type="button" class="btn btn-success" onclick="window.location='{{ route('admin::roles.create') }}';">Nuevo</button>
                          </li>
                      </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                      <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive">
                          <thead>
                              <tr>
                                  <th>ID</th>
                                  <th>Nombre</th>
                                  <th>Código</th>
                                  <th>Descripción</th>
                                  <th>Acciones</th>
                              </tr>
                          </thead>

                          <tbody>
                              @foreach ($items as $item)
                              <tr>
                                  <td>{{ $item->id }}</td>
                                  <td>{{ $item->name }}</td>
                                  <td>{{ $item->display_name }}</td>
                                  <td>{{ $item->description }}</td>
                                  <td>
                                  <a href="{{ route('admin::roles.edit', ['$roles' => $item->id, 'page' => $page]) }}" data-toggle="tooltip" data-placement="top" title="Editar" class="status-icons"><i class="fa fa-pencil-square-o fa-lg"></i></a>
                                  <a href="" data-toggle="tooltip" data-placement="top" title="Eliminar" class="status-icons eliminar-icon" data-id="{{$item->id}}"><i class="fa fa-trash-o fa-lg"></i></a>
                                  </td>
                              </tr>
                              @endforeach
                          </tbody>

                      </table>
                      @if($items->total() > 0)
                          <div class="row">
                              <div class="col-sm-4 text-muted font-13">Mostrando registros del {{$items->firstItem()}} al {{$items->lastItem()}} de {{$items->total()}}.</div>
                              <div class="col-sm-8 text-right">{{$items->appends(['search' => request('search')])->links()}}</div>
                          </div>
                      @endif
                </div>
            </div>
        </div>
    </div>
    {!! Form::open([
        'route'     => ['admin::roles.destroy','ID'],
        'method'    => 'delete',
        'role'      => 'form',
        'id'        => 'formDeleteRole'
    ]) !!}

    {!! Form::close() !!}
    <!-- /page content -->
@stop

@section('js-scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#datatable-responsive').DataTable({
                dom: 't',
                bDestroy: true,
                language: {
                    "sProcessing":     "Procesando...",
                    "sLengthMenu":     "Mostrar _MENU_ registros",
                    "sZeroRecords":    "No se encontraron resultados",
                    "sEmptyTable":     "Ningún dato disponible en esta tabla",
                    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix":    "",
                    "sSearch":         "Buscar:",
                    "sUrl":            "",
                    "sInfoThousands":  ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst":    "Primero",
                        "sLast":     "Último",
                        "sNext":     "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                }
            });

            $('.eliminar-icon').on('click', function(event){
                event.preventDefault();
                if (confirm('¿Seguro que desea eliminar el elemento?')) {
                    var action = $('#formDeleteRole').attr('action').replace('ID',$(this).data('id')) + '?page={{$page}}';
                    $('#formDeleteRole').attr('action', action);
                    $('#formDeleteRole').submit();
                }
            });
        });
    </script>
@stop
