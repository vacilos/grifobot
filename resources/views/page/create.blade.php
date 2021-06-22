@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1>Δημιουργία Σελίδας</h1>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="post" action="{{ route('page_store', ['town' => $town]) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="pagetitle">Τίτλος</label>
                            <input type="text" name="pagetitle" class="form-control" id="pagetitle" aria-describedby="pagetitlehelp" placeholder="Τίτλος">
                        <small id="pagetitlehelp" class="form-text text-muted">Ο τίτλος που θα φαίνεται στους επισκέπτες</small>
                    </div>
                    <div class="form-group">
                        <label for="pageorder">Σειρά</label>
                            <input type="text" name="pageorder" class="form-control" id="pageorder" aria-describedby="pageorderhelp" placeholder="Σειρά">
                        <small id="pageorderhelp" class="form-text text-muted">Η σειρά εμφάνισης της σελίδας</small>
                    </div>
                    <div class="form-group">
                        <label for="pageslug">Slug</label>
                        <input type="text" name="pageslug" class="form-control" id="pageslug" aria-describedby="pageslughelp" placeholder="slug">
                        <small id="pageslughelp" class="form-text text-muted">Slug που θα φαίνεται στο url για αναγνώριση της σελίδας</small>
                    </div>
                    <div class="form-group">
                        <label for="pageinfo">Κείμενο Σελίδας</label>
                            <textarea name="pageinfo" class="form-control" id="pageinfo" aria-describedby="pageinfohelp"></textarea>
                        <small id="pageinfohelp" class="form-text text-muted">Κείμενο Σελίδας</small>
                    </div>
                    <div class="form-group">
                        <label for="pagelogo">Εικόνα</label>
                        <input type="file" name="pagelogo" class="form-control" id="pagelogo" aria-describedby="pagelogohelp">
                        <small id="pagelogohelp" class="form-text text-muted">Εικόνα σελίδας (Μέγιστο ύψος: 1024px, μέγιστο πλάτος: 1024px, μέγιστο μέγεθος σε ΚΒ: 800ΚΒ</small>
                    </div>

                    <button type="submit" class="btn btn-success">Υποβολή</button> <a href="{{route('towns.show', ['town' => $town])}}" class="btn btn-default">Επιστροφή</a>
                </form>
            </div>
        </div>
    </div>
@endsection
