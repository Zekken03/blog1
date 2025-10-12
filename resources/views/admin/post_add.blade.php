@extends('admin.layouts.main')
@section('contenido')
    <h1>Agregar Post</h1>
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if($errors->any())
 <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="/dashboard/posts" method="POST" id="form" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="title">Title</label>
        <input value="{{ old('title') }}" name="title" type="text" class="form-control" id="title">
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <input value="{{ old('description') }}" name="description" type="text" class="form-control" id="description">
    </div>
    <div class="form-group">
        <label for="file">Img</label>
        <input name="image" type="file" class="form-control" id="file">
    </div>
    <div class="form-group">
        <label for="category_id">Category</label>
        <select name="category_id" id="category_id" class="form-control">
            @forelse($categories as $cate)
                <option value="{{$cate->id}}">
                    {{ $cate->nombre  }}
                </option>
            @empty
                <option>No hay categorías disponibles</option>
            @endforelse
        </select>
    </div>
    <div class="form-group">
        <label for="content">Content</label>
        <textarea name="content" id="content" class="form-control" rows="10" required>{{ old('content') }}</textarea>
    </div>
    <!-- <div id="editor">
        <p>Hello World!</p>
        <p>Some initial **bold** text</p>
    </div> -->
    <div class="form-group">
        <button class="btn btn-primary">Insertar</button>
    </div>
</form>
@endsection
@section('scripts')
    <!-- <script>
        let quill;
        
        document.addEventListener('DOMContentLoaded', function() {
            // Inicializar Quill
            quill = new Quill('#editor', {
                theme: 'snow'
            });
            
            const form = document.getElementById('form');
            const contentField = document.getElementById('content');
            
            // Capturar contenido antes de enviar
            form.addEventListener('submit', function(e) {
                // Usar getText() en lugar de innerHTML para obtener solo el texto
                const content = quill.getText().trim();
                
                // Si está vacío, usar el HTML
                if (content.length === 0) {
                    contentField.value = quill.root.innerHTML;
                } else {
                    // Usar getContents() para obtener el delta de Quill y convertirlo
                    contentField.value = quill.root.innerHTML;
                }
                
                console.log('Contenido capturado:', contentField.value);
            });
        });
    </script> -->
@endsection