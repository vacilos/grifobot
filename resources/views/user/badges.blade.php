@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">Badges - Μετάλλια</div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-12">
                            <h3>Παιχνίδια</h3>
                        </div>

                        <div class="col text-center">
                            @if(in_array('1GAME', $badgeCondition))
                                <img src="{{ asset('badges/badge_1GAME.png') }}" class="img-fluid"/>
                                <br/><b>1 Παιχνίδι</b>
                            @else
                                <img src="{{ asset('badges/badge_1GAME_off.png') }}" class="img-fluid"/>
                                <br/><span class="text-muted">1 Παιχνίδι</span>
                            @endif

                        </div>
                        <div class="col text-center">
                            @if(in_array('10GAME', $badgeCondition))
                                <img src="{{ asset('badges/badge_10GAME.png') }}" class="img-fluid"/>
                                <br/><b>10 Παιχνίδια</b>
                            @else
                                <img src="{{ asset('badges/badge_10GAME_off.png') }}" class="img-fluid"/>
                                <br/><span class="text-muted">10 Παιχνίδια</span>
                            @endif
                        </div>
                        <div class="col text-center">
                            @if(in_array('100GAME', $badgeCondition))
                                <img src="{{ asset('badges/badge_100GAME.png') }}" class="img-fluid"/>
                                <br/><b>100 Παιχνίδια</b>
                            @else
                                <img src="{{ asset('badges/badge_100GAME_off.png') }}" class="img-fluid"/>
                                <br/><span class="text-muted">100 Παιχνίδια</span>
                            @endif
                        </div>
                        <div class="col text-center">
                            @if(in_array('1KGAME', $badgeCondition))
                                <img src="{{ asset('badges/badge_1KGAME.png') }}" class="img-fluid"/>
                                <br/><b>1.000 Παιχνίδια</b>
                            @else
                                <img src="{{ asset('badges/badge_1KGAME_off.png') }}" class="img-fluid"/>
                                <br/><span class="text-muted">1.000 Παιχνίδια</span>
                            @endif
                        </div>
                    </div>
                    <hr/>
                    <div class="row text-center">
                        <div class="col-sm-12">
                            <h3>Πόντοι</h3>
                        </div>

                        <div class="col text-center">
                            @if(in_array('1KPOINT', $badgeCondition))
                                <img src="{{ asset('badges/badge_1KPOINT.png') }}" class="img-fluid"/>
                                <br/><b>1.000 Πόντοι</b>
                            @else
                                <img src="{{ asset('badges/badge_1KPOINT_off.png') }}" class="img-fluid"/>
                                <br/><span class="text-muted">1.000 Πόντοι</span>
                            @endif
                            <br/>
                        </div>
                        <div class="col text-center">
                            @if(in_array('10KPOINT', $badgeCondition))
                                <img src="{{ asset('badges/badge_10KPOINT.png') }}" class="img-fluid"/>
                                <br/><b>10.000 Πόντοι</b>
                            @else
                                <img src="{{ asset('badges/badge_10KPOINT_off.png') }}" class="img-fluid"/>
                                <br/><span class="text-muted">10.000 Πόντοι</span>
                            @endif
                        </div>
                        <div class="col text-center">
                            @if(in_array('100KPOINT', $badgeCondition))
                                <img src="{{ asset('badges/badge_100KPOINT.png') }}" class="img-fluid"/>
                                <br/><b>100.000 Πόντοι</b>
                            @else
                                <img src="{{ asset('badges/badge_100KPOINT_off.png') }}" class="img-fluid"/>
                                <br/><span class="text-muted">100.000 Πόντοι</span>
                            @endif
                        </div>
                        <div class="col text-center">
                            @if(in_array('1MPOINT', $badgeCondition))
                                <img src="{{ asset('badges/badge_1MPOINT.png') }}" class="img-fluid"/>
                                <br/><b>1.000.000 Πόντοι</b>
                            @else
                                <img src="{{ asset('badges/badge_1MPOINT_off.png') }}" class="img-fluid"/>
                                <br/><span class="text-muted">1.000.000 Πόντοι</span>
                            @endif
                        </div>
                    </div>
                    <hr/>
                    <div class="row text-center">
                        <div class="col-12">
                            <h3>Κινήσεις</h3>
                        </div>

                        <div class="col text-center">
                            @if(in_array('50MOVE', $badgeCondition))
                                <img src="{{ asset('badges/badge_50MOVE.png') }}" class="img-fluid"/>
                                <br/><b>50 Κινήσεις</b>
                            @else
                                <img src="{{ asset('badges/badge_50MOVE_off.png') }}" class="img-fluid"/>
                                <br/><span class="text-muted">50 Κινήσεις</span>
                            @endif
                        </div>
                        <div class="col text-center">
                            @if(in_array('500MOVE', $badgeCondition))
                                <img src="{{ asset('badges/badge_500MOVE.png') }}" class="img-fluid"/>
                                <br/><b>500 Κινήσεις</b>
                            @else
                                <img src="{{ asset('badges/badge_500MOVE_off.png') }}" class="img-fluid"/>
                                <br/><span class="text-muted">500 Κινήσεις</span>
                            @endif
                        </div>
                        <div class="col text-center">
                            @if(in_array('5KMOVE', $badgeCondition))
                                <img src="{{ asset('badges/badge_5KMOVE.png') }}" class="img-fluid"/>
                                <br/><b>5.000 Κινήσεις</b>
                            @else
                                <img src="{{ asset('badges/badge_5KMOVE_off.png') }}" class="img-fluid"/>
                                <br/><span class="text-muted">5.000 Κινήσεις</span>
                            @endif
                        </div>
                        <div class="col text-center">
                            @if(in_array('50KMOVE', $badgeCondition))
                                <img src="{{ asset('badges/badge_50KMOVE.png') }}" class="img-fluid"/>
                                <br/><b>50.000 Κινήσεις</b>
                            @else
                                <img src="{{ asset('badges/badge_50KMOVE_off.png') }}" class="img-fluid"/>
                                <br/><span class="text-muted">50.000 Κινήσεις</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
