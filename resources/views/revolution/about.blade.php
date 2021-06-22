@extends('layouts.app_revolution')

@section('stylesheet')
    <style>
        .manouri-16 {
            font-size: 18px;
        }

        p {
            font-size: 18px;
        }
    </style>
@endsection

@section('pagetitle')
    <img src="{{ asset("pubimg/pubimg") }}/{{ $town->logo }}" class="img-fluid"/> {{ $town->title }} - Γριφομπότ 1821
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-justify" style="padding:10px;">
                <h3>Τι είναι</h3>
                {!! nl2br(e($town->info)) !!}
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <a href="{{ route('welcome_town', ['town' => $town->slug]) }}" class="btn btn-lg btn-block btn-success">{{ $town->title }}</a>
            </div>
        </div>
    </div>
@endsection
