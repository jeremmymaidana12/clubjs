@extends('layouts.admin')

@section('title', 'Dashboard - Panel de Administración')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">
        <i class="fas fa-tachometer-alt me-2"></i>Dashboard
    </h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <button type="button" class="btn btn-sm btn-outline-secondary">
                <i class="fas fa-download me-1"></i>Exportar
            </button>
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="stat-card">
            <div class="stat-number">{{ $totalProducts }}</div>
            <div class="stat-label">
                <i class="fas fa-box me-1"></i>Total Productos
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="stat-card" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
            <div class="stat-number">{{ $totalCategories }}</div>
            <div class="stat-label">
                <i class="fas fa-tags me-1"></i>Categorías
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="stat-card" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
            <div class="stat-number">{{ $lowStockProducts }}</div>
            <div class="stat-label">
                <i class="fas fa-exclamation-triangle me-1"></i>Stock Bajo
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="stat-card" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
            <div class="stat-number">${{ number_format($totalValue, 2) }}</div>
            <div class="stat-label">
                <i class="fas fa-dollar-sign me-1"></i>Valor Total
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row mt-4">
    <div class="col-lg-8">
        <div class="admin-card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-chart-line me-2"></i>Resumen de Productos
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Categoría</th>
                                <th>Productos</th>
                                <th>Stock Total</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $categories = \App\Models\Product::select('category')
                                    ->selectRaw('COUNT(*) as products_count')
                                    ->selectRaw('SUM(stock) as total_stock')
                                    ->groupBy('category')
                                    ->get();
                            @endphp
                            @foreach($categories as $category)
                                <tr>
                                    <td>
                                        <i class="fas fa-tag me-2 text-primary"></i>{{ $category->category }}
                                    </td>
                                    <td>
                                        <span class="badge bg-primary">{{ $category->products_count }}</span>
                                    </td>
                                    <td>
                                        <span class="badge {{ $category->total_stock < 50 ? 'bg-warning' : 'bg-success' }}">
                                            {{ $category->total_stock }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('products.category', $category->category) }}"
                                           class="btn btn-sm btn-outline-primary" target="_blank">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="admin-card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-bolt me-2"></i>Acciones Rápidas
                </h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.products.create') }}" class="btn btn-success">
                        <i class="fas fa-plus me-2"></i>Nuevo Producto
                    </a>
                    <a href="{{ route('admin.products') }}" class="btn btn-primary">
                        <i class="fas fa-box me-2"></i>Gestionar Productos
                    </a>
                    <a href="{{ route('admin.categories') }}" class="btn btn-warning">
                        <i class="fas fa-tags me-2"></i>Gestionar Categorías
                    </a>
                    <a href="{{ route('products.index') }}" class="btn btn-info" target="_blank">
                        <i class="fas fa-store me-2"></i>Ver Tienda
                    </a>
                </div>
            </div>
        </div>

        <!-- Low Stock Alert -->
        @if($lowStockProducts > 0)
            <div class="admin-card mt-3">
                <div class="card-header bg-warning text-dark">
                    <h6 class="mb-0">
                        <i class="fas fa-exclamation-triangle me-2"></i>Alerta de Stock
                    </h6>
                </div>
                <div class="card-body">
                    <p class="text-warning mb-2">
                        <strong>{{ $lowStockProducts }}</strong> productos con stock bajo (menos de 10 unidades)
                    </p>
                    <a href="{{ route('admin.products') }}?filter=low_stock" class="btn btn-sm btn-warning">
                        Ver Productos
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Recent Activity -->
<div class="row mt-4">
    <div class="col-12">
        <div class="admin-card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-clock me-2"></i>Productos Recientes
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Categoría</th>
                                <th>Precio</th>
                                <th>Stock</th>
                                <th>Fecha</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $recentProducts = \App\Models\Product::orderBy('created_at', 'desc')->limit(5)->get();
                            @endphp
                            @foreach($recentProducts as $product)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ $product->image }}" alt="{{ $product->name }}"
                                                 class="rounded me-2" width="40" height="40" style="object-fit: cover;">
                                            <div>
                                                <strong>{{ Str::limit($product->name, 30) }}</strong>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary">{{ $product->category }}</span>
                                    </td>
                                    <td>${{ number_format($product->price, 2) }}</td>
                                    <td>
                                        <span class="badge {{ $product->stock < 10 ? 'bg-danger' : 'bg-success' }}">
                                            {{ $product->stock }}
                                        </span>
                                    </td>
                                    <td>{{ $product->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('products.show', $product) }}"
                                               class="btn btn-outline-primary" target="_blank">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.products.edit', $product) }}"
                                               class="btn btn-outline-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
