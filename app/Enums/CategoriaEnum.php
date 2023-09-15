<?php

namespace App\Enums;

enum CategoriaEnum
{
    const ALIMENTACAO = 'alimentacao';
    const SAUDE = 'saude';
    const TRANSPORTE = 'transporte';
    const EDUCACAO = 'educacao';
    const LAZER = 'lazer';
    const IMPREVISTOS = 'imprevistos';
    const OUTRAS = 'outras';


    public static function values(): array
    {
        return [
            self::ALIMENTACAO,
            self::SAUDE,
            self::TRANSPORTE,
            self::EDUCACAO,
            self::LAZER,
            self::IMPREVISTOS,
            self::OUTRAS,
        ];
    }
}
