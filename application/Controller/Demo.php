<?php

/**
 * LyApi Framework 接口演示
 *
 * 关于：2.X 版本在优化了用户体验同时也在改进接口开发。
 * 下方是我为各位开发者整理的接口Demo（都是接口程序）
 *
 * ⚠ 本文件的访问路径为：http://domain.com/Demo/[函数名]
 */

namespace Application\Controller;

use Application\Interface\Api as ApiController;
use Common\Api;
use ErrorException;

class Demo extends ApiController
{
    // 要开发一个接口，最重要的就是继承 ApiCon 这个对象
    // 当然你可以再 ViewCon 下调用 view::api 来实现接口生成
    // 但 ApiCon 下有很多特有的函数，方便接口相关的操作


    // 程序员写下的第一个代码便是这 Hello World 了，嘻嘻！
    public function hello(): string
    {
        return "Hi, this is a simple demo for api";
    }

    // 程序出错了，来个 404 Not Found？
    public function error()
    {
        try {
            file_get_contents("/UndefinedFile.txt");
        } catch (ErrorException) {
            // Simple 函数是 Api 提供的结构生成函数
            // 正常来说，访问数据需要复杂的数组组合，而本函数仅用几个简单参数就可以完成
            return Api::simple(null, 404, "File Not Found");
        }
        return "Hello";
    }

    // 一个接口需要遵循其他规则？Custom 函数可以完全自定义结构哦！
    public function override(): array
    {
        // Custom 需要三个参数：
        // 参数1：接口结构（默认不包含 code data msg）
        // 参数2：HTTP状态码，由于缺少了 code 则需要手动设置状态码
        // 参数3：需要删除的键，默认删除 code data msg，可以是数组和字符串
        return Api::override([
            "username" => "mrxiaozhuox",
            "password" => "hello_lyapi"
        ], 200);
    }

    public function custom()
    {
      return [
          "~" => ["custom" => "a new field"],
          
          "hello" => "something in data",

          "^" => ["msg"]
      ];
    }
}
