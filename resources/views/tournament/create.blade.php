@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-sm-12">

                <h1>Δημιουργία Τουρνουά</h1>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="post" action="{{ route('tournaments.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="category">Κατηγορία ερωτήσεων</label>
                        <select id="category" name="category" class="form-control">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="level">Επίπεδο</label>
                        <select name="level" id="level" size="1" aria-describedby="levelhelp" class="form-control">
                            <option value="1">Α' Δημοτικού</option>
                            <option value="2">Β' Δημοτικού</option>
                            <option value="3">Γ' Δημοτικού</option>
                            <option value="4">Δ' Δημοτικού</option>
                            <option value="5">Ε' Δημοτικού</option>
                            <option value="6">ΣΤ' Δημοτικού</option>
                        </select>
                        <small id="levelhelp" class="form-text text-muted">Καταγράψτε το επίπεδο του τουρνουά</small>
                    </div>
                    <div class="form-group">
                        <label for="name">Τίτλος</label>
                        <input type="text" name="name" class="form-control" id="name" aria-describedby="namehelp" placeholder="Ονομασία Τουρνουά">
                        <small id="namehelp" class="form-text text-muted">Καταγράψτε το όνομα του τουρνουά.</small>
                    </div>
                    <div class="form-group">
                        <label for="start_date">Ημερομηνία έναρξης</label>
                        <input type="text" name="start_date" class="form-control" id="start_date" aria-describedby="start_datehelp" placeholder="Ημερομηνία">
                        <small id="start_datehelp" class="form-text text-muted">Καταγράψτε ημερομηνία έναρξης YYYY-MM-DD.</small>
                    </div>
                    <div class="form-group">
                        <label for="start_time">Ώρα έναρξης</label>
                        <input type="text" name="start_time" class="form-control" id="start_time" aria-describedby="start_timehelp" placeholder="Ώρα έναρξης">
                        <small id="start_timehelp" class="form-text text-muted">Καταγράψτε την ώρα έναρξης του τουρνουά (ΩΩ:ΛΛ).</small>
                    </div>
                    <div class="form-group">
                        <label for="end_time">Ώρα λήξης</label>
                        <input type="text" name="end_time" class="form-control" id="end_time" aria-describedby="end_timehelp" placeholder="Ώρα λήξης">
                        <small id="end_timehelp" class="form-text text-muted">Καταγράψτε την ώρα έναρξης του τουρνουά (ΩΩ:ΛΛ).</small>
                    </div>
                    <div class="form-group">
                        <label for="active">Ενεργό</label>
                        <input type="text" name="active" class="form-control" id="active" aria-describedby="activehelp" placeholder="Ενεργό (0,1)">
                        <small id="activehelp" class="form-text text-muted">Ενεργό (0,1).</small>
                    </div>
                    <button type="submit" class="btn btn-success">Δημιουργία</button> <a href="{{route('tournaments.index')}}" class="btn btn-default">Επιστροφή</a>
                </form>
            </div>
        </div>
    </div>
@endsection
