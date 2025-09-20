@extends('layouts.app')

@section('title', 'Catálogo Premium - ClubJS')

@section('content')
<!-- Hero Section -->
<section class="hero-premium">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="hero-content">
                    <h1 class="hero-title">Colección Exclusiva</h1>
                    <p class="hero-subtitle">Descubre productos cuidadosamente seleccionados que reflejan distinción, calidad y elegancia atemporal.</p>
                    <a href="#productos" class="btn btn-old-money btn-lg">
                        <i class="fas fa-arrow-down me-2"></i>Explorar Catálogo
                    </a>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <div class="hero-image">
                    <i class="fas fa-gem" style="font-size: 8rem; opacity: 0.3;"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container section-padding" id="productos">
    <!-- Category Filters -->
    <div class="row mb-5">
        <div class="col-12">
            <h2 class="text-center mb-4" style="font-family: 'Playfair Display', serif;">Explora por Categorías</h2>
            <div class="d-flex flex-wrap justify-content-center gap-2">
                <a href="{{ route('products.index') }}" class="btn btn-outline-old-money filter-btn">
                    <i class="fas fa-th-large me-1"></i>Todo
                </a>
                @php
                    $categories = $products->pluck('category')->unique();
                @endphp
                @foreach($categories as $category)
                    <a href="{{ route('products.category', $category) }}" class="btn btn-outline-old-money filter-btn">
                        @switch($category)
                            @case('Electrónicos')
                                <i class="fas fa-laptop me-1"></i>
                                @break
                            @case('Audio')
                                <i class="fas fa-headphones me-1"></i>
                                @break
                            @case('Calzado')
                                <i class="fas fa-running me-1"></i>
                                @break
                            @case('Gaming')
                                <i class="fas fa-gamepad me-1"></i>
                                @break
                            @case('Fotografía')
                                <i class="fas fa-camera me-1"></i>
                                @break
                            @case('Hogar')
                                <i class="fas fa-home me-1"></i>
                                @break
                            @case('Automotriz')
                                <i class="fas fa-car me-1"></i>
                                @break
                            @default
                                <i class="fas fa-tag me-1"></i>
                        @endswitch
                        {{ $category }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>
                        

    <!-- Products Grid -->
    <div class="row">
        @forelse($products as $product)
            <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                <div class="product-card-premium">
                    <div class="position-relative overflow-hidden">
                        <img src="{{ $product->image_url }}"
                             class="product-image-premium"
                             alt="{{ $product->name }}">

                        @if($product->stock < 10 && $product->stock > 0)
                            <div class="position-absolute top-0 start-0 m-3">
                                <span class="badge" style="background-color: var(--old-money-gold); color: white;">
                                    <i class="fas fa-exclamation-triangle me-1"></i>Últimas unidades
                                </span>
                            </div>
                        @elseif($product->stock == 0)
                            <div class="position-absolute top-0 start-0 m-3">
                                <span class="badge bg-danger">
                                    <i class="fas fa-times-circle me-1"></i>Agotado
                                </span>
                            </div>
                        @endif
                    </div>

                    <div class="product-info-premium">
                        <span class="category-badge-premium">{{ $product->category }}</span>
                        <h3 class="product-title-premium">{{ $product->name }}</h3>
                        <p class="product-description-premium">
                            {{ Str::limit($product->description, 120) }}
                        </p>

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="price-tag-premium">${{ number_format($product->price, 2) }}</div>
                            <div class="stock-info-premium">
                                <i class="fas fa-box me-1"></i>{{ $product->stock }} disponibles
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <a href="{{ route('products.show', $product) }}" class="btn btn-old-money">
                                <i class="fas fa-eye me-2"></i>Ver Detalles
                            </a>
                            @if($product->stock > 0)
                                <button class="btn btn-outline-old-money" onclick="addToCart({{ $product->id }})">
                                    <i class="fas fa-shopping-bag me-2"></i>Añadir al Carrito
                                </button>
                            @else
                                <button class="btn btn-outline-secondary" disabled>
                                    <i class="fas fa-ban me-2"></i>No Disponible
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="fas fa-search" style="font-size: 4rem; color: var(--old-money-gray); opacity: 0.5;"></i>
                    <h3 class="mt-3" style="font-family: 'Playfair Display', serif;">No se encontraron productos</h3>
                    <p class="text-muted">No hay productos disponibles en esta categoría en este momento.</p>
                    <a href="{{ route('products.index') }}" class="btn btn-old-money mt-3">
                        <i class="fas fa-arrow-left me-2"></i>Ver Todos los Productos
                    </a>
                </div>
            </div>
        @endforelse
    </div>

    @if($products->count() > 0)
        <div class="text-center mt-5 pt-4 border-top">
            <p class="text-muted mb-0" style="font-size: 0.95rem;">
                <i class="fas fa-gem me-2" style="color: var(--old-money-green);"></i>
                Mostrando {{ $products->count() }} productos de calidad excepcional
            </p>
        </div>
    @endif
</div>

<script>
function addToCart(productId) {
    // Mostrar notificación elegante
    const notification = document.createElement('div');
    notification.innerHTML = `
        <div class="alert alert-premium-success alert-dismissible fade show position-fixed"
             style="top: 100px; right: 20px; z-index: 9999; min-width: 300px;">
            <i class="fas fa-check-circle me-2"></i>
            Producto añadido al carrito con éxito
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    `;
    document.body.appendChild(notification);

    // Remover la notificación después de 3 segundos
    setTimeout(() => {
        notification.remove();
    }, 3000);
}
</script>
@endsection
