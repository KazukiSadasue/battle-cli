<?php
namespace Enemy\Base;

require_once('Util.php');

use Util\Util;

// 敵の抽象クラス
abstract class Base
{
    private $ct = 0; // チャージタイム（行動時間）

    /**
     * @param int $lv レベル
     */
    function __construct(int $lv) {
        $this->initParam($lv);
    }

    /**
     * パラメータの初期化
     * @param int $lv レベル
     */
    abstract protected function initParam(int $lv);

    /**
     * アクション
     * @param array $players プレイヤーオブジェクト配列
     */
    public function action($players) {
        Util::line("");

        // 攻撃を選んだ場合
        $this->attack($players);

        // アクションを終えたらCTを0にする
        $this->ct = 0;
    }

    /**
     * 攻撃
     * @param array $players プレイヤーオブジェクト配列
     */
    public function attack($players) {
        $target = $this->getRandPlayer($players);

        // 攻撃処理
        $target->hp -= $this->atk;
        Util::lineWait("$this->name の攻撃");
        Util::lineWait("$target->name に $this->atk のダメージ！");

        // プレイヤーが死亡したときの処理
        if ($target->hp <= 0) {
            Util::lineWait("$target->name は死亡しました。");
        }
    }

    /**
     * CTを追加
     */
    public function addCt() {
        $this->ct += $this->spd;
    }

    /**
     * 行動可能か
     * @param int $count 行動可能カウント
     */
    public function isAction($count) {
        return $this->ct >= $count;
    }

    /**
     * プレイヤーをランダムで取得
     * @param array $players プレイヤーオブジェクト配列
     * @return object
     */
    private function getRandPlayer($players) {
        $rand_num = mt_rand(0, count($players) - 1);
        return $players[$rand_num];
    }
}