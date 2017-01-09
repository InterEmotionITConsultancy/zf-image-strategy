<?php
namespace InterEmotion\ImageStrategy\View\Factory;

use InterEmotion\ImageStrategy\View\Renderer\ImageRenderer;
use InterEmotion\ImageStrategy\View\Strategy\ImageStrategy;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ImageStrategyFactory implements FactoryInterface
{
    /**
     * Create and return the Image view strategy
     *
     * Retrieves the ImageRenderer service from the service locator, and
     * injects it into the constructor for the Image strategy.
     *
     * It then attaches the strategy to the View service, at a priority of 100.
     *
     * @param  ContainerInterface $container
     * @param  string $name
     * @param  null|array $options
     * @return ImageStrategy
     */
    public function __invoke(ContainerInterface $container, $name, array $options = null)
    {
        $imageRenderer = $container->get(ImageRenderer::class);
        $imageStrategy = new ImageStrategy($imageRenderer);
        return $imageStrategy;
    }

    /**
     * Create and return ImageStrategy instance
     *
     * For use with zend-servicemanager v2; proxies to __invoke().
     *
     * @param ServiceLocatorInterface $container
     * @return ImageStrategy
     */
    public function createService(ServiceLocatorInterface $container)
    {
        return $this($container, ImageStrategy::class);
    }
}
