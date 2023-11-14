
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