@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Οι δημιουργίες των παιδιών για το γριφομπότ</h1>
                <p>
                    Με απεριόριστη συγκίνηση μοιραζόμαστε μαζί σας τις δημιουργίες των παιδιών για το πως φαντάζονται το Γριφομπότ μας!
                </p>
            </div>
        </div>
        <div class="row" style="padding-top:20px;">
            <div class="col-sm-12">
                <div class="alert alert-danger" role="alert">
                    ΣΗΜΑΝΤΙΚΟ! Χρειαζόμαστε και τις δικές σου φωτογραφίες. Πάτα  <a href="{{ route('logo') }}">εδώ</a> για να δεις
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <img src="{{asset('images/kid1.jpg')}}" class="img-fluid" />
            </div>
            <div class="col-sm-3">
                <img src="{{asset('images/kid2.jpg')}}" class="img-fluid" />
            </div>
            <div class="col-sm-3">
                <img src="{{asset('images/kid3.jpg')}}" class="img-fluid" />
            </div>
            <div class="col-sm-3">
                <img src="{{asset('images/kid4.jpg')}}" class="img-fluid" />
            </div>
            <div class="col-sm-3">
                <img src="{{asset('images/kid5.jpg')}}" class="img-fluid" />
            </div>
            <div class="col-sm-3">
                <img src="{{asset('images/kid6.jpg')}}" class="img-fluid" />
            </div>
            <div class="col-sm-3">
                <img src="{{asset('images/kid7.jpg')}}" class="img-fluid" />
            </div>
            <div class="col-sm-3">
                <img src="{{asset('images/kid8.jpg')}}" class="img-fluid" />
            </div>
            <div class="col-sm-3">
                <img src="{{asset('images/kid9.jpg')}}" class="img-fluid" />
            </div>
            <div class="col-sm-3">
                <img src="{{asset('images/kid10.jpg')}}" class="img-fluid" />
            </div>
        </div>

    </div>

@endsection
