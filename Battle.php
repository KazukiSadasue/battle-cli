<?php
namespace Battle;

require_once('Util.php');

use Util\Util;

// バトル関係のクラス
class Battle
{
    const ACTION_COUNT = 1000; // 行動するまでのカウント

    public $is_continue = true; // 戦闘が続いているか判定

    /**
     * プレイヤーと敵のオブジェクトを受け取る
     * @param array $players プレイヤーオブジェクト配列
     * @param array $enemies 敵オブジェクト配列
     */
    function __construct($players, $enemies) {
        $this->players = $players;
        $this->enemies = $enemies;
    }

    /**
     * バトル開始
     */
    public function start()
    {
        Util::line('バトルを開始します。');
    }

    /**
     * バトルの１アクション
     * バトルの流れ
     * 1. PlayerにCT(チャージタイム)を加える
     * 2. CTがACTION_COUNT分溜まったら行動する
     * 3. 敵も同様
     */
    public function action()
    {
        // Players
        foreach($this->players as $player) {
            $player->addCt();
            if ($player->isAction(self::ACTION_COUNT)) {
                $player->action($this->enemies);

                // 倒した敵をゲームから排除
                foreach ($this->enemies as $key => $enemy) {
                    if ($enemy->hp <= 0) {
                        unset($this->enemies[$key]);

                        // 敵が全滅した時の処理
                        if (empty($this->enemies)) {
                            $this->is_continue = false;
                            break;
                        }
                    }
                }
            }
        }

        // Enemies
        foreach($this->enemies as $enemy) {
            $enemy->addCt();
            if ($enemy->isAction(self::ACTION_COUNT)) {
                $enemy->action($this->players);

                // 死亡したプレイヤーをゲームから排除
                foreach ($this->players as $key => $player) {
                    if ($player->hp <= 0) {
                        unset($this->players[$key]);
                        $this->players = array_values($this->players);

                        // プレイヤーが全滅した時の処理
                        if (empty($this->players)) {
                            $this->is_continue = false;
                            break;
                        }
                    }
                }
            }
        }
    }

    /**
     * バトル終了時のメソッド
     */
    public function end() {
        // 結果判定
        if (empty($this->enemies)) {
            Util::line('戦いに勝利しました。');
        }
        if (empty($this->players)) {
            Util::line('戦いに敗北しました。');
        }

        Util::line('バトルを終了します。');
    }
}