<nav class="col-md-2 bg-dark sidebar">
    <div class="sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active text-white" href="{{ route('home') }}">
                    <span data-feather="home"></span>
                    Home
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('member') }}">
                    <span data-feather="users"></span>
                    Members
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('alatlab') }}">
                    <span data-feather="book"></span>
                    List Alat Lab
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('pinjam') }}">
                    <span data-feather="file"></span>
                    Sewa
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('kembali') }}">
                    <span data-feather="check-circle"></span>
                    Pengembalian
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('kategori') }}">
                    <span data-feather="tag"></span>
                    Kategori
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('user') }}">
                    <span data-feather="user"></span>
                    Staff Lab
                </a>
            </li>
        </ul>
    </div>
</nav>