<?php

namespace Utility;

final class HTTPRequest
{
    public const METHOD_POST = 1;
    public const METHOD_GET = 2;

    public \ArrayObject $data;

    private static $request = null;

    public static function instance(): HTTPRequest {
        if (self::$request === null) {
            self::$request = new HTTPRequest();
        }
        return self::$request;
    }

    public static function getMethod(): int
    {
        $method = filter_input(\INPUT_SERVER, 'REQUEST_METHOD', \FILTER_SANITIZE_SPECIAL_CHARS);
        switch ($method) {
            case 'GET':
                return self::METHOD_GET;
                break;
            case 'POST':
                return self::METHOD_POST;
                break;
            default:
                return 0;
                break;
        }
    }

    public static function redirect(string $url)
    {
        header('Location: ' . $url);
        exit();
    }
}