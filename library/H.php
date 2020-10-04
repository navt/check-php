<?php
class H {

    private static $span = '<span class="%s">%s</span>';

    public static function render(string $template, array $data=[]){
        extract($data);
        ob_start();
        include "templates/{$template}.php";
        return ob_get_clean();
    }

    public static function boolToString(bool $flag) {
        if ($flag) {
            printf(self::$span, "good", "Да");
        } else {
            printf(self::$span, "bad", "Нет");
        } 
    }

    public static function validOrNot(bool $flag, string $value) {
        if ($flag) {
            printf(self::$span, "good", $value);
        } else {
            printf(self::$span, "bad", $value);
        } 
    }

    public static function existOrNot(bool $flag) {
        if ($flag) {
            printf(self::$span, "good", " Установлено ");
        } else {
            printf(self::$span, "bad", " Не найдено ");
        } 
    }
    
    public static function existOrNeutral(bool $flag) {
        if ($flag) {
            printf(self::$span, "good", " Установлено ");
        } else {
            printf(self::$span, "info", " Не найдено ");
        } 
    }

}
