<?php 


namespace App\Helpers ;

use NumberFormatter ;
class Currency
{
    public  function __invoke(...$params)
    {
        return static::format(...$params);
    }
    public static function format($amount , $currence = null){
        $formatter = new NumberFormatter(config('app.locale'),NumberFormatter::CURRENCY);
        if($currence === null){
            $currence = config('app.currency' , 'USD');
        }
        return $formatter->formatCurrency($amount , $currence);
    }
}