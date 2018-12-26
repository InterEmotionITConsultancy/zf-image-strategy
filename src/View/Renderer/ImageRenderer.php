<?php
namespace InterEmotion\ImageStrategy\View\Renderer;

use Imagine\Image\ImageInterface;
use InterEmotion\ImageStrategy\View\Model\ImageModel;
use Zend\View\Exception;
use Zend\View\Model\ModelInterface as Model;
use Zend\View\Renderer\RendererInterface as Renderer;
use Zend\View\Resolver\ResolverInterface as Resolver;

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
     * Renders the image from the model
     *
     * @todo   Determine what use case exists for accepting both $nameOrModel and $values
     * @param  string|Model $nameOrModel The script/resource process, or a view model
     * @param  null|array|\ArrayAccess $values Values to use during rendering
     * @throws Exception\DomainException
     * @return string The script output.
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
