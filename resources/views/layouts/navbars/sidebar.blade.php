<div class="sidebar" data-color="orange">
  <!--
    Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
-->
  <div class="logo">
    <a href="{{ route('home') }}" class="simple-text logo-normal text-center">
      {{ __('Ingeras') }}
    </a>
  </div>
  <div class="sidebar-wrapper" id="sidebar-wrapper">
    <ul class="nav">
      <div class="subtitulo-div">
        <p class="text-center subtitulo-nav">
          {{ __('Administración') }}
        </p>
      </div>
      <li>
        <a data-toggle="collapse" href="#usuario">
            <i class="fas fa-user-cog"></i>
          <p>
            {{ __("Usuario") }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse @if ($activePage == 'Usuarios' || $activePage == 'Tipo usuario' || $activePage == 'Cargos') show @endif" id="usuario">
          <ul class="nav">
            <li class="@if ($activePage == 'Usuarios') active @endif">
              <a href="{{ route('usuarios.index') }}">
                <i class="fas fa-user" style="color: transparent;"></i>
                <p> {{ __("Usuarios") }} </p>
              </a>
            </li>
            <li class="@if ($activePage == 'Tipo usuario') active @endif">
              <a href="{{ route('tipo_usuario.index') }}">
                <i class="fas fa-users" style="color: transparent;"></i>
                <p> {{ __("Tipo de Usuarios") }} </p>
              </a>
            </li>
            <li class="@if ($activePage == 'Cargos') active @endif">
              <a href="{{ route('cargos.index') }}">
                <i class="fas fa-user-tag" style="color: transparent;"></i>
                <p> {{ __("Cargos") }} </p>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li>
        <a data-toggle="collapse" href="#departamento">
            <i class="far fa-building"></i>
          <p>
            {{ __("Departamento") }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse @if ($activePage == 'Departamentos' || $activePage == 'Actividades') show @endif" id="departamento">
          <ul class="nav">
            <li class="@if ($activePage == 'Departamentos') active @endif">
              <a href="{{ route('departamentos.index') }}">
                <i style="color: transparent;">-</i>
                <p> {{ __("Departamentos") }} </p>
              </a>
            </li>
            <li class="@if ($activePage == 'Actividades') active @endif">
              <a href="#">
                <i style="color: transparent;">-</i>
                <p> {{ __("Actividades") }} </p>
              </a>
            </li>
          </ul>
        </div>
      </li>
       <li>
        <a data-toggle="collapse" href="#almacenamiento">
            <i class="fas fa-archive"></i>
          <p>
            {{ __("Almacenamiento") }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse @if ($activePage == 'Bodegas' || $activePage == 'Productos') show @endif" id="almacenamiento">
          <ul class="nav">
            <li class="@if ($activePage == 'Bodegas') active @endif">
              <a href="{{ route('bodega.index') }}">
                <i style="color: transparent;">-</i>
                <p> {{ __("Bodegas") }} </p>
              </a>
            </li>
            <li class="@if ($activePage == 'Productos') active @endif">
              <a href="{{ route('producto.index') }}">
                <i style="color: transparent;">-</i>
                <p> {{ __("Productos") }} </p>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="@if ($activePage == 'Trabajadores') active @endif">
        <a href="{{ route('trabajadores.index') }}">
          <i class="now-ui-icons education_paper"></i>
          <p>{{ __('Trabajadores') }}</p>
        </a>
      </li>
      <li class="@if ($activePage == 'Proveedores') active @endif">
        <a href="{{ route('proveedores.index') }}">
          <i class="far fa-handshake"></i>
          <p>{{ __('Proveedores') }}</p>
        </a>
      </li>
      <div class="subtitulo-div">
        <p class="text-center subtitulo-nav">
          {{ __('Abastecimiento') }}
        </p>
      </div>
      <li>
        <a data-toggle="collapse" href="#bodega">
            <i class="fas fa-warehouse"></i>
          <p>
            {{ __("Bodega") }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse @if ($activePage == 'Solicitudes' || $activePage == 'Despacho') show @endif" id="bodega">
          <ul class="nav">
            <li class="@if ($activePage == 'Solicitudes') active @endif">
              <a href="{{ route('solicitudes.index') }}">
                <i style="color: transparent;">-</i>
                <p> {{ __("Solicitudes") }} </p>
              </a>
            </li>
            <li class="@if ($activePage == 'Despacho') active @endif">
              <a href="{{ route('despacho.listaBodegas') }}">
                <i style="color: transparent;">-</i>
                <p> {{ __("Enviar Producto") }} </p>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li>
        <a data-toggle="collapse" href="#producto">
            <i class="fas fa-cogs"></i>
          <p>
            {{ __("Producto") }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse @if ($activePage == 'Orden de Compra' || $activePage == 'Factura') show @endif" id="producto">
          <ul class="nav">
            <li class="@if ($activePage == 'Orden de Compra') active @endif">
              <a href="#">
                <i class="fas fa-user" style="color: transparent;"></i>
                <p> {{ __("Ordenes de Compra") }} </p>
              </a>
            </li>
            <li class="@if ($activePage == 'Factura') active @endif">
              <a href="{{ route('factura.index') }}">
                <i style="color: transparent;">-</i>
                <p> {{ __("Facturas") }} </p>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <div class="subtitulo-div">
        <p class="text-center subtitulo-nav">
          {{ __('Proyecto') }}
        </p>
      </div>
      <li>
        <li class="@if ($activePage == 'Proyecto') active @endif">
        <a href="#">
          <i class="now-ui-icons education_atom"></i>
          <p>{{ __('Proyectos') }}</p>
        </a>
      </li>
      <div class="subtitulo-div">
        <p class="text-center subtitulo-nav">
          {{ __('General') }}
        </p>
      </div>
      <li class="@if ($activePage == 'Preguntas') active @endif">
        <a href="{{ route('preguntas.index') }}">
          <i class="fas fa-question"></i>
          <p>{{ __('Preguntas') }}</p>
        </a>
      </li>
      <li class="@if ($activePage == 'icons') active @endif">
        <a href="{{ route('page.index','icons') }}">
          <i class="now-ui-icons education_atom"></i>
          <p>{{ __('Icons') }}</p>
        </a>
      </li>
    </ul>
  </div>
</div>