@extends('admin.layout')

@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2> <small>Nuevo / Usuario</small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    {!! Form::open([
                        'route'     => 'admin::users.store',
                        'method'    => 'post',
                        'class'     => 'form-horizontal form-label-left',
                        'role'      => 'form',
                        'id'        => 'formCreateUser'
                    ]) !!}

                    @include('admin.users.includes.form')

                    @include('admin.includes.form_buttons')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->
@stop

@section('js-validation')
    {!! JsValidator::formRequest(\App\Http\Requests\UserRequest::class, '#formCreateUser') !!}
@stop
