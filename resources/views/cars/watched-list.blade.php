@props(['cars'])

<x-app-layout title="Watched List" className="page-watched-list">
       <main>
      <!-- New Cars -->
      <section>
        <div class="container">
          <h2>My Favourite Cars</h2>
          <div class="car-items-listing">
            @foreach ($cars as $car)
                <x-car-item :$car :isWatched="true"/>
            @endforeach
          </div>

          {{ $cars->onEachSide(1)->links() }}
        </div>
      </section>
      <!--/ New Cars -->
    </main>
</x-app-layout>