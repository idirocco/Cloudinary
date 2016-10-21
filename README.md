# Silex Cloudinary Provider

[![Build Status](https://travis-ci.org/SilexFriends/Cloudinary.svg?branch=master)](https://travis-ci.org/SilexFriends/Cloudinary)
[![Code Climate](https://codeclimate.com/github/SilexFriends/Cloudinary/badges/gpa.svg)](https://codeclimate.com/github/SilexFriends/Cloudinary)
[![Test Coverage](https://codeclimate.com/github/SilexFriends/Cloudinary/badges/coverage.svg)](https://codeclimate.com/github/SilexFriends/Cloudinary/coverage)
[![Issue Count](https://codeclimate.com/github/SilexFriends/Cloudinary/badges/issue_count.svg)](https://codeclimate.com/github/SilexFriends/Cloudinary)

A service provider to Cloudinary API Client.

## Install

```
composer require mrprompt/silex-cloudinary
```

## Usage

```
use SilexFriends\Cloudinary\Cloudinary as CloudinaryServiceProvider;

$app->register(
    new CloudinaryServiceProvider(
        $cloud_name,
        $api_key,
        $api_secret
    )
);

$file = $app['request']->files->get('file');
$upload = $app['cloudinary.uploader']($file);

print_r($upload);

```


#### License
MIT