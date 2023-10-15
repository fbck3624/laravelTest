<?php
return [

    /*
|--------------------------------------------------------------------------
| Firebase Admin SDK Configuration
|--------------------------------------------------------------------------
|
| In order to communicate with Firebase services (e.g., Firebase
| Authentication, Realtime Database, Firestore), you need to configure
| the Firebase Admin SDK with your service account credentials.
|
| You can obtain these credentials from the Firebase Console by going to
| Project Settings > Service accounts and generating a new private key.
|
*/

    'credentials' => [
        'file' => env('FIREBASE_CREDENTIALS', storage_path('app/firebase-service-account.json')),
        // You can also use 'json' key if you have the credentials in JSON format as a string
        // 'json' => env('FIREBASE_CREDENTIALS_JSON', ''),
    ],

    /*
|--------------------------------------------------------------------------
| Firebase Realtime Database Configuration
|--------------------------------------------------------------------------
|
| If you're using the Firebase Realtime Database, you can specify the
| database URL and the name of the node (or subpath) to use as the root.
|
*/

    'database' => [
        'url' => env('FIREBASE_DATABASE_URL', 'https://your-firebase-project-id.firebaseio.com'),
        'name' => env('FIREBASE_DATABASE_NAME', null),
    ],

    /*
|--------------------------------------------------------------------------
| Firebase Cloud Firestore Configuration
|--------------------------------------------------------------------------
|
| If you're using Firebase Cloud Firestore, you can specify the project ID
| and the key file path (or JSON string) to use for authentication.
|
*/

    'firestore' => [
        'project_id' => env('FIREBASE_FIRESTORE_PROJECT_ID', 'your-firebase-project-id'),
        'key_file' => env('FIREBASE_FIRESTORE_KEY_FILE', storage_path('app/firebase-firestore-key.json')),
    ],

    /*
|--------------------------------------------------------------------------
| Firebase Cloud Storage Configuration
|--------------------------------------------------------------------------
|
| If you're using Firebase Cloud Storage, you can specify the default
| storage bucket and set up additional options here.
|
*/

    'storage' => [
        'default' => env('FIREBASE_STORAGE_DEFAULT', 'your-firebase-storage-bucket'),
    ],

    'connections' => [
        'default' => [
            'keyFile' => base_path('test2-fbf84-4bf848f1f4d5.json'),
            // ...
        ],
    ],

];
