<?php

require_once('Battle.php');
require_once('Player/Hero.php');
require_once('Player/Warrior.php');
require_once('Enemy/Dragon.php');
require_once('Enemy/Golem.php');

use Battle\Battle;
use Player\Hero\Hero;
use Player\Warrior\Warrior;
use Enemy\Dragon\Dragon;
use Enemy\Golem\Golem;

// プレイヤーの準備
// --------------レベルを変えて難易度変更--------------
$players = [];
$players[] = new Hero(10, '勇者');
$players[] = new Warrior(10, '戦士');

// 敵の準備
$enemies = [];
$enemies[] = new Dragon(5);
$enemies[] = new Golem(5);
// --------------レベルを変えて難易度変更--------------


// バトルの開始
$Battle = new Battle($players, $enemies);
$Battle->start();
while($Battle->is_continue) {
    $Battle->action();
}
$Battle->end();