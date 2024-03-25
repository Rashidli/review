<?php

namespace App\Enum;

class Status
{
    public const review = 1;
    public const planning = 2;
    public const cancel = 3;

    public static function getStatusLabel($status)
    {
        switch ($status) {
            case self::review:
                return 'Qiymətləndirmə';
            case self::planning:
                return 'Planlanılmış tarif';
            case self::cancel:
                return 'İmtina';
            default:
                return 'Unknown';
        }
    }
}
