<?php
class Player
{
    private string $player;
    private array $weakness;
    private int $score;
    private int $winsPerRound;
    private bool $isAi;
    private string $name;
    public function __construct(string $name, bool $isAI=false)
    {
        $this->name = $name;
        $this->isAI = $isAI;
        $this->player = "";
        $this->weakness = [];
        $this->score = 0;
        $this->winsPerRound = 0;
    }
    public function getAsset(): string
    {
        return $this->player;
    }
    public function setAsset(RockPaperScissors $game, $userInput = Null): void
    {
        if($this->isAI || $userInput == Null) {
            $this->player = array_rand($game->getAssets());
        } else {
            $this->player = $game->getKeys()[$userInput-1];
        }
        $this->weakness = $game->getPlayerWeakness($this->player);
    }
    public function getWeakness(): array
    {
        return $this->weakness;
    }
    public function getScore(): int
    {
        return $this->score;
    }
    public function setScore($score): void
    {
        $this->score += $score;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function isAi(): bool
    {
        return $this->isAI;
    }
    public function setWinsPerRound(int $wins): void
    {
        $this->winsPerRound += $wins;
    }
    public function getWinsPerRound(): int
    {
        return $this->winsPerRound;
    }
    public function resetWinsPerRound(): void
    {
        $this->winsPerRound = 0;
    }
}