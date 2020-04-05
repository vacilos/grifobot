@extends('layouts.app')

@section('stylesheet')
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-sm-12">

                <h1>Σημαντική ενημέρωση</h1>
                <p>
                    Θα σας παρακαλούσαμε να μας ενημερώσετε αν επιθυμείτε να σας στέλνουμε e-mail για να σας ενημερώνουμε για τις <b>νέες εκδόσεις του Γριφομπότ</b>, τα <b>τουρνουά</b> που θα γίνονται καθώς και <b>challenges</b> που μπορεί να σας κάνουν άλλοι μαθητές. Μπορείτε να αλλάξετε στο μέλλον την επιλογή σας από την επιλογή "Αλλαγή Προφίλ".
                </p>
                <div class="text-center">
                    <a href="{{ route('user_newsletter_answer', ['answer'=>1]) }}" class="btn btn-success">Ναι, επιθυμώ</a>
                    <a href="{{ route('user_newsletter_answer', ['answer'=>0]) }}" class="btn btn-danger">Όχι, δεν επιθυμώ</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')

@endsection
