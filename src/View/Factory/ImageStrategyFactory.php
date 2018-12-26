<?php
namespace InterEmotion\ImageStrategy\View\Factory;

use InterEmotion\ImageStrategy\View\Renderer\ImageRenderer;
use InterEmotion\ImageStrategy\View\Strategy\ImageStrategy;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

class ImageStrategyFactory implements FactoryInterface
{
    /**
     * Create an object
     *
     * @param  ContainerInterface $container
     * @param  string $requestedName
     * @param  null|array $options
     * @return ImageStrategy
     * @throws ServiceNotFoundException if unable to resolve the service.
     * @throws ServiceNotCreatedException if an exception is raised when
     *     creating a service.
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $imageRenderer = $container->get(ImageRenderer::class);
        $imageStrategy = new ImageStrategy($imageRenderer);
        return $imageStrategy;
    }
}
