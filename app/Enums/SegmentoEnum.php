<?php
namespace App\Enums;

enum SegmentoEnum: string
{
    case ALIMENTACAO = 'ALIMENTACAO';
    case TRANSPORTE = 'TRANSPORTE';
    case ACOMODACAO = 'ACOMODACAO';
    case HIGIENE = 'HIGIENE';
    case DOCUMENTOS = 'DOCUMENTOS';
    case MEDICAMENTOS = 'MEDICAMENTOS';
    case BAGAGEM = 'BAGAGEM';
    case DISPOSITIVOS = 'DISPOSITIVOS';

    public function description(): string
    {
        return match($this) {
            self::ALIMENTACAO => 'Alimentação',
            self::TRANSPORTE => 'Transporte',
            self::ACOMODACAO => 'Acomodação',
            self::HIGIENE => 'Higiene',
            self::DOCUMENTOS => 'Documentos',
            self::BAGAGEM => 'Bagagem',
            self::DISPOSITIVOS => 'Dispositivos'
        };
    }
}