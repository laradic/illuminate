<?php

namespace Laradic\Foundation\Bootstrap;

use Dotenv\Dotenv;
use Dotenv\Exception\InvalidPathException;
use Illuminate\Contracts\Foundation\Application;

class DetectEnvironment {
    /**
     * Bootstrap the given application.
     *
     * @param  \Illuminate\Contracts\Foundation\Application $app
     *
     * @return void
     */
    public function bootstrap(Application $app)
    {
        $app->detectEnvironment(function(){
            return env('APP_ENV', 'production');
        });

        if ( !$app->configurationIsCached() )
        {
            try
            {
                (new Dotenv($app->environmentPath(), $app->environmentFile()))->load();
            }
            catch (InvalidPathException $e)
            {
                //
            }
        }
    }
}
