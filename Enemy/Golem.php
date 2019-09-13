<?php
namespace Enemy\Golem;

require_once('Base.php');

use Enemy\Base\Base;

class Golem extends Base
{
    // パラメーター設定
    const BASE_HP = 20; // 基礎体力
    const BASE_ATK = 5; // 基礎攻撃
    const BASE_SPD = 5; // 基礎スピード
    const PARAM_HP = 5; // 体力成長度
    const PARAM_ATK = 3; // 攻撃成長度
    const PARAM_SPD = 1; // スピード成長度
    const NAME = 'ゴーレム'; // 敵の名前

    /**
     * パラメータの初期化
     * @param int $lv
     */
    protected function initParam(int $lv) {
        $this->name = self::NAME;
        $this->hp = self::BASE_HP + self::PARAM_HP * $lv;
        $this->atk = self::BASE_ATK + self::PARAM_ATK * $lv;
        $this->spd = self::BASE_SPD + self::PARAM_SPD * $lv;
    }
}