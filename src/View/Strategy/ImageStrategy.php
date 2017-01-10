<?php
namespace InterEmotion\ImageStrategy\View\Strategy;

use InterEmotion\ImageStrategy\View\Model\ImageModel;
use InterEmotion\ImageStrategy\View\Renderer\ImageRenderer;
use Zend\EventManager\AbstractListenerAggregate;
use Zend\EventManager\EventManagerInterface;
use Zend\View\Model;
use Zend\View\ViewEvent;

class ImageStrategy extends AbstractListenerAggregate
{
    /**
     * Character set for associated content-type
     *
     * @var string
     */
    protected $charset = 'utf-8';

    /**
     * Multibyte character sets that will trigger a binary content-transfer-encoding
     *
     * @var array
     */
    protected $multibyteCharsets = [
        'UTF-16',
        'UTF-32',
    ];

    /**
     * @var ImageRenderer
     */
    protected $renderer;

    /**
     * Constructor
     *
     * @param  ImageRenderer $renderer
     */
    public function __construct(ImageRenderer $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * {@inheritDoc}
     */
    public function attach(EventManagerInterface $events, $priority = 1)
    {
        $this->listeners[] = $events->attach(ViewEvent::EVENT_RENDERER, [$this, 'selectRenderer'], $priority);
        $this->listeners[] = $events->attach(ViewEvent::EVENT_RESPONSE, [$this, 'injectResponse'], $priority);
    }

    /**
     * Set the content-type character set
     *
     * @param  string $charset
     * @return ImageStrategy
     */
    public function setCharset($charset)
    {
        $this->charset = (string) $charset;
        return $this;
    }

    /**
     * Retrieve the current character set
     *
     * @return string
     */
    public function getCharset()
    {
        return $this->charset;
    }

    /**
     * Detect if we should use the ImageRenderer based on model type
     *
     * @param  ViewEvent $e
     * @return null|ImageRenderer
     */
    public function selectRenderer(ViewEvent $e)
    {
        $model = $e->getModel();
        if (!$model instanceof ImageModel) {
            // no ImageModel; do nothing
            return;
        }

        // ImageModel found
        return $this->renderer;
    }

    /**
     * Inject the response with the image and appropriate Content-Type header
     *
     * @param  ViewEvent $e
     * @return void
     */
    public function injectResponse(ViewEvent $e)
    {
        $renderer = $e->getRenderer();
        if ($renderer !== $this->renderer) {
            return;
        }

        $result   = $e->getResult();
        /* @var $model ImageModel */
        $model = $e->getModel();
        $name = $model->getFileName();
        $format = $model->getImageFormat();

        // Populate response
        $response = $e->getResponse();
        $response->setContent($result);
        $headers = $response->getHeaders();
        $headers->addHeaderLine('Content-Transfer-Encoding', 'binary')
            ->addHeaderLine('Content-Disposition', 'filename=' . $name . '.' . $format)
            ->addHeaderLine('Content-Type', 'image/' . $format);
    }
}
