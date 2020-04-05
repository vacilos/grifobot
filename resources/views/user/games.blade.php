@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header"><h4>Παιχνίδια</h4></div>
                <div id="messagespace"></div>
                <div class="card-body">
                    <button class="btn btn-info btn-sm" onclick="javascript:history.go(-1);"><i class="fa fa-chevron-left"></i> Πίσω</button>

                    <table class="table table-bordered table-striped table-responsive-sm">
                        <thead>
                        <tr>
                            <th>
                                Παιχνίδι
                            </th>
                            <th>
                                Σκορ
                            </th>
                            <th>
                                Ώρα
                            </th>
                            <th>
                                Ενέργεια
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($games as $game)
                            <tr>
                                <td>
                                    {{$game->plan_id}}
                                </td>
                                <td>
                                    {{ number_format($game->score) }} <br/>
                                    <small>{{ $game->movements }} κινήσεις</small>
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($game->updated_at)->format('d.m.Y H:i')}}
                                </td>
                                <td>
                                    <a href="{{ route("play_plan", ['plan'=> $game->plan_id]) }}" class="btn btn-sm btn-info">Παίξε πάλι</a>
                                    <a href="{{ route("plan_details", ['plan'=> $game->plan_id]) }}" class="btn btn-sm btn-warning">Σκόρ άλλων</a>
                                    <button onclick="javascript:openChallenge({{$game->plan_id}});" class="btn btn-danger btn-sm">Κάνε CHALLENGE</button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $games->links() }}
                </div>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="challengeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Challenge</h5>
            </div>
            <div class="modal-body">
                <p>
                    Ζήτησε από ένα φίλο ή φίλη σου να σου δώσει το ψευδώνυμο ή το email που χρησιμοποιεί στο Γριφομπότ για να του κάνεις challenge.<br/>
                    Όταν ο φίλος ή η φίλη σου συνδεθεί στο σύστημα θα δει ένα μήνυμα πρόσκλησης να παίξει αυτό το επίπεδο.
                    Με αυτό τον τρόπο μπορείτε να δείτε ο καθένας τους πόντους του άλλου στο ίδιο επίπεδο. Μην ξεχάσετε να του πείτε ότι στείλατε το μήνυμα ;)
                </p>
                <div>
                    <input id="challenge" name="challenge" type="text" class="form-control" style="font-size:30px;" placeholder="Ψευδώνυμο ή email του φίλου ή της φίλης" autocomplete="off"/>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="modalbutton" onclick="javascript:submitChallenge();">CHALLENGE!</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
    <script type="text/javascript">

        var globalPlan = 0;
        function openChallenge(plan) {
            globalPlan = plan;
            $('#challengeModal').modal('show');
        }


        function submitChallenge() {
            $('#challengeModal').modal('hide');
            var friend_name = $('#challenge').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                }
            });
            $.ajax({
                type:'POST',
                url:'<?php echo e(route('challenge_friend')); ?>',
                data:
                    {
                        plan: globalPlan,
                        username: friend_name
                    },
                success:function(data) {
                    if(data.code == -1) {
                        $("#messagespace").html('<div class="alert alert-danger alert-dismissible fade show">  <button type="button" class="close" data-dismiss="alert">&times;</button>'+data.answer+'</div>');
                    } else {
                        $("#messagespace").html('<div class="alert alert-success alert-dismissible fade show">  <button type="button" class="close" data-dismiss="alert">&times;</button>'+data.answer+'</div>');
                    }

                },
                error:function(data) {
                    console.log(data)
                }
            });
        }

    </script>
@endsection
