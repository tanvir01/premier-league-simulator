<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Premier League Simulator</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <script src="http://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>
    <script src="{{asset('/js/script.js')}}"></script>
</head>
<body>
<div class="container">

    <div class="row">
        <div class="alert alert-info info-box">
            <div><strong>1 </strong> Hi, this is a four team premier cup simulator app</div>
            <div><strong>2 </strong> you can see standings and future matches, then you can choose to simulate weekly or
                all the weeks matches immediately
            </div>
            <div><strong>3 </strong> there is also a champion predictor with current team standings</div>
            <div><strong>4 </strong> in each week you can reset all the cup and do every thing from zero</div>
            <div><strong>5 </strong> in this league each team play 6 games including 2 times against another team, one
                home and one away
            </div>
            <div><strong>6 </strong> <span class="info-box_important_note">Please note home teams with better standings rank have higher chance to win the match</span>
            </div>
        </div>
    </div>

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
                                                {{$game->homeTeam->name}} &nbsp;&nbsp;
                                                {{$game->home_team_goal}} - {{$game->away_team_goal}} &nbsp;&nbsp;
                                                {{$game->awayTeam->name}}
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
