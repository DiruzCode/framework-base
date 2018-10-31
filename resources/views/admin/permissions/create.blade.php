@extends('admin.layout')

@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2> <small>Nuevo / Permiso</small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    {!! Form::open([
                        'route'     => 'admin::permissions.store',
                        'method'    => 'post',
                        'class'     => 'form-horizontal form-label-left',
                        'role'      => 'form',
                        'id'        => 'formCreatePermissions'
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
