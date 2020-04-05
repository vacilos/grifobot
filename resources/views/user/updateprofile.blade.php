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
                <form method="post" action="{{ route('user_update_profile') }}">
                    @csrf
                    @method('patch')
                    <div class="form-group">
                        <label for="level"><b>Επίπεδο</b></label>
                        <select name="level" id="level" size="1" aria-describedby="levelhelp" class="form-control">
                            <option value="1" @if(Auth::user()->level == 1) selected @endif>Α' Δημοτικού</option>
                            <option value="2" @if(Auth::user()->level == 2) selected @endif>Β' Δημοτικού</option>
                            <option value="3" @if(Auth::user()->level == 3) selected @endif>Γ' Δημοτικού</option>
                            <option value="4" @if(Auth::user()->level == 4) selected @endif>Δ' Δημοτικού</option>
                            <option value="5" @if(Auth::user()->level == 5) selected @endif>Ε' Δημοτικού</option>
                            <option value="6" @if(Auth::user()->level == 6) selected @endif>ΣΤ' Δημοτικού</option>
                            <option value="7" @if(Auth::user()->level == 7) selected @endif>Νηπιαγωγείο</option>
{{--                            <option value="7" @if(Auth::user()->level == 7) selected @endif>Α' Γυμνασίου</option>--}}
{{--                            <option value="8" @if(Auth::user()->level == 8) selected @endif>Β' Γυμνασίου</option>--}}
{{--                            <option value="9" @if(Auth::user()->level == 9) selected @endif>Γ' Γυμνασίου</option>--}}
                        </select>
                        <small id="levelhelp" class="form-text text-muted">Καταγράψτε το επίπεδο της άσκησης (τάξη)</small>
                    </div>
                    <div class="form-group">
                        <label for="municipality"><b>Δήμος σχολείου</b></label>
                        <select id="municipality" name="municipality" class="form-control">
                            @foreach($municipalities as $municipality)
                                <option value="{{ $municipality->id }}" @if(Auth::user()->municipality->id == $municipality->id) selected @endif >
                                    {{$municipality->municipality}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="newsletter"><b>Ενημέρωση</b></label>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="newsletter" name="newsletter" value="1" @if(Auth::user()->newsletter==1)checked @endif>
                                    <label class="form-check-label" for="newsletter">
                                        Πατήστε αν μας επιτρέπετε να σας στέλνουμε e-mail σχετικά με τις εκδόσεις του Γριφομπότ, τα τουρνουά που γίνονται και τα challenges που σας κάνουν άλλοι μαθητές.
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="avatar"><b>Avatar</b></label>
                        <div class="row">
                            <div class="col-sm-1">
                                <input name="avatar" type="radio" value="gav.png" id="gav" @if(Auth::user()->avatar == "gav.png") checked="checked" @endif/>
                                <label for="gav"><img src="{{ asset('images/gav.png') }}" class="img-fluid" /></label>
                            </div>
                            <div class="col-sm-1">
                                <input name="avatar" type="radio" value="boy_avatar0.png" id="boy0" @if(Auth::user()->avatar == "boy_avatar0.png") checked="checked" @endif/>
                                <label for="boy0"><img src="{{ asset('images/boy_avatar0.png') }}" class="img-fluid" /></label>
                            </div>
                            <div class="col-sm-1">
                                <input name="avatar" type="radio" value="boy_avatar1.png" id="boy1" @if(Auth::user()->avatar == "boy_avatar1.png") checked="checked" @endif/>
                                <label for="boy1"><img src="{{ asset('images/boy_avatar1.png') }}" class="img-fluid" /></label>
                            </div>
                            <div class="col-sm-1">
                                <input name="avatar" type="radio" value="boy_avatar2.png" id="boy2" @if(Auth::user()->avatar == "boy_avatar2.png") checked="checked" @endif/>
                                <label for="boy2"><img src="{{ asset('images/boy_avatar2.png') }}" class="img-fluid" /></label>
                            </div>
                            <div class="col-sm-1">
                                <input name="avatar" type="radio" value="boy_avatar3.png" id="boy3" @if(Auth::user()->avatar == "boy_avatar3.png") checked="checked" @endif/>
                                <label for="boy3"><img src="{{ asset('images/boy_avatar3.png') }}" class="img-fluid" /></label>
                            </div>
                            <div class="col-sm-1">
                                <input name="avatar" type="radio" value="boy_avatar3.png" id="boy4" @if(Auth::user()->avatar == "boy_avatar4.png") checked="checked" @endif/>
                                <label for="boy4"><img src="{{ asset('images/boy_avatar4.png') }}" class="img-fluid" /></label>
                            </div>
                            <div class="col-sm-1">
                                <input name="avatar" type="radio" value="girl_avatar0.png" id="girl0" @if(Auth::user()->avatar == "girl_avatar0.png") checked="checked" @endif/>
                                <label for="girl0"><img src="{{ asset('images/girl_avatar0.png') }}" class="img-fluid" /></label>
                            </div>
                            <div class="col-sm-1">
                                <input name="avatar" type="radio" value="girl_avatar1.png" id="girl1" @if(Auth::user()->avatar == "girl_avatar1.png") checked="checked" @endif/>
                                <label for="girl1"><img src="{{ asset('images/girl_avatar1.png') }}" class="img-fluid" /></label>
                            </div>
                            <div class="col-sm-1">
                                <input name="avatar" type="radio" value="girl_avatar2.png" id="girl2" @if(Auth::user()->avatar == "girl_avatar2.png") checked="checked" @endif/>
                                <label for="girl2"><img src="{{ asset('images/girl_avatar2.png') }}" class="img-fluid" /></label>
                            </div>
                            <div class="col-sm-1">
                                <input name="avatar" type="radio" value="girl_avatar3.png" id="girl3" @if(Auth::user()->avatar == "girl_avatar3.png") checked="checked" @endif/>
                                <label for="girl3"><img src="{{ asset('images/girl_avatar3.png') }}" class="img-fluid" /></label>
                            </div>
                            <div class="col-sm-1">
                                <input name="avatar" type="radio" value="girl_avatar3.png" id="girl4" @if(Auth::user()->avatar == "girl_avatar4.png") checked="checked" @endif/>
                                <label for="girl4"><img src="{{ asset('images/girl_avatar4.png') }}" class="img-fluid" /></label>
                            </div>
                            @for($i=0;$i<=26;$i++)
                                <div class="col-sm-1">

                                    <input name="avatar" type="radio" value="animal{{$i}}.png" id="animal{{$i}}" @if(Auth::user()->avatar == 'animal'.$i.'.png') checked="checked" @endif/>
                                    <label for="animal{{$i}}"><img src="{{ asset('images/') }}/animal{{$i}}.png" class="img-fluid" /></label>
                                </div>
                            @endfor
                        </div>


                    </div>
                    <button type="submit" class="btn btn-success">Συνέχεια</button> <a href="{{route('user_home')}}" class="btn btn-default">Επιστροφή</a>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('javascript')

@endsection
