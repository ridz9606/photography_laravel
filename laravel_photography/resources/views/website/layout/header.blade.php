
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Photography By Monali</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('website/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('website/css/style.css') }}">

    <!-- Favicon -->
    <link href="{{ asset('website/img/image.png') }}" rel="icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&family=Playfair+Display:wght@500&family=Work+Sans&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries -->
    <link href="{{ asset('website/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('website/lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('website/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    @include('sweetalert::alert')
<!-- Navbar Start -->
<div class="container-fluid bg-light sticky-top shadow-sm">
    <nav class="navbar navbar-expand-lg navbar-light py-2">
        <div class="container">

            <!-- Logo -->
            <a href="{{ url('/') }}" class="navbar-brand">
                <img src="{{ asset('website/img/logo.png') }}" alt="Photography By Monali" height="80" style="border-radius:10px;">
            </a>

            <!-- Toggle Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menu -->
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/about') }}">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/categories') }}">Categories</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/catalogues') }}">Catalogues</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/packages') }}">Packages</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/blogs') }}">Blogs</a></li>

                    <!-- Booking Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            Booking
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ url('/booking') }}">Book Appointment</a></li>
                            <li><a class="dropdown-item" href="{{ url('/mybooking') }}">My Bookings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ url('/private-gallery') }}">Private Client Gallery</a></li>
                            <li><a class="dropdown-item" href="{{ url('/support') }}">Support Tickets</a></li>
                        </ul>
                    </li>

                    <li class="nav-item"><a class="nav-link" href="{{ url('/contact') }}">Contact</a></li>
                </ul>

                <!-- ✅ RIGHT SIDE AUTH SECTION -->
                <div class="d-flex align-items-center auth-section">

                    <?php if (isset($_SESSION['client_id'])) { 
                        // Fetch unread notifications count
                        $client_id = $_SESSION['client_id'];
                        $notif_res = $this->select_where('notifications', ['client_id' => $client_id, 'is_read' => 'no']);
                        $notif_count = $notif_res->num_rows;
                    ?>

                        <!-- Notifications -->
                        <a href="notifications" class="position-relative me-4 text-dark fs-5" title="Notifications">
                            <i class="bi bi-bell"></i>
                            <?php if($notif_count > 0) { ?>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 10px; padding: 4px 6px;">
                                    <?= $notif_count ?>
                                </span>
                            <?php } ?>
                        </a>

                        <a href="profile" class="me-3 fw-bold text-dark text-decoration-none user-greeting">
                            <i class="bi bi-person-circle me-1"></i> Hi, <?= htmlspecialchars($_SESSION['name']); ?>
                        </a>

                        <a href="logout" class="btn btn-primary px-4">
                            Logout
                        </a>

                    <?php } else { ?>

                        <!-- BEFORE LOGIN -->
                        <button onclick="window.location='{{ url('/login') }}'" class="btn btn-primary me-2 px-4">Login</button>
                        <button onclick="window.location='{{ url('/registration') }}'" class="btn btn-primary px-4">Register</button>

                    <?php } ?>

                </div>
            </div>

        </div>
    </nav>
</div>
<!-- Navbar End -->

<!-- Bootstrap JS -->
<script src="{{ asset('website/js/bootstrap.bundle.min.js') }}"></script>

</body>
</html>
