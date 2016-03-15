<?php
/**
 * This file is part of KarmaBot package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 15.03.2016 19:05
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace App\Jobs;

use Analogue\ORM\System\Manager;
use Domains\Account\AvatarPublisher;
use Domains\Account\User;
use Illuminate\Config\Repository;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\Job as JobContract;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class AvatarSavingJob
 * @package App\Jobs
 */
class AvatarSavingJob extends Job implements SelfHandling, ShouldQueue
{
    /**
     * @var string
     */
    private $url;

    /**
     * AvatarSavingJob constructor.
     * @param Repository $repository
     */
    public function __construct(Repository $repository)
    {
        $this->url = $repository->get('app.url');
    }

    /**
     * @param JobContract $job
     * @param array $args
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     * @throws \Throwable
     */
    public function fire(JobContract $job, array $args = [])
    {
        if (!array_key_exists('user', $args) || !array_key_exists('avatar', $args)) {
            throw new \InvalidArgumentException();
        }

        /** @var User $user */
        $user = unserialize($args['user']);

        /** @var string $avatar */
        $avatar = $args['avatar'];

        /** @var Manager $orm */
        $orm = app(Manager::class);

        $publisher = new AvatarPublisher($avatar);
        $file = $publisher->publish();
        $fileUrl = $this->url . '/' . $file;

        $user->setEntityAttribute('avatar', $fileUrl);
        $orm->store($user);
    }
}
