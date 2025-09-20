@extends('layouts.admin')

@section('title', 'Editar Producto - Panel de Administración')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">
        <i class="fas fa-edit me-2"></i>Editar Producto
    </h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('admin.products') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i>Volver a Productos
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="admin-card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-info-circle me-2"></i>Información del Producto
                </h5>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <h6><i class="fas fa-exclamation-triangle me-2"></i>Por favor corrige los siguientes errores:</h6>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="name" class="form-label">
                                <i class="fas fa-tag me-1"></i>Nombre del Producto *
                            </label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   id="name" name="name" value="{{ old('name', $product->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">
                            <i class="fas fa-align-left me-1"></i>Descripción *
                        </label>
                        <textarea class="form-control @error('description') is-invalid @enderror"
                                  id="description" name="description" rows="4" required>{{ old('description', $product->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="price" class="form-label">
                                <i class="fas fa-dollar-sign me-1"></i>Precio *
                            </label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control @error('price') is-invalid @enderror"
                                       id="price" name="price" value="{{ old('price', $product->price) }}"
                                       step="0.01" min="0" required>
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="stock" class="form-label">
                                <i class="fas fa-boxes me-1"></i>Stock *
                            </label>
                            <input type="number" class="form-control @error('stock') is-invalid @enderror"
                                   id="stock" name="stock" value="{{ old('stock', $product->stock) }}"
                                   min="0" required>
                            @error('stock')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="category" class="form-label">
                            <i class="fas fa-layer-group me-1"></i>Categoría *
                        </label>
                        <div class="input-group">
                            <select class="form-select @error('category') is-invalid @enderror"
                                    id="category" name="category" required>
                                <option value="">Seleccionar categoría...</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat }}" {{ old('category', $product->category) == $cat ? 'selected' : '' }}>
                                        {{ $cat }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="button" class="btn btn-outline-secondary" onclick="toggleNewCategory()">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                        <div id="newCategoryDiv" style="display: none;" class="mt-2">
                            <input type="text" class="form-control" id="newCategory"
                                   placeholder="Nueva categoría..." onchange="selectNewCategory()">
                        </div>
                        @error('category')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">
                            <i class="fas fa-image me-1"></i>Imagen del Producto
                        </label>

                        @if($product->hasImage())
                            <div class="mb-2">
                                <small class="text-muted">Imagen actual:</small>
                                <div class="mt-1">
                                    <img src="{{ $product->image_url }}" alt="Imagen actual"
                                         class="img-thumbnail" style="max-height: 100px;">
                                </div>
                            </div>
                        @endif

                        <div class="input-group">
                            <input type="file" class="form-control @error('image') is-invalid @enderror"
                                   id="image" name="image" accept="image/*">
                            <label class="input-group-text" for="image">
                                <i class="fas fa-upload"></i>
                            </label>
                        </div>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">
                            <i class="fas fa-info-circle me-1"></i>
                            Formatos permitidos: JPG, JPEG, PNG, GIF. Tamaño máximo: 2MB. Deja en blanco para mantener la imagen actual.
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.products') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-1"></i>Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>Actualizar Producto
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="admin-card">
            <div class="card-header">
                <h6 class="mb-0">
                    <i class="fas fa-eye me-2"></i>Vista Previa
                </h6>
            </div>
            <div class="card-body">
                <div id="productPreview" class="text-center">
                    <div class="mb-3">
                        <img id="previewImage" src="{{ $product->image_url }}"
                             class="img-fluid rounded" style="max-height: 200px;">
                    </div>
                    <h6 id="previewName">{{ $product->name }}</h6>
                    <p id="previewDescription" class="text-muted small">{{ Str::limit($product->description, 80) }}</p>
                    <h5 id="previewPrice" class="text-primary">${{ number_format($product->price, 2) }}</h5>
                    <span id="previewCategory" class="badge bg-secondary">{{ $product->category }}</span>
                    <div class="mt-2">
                        <span id="previewStock" class="badge {{ $product->stock == 0 ? 'bg-danger' : ($product->stock < 10 ? 'bg-warning' : 'bg-success') }}">
                            {{ $product->stock }} unidades
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="admin-card mt-3">
            <div class="card-header">
                <h6 class="mb-0">
                    <i class="fas fa-info me-2"></i>Información del Producto
                </h6>
            </div>
            <div class="card-body">
                <ul class="list-unstyled mb-0">
                    <li class="mb-2">
                        <strong>ID:</strong> {{ $product->id }}
                    </li>
                    <li class="mb-2">
                        <strong>Creado:</strong> {{ $product->created_at->format('d/m/Y H:i') }}
                    </li>
                    <li class="mb-2">
                        <strong>Actualizado:</strong> {{ $product->updated_at->format('d/m/Y H:i') }}
                    </li>
                    <li class="mb-0">
                        <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-outline-primary" target="_blank">
                            <i class="fas fa-external-link-alt me-1"></i>Ver en tienda
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
function toggleNewCategory() {
    const div = document.getElementById('newCategoryDiv');
    div.style.display = div.style.display === 'none' ? 'block' : 'none';
    if (div.style.display === 'block') {
        document.getElementById('newCategory').focus();
    }
}

function selectNewCategory() {
    const newCat = document.getElementById('newCategory').value;
    if (newCat) {
        const select = document.getElementById('category');
        const option = new Option(newCat, newCat, true, true);
        select.add(option);
        updatePreview();
    }
}

// Live preview updates
document.getElementById('name').addEventListener('input', updatePreview);
document.getElementById('description').addEventListener('input', updatePreview);
document.getElementById('price').addEventListener('input', updatePreview);
document.getElementById('stock').addEventListener('input', updatePreview);
document.getElementById('category').addEventListener('change', updatePreview);
document.getElementById('image').addEventListener('change', handleImagePreview);

function handleImagePreview(event) {
    const file = event.target.files[0];
    const previewImage = document.getElementById('previewImage');

    if (file) {
        // Verificar que sea una imagen
        if (!file.type.startsWith('image/')) {
            alert('Por favor selecciona un archivo de imagen válido.');
            event.target.value = '';
            return;
        }

        // Verificar tamaño (2MB = 2 * 1024 * 1024 bytes)
        if (file.size > 2 * 1024 * 1024) {
            alert('El archivo es demasiado grande. El tamaño máximo es 2MB.');
            event.target.value = '';
            return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            previewImage.src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
    // Si no hay archivo, mantener la imagen actual
}

function updatePreview() {
    const name = document.getElementById('name').value;
    const description = document.getElementById('description').value;
    const price = document.getElementById('price').value;
    const stock = document.getElementById('stock').value;
    const category = document.getElementById('category').value;

    document.getElementById('previewName').textContent = name;
    document.getElementById('previewDescription').textContent = description.substring(0, 80) + (description.length > 80 ? '...' : '');
    document.getElementById('previewPrice').textContent = '$' + parseFloat(price || 0).toFixed(2);
    document.getElementById('previewCategory').textContent = category;
    document.getElementById('previewStock').textContent = stock + ' unidades';

    // Update stock badge color
    const stockBadge = document.getElementById('previewStock');
    stockBadge.className = 'badge ' + (stock == 0 ? 'bg-danger' : (stock < 10 ? 'bg-warning' : 'bg-success'));
}
</script>
@endsection
