<?php

namespace PengGuangSheng\LaravelWechat\Http\Middleware;

use Closure;

class SWeChatCheck
{
    public function handle($request, Closure $next)
    {
        $signature = $request->input('signature');
        $timestamp = $request->input('timestamp');
        $nonce = $request->input('nonce');
        $echostr = $request->input('echostr');

        $token = 'dusitrip';
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);

        if ($tmpStr == $signature) {
            if (empty($echostr)) {
                return $next($request);
            } else {
                response($echostr);
            }
        } else {
            response(false);
        }
    }
}
