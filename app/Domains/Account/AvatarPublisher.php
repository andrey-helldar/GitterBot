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

use Analogue\ORM\Entity;
use Analogue\ORM\System\Manager;
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
     */
    protected function getPath() : string
    {
        $hash = md5($this->url . microtime(true));
        return
            static::AVATAR_DIR . '/' .
            Str::substr($hash, 0, 2) . '/' .
            Str::substr($hash, 2, 2) . '/' .
            Str::substr($hash, 4) . '.png';
    }

    /**
     * @param string $path
     */
    protected function build(string $path)
    {
        \Image::make($this->url)
            ->resize(128, 128, function(Constraint $constraint) {
                $constraint->aspectRatio();
            })
            ->crop(128, 128)
            ->save($path);
    }

    /**
     * @return string
     * @throws \Throwable
     */
    protected function publish()
    {
        $file     = $this->getPath();
        $filePath = public_path($file);
        $fileDir  = dirname($filePath);

        if (!is_dir($fileDir) && !\File::makeDirectory($fileDir, 0777, true, true)) {
            throw new \RuntimeException('Can not create directory ' . $fileDir);
        }

        $this->build($filePath);

        return $file;
    }

    /**
     * @param Entity $entity
     * @param string $field
     */
    public function attachEntity(Entity $entity, string $field)
    {
        /** @var Manager $orm */
        $orm = app(Manager::class);

        // Remove old avatar
        if ($entity->getEntityAttribute($field)) {
            $before = $entity->getEntityAttribute($field);
            if (is_file(public_path($before))) {
                unlink(public_path($before));
            }
        }

        // Save new avatar
        $entity->setEntityAttribute($field, $this->publish());

        $orm->store($entity);
    }
}
