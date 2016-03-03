<?php
declare(strict_types = 1);

namespace MrPrompt\Silex;

use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Cloudinary Service Interface
 *
 * @author Thiago Paes <mrprompt@gmail.com>
 */
interface CloudinaryInterface
{
    /**
     * @const string
     */
    const UPLOADER  = 'cloudinary.uploader';
    /**
     * @const string
     */
    const IMPORTER  = 'cloudinary.importer';

    /**
     * Create from file upload
     *
     * @param UploadedFile $file
     * @return array
     */
    public function createFromFile(UploadedFile $file): array;

    /**
     * Import from url
     *
     * @param string $url
     * @return array
     */
    public function createFromUrl(string $url): array;
}
