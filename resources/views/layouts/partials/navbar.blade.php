<nav class="navbar navbar-dark bg-success sticky-top shadow-sm">
    <div class="container-fluid">
        <div class="d-flex align-items-center">
            <button class="navbar-toggler d-lg-none me-2" type="button"
                    data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu"
                    aria-controls="sidebarMenu" aria-label="Buka menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand fw-semibold" href="{{ route('dashboard') }}">
                <i class="bi bi-mortarboard-fill me-1"></i>
                {{ config('app.name') }}
            </a>
        </div>

        <button id="themeToggle" type="button"
                class="btn btn-outline-light btn-sm me-2">Tema gelap
        </button>

        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person-circle"></i>
                <span class="d-none d-sm-inline">{{ Auth::user()?->name ?? 'Pengguna' }}</span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <span class="dropdown-item-text small">
                        {{ Auth::user()?->email ?? '-' }}
                        <span class="badge text-bg-secondary ms-1">{{ Auth::user()?->role ?? '-' }}</span>
                    </span>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">
                            <i class="bi bi-box-arrow-right me-1"></i> Keluar
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
@push('scripts')
    <script>
        const tombolTema = document.getElementById('themeToggle');
        const elemenHtml = document.documentElement;

        // Membaca tema yang terakhir dipilih
        const temaTersimpan = localStorage.getItem('tema-siakad') || 'light';

        elemenHtml.setAttribute('data-bs-theme', temaTersimpan);
        tombolTema.textContent =
            temaTersimpan === 'dark' ? 'Tema terang' : 'Tema gelap';

        // Mengganti dan menyimpan tema
        tombolTema.addEventListener('click', function () {
            const temaSaatIni = elemenHtml.getAttribute('data-bs-theme');
            const temaBaru = temaSaatIni === 'dark' ? 'light' : 'dark';

            elemenHtml.setAttribute('data-bs-theme', temaBaru);
            localStorage.setItem('tema-siakad', temaBaru);

            tombolTema.textContent =
                temaBaru === 'dark' ? 'Tema terang' : 'Tema gelap';
        });
    </script>
@endpush