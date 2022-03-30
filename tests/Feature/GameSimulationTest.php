<?php

namespace Tests\Feature;

use App\Models\Game;
use App\Models\Prediction;
use App\Models\Team;
use App\Models\Week;
use App\Services\Simulator\SimulateGame;
use App\Services\Simulator\SimulateReset;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GameSimulationTest extends TestCase
{
    private static $simulateGame;

    public static function setUpBeforeClass(): void
    {
        self::$simulateGame = new SimulateGame();
    }

    protected function tearDown(): void
    {
    }

    protected function setUp(): void
    {
        parent::setUp();
        SimulateReset::resetAll();
    }

    public function testGameSimulationForWeek()
    {
        $week1 = Week::first();
        $game = $week1->games->first();

        $this->assertionsBeforeGame($game);

        self::$simulateGame->simulateGamesForWeek($week1);
        $game = $game->refresh();

        $this->assertionsAfterGame($game);
    }

    public function testGameSimulationForAllWeeks()
    {
        $games = Game::all();
        foreach ($games as $game) {
            $this->assertionsBeforeGame($game);
        }

        self::$simulateGame->simulateGamesForAllWeeks();

        $games = Game::all();
        foreach ($games as $game) {
            $this->assertionsAfterGame($game);
        }

        $teams = Team::all();
        foreach ($teams as $team){
            $this->assertEquals(6, $team->standing->played);
        }
    }

    private function assertionsBeforeGame(Game $game)
    {
        $this->assertEquals(0, $game->status);
        $this->assertEquals(0, $game->home_team_goal);
        $this->assertEquals(0, $game->away_team_goal);

        $this->assertEquals(0, $game->homeTeam->standing->played);
        $this->assertEquals(0, $game->awayTeam->standing->played);

        $this->assertEquals(0, Prediction::sum('percentage'));
    }

    private function assertionsAfterGame(Game $game)
    {
        $this->assertEquals(1, $game->status);
        $this->assertNotEquals(0, $game->home_team_goal);
        $this->assertNotEquals(0, $game->away_team_goal);

        $this->assertNotEquals(0, $game->homeTeam->standing->played);
        $this->assertNotEquals(0, $game->awayTeam->standing->played);

        $this->assertEquals(100, Prediction::sum('percentage'));
    }
}
