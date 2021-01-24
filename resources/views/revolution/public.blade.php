@extends('layouts.app_revolution')

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
                <h3>Παιχνίδια - Γριφομπότ Κουιζ</h3>
                <p>Διάξετε από τα παρακάτω παιχνίδια σύμφωνα με την τάξη</p>
            </div>
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{route('1821')}}" class="btn btn-primary btn-lg manouri"><i class="fa fa-home"></i> Αρχική</a>
                        <table class="table table-bordered table-striped manouri manouri-16 table-responsive-sm">
                            <thead>
                            <tr>
                                <td>Τίτλος</td>
                                <td>Ενέργειες</td>
                            </tr>
                            </thead>
                            <tr>
                                <td class="manouri">
                                    Δημοτικό: 200 Χρόνια από την Επανάσταση του 1821
                                </td>
                                <td class="manouri">
                                    <a href="{{route('quiz_play_name_revolution')}}" class="btn btn-primary manouri"><i class="fa fa-play"></i> Παίξε</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="manouri">
                                    Γυμνάσιο: 200 Χρόνια από την Επανάσταση του 1821
                                </td>
                                <td class="manouri">
                                    <a href="{{route('quiz_play_name_revolution')}}" class="btn btn-primary manouri"><i class="fa fa-play"></i> Παίξε</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="manouri">
                                    Λύκειο: 200 Χρόνια από την Επανάσταση του 1821
                                </td>
                                <td class="manouri">
                                    <a href="{{route('quiz_play_name_revolution')}}" class="btn btn-primary manouri"><i class="fa fa-play"></i> Παίξε</a>
                                </td>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
