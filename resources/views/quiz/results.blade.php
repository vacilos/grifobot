@extends('layouts.app_quiz')

@section('stylesheet')
    <style>
        .manouri-16 {
            font-size: 18px;
        }
    </style>
@endsection

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="manouri">Αποτελέσματα: {{ $quiz->name }}</h2>
                    </div>
                    <div class="card-body">
                        <a href="{{route('welcome')}}">Αρχική σελίδα</a>
                        <table class="table table-bordered table-striped manouri manouri-16 table-responsive-sm">
                            <thead>
                            <tr>
                                <td>Θέση</td>
                                <td>Παίκτης</td>
                                <td>Πόντοι</td>
                                <td>Απαντήσεις</td>
                                <td>Κινήσεις</td>
                                <td>Χρόνος</td>
                            </tr>
                            </thead>
                        @foreach($stats as $stat)
                            <tr @if(Request()->username == $stat->username) class="table-success" @endif>
                                <td class="manouri">
                                    {{$loop->index+1}}
                                </td>
                                <td class="manouri">
                                    {{ $stat->username }}
                                </td>
                                <td  class="manouri">
                                    {{ $stat->score }}
                                </td>
                                <td class="manouri">
                                    {{ $stat->questions }}
                                </td>
                                <td class="manouri">
                                    {{ $stat->movements }}
                                </td>
                                <td class="manouri">
                                    {{ $stat->timedifference }}sec
                                </td>
                            </tr>
                        @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
