<?php
/**
 * This file is part of KarmaBot package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 15.03.2016 20:00
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domains\Account;

use Illuminate\Support\Str;
use Intervention\Image\Constraint;

/**
 * Class AvatarPublisher
 * @package Domains\Account
 */
class AvatarPublisher
{
    const AVATAR_DIR = 'system';

    /**
     * @var string
     */
    private $url;

    /**
     * AvatarPublisher constructor.
     * @param string $url
     */
    public function __construct(string $url)
    {
        $this->url = $url;
    }

    /**
     * @return string
     * @throws \Throwable
     */
    public function publish()
    {
        $hash = md5($this->url . microtime(true));
        $file =
            static::AVATAR_DIR . '/' .
            Str::substr($hash, 0, 2) . '/' .
            Str::substr($hash, 2, 2) . '/' .
            Str::substr($hash, 4) . '.png';


        $filePath = public_path($file);
        $fileDir  = dirname($filePath);


        if (!is_dir($fileDir) && !\File::makeDirectory($fileDir, 0777, true, true)) {
            throw new \RuntimeException('Can not create directory ' . $fileDir);
        }

        \Image::make($this->url)
            ->resize(128, 128, function(Constraint $constraint) {
                $constraint->aspectRatio();
            })
            ->crop(128, 128)
            ->save($filePath);

        return $file;
    }
}
