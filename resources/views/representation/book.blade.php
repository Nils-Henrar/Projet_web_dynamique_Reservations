@extends ('layouts.main')

@section ('title', 'Réserver une représentation')

@section ('content')

<article>

    <h1 class="text-3xl mt-4"><strong>Representation du {{ $date }} à {{ $time }}</strong></h1>
    <p class="mt-4"><strong>Spectacle</strong> : {{ $representation->show->title }}</p>

    <p class="mt-4"><strong>Lieu :</strong>
        @if ($representation->location)
        {{ $representation->location->designation }}
        @elseif ($representation->show->location)
        {{ $representation->show->location->designation }}
        @else
        à déterminer
        @endif
    </p>

    <!-- select le nombre de place avec les différents types de prix (adulte, enfant, senior) -->
    <form action="{{ route('create-payment-checkout') }}" method="POST" class="mt-4">
        @csrf
        <input type="hidden" name="representation_id" value="{{ $representation->id }}">

        @foreach ($currentPrices as $price)
        <div class="mt-4">
            <label for="places_{{ $price->type }}" class="block">{{ ucfirst($price->type) }}(s) - {{ $price->price }}€</label>
            <input type="number" name="places[{{ $price->type }}]" id="places_{{ $price->type }}" class="border border-pink-400 p-2" data-price="{{ $price->price }}" min="0" value="0" required>
        </div>
        @endforeach


        <p class="mt-4"><strong>Total</strong> : <span id="total">0</span>€</p>

        <button type="submit" class="bg-pink-500 hover:bg-pink-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mt-4">Continuer vers le payement</button>
    </form>


</article>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const inputs = document.querySelectorAll('input[type="number"]');
        const totalElement = document.getElementById('total');

        function updateTotal() {
            let total = 0;
            inputs.forEach(input => {
                const price = parseFloat(input.dataset.price);
                const quantity = parseInt(input.value, 10) || 0;
                total += price * quantity;
            });

            totalElement.textContent = total;
        }

        inputs.forEach(input => input.addEventListener('input', updateTotal));

        // Initialiser le total à 0€
        updateTotal();
    });
</script>

<nav class="mt-4"><a href="{{ route('show.show', $representation->show->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4 rounded focus:outline-none focus:shadow-outline">Retour</a></nav>

@endsection