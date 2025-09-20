@extends('layouts.app')

@section('title', $product->name . ' - ClubJS')

@section('content')
<div class="content-spacing">
    <div class="container section-padding">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-5">
            <ol class="breadcrumb bg-transparent p-0" style="font-size: 0.95rem;">
                <li class="breadcrumb-item">
                    <a href="{{ route('products.index') }}" class="text-decoration-none" style="color: var(--old-money-gray);">
                        <i class="fas fa-home me-1"></i>Inicio
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('products.category', $product->category) }}" class="text-decoration-none" style="color: var(--old-money-gray);">
                        {{ $product->category }}
                    </a>
                </li>
                <li class="breadcrumb-item active" style="color: var(--old-money-green);">{{ Str::limit($product->name, 40) }}</li>
            </ol>
        </nav>

        <div class="row align-items-start">
            <!-- Product Image -->
            <div class="col-lg-6 mb-5">
                <div class="position-relative">
                    <div class="product-image-container" style="background: var(--old-money-white); border-radius: 1rem; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
                        <img id="productImage"
                             src="{{ $product->image_url }}"
                             class="img-fluid w-100"
                             alt="{{ $product->name }}"
                             style="height: 500px; object-fit: cover;">
                    </div>

                    @if($product->stock < 10 && $product->stock > 0)
                        <div class="position-absolute top-0 start-0 m-3">
                            <span class="badge" style="background-color: var(--old-money-gold); color: white; font-size: 0.85rem;">
                                <i class="fas fa-exclamation-triangle me-1"></i>Últimas {{ $product->stock }} unidades
                            </span>
                        </div>
                    @elseif($product->stock == 0)
                        <div class="position-absolute top-0 start-0 m-3">
                            <span class="badge bg-danger" style="font-size: 0.85rem;">
                                <i class="fas fa-times-circle me-1"></i>Agotado
                            </span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Product Details -->
            <div class="col-lg-6">
                <div class="product-details-premium">
                    <!-- Category Badge -->
                    <span class="category-badge-premium mb-3 d-inline-block">{{ $product->category }}</span>

                    <!-- Product Title -->
                    <h1 class="product-title-premium" style="font-size: 2.5rem; margin-bottom: 1.5rem;">{{ $product->name }}</h1>

                    <!-- Price Section -->
                    <div class="price-section mb-4 p-4" style="background: var(--old-money-cream); border-radius: 0.75rem; border-left: 4px solid var(--old-money-green);">
                        <div class="price-tag-premium" style="font-size: 2rem; margin-bottom: 0.5rem;">${{ number_format($product->price, 2) }}</div>
                        <p class="text-muted mb-0" style="font-size: 0.9rem;">
                            <i class="fas fa-info-circle me-1"></i>Precio incluye todos los impuestos
                        </p>
                    </div>
                    <!-- Description -->
                    <div class="mb-4">
                        <h3 class="mb-3" style="font-family: 'Playfair Display', serif; color: var(--old-money-black);">
                            <i class="fas fa-file-text me-2" style="color: var(--old-money-green);"></i>Descripción
                        </h3>
                        <p class="lead" style="line-height: 1.7; color: var(--old-money-gray);">{{ $product->description }}</p>
                    </div>

                    <!-- Stock Information -->
                    <div class="stock-section mb-4 p-3" style="background: var(--old-money-white); border-radius: 0.5rem; border: 1px solid #E5E7EB;">
                        @if($product->stock > 0)
                            <div class="d-flex align-items-center">
                                <span class="badge me-3 px-3 py-2" style="background-color: var(--old-money-green); font-size: 0.9rem;">
                                    <i class="fas fa-check-circle me-1"></i>Disponible
                                </span>
                                <span style="color: var(--old-money-gray); font-weight: 500;">
                                    <i class="fas fa-box me-1"></i>{{ $product->stock }} unidades en stock
                                </span>
                            </div>
                        @else
                            <div class="d-flex align-items-center">
                                <span class="badge bg-danger me-3 px-3 py-2" style="font-size: 0.9rem;">
                                    <i class="fas fa-times-circle me-1"></i>No Disponible
                                </span>
                                <span class="text-muted">Producto temporalmente agotado</span>
                            </div>
                        @endif
                    </div>

                    <!-- Features -->
                    <div class="features-section mb-5">
                        <h4 class="mb-3" style="font-family: 'Playfair Display', serif; color: var(--old-money-black);">
                            <i class="fas fa-award me-2" style="color: var(--old-money-green);"></i>Garantías y Beneficios
                        </h4>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-shield-alt me-3" style="color: var(--old-money-green); font-size: 1.2rem;"></i>
                                    <span style="color: var(--old-money-gray);">Producto Auténtico</span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-shipping-fast me-3" style="color: var(--old-money-green); font-size: 1.2rem;"></i>
                                    <span style="color: var(--old-money-gray);">Envío Express</span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-undo-alt me-3" style="color: var(--old-money-green); font-size: 1.2rem;"></i>
                                    <span style="color: var(--old-money-gray);">Devolución 30 días</span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-headset me-3" style="color: var(--old-money-green); font-size: 1.2rem;"></i>
                                    <span style="color: var(--old-money-gray);">Soporte 24/7</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Purchase Section -->
                    @if($product->stock > 0)
                        <div class="purchase-section p-4" style="background: var(--old-money-white); border-radius: 0.75rem; border: 2px solid var(--old-money-green); box-shadow: 0 4px 12px rgba(0,0,0,0.05);">
                            <div class="row align-items-center mb-4">
                                <div class="col-md-4">
                                    <label for="quantity" class="form-label fw-semibold" style="color: var(--old-money-black);">Cantidad:</label>
                                    <div class="input-group">
                                        <button class="btn btn-outline-secondary" type="button" onclick="decreaseQuantity()">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <input type="number" class="form-control text-center" id="quantity" value="1" min="1" max="{{ $product->stock }}" style="max-width: 80px;">
                                        <button class="btn btn-outline-secondary" type="button" onclick="increaseQuantity()">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="d-grid gap-2 d-md-block">
                                        <button class="btn btn-old-money btn-lg px-4" onclick="addToCart({{ $product->id }})">
                                            <i class="fas fa-shopping-bag me-2"></i>Añadir al Carrito
                                        </button>
                                        <button class="btn btn-outline-old-money btn-lg px-4" onclick="buyNow({{ $product->id }})">
                                            <i class="fas fa-bolt me-2"></i>Comprar Ahora
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="purchase-section p-4 text-center" style="background: #F9F9F9; border-radius: 0.75rem; border: 1px solid #E5E7EB;">
                            <h5 class="text-muted mb-3">
                                <i class="fas fa-exclamation-triangle me-2"></i>Producto No Disponible
                            </h5>
                            <p class="text-muted mb-3">Este producto se encuentra temporalmente agotado.</p>
                            <button class="btn btn-outline-secondary" onclick="notifyWhenAvailable({{ $product->id }})">
                                <i class="fas fa-bell me-2"></i>Notificarme Cuando Esté Disponible
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Additional Information Section -->
        <div class="row mt-5 pt-5 border-top">
            <div class="col-12">
                <h3 class="text-center mb-5" style="font-family: 'Playfair Display', serif;">Información Adicional</h3>
            </div>
            <div class="col-md-4 text-center mb-4">
                <div class="info-card p-4" style="background: var(--old-money-white); border-radius: 0.75rem; box-shadow: 0 2px 10px rgba(0,0,0,0.05); height: 100%;">
                    <i class="fas fa-truck fa-3x mb-3" style="color: var(--old-money-green);"></i>
                    <h5 style="font-family: 'Playfair Display', serif;">Envío Seguro</h5>
                    <p class="text-muted mb-0">Enviamos con el máximo cuidado para garantizar que tu producto llegue en perfectas condiciones.</p>
                </div>
            </div>
            <div class="col-md-4 text-center mb-4">
                <div class="info-card p-4" style="background: var(--old-money-white); border-radius: 0.75rem; box-shadow: 0 2px 10px rgba(0,0,0,0.05); height: 100%;">
                    <i class="fas fa-medal fa-3x mb-3" style="color: var(--old-money-green);"></i>
                    <h5 style="font-family: 'Playfair Display', serif;">Calidad Premium</h5>
                    <p class="text-muted mb-0">Cada producto es cuidadosamente seleccionado para cumplir con nuestros altos estándares de calidad.</p>
                </div>
            </div>
            <div class="col-md-4 text-center mb-4">
                <div class="info-card p-4" style="background: var(--old-money-white); border-radius: 0.75rem; box-shadow: 0 2px 10px rgba(0,0,0,0.05); height: 100%;">
                    <i class="fas fa-handshake fa-3x mb-3" style="color: var(--old-money-green);"></i>
                    <h5 style="font-family: 'Playfair Display', serif;">Servicio Personalizado</h5>
                    <p class="text-muted mb-0">Nuestro equipo está disponible para ayudarte con cualquier consulta o necesidad especial.</p>
                </div>
            </div>
        </div>

        <!-- Back to Catalog -->
        <div class="row mt-5">
            <div class="col-12 text-center">
                <a href="{{ route('products.index') }}" class="btn btn-outline-old-money">
                    <i class="fas fa-arrow-left me-2"></i>Volver al Catálogo
                </a>
            </div>
        </div>
    </div>
</div>

<script>
// Quantity Controls
function increaseQuantity() {
    const input = document.getElementById('quantity');
    const max = parseInt(input.getAttribute('max'));
    const current = parseInt(input.value);

    if (current < max) {
        input.value = current + 1;
    }
}

function decreaseQuantity() {
    const input = document.getElementById('quantity');
    const current = parseInt(input.value);

    if (current > 1) {
        input.value = current - 1;
    }
}

// Add to Cart Function
function addToCart(productId) {
    const quantity = document.getElementById('quantity').value;

    // Elegant notification
    showNotification('Producto añadido al carrito exitosamente', 'success');

    // Here you would make an AJAX request to add the item to cart
    console.log(`Adding ${quantity} of product ${productId} to cart`);
}

// Buy Now Function
function buyNow(productId) {
    const quantity = document.getElementById('quantity').value;
    showNotification('Redirigiendo al checkout...', 'info');

    // Here you would redirect to checkout
    console.log(`Buying ${quantity} of product ${productId} now`);
}

// Notify When Available
function notifyWhenAvailable(productId) {
    showNotification('Te notificaremos cuando el producto esté disponible', 'info');
    console.log(`Setting notification for product ${productId}`);
}

// Notification System
function showNotification(message, type = 'success') {
    const notification = document.createElement('div');
    const bgColor = type === 'success' ? 'var(--old-money-green)' :
                   type === 'error' ? '#DC2626' :
                   'var(--old-money-gray)';

    notification.innerHTML = `
        <div class="position-fixed top-0 end-0 p-3" style="z-index: 9999;">
            <div class="alert alert-dismissible fade show"
                 style="background-color: ${bgColor}; color: white; border: none; border-radius: 0.5rem; box-shadow: 0 4px 12px rgba(0,0,0,0.15);">
                <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : 'info-circle'} me-2"></i>
                ${message}
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
            </div>
        </div>
    `;

    document.body.appendChild(notification);

    // Auto remove after 4 seconds
    setTimeout(() => {
        notification.remove();
    }, 4000);
}

// Image Error Handling
document.getElementById('productImage').addEventListener('error', function() {
    this.src = '{{ asset('images/no-image.svg') }}';
    this.alt = 'Imagen no disponible';
});
</script>
@endsection
