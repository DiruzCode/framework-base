<div class="left_col scroll-view">
    <div class="navbar nav_title" style="border: 0;">
        <a href="/admin/dashboard" class="site_title">
            <i class="fa fa-cubes"></i>
            <span>Administración</span>
        </a>
    </div>

    <div class="clearfix"></div>

    <br />

    <!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
        <div class="menu_section">
            <ul class="nav side-menu">
                <li>
                    <a>
                        <i class="fa fa-bar-chart"></i> Indicadores
                    </a>
                </li>
                <li>
                    <a>
                        <i class="fa fa-sliders"></i> Configuración
                        <span class="fa fa-chevron-down"></span>
                    </a>
                </li>
                @can('ver-modulos-plataforma')

                <li>
                    <a>
                        <i class="fa fa-group"></i> Control de acceso <span class="fa fa-chevron-down"></span>
                    </a>
                    <ul class="nav child_menu">
                        <!-- INIT CONTROL DE  ACCESOS -->
                        <li><a href="{{ route('admin::users.index') }}">Usuarios</a></li>
                        <li><a href="{{ route('admin::roles.index') }}">Roles</a></li>
                        <li><a href="{{ route('admin::permissions.index') }}">Permisos</a></li>
                        <!-- END CONTROL DE ACCESOS -->

                    </ul>
                </li>
                @endcan

            </ul>
        </div>
    </div>
    <!-- /sidebar menu -->
</div>
