<?php

function storage($path): string
{
    if (config('filesystems.default') === 's3') {
        $bucket = Config::get('filesystems.disks.s3.bucket');
        return Storage::getClient()->getEndpoint() .  "/$bucket/" . ltrim($path, '/');
    }
    return Storage::url($path);
}

function storage_copy($path, $target)
{
    return Storage::exists($path) ? Storage::copy($path, $target) : false;
}

function get_privet_storage($path)
{
    $client = Storage::disk('s3')->getClient();
    $bucket = Config::get('filesystems.disks.s3-private.bucket');

    $command = $client->getCommand('GetObject', [
        'Bucket' => $bucket,
        'Key' => $path  // file name in s3 bucket which you want to access
    ]);

    $request = $client->createPresignedRequest($command, '+2 minutes');

    // Get the actual presigned-url
    return (string)$request->getUri();
}
