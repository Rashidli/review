<?php
namespace App\Enum;

class Region
{
    public const Region_1 = 1;
    public const Region_2 = 2;
    public const Region_3 = 3;
    public const Regional = 4;

    public static function getStatusLabel($status)
    {
        switch ($status) {
            case self::Region_1:
                return 'Zona 1';
            case self::Region_2:
                return 'Zona 2';
            case self::Region_3:
                return 'Zona 3';
            case self::Regional:
                return 'Regional';
            default:
                return 'Unknown';
        }
    }

}
