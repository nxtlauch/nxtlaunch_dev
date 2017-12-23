<?php

return [
  'gcm' => [
      'priority' => 'normal',
      'dry_run' => false,
      'apiKey' => 'My_ApiKey',
  ],
  'fcm' => [
        'priority' => 'normal',
        'dry_run' => false,
        'apiKey' => 'AAAAfHYwW_0:APA91bGWdocfzmK_sAEeLdDnPIvkUomLC4NK2QeEiiI8Rgvv_GsFew8nnk5k2qAstZ1RQXy2b_aoUTh838dFjyQeZzWAnCo-Nq_eA_AlmvtJRBBLgNWYZNPdF2D0hfQoSJxM966maC2D',
  ],
  'apn' => [
      'certificate' => __DIR__ . '/iosCertificates/apns-dev-cert.pem',
      'passPhrase' => '1234', //Optional
      'passFile' => __DIR__ . '/iosCertificates/yourKey.pem', //Optional
      'dry_run' => true
  ]
];