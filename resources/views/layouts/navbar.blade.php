<nav class="navbar navbar-expand navbar-dark bg-primary sticky-top cus-nav" name="header">
    <div class="container-lg">
        <a class="navbar-brand" href="/home"><img src="/image/kopte.png" alt="logo" width="50"><strong> KOPTE SURADITA </strong></a>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link link-light dropdown-toggle bi bi-people-fill" href="/" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false"> Welcome, 
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end mt-2">
                        @csrf
                        <li><a class="dropdown-item bi bi-box-arrow-in-right cus-hov" href="logout"> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>

    <style>
        .cus-nav {
            background-color: #20351d !important;
        }
        .cus-hov:hover {
        background-color: #5a6f50; /* Warna saat hover (opsional) */
        color: #ffffff !important; /* Pastikan tetap putih */
    }
    </style>
</nav>
