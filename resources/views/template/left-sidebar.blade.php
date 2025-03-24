<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
            <i class="fas fa-hotel mr-2"></i>
        </div>
        <div class="sidebar-brand-">WatHome.com</div>
    </a>


    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('pemilik.dashboard.index') }}">
            <i class="bi bi-house-door"></i> <!-- Ikon untuk Dashboard -->
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Nav Item - Homestay -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('pemilik.homestays.index') }}">
            <i class="bi bi-building"></i> <!-- Ikon untuk Homestay -->
            <span>Homestay</span>
        </a>
    </li>

    <!-- Nav Item - Tipe Kamar -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('pemilik.tipe_kamar.index') }}">
            <i class="bi bi-door-closed"></i> <!-- Ikon untuk Tipe Kamar -->
            <span>Tipe Kamar</span>
        </a>
    </li>

    <!-- Nav Item - Kamar -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('pemilik.kamars.index') }}">
            <i class="bi bi-door-open"></i> <!-- Ikon untuk Kamar -->
            <span>Kamar</span>
        </a>
    </li>

    <!-- Nav Item - Booking -->
    <li class="nav-item">
        <a class="nav-link" href="">
            <i class="bi bi-calendar-check"></i> <!-- Ikon untuk Booking -->
            <span>Booking</span>
        </a>
    </li>

    <!-- Nav Item - Ulasan -->
    <li class="nav-item">
        <a class="nav-link" href="">
            <i class="bi bi-chat-left-text"></i> <!-- Ikon untuk Ulasan -->
            <span>Ulasan</span>
        </a>
    </li>
</ul>
