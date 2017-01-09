<?php

use InterEmotion\ImageStrategy\View\Factory\ImageStrategyFactory;
use InterEmotion\ImageStrategy\View\Renderer\ImageRenderer;
use InterEmotion\ImageStrategy\View\Strategy\ImageStrategy;
use Zend\ServiceManager\Factory\InvokableFactory;

return array(
    'service_manager' => array(
        'factories' => array(
            ImageStrategy::class => ImageStrategyFactory::class,
            ImageRenderer::class => InvokableFactory::class
        )
    ),
    'view_manager' => array(
        'strategies' => array(
            ImageStrategy::class
        )
    )
);
