@extends('admin.layout')

@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="clearfix"></div>
              <div class="x_panel">
                  <div class="x_title">
                      <h2>Control Acceso <small>Permiso / Editar</small></h2>
                      <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      {!! Form::model($model, [
                          'route'     => ['admin::permissions.update', $model->id],
                          'method'    => 'patch',
                          'class'     => 'form-horizontal form-label-left',
                          'role'      => 'form',
                          'id'        => 'formEditPermissions',
                          'enctype'   => 'multipart/form-data'
                      ]) !!}

                      @include('admin.permissions.includes.form')

                      @include('admin.includes.form_buttons')

                      {!! Form::close() !!}
                  </div>
              </div>
        </div>
    </div>
    <!-- /page content -->
@stop
