@extends('layouts.admin')

@section('title', 'Gestión de Categorías - Panel de Administración')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">
        <i class="fas fa-tags me-2"></i>Gestión de Categorías
    </h1>
</div>

<!-- Categories Overview -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-number">{{ $categories->count() }}</div>
            <div class="stat-label">
                <i class="fas fa-tags me-1"></i>Total Categorías
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
            <div class="stat-number">{{ $categories->sum('products_count') }}</div>
            <div class="stat-label">
                <i class="fas fa-box me-1"></i>Total Productos
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
            <div class="stat-number">{{ $categories->sum('total_stock') }}</div>
            <div class="stat-label">
                <i class="fas fa-warehouse me-1"></i>Stock Total
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
            <div class="stat-number">${{ number_format($categories->avg('avg_price'), 2) }}</div>
            <div class="stat-label">
                <i class="fas fa-dollar-sign me-1"></i>Precio Promedio
            </div>
        </div>
    </div>
</div>

<!-- Categories Table -->
<div class="admin-card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="fas fa-list me-2"></i>Lista de Categorías
            </h5>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Categoría</th>
                        <th>Productos</th>
                        <th>Stock Total</th>
                        <th>Precio Promedio</th>
                        <th width="200">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    @switch($category->category)
                                        @case('Electrónicos')
                                            <i class="fas fa-laptop fa-2x text-primary me-3"></i>
                                            @break
                                        @case('Audio')
                                            <i class="fas fa-headphones fa-2x text-success me-3"></i>
                                            @break
                                        @case('Calzado')
                                            <i class="fas fa-running fa-2x text-warning me-3"></i>
                                            @break
                                        @case('Gaming')
                                            <i class="fas fa-gamepad fa-2x text-danger me-3"></i>
                                            @break
                                        @case('Fotografía')
                                            <i class="fas fa-camera fa-2x text-info me-3"></i>
                                            @break
                                        @case('Automotriz')
                                            <i class="fas fa-car fa-2x text-secondary me-3"></i>
                                            @break
                                        @case('Hogar')
                                            <i class="fas fa-home fa-2x text-dark me-3"></i>
                                            @break
                                        @default
                                            <i class="fas fa-tag fa-2x text-muted me-3"></i>
                                    @endswitch
                                    <div>
                                        <h6 class="mb-0">{{ $category->category }}</h6>
                                        <small class="text-muted">Categoría de productos</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-primary fs-6">{{ $category->products_count }}</span>
                            </td>
                            <td>
                                <span class="badge {{ $category->total_stock < 50 ? 'bg-warning' : 'bg-success' }} fs-6">
                                    {{ $category->total_stock }}
                                </span>
                            </td>
                            <td>
                                <strong class="text-success">${{ number_format($category->avg_price, 2) }}</strong>
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('products.category', $category->category) }}"
                                       class="btn btn-outline-info" target="_blank" title="Ver en tienda">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <button type="button" class="btn btn-outline-warning"
                                            onclick="editCategory('{{ $category->category }}')" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-outline-danger"
                                            onclick="confirmDeleteCategory('{{ $category->category }}', {{ $category->products_count }})" title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">
                                <i class="fas fa-tags fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">No hay categorías disponibles</h5>
                                <p class="text-muted">Las categorías se crean automáticamente al agregar productos.</p>
                                <a href="{{ route('admin.products.create') }}" class="btn btn-success">
                                    <i class="fas fa-plus me-1"></i>Crear Primer Producto
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Edit Category Modal -->
<div class="modal fade" id="editCategoryModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-edit text-warning me-2"></i>Editar Categoría
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editCategoryForm" method="POST" action="{{ route('admin.categories.update') }}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="old_category" class="form-label">Categoría Actual</label>
                        <input type="text" class="form-control" id="old_category" name="old_category" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="new_category" class="form-label">Nuevo Nombre</label>
                        <input type="text" class="form-control" id="new_category" name="new_category" required>
                    </div>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        Esta acción actualizará el nombre de la categoría en todos los productos asociados.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-save me-1"></i>Actualizar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Category Modal -->
<div class="modal fade" id="deleteCategoryModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-exclamation-triangle text-danger me-2"></i>Confirmar Eliminación
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="deleteCategoryForm" method="POST" action="{{ route('admin.categories.delete') }}">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <p>¿Estás seguro de que deseas eliminar la categoría <strong id="categoryToDelete"></strong>?</p>
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>¡Atención!</strong> Esta acción también eliminará <span id="productsToDelete"></span> producto(s) asociado(s) a esta categoría.
                        <br><strong>Esta acción no se puede deshacer.</strong>
                    </div>
                    <input type="hidden" id="category_to_delete" name="category">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-1"></i>Eliminar Categoría y Productos
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function editCategory(categoryName) {
    document.getElementById('old_category').value = categoryName;
    document.getElementById('new_category').value = categoryName;
    new bootstrap.Modal(document.getElementById('editCategoryModal')).show();
}

function confirmDeleteCategory(categoryName, productsCount) {
    document.getElementById('categoryToDelete').textContent = categoryName;
    document.getElementById('productsToDelete').textContent = productsCount;
    document.getElementById('category_to_delete').value = categoryName;
    new bootstrap.Modal(document.getElementById('deleteCategoryModal')).show();
}
</script>
@endsection
