<?
require_once('class.php');

$game = new Game(
    new Player('Joe', 1000),
    new Player('Jane', 100),
);

$game->start();