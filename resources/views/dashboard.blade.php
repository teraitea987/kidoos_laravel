<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
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
                        <form action="{{ route('add_word') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="title">Nom</label>
                                <input required type="text" id="title" name="title">
                                @error('title')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $errors->first('title') }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label required for="">Choisir une image <span style="color: red">(jpg, png,
                                        gif)</span></label>
                                <input type="file" name="fileToUpload" id="fileToUpload"
                                    onchange="previewImage(event)">

                                @error('fileToUpload')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $errors->first('fileToUpload') }}
                                    </div>
                                @enderror
                                <img id="preview" width="200">
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Valider" name="submit">
                            </div>
                        </form>
                    </div>
                    @if (count($words) > 0))
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        #
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nom
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Image
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        action
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($words as $item)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ ucfirst($item['title']) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <img src="{{ asset($item['path']) }}" alt="{{ $item['title'] }}" width="100">
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <a href="{{ route('edit_word', $item['id']) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                            <a href="{{ route('word.delete_word', $item['id']) }}" class="text-indigo-600 hover:text-indigo-900">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
                </div>
                </div>
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
