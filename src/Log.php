<?php

namespace Expay\Logger;

use LucidFrame\Console\ConsoleTable;

/**
 * Log
 */
class Log
{    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {}
    
    /**
     * stringFormat
     *
     * @param  mixed $text
     * @param  mixed $color
     * @param  mixed $bg
     * @return array
     */
    private function stringFormat(string $text = null, string $color = null, string $bg = null) : array
    {
        $formats = [
            // text formats
            'bold' => "\033[1m%s\033[0m",
            'dark' => "\033[2m%s\033[0m",
            'italic' => "\033[3m%s\033[0m",
            'underline' => "\033[4m%s\033[0m",
            'blink' => "\033[5m%s\033[0m",
            'reverse' => "\033[7m%s\033[0m",
            'concealed' => "\033[8m%s\033[0m",
            // foreground colors
            'black' => "\033[30m%s\033[0m",
            'red' => "\033[31m%s\033[0m",
            'green' => "\033[32m%s\033[0m",
            'yellow' => "\033[33m%s\033[0m",
            'blue' => "\033[34m%s\033[0m",
            'magenta' => "\033[35m%s\033[0m",
            'cyan' => "\033[36m%s\033[0m",
            'white' => "\033[37m%s\033[0m",
            // background colors
            'bg_black' => "\033[40m%s\033[0m",
            'bg_red' => "\033[41m%s\033[0m",
            'bg_green' => "\033[42m%s\033[0m",
            'bg_yellow' => "\033[43m%s\033[0m",
            'bg_blue' => "\033[44m%s\033[0m",
            'bg_magenta' => "\033[45m%s\033[0m",
            'bg_cyan' => "\033[46m%s\033[0m",
            'bg_white' => "\033[47m%s\033[0m",
        ];
        
        $output = array();
        $output['bg'] = !is_null($bg) ? $formats[$bg] : $bg;
        $output['text'] = !is_null($text) ? $formats[$text] : $text;
        $output['color'] = !is_null($color) ? $formats[$color] : $color;
        return $output;
    }
        
    /**
     * getEmoji
     *
     * @param  mixed $htmlEntity
     * @return string
     */
    private function getEmoji(string $htmlEntity) : string
    {
        return mb_convert_encoding($htmlEntity, 'UTF-8', 'HTML-ENTITIES');
    }
        
    /**
     * getLine
     *
     * @param  mixed $num
     * @param  mixed $char
     * @return string
     */
    private function getLine(int $num = 100, string $char = "*") : string
    {
        $output = "";
        for ($i = 0; $i < $num; $i++) {
            $output .= $char;
        }
        return $output;
    }
        
    /**
     * error
     *
     * @param  mixed $msg
     * @param  mixed $toArr
     * @param  mixed $hasLine
     * @param  mixed $customHeader
     * @param  mixed $lock
     * @return int
     */
    public function error($msg, $toArr = false, $hasLine = false, $customHeader=null, $lock=false) : int
    {
        // get formatters
        $message = ($toArr == true) ? print_r($msg, true) : json_encode($msg);
        $format = self::stringFormat('bold', 'red', 'bg_red');
        $header = sprintf($format['text'], "[ERROR]");
        
        if(!is_null($customHeader)) $header.=sprintf($format['text'],"=> [$customHeader]");
        
        // get called from methods
        $calledFromClass = debug_backtrace()[1]['class'] ?? "NONE";
        $calledFromFunction = debug_backtrace()[1]['function'] ?? "NONE";
        
        // prepare message value
        $value = "=> [Class: " . $calledFromClass . "] => [Function: " . $calledFromFunction . "] => " . $message;
        
        // apply
        $print = self::getEmoji('&#128165;') . " " . sprintf($format['bg'], $header) . " " . self::getEmoji('&#128531;') . " " . sprintf($format['text'], sprintf($value));
        
        // apply printer
        if ($hasLine) error_log(sprintf(sprintf($format['text'], sprintf($format['color'],self::getLine(11, '!')))));
        error_log($print);
        if ($hasLine) error_log(sprintf(sprintf($format['text'], sprintf($format['color'],self::getLine(11, '!') . PHP_EOL))));
        
        if($lock) {error_log("I AM LOCKING UP - LOG->INFO - TOLD ME TO"); exit;}
        
        // respond
        return 0;
    }
        
    /**
     * info
     *
     * @param  mixed $msg
     * @param  mixed $toArr
     * @param  mixed $hasLine
     * @param  mixed $customHeader
     * @param  mixed $lock
     * @return int
     */
    public function info($msg, $toArr = false, $hasLine = false, $customHeader=null, $lock=false) : int
    {
        // get formatters
        $message = ($toArr == true) ? print_r($msg, true) : json_encode($msg);
        $format = self::stringFormat('bold', 'blue', 'bg_blue');
        $header = sprintf($format['text'], "[INFO]");
        
        if(!is_null($customHeader)) $header.=sprintf($format['text'],"=> [$customHeader]");
        
        // get called from methods
        $calledFromClass = debug_backtrace()[1]['class'] ?? "NONE";
        $calledFromFunction = debug_backtrace()[1]['function'] ?? "NONE";
        
        // prepare message value
        $value = " => [Class: " . $calledFromClass . "] => [Function: " . $calledFromFunction . "] => " . $message;
        
        // apply
        $print = self::getEmoji('&#128640;') . " " . sprintf($format['bg'], $header) . " " . self::getEmoji('&#128521;') . " " . sprintf($format['text'], sprintf($value));
        
        // apply printer
        if ($hasLine) error_log(sprintf(sprintf($format['text'], sprintf($format['color'],self::getLine(11, ">")))));
        error_log($print);
        if ($hasLine) error_log(sprintf(sprintf($format['text'], sprintf($format['color'],self::getLine(11, ">") . PHP_EOL))));
        
        if($lock) {error_log("I AM LOCKING UP - LOG->INFO - TOLD ME TO"); exit;}
        
        // respond
        return 0;
    }
        
