<?php

namespace Utility\Security;

class CSRF {
    public static function generate(): string {
        return bin2hex(random_bytes(32));
    }

    public static function verify(string $CSRFToken, string $requestToken): bool {
        if (!empty($requestToken) && hash_equals($CSRFToken, $requestToken)) {
            return true;
        }
        return false;
    }
}
