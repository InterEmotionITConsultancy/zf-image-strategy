<?php
namespace InterEmotion\ImageStrategy\View\Factory;

use InterEmotion\ImageStrategy\View\Renderer\ImageRenderer;
use InterEmotion\ImageStrategy\View\Strategy\ImageStrategy;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class ImageStrategyFactory implements FactoryInterface
{

    /**
     * @inheritDoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $imageRenderer = $container->get(ImageRenderer::class);
        $imageStrategy = new ImageStrategy($imageRenderer);
        return $imageStrategy;
    }
}
