<div class="form-group row{{ $errors->has('display_name') ? ' has-error' : '' }}">
    {{ Form::label('display_name', 'Nombre *', ['class' => 'control-label col-md-2 col-sm-2 col-xs-10']) }}

    <div class="col-md-6 col-sm-6 col-xs-8">
        {{ Form::text('display_name', null, ['class' => 'form-control', 'id' => 'display_name', 'maxlength' => 250, 'placeholder' => 'Nombre']) }}

        @if ($errors->has('display_name'))
        <span class="text-danger">
            <strong>{{ $errors->first('display_name') }}</strong>
        </span>
        @endif
    </div>
</div>
<div class="form-group row{{ $errors->has('name') ? ' has-error' : '' }}">
    {{ Form::label('name', 'Codigo *', ['class' => 'control-label col-md-2 col-sm-2 col-xs-10']) }}

    <div class="col-md-6 col-sm-6 col-xs-8">
        {{ Form::text('name', null, ['class' => 'form-control', 'readonly' => 'true', 'id' => 'name', 'maxlength' => 250, 'placeholder' => 'Codigo']) }}


        @if ($errors->has('name'))
        <span class="text-danger">
            <strong>{{ $errors->first('name') }}</strong>
        </span>
        @endif
    </div>
</div>


<div class="form-group row{{ $errors->has('description') ? ' has-error' : '' }}">
    {{ Form::label('description', 'Descripción', ['class' => 'control-label col-md-2 col-sm-2 col-xs-10']) }}

    <div class="col-md-6 col-sm-6 col-xs-8">
        {{ Form::text('description', null, ['class' => 'form-control', 'id' => 'description', 'maxlength' => 250, 'placeholder' => 'Descripción']) }}

        @if ($errors->has('description'))
        <span class="text-danger">
            <strong>{{ $errors->first('description') }}</strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group row {{ $errors->has('permission_id') ? ' has-error' : '' }}">
    {{ Form::label('role_id', 'Roles *', ['class' => 'control-label col-md-2 col-sm-2 col-xs-10']) }}

    <div class="col-md-6 col-sm-6 col-xs-8">
        {{ Form::select('role_id[]', $roles, $role_id, [
            'class'             => 'select2 form-control',
            'id'                => 'role_id',
            'multiple'          => 'true',
            'style'             => 'width: 100%',
        ]) }}
        @if ($errors->has('role_id'))
            <span class="text-danger">
                <strong>{{ $errors->first('role_id') }}</strong>
            </span>
        @endif
    </div>
</div>

{{ Form::hidden('page', $page) }}

@section('js-scripts')
    <script>

      function refreshSelects(){
        $("#role_id").css({width:'100%'}).select2({
            allowClear: true,
            placeholder: {
                id: '',
                text: 'Seleccione una opción...'
            },
            minimumResultsForSearch: 6      // minima cantidad de opciones para habilitar el buscador
        });
      }
      $(document).ready(function() {
        refreshSelects();

        // SLUG / Código
        $('#display_name').blur(function(event){
            $.get('/admin/roles/slug/'+$('#display_name').val(), function(data){
                $('#name').val(data.slug);
            });
        });

      });
    </script>
@stop
