<x-app-layout>
  @include('francais.partials.style_medium')
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Niveau Moyen') }}
      </h2>

      @if (session('success'))
          <div class="alert alert-success" role="alert">
              {{ session('success') }}
          </div>
      @endif
  </x-slot>

  <div class="container-custom">
      <canvas class="d-none" id="canvas"></canvas>
      <div id="tableContainer"></div>
      <div id="paginationContainer"></div>
  </div>
</x-app-layout>