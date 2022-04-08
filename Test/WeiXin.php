<?php

namespace PengGuangSheng\LaravelWechat\Test;

class WeiXin
{
    public function index()
    {
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        $echostr = $_GET["echostr"];


        $token = 'dusitrip';
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);


        if ($tmpStr == $signature) {
            if (empty($echostr)) {
                // 回复信息
                // 接收微信发送的参数
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
                //把百分号（%）符号替换成一个作为参数进行传递的变量：
                $info = sprintf('<xml> <ToUserName><![CDATA[%s]]></ToUserName> <FromUserName><![CDATA[%s]]></FromUserName> <CreateTime>%s</CreateTime> <MsgType><![CDATA[text]]></MsgType> <Content><![CDATA[%s]]></Content> </xml>', $fromUserName, $toUserName, $time, $content);
                return $info;
//                return 'true';
            } else {
                echo $echostr;
            }
        } else {
            return 'false';
        }
    }
}