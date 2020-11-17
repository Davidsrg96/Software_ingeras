<nav class="navbar navbar-expand-lg ">
    <div class="collapse navbar-collapse" >
        <ul class="navbar-nav mr-auto header">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Departamento</a>
                <div class="dropdown-menu">
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                </div>
            </li>
            <li class="nav-item header">
                <a class="nav-link" href="{{ route('departamentos.index') }}">Departamentos</a>
            </li>
            <li class="nav-item header">
                <a class="nav-link" href="#">Administracion</a>
            </li>
            <li class="nav-item header">
                <a class="nav-link" href="{{ route('usuarios.index') }}">Usuarios</a>
            </li>
            <li class="nav-item header">
                <a class="nav-link" href="{{ route('proyectos.index') }}">Proyectos</a>
            </li>
            <li class="nav-item header">
                <a class="nav-link" href="{{ route('solicitudes.index') }}">Solicitudes</a>
            </li>
            <li class="nav-item header">
                <a class="nav-link" href="{{ route('almacenamiento.index') }}" > Almacenes</a>
            </li>
            <li class="nav-item header">
                <a class="nav-link" href="{{ route('proveedores.index') }}">Proveedores</a>
            </li>
            <li class="nav-item header">
                <a class="nav-link" href="{{ route('bodega.index') }}" >Bodega</a>
            </li>
            <li class="nav-item header">
                <a class="nav-link" href="{{ route('preguntas.index') }}" >Preguntas</a>
            </li>
            <li class="nav-item header">
                <a class="nav-link" href="{{ route('tipo_usuario.index') }}" >Tipos de Usuarios</a>
            </li>
            <li class="nav-item header">
                <a class="nav-link" href="{{ route('cargos.index') }}" >Cargos</a>
            </li>
            <li class="nav-item header">
                <a class="nav-link" href="{{ route('trabajadores.index') }}" >Trabajadores</a>
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
