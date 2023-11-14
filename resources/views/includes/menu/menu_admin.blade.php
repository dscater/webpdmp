<li class="nav-item">
    <a href="{{ route('users.index') }}" class="nav-link {{ request()->is('users*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-users"></i>
        <p>Usuarios</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('maquinarias.index') }}" class="nav-link {{ request()->is('maquinarias*') ? 'active' : '' }}">
        <i class="nav-icon fa fa-truck"></i>
        <p>Equipos/Maquinarias</p>
    </a>
</li>


<li class="nav-item @if (request()->is('proyectos*') || request()->is('proyecto_usuarios*')) menu-is-opening menu-open active @endif">
    <a href="#" class="nav-link">
        <i class="nav-icon fa fa-list"></i>
        <p>Proyectos <i class="fas fa-angle-left right"></i></p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('proyectos.index') }}"
                class="nav-link {{ request()->is('proyectos*') ? 'active' : '' }}">
                <i class="nav-icon far fa-circle"></i>
                <p>Proyectos</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('proyecto_usuarios.index') }}"
                class="nav-link {{ request()->is('proyecto_usuarios*') ? 'active' : '' }}">
                <i class="nav-icon far fa-circle"></i>
                <p>Proyectos Usuarios</p>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item">
    <a href="{{ route('hora_propios.index') }}" class="nav-link {{ request()->is('hora_propios*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-calendar-alt"></i>
        <p>Control Diario (POPIOS)</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('hora_alquilados.index') }}" class="nav-link {{ request()->is('hora_alquilados*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-calendar-alt"></i>
        <p>Control Diario (ALQUILADOS)</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('certificado_pagos.index') }}" class="nav-link {{ request()->is('certificado_pagos*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-clipboard"></i>
        <p>Certificado de Pagos</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('configuracions.index') }}"
        class="nav-link {{ request()->is('configuracions*') ? 'active' : '' }}">
        <i class="nav-icon fa fa-hospital"></i>
        <p>Configuración</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('reportes.index') }}" class="nav-link {{ request()->is('reportes*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-file-alt"></i>
        <p>Reportes</p>
    </a>
</li>