@php($petani = auth()->user())

<div class="agri-sidebar-footer">
    <a href="{{ filament()->getProfileUrl() }}" class="agri-user-card">
        <span class="agri-user-avatar">
            <x-filament::icon icon="heroicon-o-user" class="agri-user-avatar-icon" />
        </span>
        <span class="agri-user-info">
            <span class="agri-user-name">{{ $petani?->nama }}</span>
            <span class="agri-user-role">Petani</span>
        </span>
    </a>

    <form method="post" action="{{ filament()->getLogoutUrl() }}">
        @csrf
        <button type="submit" class="agri-logout">
            <x-filament::icon icon="heroicon-o-arrow-right-start-on-rectangle" class="agri-logout-icon" />
            <span>Keluar Akun</span>
        </button>
    </form>
</div>