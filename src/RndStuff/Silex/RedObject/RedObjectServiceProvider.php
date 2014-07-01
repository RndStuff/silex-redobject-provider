<?php

namespace RndStuff\Silex\RedObject;

use Exception;
use InvalidArgumentException;
use RedObject\RedObject;
use Silex\Application;
use Silex\ServiceProviderInterface;

class RedObjectServiceProvider implements ServiceProviderInterface
{

    /** @var string */
    private $predisKey;

    public function __construct($predisKey = 'predis')
    {
        if (empty($predisKey)) {
            throw new InvalidArgumentException('The specified key is not valid.');
        }
        $this->predisKey = $predisKey;
    }


    /**
     * {@inheritdoc}
     */
    public function register(Application $app)
    {
        echo $this->predisKey;
        $app['redobject'] = $app::share(
            function () use ($app) {
                if (!isset($app[$this->predisKey])) {
                    throw new Exception('Predis not fount in $app[\''.$this->predisKey.'\'] ');
                }
                return new RedObject($app[$this->predisKey]);
            }
        );
    }

    /**
     * {@inheritdoc}
     */
    public function boot(Application $app)
    {
    }
}