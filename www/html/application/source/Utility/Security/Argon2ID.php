<?php

namespace Service\Security;

class Argon2ID
{
    public function encrypt(string $password): string
    {
        return password_hash($password, PASSWORD_ARGON2ID, [
            'memory_cost' => PASSWORD_ARGON2_DEFAULT_MEMORY_COST,
            'time_cost' => PASSWORD_ARGON2_DEFAULT_TIME_COST,
            'threads' => PASSWORD_ARGON2_DEFAULT_THREADS
        ]);
    }

    public function verify(string $password, string $hash): bool
    {
        if (password_verify($password, $hash)) {
            return true;
        } else {
            return false;
        }
    }
}