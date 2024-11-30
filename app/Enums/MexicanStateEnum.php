<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum MexicanStateEnum: int implements HasLabel
{
    case AGUASCALIENTES = 1;
    case BAJA_CALIFORNIA = 2;
    case BAJA_CALIFORNIA_SUR = 3;
    case CAMPECHE = 4;
    case CHIAPAS = 5;
    case CHIHUAHUA = 6;
    case CIUDAD_DE_MEXICO = 7;
    case COAHUILA = 8;
    case COLIMA = 9;
    case DURANGO = 10;
    case ESTADO_DE_MEXICO = 11;
    case GUANAJUATO = 12;
    case GUERRERO = 13;
    case HIDALGO = 14;
    case JALISCO = 15;
    case MICHOACAN = 16;
    case MORELOS = 17;
    case NAYARIT = 18;
    case NUEVO_LEON = 19;
    case OAXACA = 20;
    case PUEBLA = 21;
    case QUERETARO = 22;
    case QUINTANA_ROO = 23;
    case SAN_LUIS_POTOSI = 24;
    case SINALOA = 25;
    case SONORA = 26;
    case TABASCO = 27;
    case TAMAULIPAS = 28;
    case TLAXCALA = 29;
    case VERACRUZ = 30;
    case YUCATAN = 31;
    case ZACATECAS = 32;

    public function getLabel(): string
    {
        return match ($this) {
            self::AGUASCALIENTES => 'Aguascalientes',
            self::BAJA_CALIFORNIA => 'Baja California',
            self::BAJA_CALIFORNIA_SUR => 'Baja California Sur',
            self::CAMPECHE => 'Campeche',
            self::CHIAPAS => 'Chiapas',
            self::CHIHUAHUA => 'Chihuahua',
            self::CIUDAD_DE_MEXICO => 'Ciudad de México',
            self::COAHUILA => 'Coahuila',
            self::COLIMA => 'Colima',
            self::DURANGO => 'Durango',
            self::ESTADO_DE_MEXICO => 'Estado de México',
            self::GUANAJUATO => 'Guanajuato',
            self::GUERRERO => 'Guerrero',
            self::HIDALGO => 'Hidalgo',
            self::JALISCO => 'Jalisco',
            self::MICHOACAN => 'Michoacán',
            self::MORELOS => 'Morelos',
            self::NAYARIT => 'Nayarit',
            self::NUEVO_LEON => 'Nuevo León',
            self::OAXACA => 'Oaxaca',
            self::PUEBLA => 'Puebla',
            self::QUERETARO => 'Querétaro',
            self::QUINTANA_ROO => 'Quintana Roo',
            self::SAN_LUIS_POTOSI => 'San Luis Potosí',
            self::SINALOA => 'Sinaloa',
            self::SONORA => 'Sonora',
            self::TABASCO => 'Tabasco',
            self::TAMAULIPAS => 'Tamaulipas',
            self::TLAXCALA => 'Tlaxcala',
            self::VERACRUZ => 'Veracruz',
            self::YUCATAN => 'Yucatán',
            self::ZACATECAS => 'Zacatecas',
        };
    }
}
