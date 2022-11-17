<?php

namespace Service\Security;

class Validation
{
    public static $patternsGeneric = [
        'int' => [
            'pattern' => '^[0-9]+$',
            'message' => 'Digite somente números.'
        ],
        'string' => [
            'pattern' => '^[0-9a-zA-ZÀÁÃÇÈÉÊÌÍÎÏÑÒÓÔÕÙÚÛàáâãçèéêìíîñòóôõùúû.,; ]+$',
            'message' => 'Digite somente letras, números, espaços, vírgulas, pontos e ponto e vírgula.'
        ]
    ];

    public static $patterns = [
        'uri' => '[A-Za-z0-9-\/_?&=]+',
        'url' => '[A-Za-z0-9-:.\/_?&=#]+',
        'alpha' => '[\p{L}]+',
//        'words' => '[\p{L}\s]+',
        'word' => [
            'pattern' => '^[a-zA-ZÀÁÃÇÈÉÊÌÍÎÏÑÒÓÔÕÙÚÛàáâãçèéêìíîñòóôõùúû ]+$',
            'message' => 'Digite somente letras e espaços.'
        ],
        'text' => [
            'pattern' => '^[0-9a-zA-ZÀÁÃÇÈÉÊÌÍÎÏÑÒÓÔÕÙÚÛàáâãçèéêìíîñòóôõùúû.,; ]+$',
            'message' => 'Digite somente letras, números, espaços, vírgulas, pontos e ponto e vírgula.'
        ],
        'password' => [
            'pattern' => '^([a-zA-Z0-9ÀÁÃÇÈÉÊÌÍÎÏÑÒÓÔÕÙÚÛàáâãçèéêìíîñòóôõùúû!?@#$%&*+={}.,])+$',
            'message' => 'Digite somente caracteres permitidos.'
        ],
        'decimal' => [
            'pattern' => '^[0-9.,]+$',
            'message' => 'Digite somente números decimais.'
        ],
//        'alphanum' => '[\p{L}0-9]+',
//        'integer' => '[0-9]+',
        'integer' => [
            'pattern' => '^[0-9]+$',
            'message' => 'Digite somente números.'
        ],
//        'float' => '[0-9\.,]+',
        'tel' => '[0-9+\s()-]+',
//        'text' => '[\p{L}0-9\s-.,;:!"%&()?+\'°#\/@]+',
        'file' => '[\p{L}\s0-9-_!%&()=\[\]#@,.;+]+\.[A-Za-z0-9]{2,4}',
        'folder' => '[\p{L}\s0-9-_!%&()=\[\]#@,.;+]+',
        'address' => '[\p{L}0-9\s.,()°-]+',
        /*'date' => [
            'pattern' => '^((0[1-9]|[1-2][0-9]|3[0-1])\/(0[1-9]|1[0-2])\/([0-9]{4}))+$',
            'message' => 'Digite um data válida.'
        ],*/
        'date' => [
            'pattern' => '^(([0-9]{4})-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1]))+$',
            'message' => 'Digite um data válida.'
        ],
//        'date_ymd' => '^(([0-9]{4})-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1]))*$',
//        'date' => '[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{4}',
//        'date_ymd' => '[0-9]{4}\-[0-9]{1,2}\-[0-9]{1,2}',
//        'email' => '^([a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+[.]+[a-z-A-Z])*$',
//        'email' => '^([_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6})*$',
        'email' => [
            'pattern' => '^([_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6})+$',
            'message' => 'Digite um e-mail válido.'
        ]
    ];

    public static $validation;

    public static function getInputMapping(): \stdClass
    {
        return json_decode(file_get_contents(__DIR__ . '/../../../Configuration/input.json'));
    }

    public static function getValidationMapping(): \stdClass
    {
        return json_decode(file_get_contents(__DIR__ . '/../../../Configuration/validation.json'));
    }

