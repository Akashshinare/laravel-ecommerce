<div class="sticky-top">

    <!-- Top Navbar -->
    <div class="bg-light py-1" style="z-index: 1050;">
        <div class="container">
            <div class="row align-items-center">

                <!-- Contact Info -->
                <div class="col-md-6 col-12">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item me-3">
                            <i class="fa fa-whatsapp text-success"></i>
                            <a href="https://wa.me/7774948040" target="_blank">7774948040</a>
                        </li>
                        <li class="list-inline-item me-3">
                            <i class="fa fa-envelope text-danger"></i>
                            <a href="mailto:akashshinare199@gmail.com">akashshinare199@gmail.com</a>
                        </li>
                        <li class="list-inline-item">
                            <i class="fa fa-phone text-primary"></i>
                            <a href="tel:7774948040">7774948040</a>
                        </li>
                    </ul>
                </div>

                <!-- Social Links -->
                <div class="col-md-6 col-12 text-md-end mt-2 mt-md-0">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item me-2">Follow Us:</li>
                        <li class="list-inline-item me-3">
                            <i class="fa fa-linkedin text-primary"></i>
                            <a href="https://www.linkedin.com/in/akash-shinare-14566421b/" target="_blank">LinkedIn</a>
                        </li>
                        <li class="list-inline-item me-3">
                            <i class="fa fa-github"></i>
                            <a href="https://github.com/akashshinare" target="_blank">GitHub</a>
                        </li>
                        <li class="list-inline-item">
                            <i class="fa fa-globe"></i>
                            <a href="https://akashshinare.github.io/html-portfolio/" target="_blank">Portfolio</a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>

    <!-- Main Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white" style="z-index: 1040;">

        <div class="container-fluid">

            <!-- Brand -->
            <a class="navbar-brand" href="/">Laravel Ecommerce</a>

            <!-- Toggler -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"
                aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar Links + Buttons -->
            <div class="collapse navbar-collapse justify-content-end" id="mainNavbar">

                <!-- Nav Links -->
                <ul class="navbar-nav mb-2 mb-lg-0 me-3">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('shop-by-category') }}">Shop By Category</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/products') }}">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/about') }}">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/contactss') }}">Contact Us</a>
                    </li>
                </ul>

                <!-- Login / Register Buttons -->
                <div class="d-flex">
                    <a class="btn btn-danger me-2" href="{{ route('login') }}">
                        <i class="fas fa-sign-in-alt me-1"></i> Login
                    </a>
                    <a class="btn btn-primary" href="{{ route('register') }}">
                        <i class="fas fa-user-plus me-1"></i> Register
                    </a>
                </div>

            </div>
        </div>
    </nav>

</div>