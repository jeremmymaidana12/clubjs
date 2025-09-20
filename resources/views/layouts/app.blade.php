<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ClubJS Store - Elegancia y Calidad')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css'])
    <style>
        :root {
            --old-money-green: #2D5016;
            --old-money-green-light: #3D6B23;
            --old-money-green-dark: #1F3A0F;
            --old-money-cream: #F8F6F0;
            --old-money-black: #1A1A1A;
            --old-money-gray: #6B6B6B;
            --old-money-white: #FFFFFF;
            --old-money-gold: #B8860B;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--old-money-cream);
            color: var(--old-money-black);
            line-height: 1.6;
            font-weight: 400;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', serif;
            font-weight: 600;
            letter-spacing: -0.02em;
        }

        /* Navigation Styles */
        .navbar-premium {
            background-color: var(--old-money-white);
            border-bottom: 1px solid #E5E7EB;
            backdrop-filter: blur(10px);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            padding: 1rem 0;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1050;
        }

        .navbar-brand-premium {
            font-family: 'Playfair Display', serif;
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--old-money-black) !important;
            text-decoration: none;
            letter-spacing: -0.02em;
        }

        .nav-link-premium {
            color: var(--old-money-gray) !important;
            font-weight: 500;
            padding: 0.75rem 1rem !important;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-link-premium:hover {
            color: var(--old-money-green) !important;
        }

        .nav-link-premium::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 50%;
            background-color: var(--old-money-green);
            transition: all 0.3s ease;
        }

        .nav-link-premium:hover::after {
            width: 80%;
            left: 10%;
        }

        /* Button Styles */
        .btn-old-money {
            background-color: var(--old-money-green);
            border: none;
            color: var(--old-money-white);
            padding: 0.75rem 2rem;
            font-weight: 500;
            border-radius: 0.375rem;
            transition: all 0.3s ease;
            font-family: 'Inter', sans-serif;
            letter-spacing: 0.025em;
        }

        .btn-old-money:hover {
            background-color: var(--old-money-green-dark);
            color: var(--old-money-white);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(45, 80, 22, 0.3);
        }

        .btn-outline-old-money {
            background-color: transparent;
            border: 2px solid var(--old-money-green);
            color: var(--old-money-green);
            padding: 0.75rem 2rem;
            font-weight: 500;
            border-radius: 0.375rem;
            transition: all 0.3s ease;
        }

        .btn-outline-old-money:hover {
            background-color: var(--old-money-green);
            color: var(--old-money-white);
        }

        /* Product Card Styles */
        .product-card-premium {
            background: var(--old-money-white);
            border-radius: 0.75rem;
            overflow: hidden;
            transition: all 0.4s ease;
            border: 1px solid #F3F4F6;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            margin-bottom: 2rem;
        }

        .product-card-premium:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            border-color: var(--old-money-green);
        }

        .product-image-premium {
            height: 280px;
            object-fit: cover;
            width: 100%;
            transition: all 0.4s ease;
        }

        .product-card-premium:hover .product-image-premium {
            transform: scale(1.05);
        }

        .product-info-premium {
            padding: 1.5rem;
        }

        .product-title-premium {
            font-family: 'Playfair Display', serif;
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--old-money-black);
            margin-bottom: 0.5rem;
            line-height: 1.4;
        }

        .product-description-premium {
            color: var(--old-money-gray);
            font-size: 0.95rem;
            line-height: 1.5;
            margin-bottom: 1rem;
        }

        .price-tag-premium {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--old-money-green);
            margin-bottom: 1rem;
        }

        .category-badge-premium {
            background-color: var(--old-money-cream);
            color: var(--old-money-gray);
            padding: 0.25rem 0.75rem;
            border-radius: 0.375rem;
            font-size: 0.875rem;
            font-weight: 500;
            display: inline-block;
            margin-bottom: 0.5rem;
        }

        .stock-info-premium {
            font-size: 0.875rem;
            color: var(--old-money-green);
            font-weight: 500;
        }

        /* Hero Section */
        .hero-premium {
            background: linear-gradient(135deg, var(--old-money-black) 0%, var(--old-money-green-dark) 100%);
            color: var(--old-money-white);
            padding: 8rem 0 4rem;
            margin-top: 80px;
            position: relative;
            overflow: hidden;
        }

        .hero-premium::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><g fill="%23ffffff" fill-opacity="0.05"><path d="m36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/></g></g></svg>') repeat;
            opacity: 0.1;
        }

        .hero-content {
            position: relative;
            z-index: 1;
        }

        .hero-title {
            font-family: 'Playfair Display', serif;
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            letter-spacing: -0.02em;
        }

        .hero-subtitle {
            font-size: 1.25rem;
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 2rem;
            max-width: 600px;
        }

        /* Trust Section */
        .trust-section {
            background: var(--old-money-white);
            padding: 4rem 0;
            border-top: 1px solid #E5E7EB;
            border-bottom: 1px solid #E5E7EB;
        }

        .trust-item {
            text-align: center;
            padding: 2rem 1rem;
        }

        .trust-icon {
            font-size: 3rem;
            color: var(--old-money-green);
            margin-bottom: 1rem;
        }

        .trust-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .trust-description {
            color: var(--old-money-gray);
            font-size: 0.95rem;
        }

        /* Footer Styles */
        .footer-premium {
            background-color: var(--old-money-black);
            color: var(--old-money-white);
            padding: 4rem 0 2rem;
            margin-top: 4rem;
        }

        .footer-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: var(--old-money-white);
        }

        .footer-link {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: all 0.3s ease;
            display: block;
            padding: 0.25rem 0;
        }

        .footer-link:hover {
            color: var(--old-money-green-light);
            padding-left: 0.5rem;
        }

        .social-link {
            color: rgba(255, 255, 255, 0.7);
            font-size: 1.5rem;
            transition: all 0.3s ease;
            margin-right: 1rem;
        }

        .social-link:hover {
            color: var(--old-money-green-light);
            transform: translateY(-2px);
        }

        /* Enhanced Social Links */
        .social-link-enhanced {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 45px;
            height: 45px;
            background: var(--old-money-green-dark);
            color: rgba(255, 255, 255, 0.7);
            border-radius: 0.5rem;
            text-decoration: none;
            font-size: 1.2rem;
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }

        .social-link-enhanced:hover {
            background: var(--old-money-green);
            color: white;
            transform: translateY(-3px);
            border-color: var(--old-money-green-light);
            box-shadow: 0 8px 25px rgba(45, 80, 22, 0.3);
        }

        /* Newsletter Section */
        .newsletter-section .form-control {
            border-radius: 0.5rem 0 0 0.5rem;
            border-right: none;
        }

        .newsletter-section .btn {
            border-radius: 0 0.5rem 0.5rem 0;
        }

        .newsletter-section .btn:hover {
            background: #9A7A0A !important;
            transform: translateY(-1px);
        }

        /* Contact Info Styling */
        .contact-item {
            padding: 0.75rem 0;
            border-bottom: 1px solid var(--old-money-green-dark);
        }

        .contact-item:last-child {
            border-bottom: none;
        }

        /* Enhanced Footer Links */
        .footer-link {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            padding: 0.5rem 0;
            border-radius: 0.25rem;
            margin: 0 -0.5rem;
            padding-left: 0.5rem;
        }

        .footer-link:hover {
            color: var(--old-money-green-light);
            background: rgba(255, 255, 255, 0.05);
            padding-left: 1rem;
        }

        /* Certifications Badges */
        .cert-badge {
            transition: all 0.3s ease;
        }

        .cert-badge:hover {
            transform: translateY(-2px);
            background: var(--old-money-green) !important;
        }

        /* Payment Methods */
        .payment-section img {
            transition: all 0.3s ease;
            opacity: 0.8;
        }

        .payment-section img:hover {
            opacity: 1;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        /* Security Badge */
        .security-badge {
            transition: all 0.3s ease;
        }

        .security-badge:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(45, 80, 22, 0.4);
        }

        /* Footer Responsive */
        @media (max-width: 768px) {
            .newsletter-section {
                padding: 2rem !important;
            }
            
            .newsletter-section h3 {
                font-size: 1.5rem;
            }
            
            .certifications .d-flex {
                justify-content: center;
            }
            
            .contact-info {
                text-align: center;
            }
            
            .payment-section {
                text-align: center;
            }
            
            .footer-bottom-info {
                text-align: center !important;
            }
        }

        /* Alert Styles */
        .alert-premium-success {
            background-color: #F0FDF4;
            border: 1px solid var(--old-money-green-light);
            color: var(--old-money-green-dark);
            border-radius: 0.5rem;
        }

        .alert-premium-error {
            background-color: #FEF2F2;
            border: 1px solid #F87171;
            color: #DC2626;
            border-radius: 0.5rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .hero-premium {
                padding: 6rem 0 3rem;
            }

            .trust-item {
                margin-bottom: 2rem;
            }
        }

        /* Spacing Utilities */
        .section-padding {
            padding: 4rem 0;
        }

        .content-spacing {
            margin-top: 100px;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-premium">
        <div class="container">
            <a class="navbar-brand-premium" href="{{ route('products.index') }}">
                <i class="fas fa-gem me-2"></i>ClubJS
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link-premium" href="{{ route('products.index') }}">
                            <i class="fas fa-store me-1"></i>Catálogo
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link-premium" href="#">
                            <i class="fas fa-crown me-1"></i>Exclusivos
                        </a>
                    </li>
                </ul>

                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link-premium" href="#">
                            <i class="fas fa-shopping-bag me-1"></i>
                            <span class="badge bg-success rounded-pill ms-1">0</span>
                        </a>
                    </li>
                    @auth
                        @if(auth()->user()->isEmployee())
                            <li class="nav-item">
                                <a class="nav-link-premium" href="{{ route('admin.dashboard') }}">
                                    <i class="fas fa-cog me-1"></i>Administración
                                </a>
                            </li>
                        @endif
                        <li class="nav-item dropdown">
                            <a class="nav-link-premium dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle me-1"></i>{{ auth()->user()->name }}
                            </a>
                            <ul class="dropdown-menu border-0 shadow-lg">
                                <li><a class="dropdown-item py-2" href="#"><i class="fas fa-user me-2"></i>Mi Perfil</a></li>
                                <li><a class="dropdown-item py-2" href="#"><i class="fas fa-history me-2"></i>Historial</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item py-2" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt me-2"></i>Cerrar Sesión
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link-premium" href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt me-1"></i>Acceder
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link-premium" href="{{ route('register') }}">
                                <i class="fas fa-user-plus me-1"></i>Registro
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @if(session('success'))
            <div class="container content-spacing">
                <div class="alert alert-premium-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="container content-spacing">
                <div class="alert alert-premium-error alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Trust Section -->
    <section class="trust-section">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="trust-item">
                        <div class="trust-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h4 class="trust-title">Compra Segura</h4>
                        <p class="trust-description">Transacciones protegidas con la más alta seguridad</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="trust-item">
                        <div class="trust-icon">
                            <i class="fas fa-shipping-fast"></i>
                        </div>
                        <h4 class="trust-title">Envío Express</h4>
                        <p class="trust-description">Entrega rápida y cuidadosa a tu domicilio</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="trust-item">
                        <div class="trust-icon">
                            <i class="fas fa-medal"></i>
                        </div>
                        <h4 class="trust-title">Calidad Premium</h4>
                        <p class="trust-description">Solo productos de la más alta calidad</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="trust-item">
                        <div class="trust-icon">
                            <i class="fas fa-headset"></i>
                        </div>
                        <h4 class="trust-title">Soporte 24/7</h4>
                        <p class="trust-description">Atención personalizada cuando la necesites</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer-premium">
        <div class="container">
            <!-- Newsletter Section -->
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <div class="newsletter-section p-5" style="background: linear-gradient(135deg, var(--old-money-green-dark) 0%, var(--old-money-green) 100%); border-radius: 1rem; position: relative; overflow: hidden;">
                        <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: url('data:image/svg+xml,<svg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><g fill="%23ffffff" fill-opacity="0.05"><circle cx="30" cy="30" r="2"/></g></g></svg>') repeat; opacity: 0.3;"></div>
                        <div style="position: relative; z-index: 1;">
                            <h3 class="text-white mb-3" style="font-family: 'Playfair Display', serif;">Únete a Nuestra Comunidad Exclusiva</h3>
                            <p class="text-white mb-4" style="opacity: 0.9;">Recibe ofertas especiales y novedades antes que nadie</p>
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input type="email" class="form-control" placeholder="Tu email aquí..." style="border: none; padding: 1rem;">
                                        <button class="btn" type="button" style="background: var(--old-money-gold); color: white; border: none; padding: 1rem 2rem; font-weight: 600;">
                                            <i class="fas fa-paper-plane me-2"></i>Suscribirse
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Footer Content -->
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-5">
                    <div class="footer-brand-section">
                        <h3 class="footer-title d-flex align-items-center mb-4">
                            <i class="fas fa-gem me-3" style="color: var(--old-money-green-light); font-size: 1.5rem;"></i>ClubJS
                        </h3>
                        <p class="text-muted mb-4" style="line-height: 1.7;">Desde 2020, nos dedicamos a ofrecer productos de la más alta calidad con un servicio excepcional. Tu confianza y satisfacción son nuestro mayor logro.</p>
                        
                        <!-- Awards/Certifications -->
                        <div class="certifications mb-4">
                            <h6 class="text-white mb-3">Certificaciones</h6>
                            <div class="d-flex gap-3">
                                <div class="cert-badge" style="background: var(--old-money-green-dark); padding: 0.5rem; border-radius: 0.375rem; text-align: center; min-width: 60px;">
                                    <i class="fas fa-shield-alt" style="color: var(--old-money-green-light);"></i>
                                    <small class="d-block text-muted mt-1" style="font-size: 0.7rem;">SSL</small>
                                </div>
                                <div class="cert-badge" style="background: var(--old-money-green-dark); padding: 0.5rem; border-radius: 0.375rem; text-align: center; min-width: 60px;">
                                    <i class="fas fa-award" style="color: var(--old-money-green-light);"></i>
                                    <small class="d-block text-muted mt-1" style="font-size: 0.7rem;">Premium</small>
                                </div>
                                <div class="cert-badge" style="background: var(--old-money-green-dark); padding: 0.5rem; border-radius: 0.375rem; text-align: center; min-width: 60px;">
                                    <i class="fas fa-star" style="color: var(--old-money-green-light);"></i>
                                    <small class="d-block text-muted mt-1" style="font-size: 0.7rem;">5.0</small>
                                </div>
                            </div>
                        </div>

                        <!-- Social Media -->
                        <div class="social-section">
                            <h6 class="text-white mb-3">Síguenos</h6>
                            <div class="d-flex gap-2">
                                <a href="#" class="social-link-enhanced"><i class="fab fa-facebook-f"></i></a>
                                <a href="#" class="social-link-enhanced"><i class="fab fa-instagram"></i></a>
                                <a href="#" class="social-link-enhanced"><i class="fab fa-twitter"></i></a>
                                <a href="#" class="social-link-enhanced"><i class="fab fa-linkedin"></i></a>
                                <a href="#" class="social-link-enhanced"><i class="fab fa-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6 mb-5">
                    <h5 class="footer-title">Navegación</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('products.index') }}" class="footer-link"><i class="fas fa-chevron-right me-2" style="font-size: 0.7rem; color: var(--old-money-green-light);"></i>Catálogo</a></li>
                        <li><a href="#" class="footer-link"><i class="fas fa-chevron-right me-2" style="font-size: 0.7rem; color: var(--old-money-green-light);"></i>Exclusivos</a></li>
                        <li><a href="#" class="footer-link"><i class="fas fa-chevron-right me-2" style="font-size: 0.7rem; color: var(--old-money-green-light);"></i>Ofertas</a></li>
                        <li><a href="#" class="footer-link"><i class="fas fa-chevron-right me-2" style="font-size: 0.7rem; color: var(--old-money-green-light);"></i>Novedades</a></li>
                        <li><a href="#" class="footer-link"><i class="fas fa-chevron-right me-2" style="font-size: 0.7rem; color: var(--old-money-green-light);"></i>Marcas</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 mb-5">
                    <h5 class="footer-title">Atención al Cliente</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="footer-link"><i class="fas fa-question-circle me-2" style="color: var(--old-money-green-light);"></i>Centro de Ayuda</a></li>
                        <li><a href="#" class="footer-link"><i class="fas fa-undo-alt me-2" style="color: var(--old-money-green-light);"></i>Política de Devoluciones</a></li>
                        <li><a href="#" class="footer-link"><i class="fas fa-file-contract me-2" style="color: var(--old-money-green-light);"></i>Términos y Condiciones</a></li>
                        <li><a href="#" class="footer-link"><i class="fas fa-user-shield me-2" style="color: var(--old-money-green-light);"></i>Política de Privacidad</a></li>
                        <li><a href="#" class="footer-link"><i class="fas fa-shipping-fast me-2" style="color: var(--old-money-green-light);"></i>Información de Envío</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 mb-5">
                    <h5 class="footer-title">Contacto</h5>
                    <div class="contact-info">
                        <div class="contact-item mb-3">
                            <div class="d-flex align-items-start">
                                <i class="fas fa-phone me-3 mt-1" style="color: var(--old-money-green-light);"></i>
                                <div>
                                    <strong class="d-block text-white">Teléfono</strong>
                                    <span class="text-muted">+34 915 123 456</span><br>
                                    <small class="text-muted">Lun-Vie: 9:00-20:00</small>
                                </div>
                            </div>
                        </div>
                        <div class="contact-item mb-3">
                            <div class="d-flex align-items-start">
                                <i class="fas fa-envelope me-3 mt-1" style="color: var(--old-money-green-light);"></i>
                                <div>
                                    <strong class="d-block text-white">Email</strong>
                                    <span class="text-muted">hola@clubjs.com</span><br>
                                    <small class="text-muted">Respuesta en 24h</small>
                                </div>
                            </div>
                        </div>
                        <div class="contact-item mb-3">
                            <div class="d-flex align-items-start">
                                <i class="fas fa-map-marker-alt me-3 mt-1" style="color: var(--old-money-green-light);"></i>
                                <div>
                                    <strong class="d-block text-white">Oficina</strong>
                                    <span class="text-muted">Calle Serrano 123<br>28006 Madrid, España</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Methods & Copyright -->
            <hr class="my-5" style="border-color: var(--old-money-green-dark); opacity: 0.3;">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-3">
                    <div class="payment-section">
                        <h6 class="text-white mb-3">Métodos de Pago Seguros</h6>
                        <div class="d-flex align-items-center gap-3 flex-wrap">
                            <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iMjQiIHZpZXdCb3g9IjAgMCA0MCAyNCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjQwIiBoZWlnaHQ9IjI0IiByeD0iNCIgZmlsbD0iIzAwNTZBNCIvPgo8dGV4dCB4PSI4IiB5PSIxNiIgZm9udC1mYW1pbHk9IkFyaWFsIiBmb250LXNpemU9IjEwIiBmb250LXdlaWdodD0iYm9sZCIgZmlsbD0id2hpdGUiPlZJU0E8L3RleHQ+Cjwvc3ZnPgo=" alt="Visa" style="height: 36px; border-radius: 6px;">
                            <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iMjQiIHZpZXdCb3g9IjAgMCA0MCAyNCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjQwIiBoZWlnaHQ9IjI0IiByeD0iNCIgZmlsbD0iI0VCMDAxQiIvPgo8dGV4dCB4PSI1IiB5PSIxNiIgZm9udC1mYW1pbHk9IkFyaWFsIiBmb250LXNpemU9IjgiIGZvbnQtd2VpZ2h0PSJib2xkIiBmaWxsPSJ3aGl0ZSI+TUFTUEVSQ0FSRDY8L3RleHQ+Cjwvc3ZnPgo=" alt="MasterCard" style="height: 36px; border-radius: 6px;">
                            <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iMjQiIHZpZXdCb3g9IjAgMCA0MCAyNCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjQwIiBoZWlnaHQ9IjI0IiByeD0iNCIgZmlsbD0iIzAwMzA4NyIvPgo8dGV4dCB4PSI4IiB5PSIxNiIgZm9udC1mYW1pbHk9IkFyaWFsIiBmb250LXNpemU9IjEwIiBmb250LXdlaWdodD0iYm9sZCIgZmlsbD0id2hpdGUiPlBBWVBBTDwvdGV4dD4KPC9zdmc+Cg==" alt="PayPal" style="height: 36px; border-radius: 6px;">
                            <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iMjQiIHZpZXdCb3g9IjAgMCA0MCAyNCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjQwIiBoZWlnaHQ9IjI0IiByeD0iNCIgZmlsbD0iIzAwRDkyNiIvPgo8dGV4dCB4PSI4IiB5PSIxNiIgZm9udC1mYW1pbHk9IkFyaWFsIiBmb250LXNpemU9IjEwIiBmb250LXdlaWdodD0iYm9sZCIgZmlsbD0id2hpdGUiPkFQUExFPC90ZXh0Pgo8L3N2Zz4K" alt="Apple Pay" style="height: 36px; border-radius: 6px;">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 text-lg-end mb-3">
                    <div class="footer-bottom-info">
                        <p class="text-muted mb-2">&copy; {{ date('Y') }} ClubJS. Todos los derechos reservados.</p>
                        <p class="text-muted mb-0" style="font-size: 0.85rem;">
                            Diseñado con <i class="fas fa-heart" style="color: var(--old-money-green-light);"></i> en España
                        </p>
                    </div>
                </div>
            </div>

            <!-- Security Badge -->
            <div class="row mt-4">
                <div class="col-12 text-center">
                    <div class="security-badge p-3" style="background: var(--old-money-green-dark); border-radius: 0.75rem; display: inline-block;">
                        <i class="fas fa-lock me-2" style="color: var(--old-money-green-light);"></i>
                        <span class="text-white" style="font-size: 0.9rem; font-weight: 500;">Sitio Protegido con Certificado SSL</span>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Enhanced navigation transparency on scroll
        document.addEventListener('DOMContentLoaded', function() {
            window.addEventListener('scroll', function() {
                const navbar = document.querySelector('.navbar');
                if (window.scrollY > 50) {
                    navbar.style.backgroundColor = 'rgba(34, 59, 19, 0.95)';
                    navbar.style.backdropFilter = 'blur(10px)';
                } else {
                    navbar.style.backgroundColor = 'rgba(34, 59, 19, 0.9)';
                    navbar.style.backdropFilter = 'blur(5px)';
                }
            });

            // Newsletter subscription handling
            const newsletterForm = document.getElementById('newsletter-form');
            if (newsletterForm) {
                newsletterForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const email = document.getElementById('newsletter-email').value;
                    
                    if (validateEmail(email)) {
                        // Show success message
                        showMessage('¡Gracias por suscribirte! Te enviaremos las mejores ofertas.', 'success');
                        document.getElementById('newsletter-email').value = '';
                    } else {
                        showMessage('Por favor, introduce una dirección de email válida.', 'error');
                    }
                });
            }

            // Social media tracking (analytics)
            document.querySelectorAll('.social-link-enhanced').forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const platform = this.getAttribute('aria-label');
                    console.log(`Social media click: ${platform}`);
                    // Add your analytics tracking here
                    showMessage(`Redirigiendo a ${platform}...`, 'info');
                    
                    // Simulate redirect after brief delay
                    setTimeout(() => {
                        window.open('#', '_blank');
                    }, 500);
                });
            });

            // Footer link animations
            document.querySelectorAll('.footer-link').forEach(link => {
                link.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateX(5px)';
                });
                
                link.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateX(0)';
                });
            });

            // Smooth scroll for internal links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        });

        // Email validation function
        function validateEmail(email) {
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        }

        // Enhanced message display function
        function showMessage(message, type = 'info') {
            // Remove existing messages
            const existingMsg = document.querySelector('.floating-message');
            if (existingMsg) {
                existingMsg.remove();
            }

            const messageEl = document.createElement('div');
            messageEl.className = `floating-message alert alert-${type === 'error' ? 'danger' : type} position-fixed`;
            messageEl.style.cssText = `
                top: 20px;
                right: 20px;
                z-index: 9999;
                max-width: 350px;
                opacity: 0;
                transform: translateX(100%);
                transition: all 0.3s ease;
                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
                border: none;
                border-radius: 0.75rem;
            `;
            messageEl.innerHTML = `
                <div class="d-flex align-items-center">
                    <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-triangle' : 'info-circle'} me-2"></i>
                    <span>${message}</span>
                    <button type="button" class="btn-close ms-auto" aria-label="Close"></button>
                </div>
            `;

            document.body.appendChild(messageEl);

            // Animate in
            requestAnimationFrame(() => {
                messageEl.style.opacity = '1';
                messageEl.style.transform = 'translateX(0)';
            });

            // Close button functionality
            messageEl.querySelector('.btn-close').addEventListener('click', () => {
                messageEl.style.opacity = '0';
                messageEl.style.transform = 'translateX(100%)';
                setTimeout(() => messageEl.remove(), 300);
            });

            // Auto-remove after 5 seconds
            setTimeout(() => {
                if (messageEl.parentNode) {
                    messageEl.style.opacity = '0';
                    messageEl.style.transform = 'translateX(100%)';
                    setTimeout(() => messageEl.remove(), 300);
                }
            }, 5000);
        }

        // Parallax effect for hero sections
        function initParallax() {
            const heroElements = document.querySelectorAll('.hero-section, .newsletter-section');
            
            window.addEventListener('scroll', () => {
                const scrolled = window.pageYOffset;
                heroElements.forEach(element => {
                    const rate = scrolled * -0.3;
                    element.style.transform = `translateY(${rate}px)`;
                });
            });
        }

        // Initialize parallax if hero elements exist
        if (document.querySelector('.hero-section, .newsletter-section')) {
            initParallax();
        }
    </script>
    
    @vite(['resources/js/app.js'])
</body>
</html>
