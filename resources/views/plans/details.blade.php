@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header"><h4>Παιχνίδι {{ $plan->id }}</h4></div>

                <div class="card-body">
                    <button class="btn btn-info btn-sm" onclick="javascript:history.go(-1);"><i class="fa fa-chevron-left"></i> Πίσω</button>
                    <a href="{{ route("play_plan", ['plan'=> $plan->id]) }}" class="btn btn-sm btn-success">Παίξε τώρα</a>

                    <table class="table table-bordered table-striped table-responsive-sm">
                        <thead>
                        <tr>
                            <th>
                                Παίκτης
                            </th>
                            <th>
                                Σκορ
                            </th>
                            <th>
                                Ώρα
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($scores as $score)
                            <tr @if($score->user->id == Auth::user()->id) class="table-success"  @endif >
                                <td>
                                    <img src="{{asset('images')}}/{{$score->user->avatar}}" class="img-fluid" style="max-width:30px;"/>&nbsp;{{$score->user->name}}
                                </td>
                                <td>
                                    {{ number_format($score->score) }} <br/>
                                    <small>{{ $score->movements }} κινήσεις</small>
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($score->updated_at)->format('d.m.Y H:i')}}
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
