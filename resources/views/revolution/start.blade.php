@extends('layouts.app_revoltion')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        @if(Request()->message != null)
                            <h3 class="text-danger text-center">{{ Request()->message }}</h3>
                        @endif
                        <form method="post" action="{{ route('quiz_play_name') }}">
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control form-control-xl manouri manouri-xl" name="pin" id=pin" placeholder="Δώσε το PIN" value="{{ Request()->pin }}">
                                <small class="form-text text-muted">Γράψε το PIN που έχεις για το KOYIZ!</small>
                            </div>
                            <button type="submit" class="btn btn-success btn-lg manouri btn-block manouri-lg">Επόμενο <i class="fa fa-chevron-right"></i> </button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
