@extends ('layouts.main')

@section ('title', 'Liste des représentations')

@section ('content')


<div class="flex flex-wrap mt-4">
    <!-- Colonne de navigation / Tri / Recherche -->
    <div class="w-full sm:w-1/4 p-4">

        <!--  formulaire de recherche keyword -->
        <form id="keywordSearchForm" action="{{ route('show.index') }}" method="GET">
            <input type="text" name="keyword" placeholder="{{ __('shows.keyword_search_placeholder') }}" aria-label="Search for shows" class="border p-2 rounded">
            <button type="submit" class="bg-pink-500 hover:bg-pink-700 text-white font-bold py-2 px-4 rounded">
            {{__('shows.research')}}   
            </button>
        </form>

        <!-- Formulaire de filtrage -->
        <form id=" filterForm" action="{{ route('show.index') }}" method="GET" class="mt-4">

            <span class="text-pink-500 text-2xl mt-4">{{__('shows.filter')}}</span>


            <!-- Date picker pour choisir une date en particulier -->
            <div class="date-range-picker flex flex-col mb-4">
            {{__('shows.from')}}
                <label for="start_date"></label>
                <input type="date" id="start_date" name="start_date" value="{{ request('start_date') }}" onchange="clearDateOption()" class="border focus:ring-pink-500 focus:border-pink-500"  à <label for="end_date" ></label>
            {{__('shows.to')}}
                <input type="date" id="end_date" name="end_date" value="{{ request('end_date') }}" onchange="clearDateOption()" class="border focus:ring-pink-500 focus:border-pink-500">
            </div>

  
            <div class="date-options flex flex-col mb-4">
                <label>
                    <input type="radio" class="h-4 w-4 text-pink-600 focus:ring-pink-500 border-gray-300 rounded" name="date_option" value="today" onchange="clearDateRange()" {{ request('date_option') == 'today' ? 'checked' : '' }}>
                    {{__('shows.today')}}
                </label>
                <label>
                    <input type="radio" class="h-4 w-4 text-pink-600 focus:ring-pink-500 border-gray-300 rounded" name="date_option" value="this_week" onchange="clearDateRange()" {{ request('date_option') == 'this_week' ? 'checked' : '' }}>
                    {{__('shows.week')}}
                </label>
                <label>
                    <input type="radio" class="h-4 w-4 text-pink-600 focus:ring-pink-500 border-gray-300 rounded" name="date_option" value="this_month" onchange="clearDateRange()" {{ request('date_option') == 'this_month' ? 'checked' : '' }}>
                    {{__('shows.month')}}
                </label>
                <label>
                    <input type="radio" class="h-4 w-4 text-pink-600 focus:ring-pink-500 border-gray-300 rounded" name="date_option" value="" onchange="clearDateRange()" {{ request('date_option') ? 'checked' : '' }}>
                    {{__('shows.date')}}
                </label>

            </div>
            <!-- Sélecteur de commune -->
            <div class="relative" x-data="{ open: false }">
                <div>
                    <button @click="open = !open" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 focus:outline-none focus:border-pink-500 focus:ring focus:ring-pink-500 focus:ring-opacity-50">
                        Communes
                        <svg :class="{ 'transform rotate-180': open }" class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
                <div x-show="open" @click.away="open = false" class="absolute z-10 mt-1 w-full rounded-md bg-white shadow-lg">
                    <div class="px-4 py-2 space-y-1">
                        @foreach($localities as $locality)
                        <label class="flex items-center">
                            <input type="checkbox" name="commune[]" value="{{ $locality->id }}" {{ in_array($locality->id, (array)request('commune')) ? 'checked' : '' }} class="h-4 w-4 text-pink-600 focus:ring-pink-500 border-gray-300 rounded">
                            <span class="ml-2 text-gray-700">{{ $locality->locality }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>
            </div>

            <button onclick="submitForm()" class="bg-pink-500 hover:bg-pink-700 text-white font-bold py-1 px-3 rounded mt-4 mb-4">{{__('shows.filter_button')}}</button>

        </form>

        <script>
            function checkDateRange() {
                var startDate = document.getElementById('start_date').value;
                var endDate = document.getElementById('end_date').value;

                // Vérifie si la date de fin est vide
                if (endDate === '') {
                    document.getElementById('end_date').value = startDate;
                } else {
                    // Soumet le formulaire si la date de fin est sélectionnée
                    document.getElementById('filterForm').submit();
                }
            }

            function submitForm() {
                checkDateRange();
                document.getElementById('filterForm').submit();
            }

            function clearDateRange() {
                document.getElementById('start_date').value = '';
                document.getElementById('end_date').value = '';
            }

            function clearDateOption() {
                var radios = document.querySelectorAll('input[name="date_option"]');
                radios.forEach(function(radio) {
                    radio.checked = false;
                });
            }
        </script>
    </div>


    <!-- Colonne principale pour la liste des spectacles -->
    <div class="w-full sm:w-3/4 mb-8">
        <h2 class="text-pink-500 text-3xl mt-2">{{__('shows.list')}}</h2>
        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($shows as $show)
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <a href="{{ route('show.show', $show->id) }}"><img src="{{ asset('images/' . $show->poster_url) }}" alt="{{ $show->title }}" class="w-full h-56 object-cover"> </a>
                <!-- <div class="bg-cover bg-center h-56 p-4" style="background-image: url('{{ asset('images/' . $show->poster_url) }}')">
                    {{-- Poster du spectacle --}}
                </div>  -->
                <div class="p-4">
                    <h3 class="text-pink-500 text-2xl mb-2">{{ $show->title }}</h3>
                    <div class="text-gray-700">
                         {{__('shows.realize')}}    
                        @foreach ($show->auteurs as $auteur)
                        <a href="{{ route('artist.show', $auteur->id) }}" class="text-blue-500 hover:text-blue-700">{{ $auteur->firstname }} {{ $auteur->lastname }}</a>
                        @if (!$loop->last),
                        @endif
                        @endforeach
                    </div>
                </div>
                <div class="p-4 border-t border-gray-200">
                    <div class="flex justify-between">
                        <a href="{{ route('show.show', $show->id) }}" class="bg-pink-500 hover:bg-pink-700 text-white font-bold py-1 px-3 rounded">{{__('shows.more')}}</a>
                        @if ($show->bookable && $show->representations->count() > 0)
                        <em class="text-green-500">{{__('shows.book')}}</em>
                        @else
                        <em class="text-red-500">{{__('shows.no_book')}}</em>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection