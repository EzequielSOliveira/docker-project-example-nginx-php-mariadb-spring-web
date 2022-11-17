<?php

final class Autoload
{
    final public static function load(): void
    {
        set_error_handler(function (int $severity, string $message, string $filename, int $lineno): void {
            throw new \ErrorException($message, 0, $severity, $filename, $lineno);
        });

        set_exception_handler(function ($exception): void {
            header('Content-Type: text/plain');
            // \Service\Monitoring\Log::save($exception);
            var_dump($exception);
            exit();
        });

        spl_autoload_register(function ($class): bool {
            $file = __DIR__ . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
            if (file_exists($file)) {
                require_once($file);
                return true;
            }
            return false;
        });

        $input = (object) array_merge($_GET ?? [], $_POST ?? [], json_decode(file_get_contents('php://input') ?? '', true) ?? []);

        $service = $input->service ?? '';
        
        unset($input->service);

        $class = '\\Service\\' . $service;

        if (class_exists($class) && method_exists($class, 'process')) {
            echo json_encode(forward_static_call([$class, 'process'], $input), JSON_PRETTY_PRINT);
        } else {
            echo '{}';
        }
    }
}
