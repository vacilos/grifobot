@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-1">
        <div class="col-sm-12">
            <h3>Challenges</h3>
            <p>
                Μπορείς όταν τελειώσεις ένα παιχνίδι να κάνεις challenge ένα φίλο ή μία φίλη σου για να δεις τι σκορ μπορεί να πετύχει. Για να το κάνεις αυτό θα χρειαστεί να γνωρίζεις είτε το ψευδώνυμο είτε το email του. Δες τα παιχνίδια σου για να κάνεις κι εσύ challenge: <a href="{{ route('user_games') }}" class="btn btn-sm btn-info">Tα παιχνίδια μου</a>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header"><h4>Challenges</h4></div>

                <div class="card-body">
                    <button class="btn btn-info btn-sm" onclick="javascript:history.go(-1);"><i class="fa fa-chevron-left"></i> Πίσω</button>

                    <table class="table table-bordered table-striped table-responsive-sm">
                        <thead>
                        <tr>
                            <th>
                                Παιχνίδι
                            </th>
                            <th>
                                Λεπτομέρειες
                            </th>
                            <th>
                                Ενέργεια
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($challenges as $challenge)
                            <tr @if($challenge->from_user_id == Auth::user()->id)
                                class="table-success"
                            @else
                                class="table-warning"
                            @endif>
                                <td>
                                    {{$challenge->plan->id}}
                                </td>
                                <td>
                                    @if($challenge->from_user_id == Auth::user()->id)
                                        Έχεις κάνει challenge στον/στην {{ $challenge->toUser->name }}
                                    @else
                                        Σου έχει κάνει challenge ο/η {{ $challenge->fromUser->name }}
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route("plan_details", ['plan'=> $challenge->plan_id]) }}" class="btn btn-sm btn-warning">Σκόρ παιχνιδιού</a>
                                    <a href="{{ route("play_plan", ['plan'=> $challenge->plan_id]) }}" class="btn btn-sm btn-info">Παίξε τώρα</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