    /**
     * success
     *
     * @param  mixed $msg
     * @param  mixed $toArr
     * @param  mixed $hasLine
     * @param  mixed $customHeader
     * @param  mixed $lock
     * @return int
     */
    public function success($msg, $toArr = false, $hasLine = false, $customHeader=null, $lock=false) : int
    {
        // get formatters
        $message = ($toArr == true) ? print_r($msg, true) : json_encode($msg);
        $format = self::stringFormat('bold', 'green', 'bg_green');
        $header = sprintf($format['text'], "[SUCCESS]");
        
        if(!is_null($customHeader)) $header.=sprintf($format['text'],"=> [$customHeader]");
        
        // get called from methods
        $calledFromClass = debug_backtrace()[1]['class'] ?? "NONE";
        $calledFromFunction = debug_backtrace()[1]['function'] ?? "NONE";
        
        // prepare message value
        $value = " => [Class: " . $calledFromClass . "] => [Function: " . $calledFromFunction . "] => " . $message;
        
        // apply
        $print = self::getEmoji('&#127881;') . " " . sprintf($format['bg'], $header) . " " . self::getEmoji('&#128526;') . " " . sprintf($format['text'], sprintf($value));
        
        // apply printer
        if ($hasLine) error_log(sprintf(sprintf($format['text'], sprintf($format['color'],self::getLine(12, "*")))));
        error_log($print);
        if ($hasLine) error_log(sprintf(sprintf($format['text'], sprintf($format['color'],self::getLine(12, "*") . PHP_EOL))));
        
        if($lock) {error_log("I AM LOCKING UP - LOG->INFO - TOLD ME TO"); exit;}
        
        // respond
        return 0;
    }
        
    /**
     * debug
     *
     * @param  mixed $msg
     * @param  mixed $file
     * @param  mixed $header
     * @param  mixed $hasLine
     * @param  mixed $customHeader
     * @param  mixed $lock
     * @return int
     */
    public function debug($msg, $file = "", $header = "DEBUG", $hasLine = false, $customHeader=null, $lock=false) : int
    {
        // set custom debug file
        if(!empty($file))ini_set('error_log',$file);

        // init table view
        $cTable = new ConsoleTable();
            
        $format = self::stringFormat('bold', 'yellow', 'bg_yellow');
        $header = sprintf($format['text'], "[" . $header . "]");
        
        if(!is_null($customHeader)) $header.=sprintf($format['text'],"=> [$customHeader]");
        
        $calledFromClass = debug_backtrace()[1]['class'] ?? "NONE";
        $calledFromFunction = debug_backtrace()[1]['function'] ?? "NONE";
        
        // set table header
        $cTable->addHeader("OUTPUT");
        
        // set table row and column data
        $cTable->addRow()->addColumn(json_encode($msg));
        
        // apply
        $value = " => [Class: " . $calledFromClass . "] => [Function: " . $calledFromFunction . "] => ";
        $print = self::getEmoji('&#128293;') . " " . sprintf($format['bg'], $header) . " " . self::getEmoji('&#128556;') . " " . sprintf($format['text'], sprintf($value));
        
        // apply printer
        if ($hasLine) error_log(sprintf(sprintf($format['text'], sprintf($format['color'],self::getLine(12, "+")))));
        error_log($print);
        error_log(sprintf($format['text'], $cTable->getTable()));
        if ($hasLine) error_log(sprintf(sprintf($format['text'], sprintf($format['color'],self::getLine(12, "+") . PHP_EOL))));
        
        if($lock) {error_log("I AM LOCKING UP - LOG->INFO - TOLD ME TO"); exit;}
        
        // respond
        return 0;
    }
        
    /**
     * runner
     *
     * @param  mixed $msg
     * @param  mixed $color
     * @param  mixed $spacer
     * @param  mixed $emoji
     * @param  mixed $lock
     * @return int
     */
    public function runner(string $msg, string $color = "green", bool $spacer = false, string $emoji = "&#128584;",$lock=false) : int
    {
        // get text color
        $format = self::stringFormat('bold', $color);
        
        // prepare output value
        $print = sprintf(self::getEmoji($emoji)) . " " . sprintf($format['text'], sprintf($format['color'], ucfirst($msg)));
        
        // print
        if ($spacer) error_log(PHP_EOL);
        error_log($print);
        if ($spacer) error_log(PHP_EOL);
        
        if($lock) {error_log("I AM LOCKING UP - LOG->INFO - TOLD ME TO"); exit;}
        
        // respond
        return 0;
    }
}