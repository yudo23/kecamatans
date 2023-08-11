<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class AnnouncementEnum extends Enum
{
    const IMAGE_EXT = ['jpeg','jpg','png'];

    const STATUS_TRUE = 1;
    const STATUS_FALSE = 0;

    public static function status()
    {
        $data = [
            self::STATUS_TRUE => 'Active',
            self::STATUS_FALSE => 'Inactive',
        ];
        
        return $data;
    }
}
