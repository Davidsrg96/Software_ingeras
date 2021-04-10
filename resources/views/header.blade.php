<nav class="navbar navbar-expand-lg">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="main_nav">
        <ul class="navbar-nav">
            <li class="nav-header">
                <a class="navbar-brand font-weight-bold" href="{{ route('home.index') }}">Ingeras</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Administracion</a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">Usuario &raquo </a>
                     <ul class="submenu dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('usuarios.index') }}">
                            Usuarios
                        </a></li>
                        <li><a class="dropdown-item" href="{{ route('tipo_usuario.index') }}">
                          Tipos de Usuarios
                        </a></li>
                        <li><a class="dropdown-item" href="{{ route('cargos.index') }}">
                            Cargos
                        </a></li>
                     </ul>
                  </li>
                  <li><a class="dropdown-item" href="#">Departamento &raquo </a>
                     <ul class="submenu dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('departamentos.index') }}">
                            Departamentos
                        </a></li>
                        <li><a class="dropdown-item" href="">
                            Actividades
                        </a></li>
                     </ul>
                  </li>
                  <li><a class="dropdown-item" href="#">Almacenamiento &raquo </a>
                     <ul class="submenu dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('bodega.index') }}">
                            Bodegas
                        </a></li>
                        <li><a class="dropdown-item" href="{{ route('producto.index') }}">
                            Productos
                        </a></li>
                     </ul>
                  </li>
                  <li><a class="dropdown-item" href="{{ route('proveedores.index') }}">
                      Proveedores
                  </a>
                  <li><a class="dropdown-item" href="{{ route('trabajadores.index') }}">
                      Trabajadores
                  </a></li>
                </ul>
            </li>
             <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Abastecimiento</a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">Bodega &raquo </a>
                     <ul class="submenu dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('solicitudes.index')}}">
                          Solicitudes
                        </a></li>
                        <li><a class="dropdown-item" href="{{ route('despacho.listaBodegas')}}">
                          Enviar Producto
                        </a></li>
                     </ul>
                  </li>
                  <li><a class="dropdown-item" href="#">Producto &raquo </a>
                     <ul class="submenu dropdown-menu">
                        <li><a class="dropdown-item" href="#">
                          Ordenes de Compra
                        </a></li>
                        <li><a class="dropdown-item" href="{{ route('factura.index')}}">
                          Facturas
                        </a></li>
                     </ul>
                  </li>
                </ul>
            </li>
            <li class="nav-item"><a class="nav-link" href="{{ route('proyectos.index') }}">
                Proyectos
            </a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('solicitudes.index') }}">
                Solicitudes
            </a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('preguntas.index') }}">
                Preguntas
            </a></li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</nav>
