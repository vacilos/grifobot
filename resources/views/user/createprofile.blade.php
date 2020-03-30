@extends('layouts.app')

@section('stylesheet')
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-sm-12">

                <h1>Προφίλ Χρήστη</h1>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="post" action="{{ route('user_store_profile') }}">
                    @csrf
                    <div class="form-group">
                        <label for="level">Επίπεδο</label>
                        <select name="level" id="level" size="1" aria-describedby="levelhelp" class="form-control">
                            <option value="1">Α' Δημοτικού</option>
                            <option value="2">Β' Δημοτικού</option>
                            <option value="3">Γ' Δημοτικού</option>
                            <option value="4">Δ' Δημοτικού</option>
                            <option value="5">Ε' Δημοτικού</option>
                            <option value="6">ΣΤ' Δημοτικού</option>
                            <option value="7">Νηπιαγωγείο</option>
{{--                            <option value="7">Α' Γυμνασίου</option>--}}
{{--                            <option value="8">Β' Γυμνασίου</option>--}}
{{--                            <option value="9">Γ' Γυμνασίου</option>--}}
                        </select>
                        <small id="levelhelp" class="form-text text-muted">Καταγράψτε το επίπεδο της άσκησης (τάξη)</small>
                    </div>
                    <div class="form-group">
                        <label for="municipality">Δήμος σχολείου</label>
                        <select id="municipality" name="municipality" class="form-control">
                            @foreach($municipalities as $municipality)
                            <option value="{{ $municipality->id }}">{{$municipality->municipality}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="avatar">Avatar</label>
                        <div class="row">
                            <div class="col-sm-2">
                                <input name="avatar" type="radio" value="gav.png" id="gav"/>
                                <label for="gav"><img src="{{ asset('images/gav.png') }}" class="img-fluid" /></label>
                            </div>
                            <div class="col-sm-2">
                                <input name="avatar" type="radio" value="boy_avatar0.png" id="boy0"/>
                                <label for="boy0"><img src="{{ asset('images/boy_avatar0.png') }}" class="img-fluid" /></label>
                            </div>
                            <div class="col-sm-2">
                                <input name="avatar" type="radio" value="boy_avatar1.png" id="boy1"/>
                                <label for="boy1"><img src="{{ asset('images/boy_avatar1.png') }}" class="img-fluid" /></label>
                            </div>
                            <div class="col-sm-2">
                                <input name="avatar" type="radio" value="boy_avatar2.png" id="boy2"/>
                                <label for="boy2"><img src="{{ asset('images/boy_avatar2.png') }}" class="img-fluid" /></label>
                            </div>
                            <div class="col-sm-2">
                                <input name="avatar" type="radio" value="boy_avatar3.png" id="boy3"/>
                                <label for="boy3"><img src="{{ asset('images/boy_avatar3.png') }}" class="img-fluid" /></label>
                            </div>
                            <div class="col-sm-2">
                                <input name="avatar" type="radio" value="boy_avatar3.png" id="boy4"/>
                                <label for="boy4"><img src="{{ asset('images/boy_avatar4.png') }}" class="img-fluid" /></label>
                            </div>
                            <div class="col-sm-2">
                                <input name="avatar" type="radio" value="girl_avatar0.png" id="girl0"/>
                                <label for="girl0"><img src="{{ asset('images/girl_avatar0.png') }}" class="img-fluid" /></label>
                            </div>
                            <div class="col-sm-2">
                                <input name="avatar" type="radio" value="girl_avatar1.png" id="girl1"/>
                                <label for="girl1"><img src="{{ asset('images/girl_avatar1.png') }}" class="img-fluid" /></label>
                            </div>
                            <div class="col-sm-2">
                                <input name="avatar" type="radio" value="girl_avatar2.png" id="girl2"/>
                                <label for="girl2"><img src="{{ asset('images/girl_avatar2.png') }}" class="img-fluid" /></label>
                            </div>
                            <div class="col-sm-2">
                                <input name="avatar" type="radio" value="girl_avatar3.png" id="girl3"/>
                                <label for="girl3"><img src="{{ asset('images/girl_avatar3.png') }}" class="img-fluid" /></label>
                            </div>
                            <div class="col-sm-2">
                                <input name="avatar" type="radio" value="girl_avatar3.png" id="girl4"/>
                                <label for="girl4"><img src="{{ asset('images/girl_avatar4.png') }}" class="img-fluid" /></label>
                            </div>
                            @for($i=0;$i<=26;$i++)
                                <div class="col-sm-2">
                                    <input name="avatar" type="radio" value="animal{{$i}}.png" id="animal{{$i}}"/>
                                    <label for="animal{{$i}}"><img src="{{ asset('images/') }}/animal{{$i}}.png" class="img-fluid" /></label>
                                </div>
                            @endfor
                        </div>


                    </div>
                    <button type="submit" class="btn btn-success">Συνέχεια</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('javascript')

@endsection
