@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-sm-12">

                <h1>Δημιουργία Κατηγορίας</h1>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="post" action="{{ route('categories.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="categoryname">Κατηγορία</label>
                            <input type="text" name="categoryname" class="form-control" id="categoryname" aria-describedby="categorynamehelp" placeholder="Όνομα κατηγορίας">
                        <small id="categorynamehelp" class="form-text text-muted">Όνομα κατηγορίας.</small>
                    </div>
                    <button type="submit" class="btn btn-success">Δημιουργία</button> <a href="{{route('categories.index')}}" class="btn btn-default">Επιστροφή</a>
                </form>
            </div>
        </div>
    </div>
@endsection
