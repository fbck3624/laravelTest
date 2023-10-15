<?php

namespace App\Service;

use Google\Cloud\Storage\StorageClient;

class FileUploadService
{
    // 文件上傳
    public function upload($file, $folder)
    {
        // api key
        $storage = new StorageClient([
            'keyFilePath' => env('GOOGLE_CLOUD_KEY_FILE'),
        ]);

        $bucketName = env('GOOGLE_CLOUD_STORAGE_BUCKET');
        // bucket
        $bucket = $storage->bucket($bucketName);
        //時間戳+_+name
        $name = time() . '_' . $file['name'];
        // 上傳
        $bucket->upload(
            fopen($file['tmp_name'], 'r'),
            ['name' => $folder . '/' . $name]
        );

        return "https://storage.googleapis.com/{$bucketName}/{$folder}/{$name}";
    }
}