    public function verify(string $key, string $rule, string $data, bool $required): void
    {
        if ($required === true && empty($data)) {
            \Service\HTTPRequest::instance()->validation->$key = 'O preenchimento é obrigatório.';
        } else {
            if(!empty($data)) {
                $patterns = self::getValidationMapping();
                if (!preg_match('/' . $patterns->$rule->pattern . '/', $data)) {
                    \Service\HTTPRequest::instance()->validation->$key = $patterns->$rule->message;
                }
            }
        }
    }

    public function check(string $key, string $rule, string $data): bool
    {
        $patterns = self::getValidationMapping();
        if (!preg_match('/' . $patterns->$rule->pattern . '/', $data)) {
            return true;
        }
        return false;
    }

    public static function sanitize(array $data): array
    {
        return filter_var_array($data, FILTER_SANITIZE_SPECIAL_CHARS);
    }

    public function validate($rules, $data)
    {
        $result = [];
        foreach ($data as $key => $value) {
            if (array_key_exists($key, $rules)) {
                if (array_key_exists($rules[$key], self::$patterns)) {
                    $pattern = self::$patterns[$rules[$key]];
                    if (!preg_match('/' . $pattern . '/', $value)) {
                        $result[$key] = 'O campo ' . $key . ' precisa ter um formato válido Digite somente letras e números.'/* . $rules[$key]*/
                        ;
                    }
                }
            } else {
                if (!preg_match('/^[0-9a-zA-ZÀÁÃÇÈÉÊÌÍÎÏÑÒÓÔÕÙÚÛàáâãçèéêìíîñòóôõùúû ]*$/', $value)) {
                    $result[$key] = 'O campo ' . $key . ' é totalmente inválido.';
                }
            }
        }
        return $result;
    }

    /*public function validate($rules, $data) {
        foreach ($data as $key => $value) {
            if (array_key_exists($key, $rules)) {
                if (array_key_exists($rules[$key][1], self::$patterns)) {
                    $pattern = self::$patterns[$rules[$key][1]];
                    if (!preg_match('/' . $pattern . '/', $value)) {
                        if($rules[$key][2]) {
                            $result[$key] = $rules[$key][2];
                        } else {
                            $result[$key] = 'Digite um formáto válido.';
                        }
                    }
                }
            } else {
                if (!preg_match('/^[0-9a-zA-ZÀÁÃÇÈÉÊÌÍÎÏÑÒÓÔÕÙÚÛàáâãçèéêìíîñòóôõùúû ]*$/', $value)) {
                    $result[$key] = 'O campo ' . $key . ' é totalmente inválido.';
                }
            }
        }
        return $result;
    }*/

