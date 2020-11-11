<nav class="navbar navbar-expand-lg ">
    <div class="collapse navbar-collapse" >
        <ul class="navbar-nav mr-auto header">
            <li class="nav-item header">
                <a class="nav-link" href="/admin/departamentos">Departamentos</a>
            </li>
            <li class="nav-item header">
                <a class="nav-link" href="#">Administracion</a>
            </li>
            <li class="nav-item header">
                <a class="nav-link" href="{{action('Usuario@index')}}">Usuarios</a>
            </li>
            <li class="nav-item header">
                <a class="nav-link" href="/proyectos">Proyectos</a>
            </li>
            <li class="nav-item header">
                <a class="nav-link" href="/solicitudes">Solicitudes</a>
            </li>
            <li class="nav-item header">
                <a class="nav-link" href="/admin/almacenamiento" > Almacenes</a>
            </li>
            <li class="nav-item header">
                <a class="nav-link" href="{{action('ProveedoresController@index')}}">Proveedores</a>
            </li>
            <li class="nav-item header">
                <a class="nav-link" href="{{action('BodegaController@index')}}" >Bodega</a>
            </li>
            <li class="nav-item header">
                <a class="nav-link" href="{{action('PreguntasController@index')}}" >Preguntas</a>
            </li>
            <li class="nav-item header">
                <a class="nav-link" href="{{action('TipoUsuarioController@index')}}" >Tipos de Usuarios</a>
            </li>
            <li class="nav-item header">
                <a class="nav-link" href="{{action('CargosController@index')}}" >Cargos</a>
            </li>
            <li class="nav-item header">
                <a class="nav-link" href="{{action('TrabajadoresController@index')}}" >Trabajadores</a>
            </li>
            <li class="nav-item header">
                <a class="nav-link" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</nav>
