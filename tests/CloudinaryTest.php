<?php
namespace MrPrompt\Silex\Tests;

use MrPrompt\Silex\Cloudinary;
use PHPUnit_Framework_TestCase;
use Silex\Application;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Image service test case.
 *
 * @author Thiago Paes <mrprompt@gmail.com>
 */
class CloudinaryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Application
     */
    private $app;

    /**
     * Bootstrap
     */
    public function setUp()
    {
        parent::setUp();

        $cloud_name = getenv('CLOUDINARY_CLOUD_NAME');
        $api_key    = getenv('CLOUDINARY_API_KEY');
        $api_secret = getenv('CLOUDINARY_API_SECRET');

        $app     = new Application;
        $app->register(new Cloudinary($cloud_name, $api_key, $api_secret));

        $this->app = $app;
    }

    /**
     * Shutdown
     */
    public function tearDown()
    {
        $this->app = null;

        parent::tearDown();
    }

    /**
     * @test
     */
    public function createFromFileUploadMustBeReturnArray()
    {
        $file    = __DIR__ . '/../resources/image_normal.png';
        $upload  = new UploadedFile($file, basename($file), filetype($file), filesize($file), null, true);

        $result = $this->app[Cloudinary::UPLOADER]($upload);

        $this->assertArrayHasKey('public_id', $result);
        $this->assertArrayHasKey('width', $result);
        $this->assertArrayHasKey('height', $result);
        $this->assertArrayHasKey('url', $result);
        $this->assertArrayHasKey('secure_url', $result);
    }

    /**
     * @test
     */
    public function createFromUrlMustBeReturnArray()
    {
        $url    = 'https://res.cloudinary.com/image/sample.jpg';

        $result = $this->app[Cloudinary::IMPORTER]($url);

        $this->assertArrayHasKey('public_id', $result);
        $this->assertArrayHasKey('width', $result);
        $this->assertArrayHasKey('height', $result);
        $this->assertArrayHasKey('url', $result);
        $this->assertArrayHasKey('secure_url', $result);
    }
}
