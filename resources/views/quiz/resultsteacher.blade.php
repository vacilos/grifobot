@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Αποτελέσματα: {{ $quiz->name }}</h3>
                <a href="{{ route('quiz_my') }}" class="btn btn-info">Αρχική</a>

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
                            <td >
                                {{$loop->index+1}}
                            </td>
                            <td >
                                {{ $stat->username }}
                            </td>
                            <td  >
                                {{ $stat->score }}
                            </td>
                            <td >
                                {{ $stat->questions }}
                            </td>
                            <td >
                                {{ $stat->movements }}
                            </td>
                            <td >
                                {{ $stat->timedifference }}sec
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

@endsection
