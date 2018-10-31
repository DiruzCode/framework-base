@extends('admin.layout')

@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
          <div class="clearfix"></div>
            <div class="x_panel">
                <div class="x_title">
                    <h2>Control Acceso <small>Role / Editar</small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    {!! Form::model($model, [
                        'route'     => ['admin::roles.update', $model->id],
                        'method'    => 'patch',
                        'class'     => 'form-horizontal form-label-left',
                        'role'      => 'form',
                        'id'        => 'formEditRoles'
                    ]) !!}

                    @include('admin.roles.includes.form')

                    @include('admin.includes.form_buttons')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->
@stop
