@extends('layouts.app')

@section('title', 'Create Category')

@section('content')

<div class="page-header">
    <h1 class="page-title">Create New Category</h1>
    <p class="page-subtitle">Add a new category to organize your tasks</p>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('category.store') }}" method="POST">
                    @csrf

                    <!-- Category Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Category Name <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control @error('name') is-invalid @enderror" 
                               id="name" 
                               name="name" 
                               value="{{ old('name') }}" 
                               placeholder="e.g., Work, Personal, Shopping"
                               >
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Color Picker -->
                    <div class="mb-3">
                        <label for="color" class="form-label">Color <span class="text-danger">*</span></label>
                        <div class="d-flex gap-2 align-items-center">
                            <input type="color" 
                                   class="form-control form-control-color @error('color') is-invalid @enderror" 
                                   id="color" 
                                   name="color" 
                                   value="{{ old('color', '#023B7E') }}"
                                   style="width: 70px; height: 45px;">
                            <input type="text" 
                                   class="form-control" 
                                   id="colorHex" 
                                   value="{{ old('color', '#023B7E') }}"
                                   readonly>
                        </div>
                        <small class="text-muted">Choose a color to identify this category</small>
                        @error('color')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Icon Selector -->
                    <div class="mb-3">
                        <label class="form-label">Icon (Optional)</label>
                        <input type="hidden" name="icon" id="selectedIcon" value="{{ old('icon', 'bi-folder') }}">
                        
                        <div class="icon-selector">
                            <div class="row g-2">
                                @php
                                    $icons = [
                                        'bi-folder', 'bi-briefcase', 'bi-person', 'bi-cart', 
                                        'bi-heart-pulse', 'bi-book', 'bi-house', 'bi-laptop',
                                        'bi-camera', 'bi-music-note', 'bi-gift', 'bi-airplane',
                                        'bi-star', 'bi-lightbulb', 'bi-palette', 'bi-hammer'
                                    ];
                                @endphp
                                @foreach($icons as $icon)
                                    <div class="col-3 col-md-2">
                                        <div class="icon-option {{ old('icon', 'bi-folder') == $icon ? 'active' : '' }}" 
                                             data-icon="{{ $icon }}">
                                            <i class="{{ $icon }}"></i>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Description (Optional)</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" 
                                  name="description" 
                                  rows="3" 
                                  placeholder="Brief description of this category">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Buttons -->
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle me-2"></i>Create Category
                        </button>
                        <a href="{{ route('categories.index') }}" class="btn btn-secondary">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Preview Card -->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Preview</h5>
            </div>
            <div class="card-body">
                <div class="category-preview" id="categoryPreview">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="preview-icon" id="previewIcon">
                            <i class="bi-folder"></i>
                        </div>
                        <div>
                            <h5 class="mb-0" id="previewName">Category Name</h5>
                            <small class="text-muted">0 tasks</small>
                        </div>
                    </div>
                    <p class="text-muted small" id="previewDescription">Description will appear here</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    .icon-option {
        border: 2px solid #e9ecef;
        border-radius: 8px;
        padding: 15px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s;
        font-size: 24px;
    }

    .icon-option:hover {
        border-color: #023B7E;
        background: #f8f9fa;
    }

    .icon-option.active {
        border-color: #023B7E;
        background: #023B7E;
        color: white;
    }

    .preview-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 30px;
        background: #023B7E20;
        color: #023B7E;
    }

    .category-preview {
        padding: 20px;
        border-left: 4px solid #023B7E;
        background: #f8f9fa;
        border-radius: 8px;
    }
</style>
@endpush

@push('scripts')
<script>
    // Color picker sync
    const colorInput = document.getElementById('color');
    const colorHex = document.getElementById('colorHex');
    const previewIcon = document.getElementById('previewIcon');
    const categoryPreview = document.querySelector('.category-preview');

    colorInput.addEventListener('input', function() {
        colorHex.value = this.value;
        previewIcon.style.background = this.value + '20';
        previewIcon.style.color = this.value;
        categoryPreview.style.borderLeftColor = this.value;
    });

    // Icon selector
    const iconOptions = document.querySelectorAll('.icon-option');
    const selectedIconInput = document.getElementById('selectedIcon');
    const previewIconElement = previewIcon.querySelector('i');

    iconOptions.forEach(option => {
        option.addEventListener('click', function() {
            iconOptions.forEach(opt => opt.classList.remove('active'));
            this.classList.add('active');
            const icon = this.dataset.icon;
            selectedIconInput.value = icon;
            previewIconElement.className = icon;
        });
    });

    // Name preview
    const nameInput = document.getElementById('name');
    const previewName = document.getElementById('previewName');

    nameInput.addEventListener('input', function() {
        previewName.textContent = this.value || 'Category Name';
    });

    // Description preview
    const descriptionInput = document.getElementById('description');
    const previewDescription = document.getElementById('previewDescription');

    descriptionInput.addEventListener('input', function() {
        previewDescription.textContent = this.value || 'Description will appear here';
    });
</script>
@endpush