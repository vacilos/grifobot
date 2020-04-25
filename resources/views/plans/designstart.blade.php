@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-sm-12">

                <h1>Δημιουργία Νέου Ταμπλώ</h1>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="post" action="{{ route('design') }}">
                    @csrf
                    <div class="form-group">
                        <label for="size">Μέγεθος</label>
                            <input type="text" name="size" class="form-control" id="size" aria-describedby="sizehelp" placeholder="Επίπεδο πλάνου">
                        <small id="sizehelp" class="form-text text-muted">Καταγράψτε το μέγεθος (π.χ. 6 για να φτιάξει πλάνο 6Χ6).</small>
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
                            <option value="7">Νηπιαγωγείο</option>
                        </select>
                        <small id="levelhelp" class="form-text text-muted">Καταγράψτε το επίπεδο της άσκησης (τάξη)</small>
                    </div>
                    <button type="submit" class="btn btn-success">Δημιουργία</button> <a href="{{route('maths.index')}}" class="btn btn-default">Επιστροφή</a>
                </form>
            </div>
        </div>
    </div>
@endsection
