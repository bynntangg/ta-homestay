<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center py-4 mb-2" href="index.html">
        <div class="sidebar-brand-icon">
            <i class="fas fa-hotel fa-2x"></i>
        </div>
        <div class="sidebar-brand-text mx-3 text-uppercase font-weight-bold">Owner Homestay</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-1 bg-white opacity-25">

    <!-- Heading -->
    <div class="sidebar-heading text-center mt-3 mb-2">
        <span class="badge bg-info text-dark">MAIN MENU</span>
    </div>

    <!-- Nav Items -->
    <div class="nav-items-container">
        <!-- Dashboard -->
        <li class="nav-item mb-2">
            <a class="nav-link d-flex align-items-center rounded-pill py-3 px-3"
                href="{{ route('pemilik.management.index') }}">
                <i class="bi bi-house-door-fill fs-5 me-3"></i>
                <span class="font-weight-bold">Dashboard</span>
                <span class="badge bg-success ms-auto">New</span>
            </a>
        </li>

        <!-- Homestay -->
        <li class="nav-item mb-2">
            <a class="nav-link d-flex align-items-center rounded-pill py-3 px-3"
                href="{{ route('pemilik.homestays.index') }}">
                <i class="bi bi-building fs-5 me-3"></i>
                <span class="font-weight-bold">Homestay</span>
            </a>
        </li>

        <!-- Tipe Kamar -->
        <li class="nav-item mb-2">
            <a class="nav-link d-flex align-items-center rounded-pill py-3 px-3"
                href="{{ route('pemilik.tipe_kamar.index') }}">
                <i class="bi bi-door-closed fs-5 me-3"></i>
                <span class="font-weight-bold">Tipe Kamar</span>
            </a>
        </li>

        <!-- Kamar -->
        <li class="nav-item mb-2">
            <a class="nav-link d-flex align-items-center rounded-pill py-3 px-3"
                href="{{ route('pemilik.kamars.index') }}">
                <i class="bi bi-door-open fs-5 me-3"></i>
                <span class="font-weight-bold">Kamar</span>
                <span class="badge bg-warning text-dark ms-auto">6</span>
            </a>
        </li>

        <!-- Carousel -->
        <li class="nav-item mb-2">
            <a class="nav-link d-flex align-items-center rounded-pill py-3 px-3" href="{{ route('pemilik.carousel.index') }}">
                <i class="bi bi-image-fill fs-5 me-3"></i>
                <span class="font-weight-bold">Carousel</span>
            </a>
        </li>



        <!-- Confirm Booking -->
        <li class="nav-item mb-2">
            <a class="nav-link d-flex align-items-center rounded-pill py-3 px-3"
                href="{{ route('pemilik.pemesanan.konfirmasi') }}">
                <i class="bi bi-chat-left-text-fill fs-5 me-3"></i>
                <span class="font-weight-bold">Detail Bookings</span>
                <span class="badge bg-danger ms-auto">3</span>
            </a>
        </li>

    </div>

    <!-- Divider -->
    <hr class="sidebar-divider my-3 bg-white opacity-25">

    <!-- Bottom Space -->
    <div class="sidebar-bottom-space"></div>
</ul>

<style>
    /* Custom CSS for the sidebar */
    .sidebar {
        background: linear-gradient(135deg, #4e73df 0%, #224abe 100%) !important;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
    }

    .sidebar-brand {
        padding: 1.5rem 0;
        background: rgba(255, 255, 255, 0.1);
        margin-bottom: 1rem;
        border-radius: 0 0 10px 10px;
    }

    .sidebar-brand-text {
        font-size: 1.2rem;
        letter-spacing: 1px;
    }

    .nav-link {
        transition: all 0.3s ease;
        margin: 0 10px;
    }

    .nav-link:hover {
        background: rgba(255, 255, 255, 0.15) !important;
        transform: translateX(5px);
    }

    .nav-link.active {
        background: rgba(255, 255, 255, 0.2) !important;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .sidebar-bottom-space {
        height: 100px;
    }

    .nav-items-container {
        padding: 0 10px;
    }

    .badge {
        font-size: 0.7rem;
        padding: 0.35em 0.65em;
        font-weight: 600;
    }
</style>
