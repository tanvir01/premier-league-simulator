<?php

namespace Tests\Feature;

use App\Models\Game;
use App\Models\Prediction;
use App\Models\Standing;
use App\Models\Week;
use App\Services\Simulator\SimulateGame;
use App\Services\Simulator\SimulateReset;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SimulateGameTest extends TestCase
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
        $team = $game->homeTeam;
        $teamStanding = $team->standing;

        $this->assertEquals(0, $game->status);
        $this->assertEquals(0, $game->home_team_goal);
        $this->assertEquals(0, $game->away_team_goal);
        $this->assertEquals(0, $teamStanding->played);
        $this->assertEquals(0, Prediction::sum('percentage'));

        self::$simulateGame->simulateGamesForWeek($week1);

        $game = $game->refresh();
        $teamStanding = $teamStanding->refresh();

        $this->assertEquals(1, $game->status);
        $this->assertNotEquals(0, $game->home_team_goal);
        $this->assertNotEquals(0, $game->away_team_goal);
        $this->assertEquals(1, $teamStanding->played);
        $this->assertEquals(100, Prediction::sum('percentage'));
    }
}
