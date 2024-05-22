<?php
function cls(): void
{
    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
        system('cls');
    } else {
        system('clear');
    }
}
function assetSelector(RockPaperScissors $game): int
{
    echo "Select Your Asset!:\n";
    for ($i = 1; $i <= count($game->getAssets()); $i++) {
        echo "[ $i: " . $game->getKeys()[$i-1] . " ]";//echoing out options from asset table
    }
    echo "\n";
    return (int) readline("Make Your choice!: ");
}
function resultNotificationPrint(array $winners): void
{
    if(count($winners) > 1) {
        echo "There is a tie between players: \n";
        foreach ($winners as $winner) {
            echo $winner->getName() . ": " . $winner->getAsset() . "\n";
        }
        echo "All get the point in this round\n";
    } else {
        foreach ($winners as $winner) {
            echo "The winner is " . $winner->getName() .
                " with " . $winner->getAsset() . ".\n";
            echo $winner->getName() . " gets the point in this round\n";
        }
    }
}
function returnResults(array $players): void
{
    echo "Results:\n";
    foreach ($players as $player) {
        echo $player->getName() . ": " . $player->getScore() . "\n";
    }

    $maxScore = max(array_map(function ($player) {
        return $player->getScore();
    }, $players));

    $maxWinners = array_filter($players, function($player) use ($maxScore) {
        return $player->getScore() === $maxScore;
    });

    echo "The absolute winner/s are: \n";
    foreach ($maxWinners as $winner) {
        echo $winner->getName() . " with " . $winner->getScore() . " points!\n";
    }
    echo "Thank You For Playing!\n";
}