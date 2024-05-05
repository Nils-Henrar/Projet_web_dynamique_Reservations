@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Admin</h1>
@stop

@section('content')
<div class="container p-2">
    <div class="row mb-3">
        <p>Welcome to this beautiful admin panel.</p>
    </div>
    <div class="row">

        <!-- Show -->
        <div class="col-md-4 col-sm-12">
            <div class="small-box bg-gradient-warning">
                <div class="inner">
                    <h3>{{ $shows->count() }}</h3>
                    <p>{{ $shows->first()->getTable() }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <a href="{{ route('admin.show') }}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div> 
        </div>

        <!-- Artist -->
        <div class="col-md-4 col-sm-12">
            <div class="small-box bg-gradient-info">
                <div class="inner">
                    <h3>{{ $artists->count() }}</h3>
                    <p>{{ $artists->first()->getTable() }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <a href="{{ route('artist.index') }}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div> 
        </div>
        <!-- Representation -->
        <div class="col-md-4 col-sm-12">
            <div class="small-box bg-gradient-success">
                <div class="inner">
                    <h3>{{ $representations->count() }}</h3>
                    <p>{{ $representations->first()->getTable() }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <a href="{{ route('representation.index') }}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div> 
        </div>

        <!-- Reservation -->
        <div class="col-md-4 col-sm-12">
            <div class="small-box bg-gradient-danger">
                <div class="inner">
                    <h3>{{ $reservations->count() }}</h3>
                    <p>{{ $reservations->first()->getTable() }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <a href="{{ route('reservation.index') }}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div> 
        </div>

        <!-- Location -->
        <div class="col-md-4 col-sm-12">
            <div class="small-box bg-gradient-primary">
                <div class="inner">
                    <h3>{{ $locations->count() }}</h3>
                    <p>{{ $locations->first()->getTable() }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <a href="{{ route('artist.index') }}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div> 
        </div>

        <!-- Localities -->
        <div class="col-md-4 col-sm-12">
            <div class="small-box bg-gradient-secondary">
                <div class="inner">
                    <h3>{{ $localities->count() }}</h3>
                    <p>{{ $localities->first()->getTable() }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <a href="{{ route('artist.index') }}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div> 
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-md-4 col-sm-12"> 
            <div class="info-box bg-info">
                <span class="info-box-icon"><i class="far fa-flag"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">{{ $users->first()->getTable() }}</span>
                    <span class="info-box-number">{{ $users->count() }}</span>
                </div>
            </div>   
        </div>
        <div class="col-md-4 col-sm-12">
            <div class="info-box bg-success">
                <span class="info-box-icon"><i class="far fa-flag"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">{{ $reviews->first()->getTable() }}</span>
                    <span class="info-box-number">{{ $users->count() }}</span>
                </div>
            </div>         
        </div>
        <div class="col-md-4 col-sm-12">
        <div class="info-box" style="background-color:#c9a0dc;">
                <span class="info-box-icon"><i class="far fa-flag"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Bookmarks</span>
                    <span class="info-box-number">410</span>
                </div>
            </div>  
        </div>
    </div>
</div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop