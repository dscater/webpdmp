
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
