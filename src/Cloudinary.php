<?php
declare(strict_types = 1);

namespace MrPrompt\Silex;

use Cloudinary as Driver;
use Cloudinary\Uploader;
use Silex\Application;
use Silex\ServiceProviderInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Cloudinary Service
 *
 * @author Thiago Paes <mrprompt@gmail.com>
 */
final class Cloudinary implements CloudinaryInterface, ServiceProviderInterface
{
    /**
     * @var array
     */
    private $config;

    /**
     * Cloudinary constructor.
     *
     * @param string $cloud_name
     * @param string $api_key
     * @param string $api_secret
     */
    public function __construct(string $cloud_name, string $api_key, string $api_secret)
    {
        $this->config = [
            'cloud_name' => $cloud_name,
            'api_key'    => $api_key,
            'api_secret' => $api_secret,
        ];
    }

    /**
     * (non-PHPdoc)
     * @see \Silex\ServiceProviderInterface::register()
     * @param Application $app
     */
    public function register(Application $app)
    {
        Driver::config($this->config);

        $service = $this;

        $app[static::UPLOADER] = $app->protect(
            function (UploadedFile $file) use ($service) {
                return $service->createFromFile($file);
            }
        );

        $app[static::IMPORTER] = $app->protect(
            function (string $url) use ($service) {
                return $service->createFromUrl($url);
            }
        );
    }

    /**
     * (non-PHPdoc)
     * @see \Silex\ServiceProviderInterface::boot()
     * @param Application $app
     */
    public function boot(Application $app)
    {
        // :)
    }

    /**
     * @inheritdoc
     */
    public function createFromFile(UploadedFile $file): array
    {
        return Uploader::upload($file);
    }

    /**
     * @inheritdoc
     */
    public function createFromUrl(string $url): array
    {
        return Uploader::upload($url);
    }
}
