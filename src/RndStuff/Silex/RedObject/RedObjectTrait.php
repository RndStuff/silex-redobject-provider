<?php

namespace RndStuff\Silex\RedObject;

use RedObject\RedObject;

trait RedObjectTrait
{
    /**
     * @return RedObject
     */
    public function getRedObject()
    {
        return $this['redobject'];
    }
}