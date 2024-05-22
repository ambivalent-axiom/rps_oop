<?php
require "RockPaperScissors.php";
require "Player.php";
require "functions.php";

$assets = [
    'rock' => ['scissors', 'lizard'],
    'paper' => ['rock', 'spock'],
    'scissors' => ['paper', 'lizard'],
    'lizard' => ['paper', 'spock'],
    'spock' => ['rock', 'scissors']
];

while(true) {
    $playerCount = readline("Number of players?: ");
    if(is_numeric($playerCount) && $playerCount > 0 && $playerCount < 10) {
        break;
    }
    echo "Hmmm, you either have not entered the number of players or you have entered the number of rocks.\n";
    echo "It has to be an integer between 1 and 10.\n";
}

$gameOn = new RockPaperScissors($assets, $playerCount);

while($gameOn->getGameStatus())
{
    cls();
    foreach ($gameOn->getPlayers() as $player)
    {
        if($player->isAi()) {
            $player->setAsset($gameOn);
        } else {
            cls();
            echo $player->getName() . "\n";
            $userInput = assetSelector($gameOn);
            if ($userInput <= count($gameOn->getAssets()) && $userInput >= 1) {
                $player->setAsset($gameOn, $userInput);
            } else {
                echo "\nInvalid input! Random asset assigned!\n";
                $player->setAsset($gameOn);
            }
        }
    }
    foreach ($gameOn->getPlayers() as $player) {
        echo $player->getName() . ": " . $player->getAsset() . "\n";
    }
    resultNotificationPrint($gameOn->getWinners());
    $gameOn->setGameStatus(strtolower(readline("Continue playing? Y?: ")));
}
returnResults($gameOn->getPlayers());


