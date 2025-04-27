<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" style="background: linear-gradient(135deg, #4e73df 0%, #224abe 100%); box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center py-4 mb-2" href="index.html" style="background: rgba(255, 255, 255, 0.1); border-radius: 0 0 10px 10px;">
        <div class="sidebar-brand-icon">
            <i class="fas fa-hotel fa-2x"></i>
        </div>
        <div class="sidebar-brand-text mx-3 text-uppercase font-weight-bold">Master WatHome</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-1 bg-white opacity-25">

    <!-- Heading -->
    <div class="sidebar-heading text-center mt-3 mb-2">
        <span class="badge bg-info text-dark">MAIN MENU</span>
    </div>

    <!-- Nav Items -->
    <div class="nav-items-container" style="padding: 0 10px;">
        <!-- Dashboard -->
        <li class="nav-item mb-2">
            <a class="nav-link d-flex align-items-center rounded-pill py-3 px-3" href="{{ route('master.management') }}" style="transition: all 0.3s ease;">
                <i class="bi bi-house-door-fill fs-5 me-3"></i>
                <span class="font-weight-bold">Dashboard</span>
            </a>
        </li>        

        <!-- Management User -->
        <li class="nav-item mb-2">
            <a class="nav-link d-flex align-items-center rounded-pill py-3 px-3" href="{{ route('master.management-user') }}" style="transition: all 0.3s ease;">
                <i class="bi bi-people-fill fs-5 me-3"></i>
                <span class="font-weight-bold">Management User</span>
            </a>
        </li>

        <!-- Create New Owners -->
        <li class="nav-item mb-2">
            <a class="nav-link d-flex align-items-center rounded-pill py-3 px-3" href="{{ route('master.create-owner') }}" style="transition: all 0.3s ease;">
                <i class="fas fa-user-plus fs-5 me-3"></i>
                <span class="font-weight-bold">Create New Owners</span>
                <span class="badge bg-success ms-auto">+</span>
            </a>
        </li>
    </div>

    <!-- Divider -->
    <hr class="sidebar-divider my-3 bg-white opacity-25">

    <!-- Bottom Space -->
    <div style="height: 100px;"></div>
</ul>

<style>
    .nav-link:hover {
        background: rgba(255, 255, 255, 0.15) !important;
        transform: translateX(5px);
    }
    
    .nav-link.active {
        background: rgba(255, 255, 255, 0.2) !important;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    
    .badge {
        font-size: 0.7rem;
        padding: 0.35em 0.65em;
        font-weight: 600;
    }
</style>