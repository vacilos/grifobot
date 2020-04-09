@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h3>{{ $tournament->name }}</h3> </div>

                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col text-center">
                               Το τουρνουά έχει ολοκληρωθεί.
                            </div>
                        </div>
                        <a href="{{ route('results_tournament', ['tournament'=>$tournament->id]) }}">Αποτελέσματα Τουρνουά</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
