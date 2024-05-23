<?php
class RockPaperScissors
{
    private array $assets;
    private array $keys;
    private bool $gameOn;
    private array $players;
    public function __construct(array $assets, int $playerCount = 2, bool $gameOn = true)
    {
        $this->gameOn = $gameOn;
        $this->assets = $assets;
        $this->keys = array_keys($assets);
        $this->playerCount = $playerCount;
        $this->players = $this->initPlayers($this->playerCount);
    }
    private function playAgain(string $userInput): bool
    {
        if($userInput === "y" || $userInput === "yes"){
            return true;
        }
        return false;
    }
    public function setGameStatus(string $userInput): void
    {
        $this->gameOn = $this->playAgain($userInput);
    }
    public function getGameStatus(): bool
    {
        return $this->gameOn;
    }
    public function getKeys(): array
    {
        return $this->keys;
    }
    private function calcWinner(): void
    {
        foreach ($this->players as $player1) {
            foreach ($this->players as $player2) {
                if($player1 != $player2) {
                    if(in_array($player2->getAsset(), $player1->getWeakness())) {
                        $player1->setWinsPerRound(1);
                    }
                }
            }
        }
    }
    public function getWinners(): array
    {
        $this->calcWinner();
        $maxWins = max(array_map(function ($player) {
            return $player->getWinsPerRound();
        }, $this->players));

        $maxWinners = array_filter($this->players, function($player) use ($maxWins) {
            return $player->getWinsPerRound() === $maxWins;
        });
        foreach ($this->players as $player) {
            $player->resetWinsPerRound();
        }
        foreach ($maxWinners as $winner) {
            foreach ($this->players as $player) {
                if($player === $winner) {git
                    $player->setScore(1);
                }
            }
        }
        return $maxWinners;
    }
    public function getPlayerWeakness(string $asset): array
    {
        return $this->assets[$asset];
    }
    public function getAssets(): array
    {
        return $this->assets;
    }
    private function initPlayers(int $playerCount): array
    {
        $players = [];
        for($i = 0; $i < $playerCount; $i++) {
            echo "Player" . ($i+1) . "\n";
            while(true) {
                $name = readline("Enter name: ");
                $names = array_map(function ($player) {
                    return $player->getName();
                }, $players);
                if(in_array($name, $names)) {
                    echo "This name has been already chosen by another player!\n";
                    continue;
                }
                break;
            }

            $ai = strtolower(readline("Real person Y?: "));
            if($ai == 'y') {
                $ai = false;
            } else {
                $ai = true;
            }
            $players[] = new Player($name, $ai);
        }
        return $players;
    }
    public function getPlayers(): array
    {
        return $this->players;
    }
}