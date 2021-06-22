@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1>Δημιουργία Πόλης</h1>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="post" action="{{ route('towns.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="townname">Ονομασία</label>
                            <input type="text" name="townname" class="form-control" id="townname" aria-describedby="townnamehelp" placeholder="Όνομα πόλης">
                        <small id="townnamehelp" class="form-text text-muted">όνομα πόλης (για το διαχειριστή</small>
                    </div>
                    <div class="form-group">
                        <label for="towntitle">Τίτλος</label>
                            <input type="text" name="towntitle" class="form-control" id="towntitle" aria-describedby="towntitlehelp" placeholder="Τίτλος">
                        <small id="towntitlehelp" class="form-text text-muted">Ο τίτλος που θα φαίνεται στους επισκέπτες</small>
                    </div>
                    <div class="form-group">
                        <label for="townslug">Slug</label>
                        <input type="text" name="townslug" class="form-control" id="townslug" aria-describedby="townslughelp" placeholder="slug">
                        <small id="townslughelp" class="form-text text-muted">Slug που θα φαίνεται στο url για αναγνώριση της πόλης</small>
                    </div>
                    <div class="form-group">
                        <label for="towninfo">Πληροφορίες</label>
                            <textarea name="towninfo" class="form-control" id="towninfo" aria-describedby="towninfohelp"></textarea>
                        <small id="towninfohelp" class="form-text text-muted">Πληροφορίες για το πρόγραμμα</small>
                    </div>
                    <div class="form-group">
                        <label for="townlogo">Λογότυπο</label>
                        <input type="file" name="townlogo" class="form-control" id="townlogo" aria-describedby="townlogohelp">
                        <small id="townlogohelp" class="form-text text-muted">Λογότυπο πόλης (Μέγιστο ύψος: 600px, μέγιστο πλάτος: 600px, μέγιστο μέγεθος σε ΚΒ: 800ΚΒ</small>
                    </div>
                    <div class="form-group">
                        <label for="townbackground">Bakground</label>
                        <input type="file" name="townbackground" class="form-control" id="townbackground" aria-describedby="townbackgroundhelp">
                        <small id="townbackgroundhelp" class="form-text text-muted">Βackground σελίδων  (Μέγιστο ύψος: 600px, μέγιστο πλάτος: 600px, μέγιστο μέγεθος σε ΚΒ: 800ΚΒ</small>
                    </div>

                    <div class="form-group">
                        <label for="towncss">CSS</label>
                        <textarea name="towncss" class="form-control" id="towncss" aria-describedby="towncsshelp"></textarea>
                        <small id="towncsshelp" class="form-text text-muted">Custsom CSS για την πόλη</small>
                    </div>
                    <div class="form-group">
                        <label for="towngamebackground">Game Bakground</label>
                        <input type="file" name="towngamebackground" class="form-control" id="towngamebackground" aria-describedby="towngamebackgroundhelp">
                        <small id="towngamebackgroundhelp" class="form-text text-muted">Βackground πλαισίου παιχνιδιού  (Μέγιστο ύψος: 600px, μέγιστο πλάτος: 600px, μέγιστο μέγεθος σε ΚΒ: 800ΚΒ</small>
                    </div>
                    <div class="form-group">
                        <label for="towngameplayer">Game Player</label>
                        <input type="file" name="towngameplayer" class="form-control" id="towngameplayer" aria-describedby="towngameplayerhelp">
                        <small id="towngameplayerhelp" class="form-text text-muted">Εικόνα παίκτη παιχνιδιού  (Μέγιστο ύψος: 600px, μέγιστο πλάτος: 600px, μέγιστο μέγεθος σε ΚΒ: 800ΚΒ</small>
                    </div>
                    <div class="form-group">
                        <label for="towngamequestion">Game Question</label>
                        <input type="file" name="towngamequestion" class="form-control" id="towngamequestion" aria-describedby="towngamequestionhelp">
                        <small id="towngamequestionhelp" class="form-text text-muted">Εικόνα ερώτησης παιχνιδιού  (Μέγιστο ύψος: 600px, μέγιστο πλάτος: 600px, μέγιστο μέγεθος σε ΚΒ: 800ΚΒ</small>
                    </div>
                    <div class="form-group">
                        <label for="towngameobstacle">Game Obstacle</label>
                        <input type="file" name="towngameobstacle" class="form-control" id="towngameobstacle" aria-describedby="towngameobstaclehelp">
                        <small id="towngameobstaclehelp" class="form-text text-muted">Εικόνα εμποδίου παιχνιδιού  (Μέγιστο ύψος: 600px, μέγιστο πλάτος: 600px, μέγιστο μέγεθος σε ΚΒ: 800ΚΒ</small>
                    </div>
                    <div class="form-group">
                        <label for="municipality">Δήμος (λίστα)</label>
                        <select id="municipality" name="municipality" class="form-control">
                            @foreach($municipalities as $municipality)
                                <option value="{{ $municipality->id }}">{{$municipality->municipality}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Δημιουργία</button> <a href="{{route('towns.index')}}" class="btn btn-default">Επιστροφή</a>
                </form>
            </div>
        </div>
    </div>
@endsection
