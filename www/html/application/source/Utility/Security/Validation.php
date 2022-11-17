<?php

namespace Utility\Security;

final class Validation {
    public static function validate(array $data): array {
        $validation = [];
        foreach($data as $value) {
            if(empty($value['rule'])) {
                $validation[$value['key']] = 'Empty regular expression!';
            } else {
                if (!preg_match($value['rule'], $value['value'])) {
                    $validation[$value['key']] = 'Invalid!';
                }
            }
        }
        return $validation;
    }
    public static function isInvalid(string $data, string $rule, bool $required): \stdClass {
        
        /*if ($required === true && empty($data)) {
            return true;
        } else {
            if(!empty($data)) {
                if (!preg_match('/' . $rule . '/', $data)) {
                    return true;
                }
            }
        }*/
        if (!preg_match('/' . $rule . '/', $data)) {
            return true;
        }
        return false;
    }
}
