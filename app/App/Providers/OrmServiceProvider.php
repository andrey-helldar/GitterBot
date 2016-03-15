<?php

namespace App\Providers;

use Analogue\ORM\Plugins\SoftDeletes\SoftDeletesPlugin;
use Analogue\ORM\Plugins\Timestamps\TimestampsPlugin;
use Analogue\ORM\System\Manager;
use App\Mappers\ServiceMap;
use App\Mappers\ServiceUserMap;
use App\Mappers\UserMap;
use App\Observers\CuidObserver;
use Domains\Account\User;
use Domains\Service\Service;
use Domains\Service\ServiceUser;
use Illuminate\Support\ServiceProvider;

/**
 * Class OrmServiceProvider
 * @package App\Providers
 */
class OrmServiceProvider extends ServiceProvider
{
    /**
     * @return void
     * @throws \Analogue\ORM\Exceptions\MappingException
     */
    public function register()
    {
        $this->app->alias('analogue', Manager::class);

        /** @var Manager $orm */
        $orm = $this->app->make(Manager::class);

        $this->registerPlugins($orm);

        $this->registerMappers($orm);

        $this->registerEvents($orm);
    }

    /**
     * @param Manager $orm
     */
    private function registerPlugins(Manager $orm)
    {
        $orm->registerPlugin(TimestampsPlugin::class);
        $orm->registerPlugin(SoftDeletesPlugin::class);
    }

    /**
     * @param Manager $orm
     * @throws \Analogue\ORM\Exceptions\MappingException
     */
    private function registerMappers(Manager $orm)
    {
        $orm->register(User::class, UserMap::class);
        $orm->register(Service::class, ServiceMap::class);


        $orm->registerValueObject(ServiceUser::class, ServiceUserMap::class);
    }

    /**
     * @param Manager $orm
     * @throws \Analogue\ORM\Exceptions\MappingException
     */
    private function registerEvents(Manager $orm)
    {
        $cuidObserver = new CuidObserver();

        $orm->mapper(User::class)->registerEvent('creating', [$cuidObserver, 'creating']);
        $orm->mapper(Service::class)->registerEvent('creating', [$cuidObserver, 'creating']);
    }
}
