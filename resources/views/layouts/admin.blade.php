<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MySCAT Dashboard</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>

<!-- MOBILE TOP NAVBAR -->
 <nav class="d-md-none navbar navbar-dark bg-primary px-3">
    <button class="btn text-white" id="sidebarToggle">
        <i class="bi bi-list fs-3"></i>
    </button>
    <span class="navbar-brand mb-0 h1 text-center">MySCAT</span>
</nav> 

<!-- SIDEBAR -->
<div id="sidebar" class="sidebar d-flex flex-column p-3">

    <h4 class="sidebar-logo mb-4">
        <a href="/admin" class="sidebar-logo-text text-decoration-none">
            <i class="bi bi-clipboard-heart-fill me-2"></i> MySCAT
        </a>
    </h4>

    <!-- Menu -->
<ul class="nav nav-pills flex-column mb-auto">

    <li class="nav-item">
        <a href="{{ route('admin.dashboard') }}" class="nav-link">
            <i class="bi bi-house-door-fill me-2"></i> Dashboard
        </a>
    </li>

    <li>
        <a href="{{ route('admin.patientindex') }}" class="nav-link">
            <i class="bi bi-people-fill me-2"></i> Patients
        </a>
    </li>

</ul>


    <!-- Logout Button -->
    <div class="mt-auto pt-4">
        <a href="#" class="nav-link text-white logout-btn"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="bi bi-box-arrow-right me-2"></i> Logout
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> @csrf </form>
    </div> 
</div>

<!-- MAIN CONTENT -->
<div class="content">
    @yield('content')
</div>


<!-- ================= CSS AT BOTTOM ================= -->
<style>

    body {
        overflow-x: hidden;
        background: #f8f9fc;
    }

    /* Sidebar */
    .sidebar {
        height: 100vh;
        width: 250px;
        background-color: #0C1E42;
        color: white;
        position: fixed;
        top: 0;
        left: 0;
        transition: transform 0.3s ease;
    }

    /* Hidden on mobile by default */
    @media (max-width: 768px) {
        .sidebar {
            transform: translateX(-260px);
            position: fixed;
            z-index: 2000;
        }
        .sidebar.show {
            transform: translateX(0);
        }

        .content {
            margin-left: 0 !important;
        }
    }

    /* Logo */
    .sidebar-logo-text {
        color: #F9D878 !important;
        font-weight: 800;
        font-size: 1.4rem;
        letter-spacing: 0.5px;
    }

    .sidebar-logo-text:hover {
        color: #fff3c4 !important;
    }

    /* Menu links */
    .sidebar .nav-link {
        color: #ffffff;
        padding: 12px 20px;
        border-radius: 6px;
        font-size: 0.95rem;
    }

    .sidebar .nav-link:hover {
        background-color: #1f3d7a;
        color: #ffffff;
    }

    /* Logout */
    .logout-btn:hover {
        background-color: #8b0000;
        border-radius: 6px;
    }

    /* Main content margin */
    .content {
        margin-left: 250px;
        padding: 20px;
        transition: margin-left 0.3s ease;
    }

</style>


<!-- ================= JavaScript ================= -->
<script>
// Toggle sidebar on mobile
document.getElementById('sidebarToggle').addEventListener('click', function () {
    document.getElementById('sidebar').classList.toggle('show');
});
</script>

</body>
</html>