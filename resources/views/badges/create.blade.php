@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-sm-12">

                <h1>Δημιουργία Badge</h1>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="post" action="{{ route('badges.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="badgename">Badge</label>
                            <input type="text" name="badgename" class="form-control" id="badgename" aria-describedby="badgenamehelp" placeholder="Όνομα badge">
                        <small id="badgenamehelp" class="form-text text-muted">Όνομα badge.</small>
                    </div>
                    <div class="form-group">
                        <label for="badgeimage">Εικόνα</label>
                            <input type="text" name="badgeimage" class="form-control" id="badgeimage" aria-describedby="badgeimagehelp" placeholder="Εικόνα badge">
                        <small id="badgeimagehelp" class="form-text text-muted">Εικόνα svg.</small>
                    </div>
                    <div class="form-group">
                        <label for="badgecondition">Συνθήκη</label>
                            <input type="text" name="badgecondition" class="form-control" id="badgecondition" aria-describedby="badgeconditionhelp" placeholder="Συνθήκη">
                        <small id="badgeconditionhelp" class="form-text text-muted">γράψε τη συνθήκη (1GAME, 1POINT, 50MOVE).</small>
                    </div>
                    <button type="submit" class="btn btn-success">Δημιουργία</button> <a href="{{route('badges.index')}}" class="btn btn-default">Επιστροφή</a>
                </form>
            </div>
        </div>
    </div>
@endsection
