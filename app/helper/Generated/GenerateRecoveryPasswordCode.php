<?php

class GenerateRecoveryPasswordCode
{

    public static function generateCode(): int
    {
        return random_int(100000, 999999);
    }
}
