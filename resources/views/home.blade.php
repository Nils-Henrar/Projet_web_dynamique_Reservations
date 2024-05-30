@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="margin-top: 20px; text-align: center;">

                <div class="card-body">
                    <!-- @if (session('status') == 'verification-link-sent')
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('You are logged in!') }} -->

                    <h1 class="text-3xl font-bold mb-8">Bienvenue sur le site de réservation de spectacles</h1>
                    <p class="text-lg">Vous pouvez consulter les spectacles disponibles</p>

                    <!-- si je ne suis pas connecté -->
                    @guest
                    <p class="text-lg">Connectez-vous pour accéder à votre espace personnel et pouvoir réserver des spectacles</p>
                    <div class="mt-4">
                        <a href="{{ route('login') }}" class="text-blue-500 hover:text-blue-700">Se connecter</a>
                    </div>
                    @endguest

                </div>
            </div>
        </div>
    </div>
</div>
@endsection