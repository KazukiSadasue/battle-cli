<?php
namespace Util;

// その他機能をまとめたクラス
class Util
{
    /**
     * 画面に文字を表示：末尾に改行なし
     * @param string $message
     */
    public static function message(string $message) {
        // 危険な文字はエスケープする（HTMLエスケープのシェル版みたいなもの）
        echo escapeshellcmd($message);
    }

    /**
     * 画面に文字を表示：末尾に改行あり
     * @param string $message
     */
    public static function line(string $message) {
        echo escapeshellcmd($message) . "\n";
    }

    /**
     * 画面に文字を表示して1秒待つ
     * @param string $message
     */
    public static function lineWait(string $message) {
        self::line($message);
        sleep(1);
    }

    /**
     * 画面に文字を表示して、入力を受け付ける
     * @param string $message
     * @return string
     */
    public static function ask(string $message) {
        self::message($message);
        return trim(fgets(STDIN));
    }
}