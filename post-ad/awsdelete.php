<?php

include $BaseUrl.'/aws/aws-autoloader.php'; 
    use Aws\S3\S3Client;

    $s3 = new S3Client([
    'version' => 'latest',
    'region' => $region_name,
    'credentials' => [
    'key'    => $key_name,
    'secret' => $secret_name 
    ]
]);


    $bucket = 'artandcraft1';
    $keyname = '9953068428';
    
    $result = $s3->deleteObject(array(
        'Bucket' => $bucket,
        'Key'    => $keyname
    ));

?>