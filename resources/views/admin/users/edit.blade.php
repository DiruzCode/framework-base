@extends('admin.layout')

@section('content')
    <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Control Acceso <small>Usuario / Editar</small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  {!! Form::model($model, [
                      'route'     => ['admin::users.update', $model->id],
                      'method'    => 'patch',
                      'class'     => 'form-horizontal form-label-left',
                      'role'      => 'form',
                      'id'        => 'formEditUser',
                      'enctype'   => 'multipart/form-data'
                  ]) !!}

                  @include('admin.users.includes.form')

                  @include('admin.includes.form_buttons')

                  {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop

@section('js-validation')
    {!! JsValidator::formRequest(\App\Http\Requests\UserRequest::class, '#formCreateUser') !!}
@stop
