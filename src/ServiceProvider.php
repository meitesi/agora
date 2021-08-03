<?php


namespace Meitesi\Agora;


class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    protected $defer = true;

    public function register()
    {
        $this->app->singleton(TokenBuilder::class, function(){
            return new TokenBuilder();
        });

        $this->app->alias(TokenBuilder::class, 'tokenBuild');
    }

    public function provides()
    {
        return [TokenBuilder::class, 'tokenBuild'];
    }
}