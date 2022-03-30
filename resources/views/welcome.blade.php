<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Premier League Simulator</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css">

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container">

    @if($standings)
        <div class="row standings-box">
            <div class="col-md-12">
                <h2 style="text-align: center">Premier League Simulator</h2>
                <div class="table-responsive">
                    <table id="standings-table" class="table table-bordred table-striped">
                        <thead>
                        <th>Leage Table</th>
                        <th>Match</th>
                        @if((!$week->isLastWeek()) || ($games->first()->status == 0))<th>Predictions Of Championship</th>@endif
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <table id="standings-table" class="table table-bordred table-striped">
                                    <thead>
                                    <th>Teams</th>
                                    <th>PTS</th>
                                    <th>P</th>
                                    <th>W</th>
                                    <th>D</th>
                                    <th>L</th>
                                    <th>GD</th>
                                    </thead>
                                    <tbody>
                                    @foreach($standings as $standing)
                                        <tr>
                                            <td>
                                                {{$standing->team->name}}
                                            </td>
                                            <td>{{$standing->points}}</td>
                                            <td>{{$standing->played}}</td>
                                            <td>{{$standing->won}}</td>
                                            <td>{{$standing->draw}}</td>
                                            <td>{{$standing->loss}}</td>
                                            <td>{{$standing->goal_difference}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </td>
                            <td>
                                <table id="games-table" class="table table-bordred table-striped">
                                    <thead>
                                    <th style="text-align: left">{{$week->title}}</th>
                                    </thead>
                                    <tbody>
                                    @foreach($games as $game)
                                        <tr style="text-align: left">
                                            <td>
                                                <img width="24" height="24" src="{{asset('images/home.png')}}"> {{$game->homeTeam->name}} &nbsp;&nbsp;
                                                {{$game->home_team_goal}} - {{$game->away_team_goal}} &nbsp;&nbsp;
                                                {{$game->awayTeam->name}} <img width="24" height="24" src="{{asset('images/away.png')}}">
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </td>
                            @if((!$week->isLastWeek()) || ($games->first()->status == 0))
                            <td>
                                <table id="predictions-table" class="table table-bordred table-striped">
                                    <tbody>
                                    @foreach($predictions as $prediction)
                                        <tr style="text-align: left">
                                            <td>
                                                {{$prediction->team->name}} - {{$prediction->percentage}} %
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </td>
                            @endif
                        </tr>
                        <tr>
                            <td style="text-align: left">
                                @if((!$week->isLastWeek()) || ($games->first()->status == 0))
                                    <form method="POST" action="/simulate-all">
                                        @csrf
                                        <input type="submit" value="Play All" class="btn btn-primary play-all-button">
                                    </form>
                                @endif
                            </td>
                            <td style="text-align: right">
                                @if($games->first()->status == 0)
                                    <form method="POST" action="/simulate-week/{{$week->id}}">
                                        @csrf
                                        <input type="submit" value="Simulate Week" class="btn btn-primary simulate-button">
                                    </form>
                                @else
                                    @if(!$week->isLastWeek())
                                        <a href="/" class="btn btn-primary">Next Week</a>
                                    @endif
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <form method="POST" action="/simulate-reset">
                                    @csrf
                                    <input style="width: 100%" type="submit" value="Reset All" class="btn btn-danger reset-all-button">
                                </form>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    @endif

</div>
</body>
</html>
