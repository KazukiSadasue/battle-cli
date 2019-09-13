<?php
namespace Player\Base;

require_once('Util.php');

use Util\Util;

// プレイヤーの抽象クラス
abstract class Base
{
    private $ct = 0; // チャージタイム（行動時間）

    /**
     * @param int $lv レベル
     * @param string $name 名前
     */
    function __construct(int $lv, string $name) {
        $this->initParam($lv, $name);
    }

    /**
     * パラメータの初期化
     * @param int $lv レベル
     * @param string $name 名前
     */
    abstract protected function initParam(int $lv, string $name);

    /**
     * アクション
     * @param array $enemies 敵オブジェクト配列
     */
    public function action($enemies) {
        Util::line("");
        Util::line("$this->name のターンです。");

        // 攻撃を選んだ場合
        $this->attack($enemies);

        // アクションを終えたらCTを0にする
        $this->ct = 0;
    }

    /**
     * 攻撃
     * @param array $enemies 敵オブジェクト配列
     */
    public function attack($enemies) {
        $enemy = $this->askTargetEnemy($enemies);

        // 攻撃処理
        $enemy->hp -= $this->atk;
        Util::lineWait("$this->name の攻撃");
        Util::lineWait("$enemy->name に $this->atk のダメージ！");

        if ($enemy->hp <= 0) {
            Util::lineWait("$enemy->name を倒した！");
        }
    }

    // プレイヤーは攻撃以外にも、防御などのアクションが選べたら楽しいかも
    public static function defence() {
        //
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
     * ユーザーから入力された敵オブジェクトを取得
     * @param array $enemies 敵オブジェクト
     * @return string
     */
    private function askTargetEnemy($enemies) {
        Util::line("どの敵を攻撃しますか？");

        // 敵の名前を表示
        foreach($enemies as $key => $enemy) {
            Util::line("$key: $enemy->name");
        }

        $is_selected = false;
        while (!$is_selected) {
            $select_enemy = Util::ask('敵を数字で選択してください: ');
            if (isset($enemies[$select_enemy])) {
                return $enemies[$select_enemy];
            }
            Util::line('入力された敵はいません。再度入力してください。');
        }
    }
}