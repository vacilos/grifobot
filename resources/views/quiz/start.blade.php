@extends('layouts.app_quiz')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        @if(Request()->message != null)
                            <b class="text-danger">{{ Request()->message }}</b>
                        @endif
                        <form method="post" action="{{ route('quiz_play_name') }}">
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control form-control-xl manouri manouri-xl" name="pin" id=pin" placeholder="Δώσε το PIN" value="{{ Request()->pin }}">
                                <small class="form-text text-muted">Γράψε το PIN που έχεις για το KOYIZ!</small>
                            </div>
                            <button type="submit" class="btn btn-success btn-lg manouri btn-block manouri-lg">Επόμενο</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
