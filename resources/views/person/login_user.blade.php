@extends('layouts.app_1821')

@section('town')
    {{ $town->title }}
@endsection

@section('pagetitle')
    {{ $town->title }} - Γριφομπότ 1821
@endsection


@section('menu')
    <a href="{{ route('plan_invalidate', ['town' => $town->id]) }}">Log Out</a>
    <a href="{{ route('welcome_town', ['town' => $town->slug]) }}"><i class="fa fa-book"></i> Ιστορία</a>
@endsection


@section('banner')
    <section id="banner-small">
        <div class="inner">
            <section>
                <h2 style="text-align: center;"><img src="{{ asset("pubimg/pubimg") }}/{{ $town->logo }}"  style="vertical-align:middle"/> Επανάσταση 1821 - 2021 | {{ $town->title }}</h2><br/>

            </section>
        </div>
    </section>
@endsection

@section('content')
    <section id="one" class="wrapper">
        <div class="inner">
            <section class="sone">
                <p>Γράψε ένα ψευδώνυμο και έναν κωδικό για να αποθηκεύεται στο σκορ σου</p>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('plan_do_login', ['town' => $town->id]) }}">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control form-control-xl manouri manouri-xl" name="name" id="name" placeholder="Ψευδώνυμο">
                        <small class="form-text text-muted">Γράψε το ψευδώνυμό σου!</small>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-xl manouri manouri-xl" name="password" id=password" placeholder="Κωδικός (pin)" value="">
                        <small class="form-text text-muted">Ο κωδικός (pin) πρέπει να είναι 4 ψηφία</small>
                    </div>
                    <button type="submit" class="button special">ΕΠΟΜΕΝΟ <i class="fa fa-chevron-right"></i> </button>
                </form>
            </section>
        </div>
    </section>

@endsection
