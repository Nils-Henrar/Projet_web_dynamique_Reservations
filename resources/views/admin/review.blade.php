@extends('adminlte::page')

@section('title', 'Review')

@section('content_header')
    <h1>Review</h1>
@stop

@section('content')
<div class="container">

    <div class="row">
        <p>Gestion des reviews.</p>
    </div>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    <div class="row mt-4 justify-content-center">
        <div class="col-md-12">

        <div class="row mb-3">
            @if ($reviews->isEmpty())
                <p class="text-center">Aucun résultat trouvé.</p>
            @else
            <table class="table table-striped border">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Show</th>
                        <th>stars</th>
                        <th class="col-md-4">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reviews as $review)
                    <tr>
                        <td>{{ $review->id }}</td>
                        <td>{{ $review->user->firstname }}</td>
                        <td>{{ $review->user->lastname }}</td>
                        <td>{{ $review->show->title }}</td>
                        <!-- <td>{{ $review->stars }}
                        @for ($i = $review->stars; $i < 5; $i++)
    ☆
@endfor
                        </td> -->
                        <td>
                        @for ($i = 0; $i < $review->stars; $i++)
        ★ <!-- Étoiles pleines pour le nombre de 'stars' -->
    @endfor
    @for ($i = $review->stars; $i < 5; $i++)
        ☆ <!-- Étoiles vides pour le reste -->
    @endfor
                        </td>
                        <td>
                            <div class="row">
                                @if($review->validated == 0)
                                    <form action="{{ route('admin.validatedreview', $review->id) }}" method="POST">
                                        @csrf
                                        @method('POST')
                                        <button type="submit" class="btn btn-success">valider</button>
                                    </form>
                                @else
                                    <form action="{{ route('admin.unvalidatedreview', $review->id) }}" method="POST">
                                        @csrf
                                        @method('POST')
                                        <button type="submit" class="btn btn-danger">dévalider</button>
                                    </form>
                                @endif
                                
                                <form action="" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cet artiste ?');" class="ml-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">delete</button>
                                </form>
                            </div>
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

@stop

@section('css')
@stop

@section('js')
@stop