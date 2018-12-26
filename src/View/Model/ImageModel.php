<?php
namespace InterEmotion\ImageStrategy\View\Model;

use Zend\View\Model\ViewModel;
use Imagine\Image\ImageInterface;

class ImageModel extends ViewModel
{
    /** @var string */
    protected $captureTo = null;

    /** @var bool */
    protected $terminate = true;

    /** @var ImageInterface */
    private $image;

    /** @var string */
    private $imageFormat = 'png';

    /** @var string */
    private $fileName;

    /** @var array */
    private $imageOptions = array();

    /**
     * @return ImageInterface
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param ImageInterface $image
     */
    public function setImage(ImageInterface $image)
    {
        $this->image = $image;
    }
    /**
     * @return string
     */
    public function getImageFormat()
    {
        return $this->imageFormat;
    }

    /**
     * @param string $imageFormat
     */
    public function setImageFormat($imageFormat)
    {
        $this->imageFormat = $imageFormat;
    }

    /**
     * Gets the $fileName
     *
     * @return string
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * Sets the $fileName
     *
     * @param string $fileName
     * @return ImageModel
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;

        return $this;
    }

    /**
     * @return array
     */
    public function getImageOptions()
    {
        return $this->imageOptions;
    }

    /**
     * @param array $imageOptions
     */
    public function setImageOptions($imageOptions)
    {
        $this->imageOptions = $imageOptions;
    }
}
