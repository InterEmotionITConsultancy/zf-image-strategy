<?php
namespace InterEmotion\ImageStrategy\View\Renderer;

use Imagine\Image\ImageInterface;
use InterEmotion\ImageStrategy\View\Model\ImageModel;
use Laminas\View\Exception;
use Laminas\View\Renderer\RendererInterface as Renderer;
use Laminas\View\Resolver\ResolverInterface as Resolver;

/**
 * Image renderer
 */
class ImageRenderer implements Renderer
{
    /** @var Resolver */
    protected $resolver;


    /**
     *
     * @return Renderer
     */
    public function getEngine()
    {
        return $this;
    }

    /**
     * @param  Resolver $resolver
     * @return Renderer
     */
    public function setResolver(Resolver $resolver)
    {
        $this->resolver = $resolver;

        return $this;
    }


    /**
     * @inheritDoc
     */
    public function render($nameOrModel, $values = null)
    {
        if ($nameOrModel instanceof ImageModel) {
            $imageModel = $nameOrModel;
            $image = $imageModel->getImage();
            $format = $imageModel->getImageFormat();
            if (!$image instanceof ImageInterface) {
                throw new Exception\RuntimeException(
                    'You must provide Imagine\Image\ImageInterface or path of image'
                );
            }
            return $image->get($format, $imageModel->getImageOptions());
        }
        throw new Exception\InvalidArgumentException(sprintf(
            '%s expects argument 1 to be an instance of InterEmotion\ImageStrategy\View\Model\ImageModel'
            . ', %s provided instead',
            __METHOD__,
            is_object($nameOrModel) ? get_class($nameOrModel) : gettype($nameOrModel)
        ));
    }
}
