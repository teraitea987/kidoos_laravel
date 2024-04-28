<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edition') }}
        </h2>

        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="custom-form">
                        <form action="{{ route('word.update', $word->id) }}" method="post" enctype="multipart/form-data">
                            
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label for="title">Nom</label>
                                  <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $word->title)" required autofocus autocomplete="title" />
                                
                                @error('title')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $errors->first('title') }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Choisir une image <span style="color: red">(jpg, png,
                                        gif)</span></label>
                                <input type="file" name="fileToUpload" id="fileToUpload"
                                    onchange="previewImage(event)">

                                @error('fileToUpload')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $errors->first('fileToUpload') }}
                                    </div>
                                @enderror

                                @if ($word->path)
                                  <img id="preview" src="{{ asset($word->path) }}" width="200">
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Valider" name="submit">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <script>
                function previewImage(event) {
                    var reader = new FileReader();
                    reader.onload = function() {
                        var output = document.getElementById('preview');
                        output.src = reader.result;
                    };
                    reader.readAsDataURL(event.target.files[0]);
                }

                setTimeout(function() {
                    document.querySelector('.alert-success').style.display = 'none';
                }, 5000);
            </script>
</x-app-layout>
