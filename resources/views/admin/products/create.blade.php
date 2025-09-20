@extends('layouts.admin')

@section('title', 'Crear Producto - Panel de Administración')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">
        <i class="fas fa-plus me-2"></i>Crear Nuevo Producto
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

                <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="name" class="form-label">
                                <i class="fas fa-tag me-1"></i>Nombre del Producto *
                            </label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   id="name" name="name" value="{{ old('name') }}" required>
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
                                  id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
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
                                       id="price" name="price" value="{{ old('price') }}"
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
                                   id="stock" name="stock" value="{{ old('stock') }}"
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
                                    <option value="{{ $cat }}" {{ old('category') == $cat ? 'selected' : '' }}>
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
                        <input type="file" class="form-control @error('image') is-invalid @enderror"
                               id="image" name="image" accept="image/*">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">
                            <i class="fas fa-info-circle me-1"></i>
                            Formatos permitidos: JPG, JPEG, PNG, GIF. Tamaño máximo: 2MB.
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.products') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-1"></i>Cancelar
                        </a>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save me-1"></i>Crear Producto
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
                        <img id="previewImage" src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAwIiBoZWlnaHQ9IjIwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KICAgIDxyZWN0IHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiIGZpbGw9IiNmOGY5ZmEiLz4KICAgIDx0ZXh0IHg9IjUwJSIgeT0iNTAlIiB0ZXh0LWFuY2hvcj0ibWlkZGxlIiBkeT0iLjNlbSIgZmlsbD0iIzZjNzU3ZCIgZm9udC1mYW1pbHk9IkFyaWFsLCBzYW5zLXNlcmlmIiBmb250LXNpemU9IjE2Ij4KICAgICAgICBTaW4gaW1hZ2VuCiAgICA8L3RleHQ+Cjwvc3ZnPg=="
                             class="img-fluid rounded" style="max-height: 200px;">
                    </div>
                    <h6 id="previewName" class="text-muted">Nombre del producto</h6>
                    <p id="previewDescription" class="text-muted small">Descripción del producto</p>
                    <h5 id="previewPrice" class="text-primary">$0.00</h5>
                    <span id="previewCategory" class="badge bg-secondary">Categoría</span>
                    <div class="mt-2">
                        <span id="previewStock" class="badge bg-success">0 unidades</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="admin-card mt-3">
            <div class="card-header">
                <h6 class="mb-0">
                    <i class="fas fa-lightbulb me-2"></i>Consejos
                </h6>
            </div>
            <div class="card-body">
                <ul class="list-unstyled mb-0">
                    <li class="mb-2">
                        <i class="fas fa-check text-success me-2"></i>
                        Usa nombres descriptivos y únicos
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-check text-success me-2"></i>
                        Incluye características clave en la descripción
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-check text-success me-2"></i>
                        Asegúrate de que el precio sea competitivo
                    </li>
                    <li class="mb-0">
                        <i class="fas fa-check text-success me-2"></i>
                        Mantén el stock actualizado
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
    } else {
        // Restaurar imagen por defecto
        previewImage.src = 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAwIiBoZWlnaHQ9IjIwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KICAgIDxyZWN0IHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiIGZpbGw9IiNmOGY5ZmEiLz4KICAgIDx0ZXh0IHg9IjUwJSIgeT0iNTAlIiB0ZXh0LWFuY2hvcj0ibWlkZGxlIiBkeT0iLjNlbSIgZmlsbD0iIzZjNzU3ZCIgZm9udC1mYW1pbHk9IkFyaWFsLCBzYW5zLXNlcmlmIiBmb250LXNpemU9IjE2Ij4KICAgICAgICBTaW4gaW1hZ2VuCiAgICA8L3RleHQ+Cjwvc3ZnPg==';
    }
}

function updatePreview() {
    const name = document.getElementById('name').value || 'Nombre del producto';
    const description = document.getElementById('description').value || 'Descripción del producto';
    const price = document.getElementById('price').value || '0.00';
    const stock = document.getElementById('stock').value || '0';
    const category = document.getElementById('category').value || 'Categoría';

    document.getElementById('previewName').textContent = name;
    document.getElementById('previewDescription').textContent = description.substring(0, 80) + (description.length > 80 ? '...' : '');
    document.getElementById('previewPrice').textContent = '$' + parseFloat(price).toFixed(2);
    document.getElementById('previewCategory').textContent = category;
    document.getElementById('previewStock').textContent = stock + ' unidades';

    // Update stock badge color
    const stockBadge = document.getElementById('previewStock');
    stockBadge.className = 'badge ' + (stock == 0 ? 'bg-danger' : (stock < 10 ? 'bg-warning' : 'bg-success'));
}

// Drag and drop functionality for image
const imageInput = document.getElementById('image');
const previewImage = document.getElementById('previewImage');

previewImage.addEventListener('click', function() {
    imageInput.click();
});

previewImage.addEventListener('dragover', function(e) {
    e.preventDefault();
    this.style.opacity = '0.7';
});

previewImage.addEventListener('dragleave', function(e) {
    e.preventDefault();
    this.style.opacity = '1';
});

previewImage.addEventListener('drop', function(e) {
    e.preventDefault();
    this.style.opacity = '1';

    const files = e.dataTransfer.files;
    if (files.length > 0) {
        imageInput.files = files;
        handleImagePreview({ target: imageInput });
    }
});
</script>
@endsection
