<?php

if(!function_exists('display_level')) {
    function display_level($level) {
        if($level == 1) {
            return "Α' Δημοτικού";
        }

        if($level == 2) {
            return "Β' Δημοτικού";
        }

        if($level == 3) {
            return "Γ' Δημοτικού";
        }

        if($level == 4) {
            return "Δ' Δημοτικού";
        }

        if($level == 5) {
            return "Ε' Δημοτικού";
        }

        if($level == 6) {
            return "ΣΤ' Δημοτικού";
        }

        if($level == 7) {
            return "Α' Γυμνασίού";
        }

        if($level == 8) {
            return "Β' Γυμνασίου";
        }

        if($level == 9) {
            return "Γ' Γυμνασίου";
        }
    }
}


if(!function_exists('fix_equation')) {
    function fix_equation($number)
    {
        // replace : with divide sign
        $pattern = '/(\d+)\:(\d+)/';
        $replace = '${1}&divide;${2}';
        $number = preg_replace($pattern, $replace, $number);

        // replace * with multiply
        $pattern = '/(\d+)\*/';
        $replace = '${1}&times;';
        $number = preg_replace($pattern, $replace, $number);

        // fix power
        $pattern = '/(\d+)\^(\d+)/';
        $replace = '${1}<sup>${2}</sup>';
        $number = preg_replace($pattern, $replace, $number);

        $pattern = '/(\d+)\/(\d+)/';
        $replace = '<div class="fraction" top="${1}" bottom="${2}"></div>';
        $number = preg_replace($pattern, $replace, $number);

        // replace dot with comma
//        $pattern = '/(\d+)\.(\d+)/';
//        $replace = '${1},${2}';
//        $number = preg_replace($pattern, $replace, $number);

        // replace * with multiply
        $pattern = '/(\d+)\*/';
        $replace = '${1}&times;';
        $number = preg_replace($pattern, $replace, $number);

        // replace x with multiply
        $pattern = '/(\d+)x(\d+)/';
        $replace = '${1}&times;${2}';
        $number = preg_replace($pattern, $replace, $number);

        return $number;
    }
}
