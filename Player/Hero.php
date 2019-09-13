<?php
namespace Player\Hero;

require_once('Base.php');

use Player\Base\Base;

class Hero extends Base
{
    // パラメーター設定
    const BASE_HP = 5; // 基礎体力
    const BASE_ATK = 5; // 基礎攻撃
    const BASE_SPD = 5; // 基礎スピード
    const PARAM_HP = 2; // 体力成長度
    const PARAM_ATK = 2; // 攻撃成長度
    const PARAM_SPD = 2; // スピード成長度

    /**
     * パラメータの初期化
     * @param int $lv
     * @param string $name
     */
    protected function initParam(int $lv, string $name) {
        $this->name = $name;
        $this->hp = self::BASE_HP + self::PARAM_HP * $lv;
        $this->atk = self::BASE_ATK + self::PARAM_ATK * $lv;
        $this->spd = self::BASE_SPD + self::PARAM_SPD * $lv;
    }
}