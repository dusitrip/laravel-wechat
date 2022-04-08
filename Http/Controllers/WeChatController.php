<?php

namespace PengGuangSheng\LaravelWechat\Http\Controllers;

use Illuminate\Http\Request;

class WeChatController extends Controller
{
    public function index(Request $request)
    {
        $postObj = file_get_contents('php://input');
        $postArr = simplexml_load_string($postObj, "SimpleXMLElement", LIBXML_NOCDATA);
        //消息内容
        $content = $postArr->Content;
        //接受者
        $toUserName = $postArr->ToUserName;
        //发送者
        $fromUserName = $postArr->FromUserName;
        //获取时间戳
        $time = time();
        //你好，你的消息是： $content
        $content = "你好，你的消息是： $content";
        $info = sprintf(config('swechat.wechat_tmp.text'),$fromUserName, $toUserName, $time, $content);
        return $info;
    }
}