<?php
namespace app\common;

class Tool
{
    public static function url($querystring)
    {
        $urlFull = request()->url(true);

        if (!isset(parse_url($urlFull)['query'])) {
            return $urlFull.'?';
        }

        $query = parse_url($urlFull)['query'];

        parse_str($query, $urlArr);

        unset($urlArr[$querystring]);

        $queryAll = http_build_query($urlArr);

        echo request()->domain().request()->baseUrl().'?'.$queryAll.'&';
    }
}