@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>{{ $town->name }}</h3>
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>
                            Τίτλος
                        </th>
                        <td>
                            {{ $town->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Πληροφορίες
                        </th>
                        <td>
                            {{ $town->info }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Slug
                        </th>
                        <td>
                            {{ $town->slug }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Logo
                        </th>
                        <td>
                            {{ $town->logo }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Background
                        </th>
                        <td>
                            {{ $town->background }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            CSS
                        </th>
                        <td>
                            {{ $town->css }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            CSS
                        </th>
                        <td>
                            {{ $town->css }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Game Background
                        </th>
                        <td>
                            {{ $town->game_background }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Game Player
                        </th>
                        <td>
                            {{ $town->game_player }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Game Question
                        </th>
                        <td>
                            {{ $town->game_question }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Game Obstacle
                        </th>
                        <td>
                            {{ $town->game_obstacle }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Σελίδες
                        </th>
                        <td>
                            <a href="{{ route('page_create', ['town' => $town->id] ) }}" class="btn btn-primary btn-sm">Add Page</a><br/>
                            @foreach($town->pages as $page)
                                {{ $page->title }} <br/>
                            @endforeach
                        </td>
                    </tr>
                </table>
                <a href="{{ route('towns.index') }}" class="btn btn-info">Αρχική</a>
            </div>
        </div>
    </div>

@endsection

@section('javascript')

    <script type="text/javascript">
        function copyText() {
            var copyText = document.getElementById("link");
            copyText.select();
            document.execCommand("copy");
            alert('Αντιγράφηκε ο σύνδεσμος: '+copyText.value);
        }
    </script>
@endsection