    public static function ajeitar(array $data = []): array
    {
        $result = [];

        if ($data) {
            $result = filter_var_array($data, FILTER_SANITIZE_SPECIAL_CHARS);

            /*function filter_me(&$array)
            {
                foreach ($array as $key => $item) {
                    if(is_array($item) && $array[$key]) {
                        $array[$key] = filter_me($item);
                    }
                    $array[$key] = trim($array[$key]);
                }
                return $array;
            }

            $result = filter_me($result);*/

            /*function mytrim($arr, $charlist = ' ')
            {
                if (is_string($arr)) {
                    return trim($arr, $charlist);
                } elseif (is_array($arr)) {
                    foreach ($arr as $key => $value) {
                        if (is_array($value)) {
                            $result[$key] = self::trim($value, $charlist);
                        } else {
                            $result[$key] = trim($value, $charlist);
                        }
                    }

                    return $result;
                } else {
                    return $arr;
                }
            }*/

            /*function recursiveStripTags($data)
            {
                foreach ($data ?? [] as $key => $value) {
                    if (is_array($value)) {
                        $data[$key] = recursiveStripTags($value);
                    } else {
                        $data[$key] = strip_tags($value);
                    }
                }
                return $data;
            }*/

            // $result = recursiveStripTags($result);

            // $result = mytrim($result);


//            var_dump($result);
        }

        // prevent XSS
//        $_GET   = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
//        $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        /*$safePost = filter_input_array(INPUT_POST, [
            "id" => FILTER_VALIDATE_INT,
            "name" => FILTER_SANITIZE_STRING,
            "email" => FILTER_SANITIZE_EMAIL
        ]);*/

        /*foreach ($data as $key => $value) {
            if (array_key_exists($key, $rules)) {
                if (array_key_exists($rules[$key], self::$patterns)) {
                    $pattern = self::$patterns[$rules[$key]];
                    if (!preg_match('/' . $pattern . '/', $value)) {
                        $result[$key] = 'O campo ' . $key . ' precisa ter um formato válido.' . $rules[$key];
                    }
                }
            } else {
                if (!preg_match('/^[0-9a-zA-ZÀÁÃÇÈÉÊÌÍÎÏÑÒÓÔÕÙÚÛàáâãçèéêìíîñòóôõùúû ]*$/', $value)) {
                    $result[$key] = 'O campo ' . $key . ' é totalmente inválido.';
                }
            }
        }*/

        return $result;
    }

    public function removeExtraSpaceArray(array $input): array
    {
        return array_map(function ($value) {
            return trim(preg_replace('/[\n\r\s]+/', '', $value));
        }, $input);
    }

    public function removeExtraSpace(string $input): string
    {
        return trim(preg_replace('/[\n\r\s]+/', '', $input));
    }

    public function validateNumber(string $input, int $min, int $max, bool $required): bool
    {
        if ($required === true && $input === '') {
            return false;
        }
        if ($required === false && $input === '') {
            $min = 0;
        }
        if (preg_match('/^[0-9]*$/', $input) && strlen($input) >= $min && strlen($input) <= $max) {
            return true;
        } else {
            return false;
        }
    }

    public function validateWord(string $input, int $min, int $max, bool $required): bool
    {
        if ($required === true && $input === '') {
            return false;
        }
        if ($required === false && $input === '') {
            $min = 0;
        }
        if (preg_match('/^[a-zA-ZÀÁÃÇÈÉÊÌÍÎÏÑÒÓÔÕÙÚÛàáâãçèéêìíîñòóôõùúû ]*$/', $input) && strlen($input) >= $min && strlen($input) <= $max) {
            return true;
        } else {
            return false;
        }
    }

    public function validateCharacter(string $input, int $min, int $max, bool $required): bool
    {
        if ($required === true && $input === '') {
            return false;
        }
        if ($required === false && $input === '') {
            $min = 0;
        }
        if (preg_match('/^[0-9a-zA-ZÀÁÃÇÈÉÊÌÍÎÏÑÒÓÔÕÙÚÛàáâãçèéêìíîñòóôõùúû ]*$/', $input) && strlen($input) >= $min && strlen($input) <= $max) {
            return true;
        } else {
            return false;
        }
    }

    public function validateDate(string $input, bool $required): bool
    {
        if ($required === true && $input === '') {
            return false;
        }
        if (preg_match('/^(([0-9]{4})-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1]))*$/', $input)) {
            return true;
        } else {
            return false;
        }
    }

    public function validateEmail(string $input, int $min, int $max, bool $required): bool
    {
        if ($required === true && $input === '') {
            return false;
        }
        if ($required === false && $input === '') {
            $min = 0;
        }
        if (preg_match('/^([_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6})*$/', $input) && strlen($input) >= $min && strlen($input) <= $max) {
            return true;
        } else {
            return false;
        }
    }

    public function validatePassword(string $input, int $min, int $max, bool $required): bool
    {
        if ($required === true && $input === '') {
            return false;
        }
        if ($required === false && $input === '') {
            $min = 0;
        }
        if (preg_match('/^([a-zA-Z0-9ÀÁÃÇÈÉÊÌÍÎÏÑÒÓÔÕÙÚÛàáâãçèéêìíîñòóôõùúû!?@#$%&*+={}.,])*$/', $input) && strlen($input) >= $min && strlen($input) <= $max) {
            return true;
        } else {
            return false;
        }
    }
}