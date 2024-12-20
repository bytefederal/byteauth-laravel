![ByteAuth-Laravel Logo](byteauth-laravel.png)

# ByteAuth-Laravel

## Description

ByteAuth-Laravel is a plug and play Laravel package that integrates Byte Federal's fast authentication system into your Laravel application, leveraging bitcoin cryptographic (ECDSA/SHA256) standards. This advanced package not only offers a seamless way to onboard users and enable secure sign-in functionalities, akin to the Webauthn standard, but it also introduces several groundbreaking features: 

- It ensures that cryptographic keys are backed up for added security, 
- Operates independently of the user's operating system and instead uses a smart-phone as universal access key, 
- Incorporates a user identity check to thwart fraudulent users including a liveness check to verify the presence of real human beings during authentication.
- Additionally, it furnishes users with a wallet that supports lightning and bitcoin transactions, enhancing the overall user experience (LNUrl, micropayments, etc).

By integrating ByteAuth-Laravel, you can easily implement a state-of-the-art, comprehensive authentication system in your Laravel projects, harnessing the robustness and security of bitcoin's cryptographic infrastructure.

[Learn more about ByteAut / Fast Login](https://fast.bytefederal.com).

[Learn more about ByteWallet](https://www.bytefederal.com/bytewallet).

## Features

- **Fast Authentication**: Utilize Byte Federal's rapid authentication process to enhance user experience.
- **Bitcoin Cryptographic Standards**: Benefit from the high security of bitcoin cryptographic practices.
- **Easy Integration**: Seamlessly integrate with Laravel applications, providing a Livewire component for both front-end and back-end operations.
- **Sample Login Page**: Get started quickly with a sample login landing page tailored for Laravel applications.
- **Webhook Support**: Includes a `WebhookController` for handling authentication callbacks.

## Installation

This package requires `simplesoftwareio/simple-qrcode`. If it's not already installed, you can install it by running:

```bash
composer require simplesoftwareio/simple-qrcode
```

To install ByteAuth-Laravel, run the following command in your Laravel project:

```bash
composer require bytefederal/byteauth-laravel
```

After installing the byteauth-laravel package, you may publish the QR Code's configuration file using:

```bash
php artisan vendor:publish --provider="SimpleSoftwareIO\QrCode\QrCodeServiceProvider"
```

## Configuration
After installation, publish the package's configuration file by running:

```bash
php artisan vendor:publish --provider="ByteFederal\\ByteAuthLaravel\\ByteAuthServiceProvider"
```
This will publish the ByteAuth-Laravel configuration file to your project's config directory. Edit this file as needed to match your application's requirements.

Additionally, to customize the domain used by the QR code generation process:

### Publish the Configuration:

```bash
php artisan vendor:publish --tag=byteauth-config
```

This command publishes the ByteAuth-Laravel configuration file to your Laravel project's config directory.

### Edit the Configuration File:
Open the published config/byteauth.php in your project and set the domain value to your website's domain, your api key and your website's dashboard path for the redirect after successful login.

```bash
return [
    'domain' => env('BYTEAUTH_DOMAIN_REGISTERED', 'my.example.com'),
    'api_key' => env('BYTEAUTH_API_KEY', 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx'),
    'home' => env("BYTEAUTH_HOME_REDIRECT", "/home"),
];
```

Make sure to register your domain in the API section [on ByteFederal](https://wallet.bytefederal.com/web/login).

### Utilize Configuration in Your Component:
Update your Livewire component or other parts of your application to use this configuration value when generating QR codes or making related API calls.

```bash
php artisan vendor:publish --tag=byteauth-views
```

This setup enables your application to use and potentially customize the included sample login page.

Make sure to add the following three routes to your `routes/api.php` file:

```bash
use ByteFederal\ByteAuthLaravel\Controllers\WebhookController;
...
//backend webhook endpoints
Route::post('/webhook/registration', [WebhookController::class, 'handleRegistration']);
Route::post('/webhook/login', [WebhookController::class, 'handleLogin']);
```
While the above routes do not require session information and will be called from the relay server, the following endpoints DO need session information and should thus be set up in your `routes/web.php` file:

```bash
use ByteFederal\ByteAuthLaravel\Controllers\WebhookController;
...
//frontend session handling endpoints
Route::get('/api/check', [WebhookController::class, 'check']);
Route::get('/api/bwauth', [WebhookController::class, 'bwauth']);
//sample login page
Route::get('/byte', [WebhookController::class, 'sample']);
```

or guest Route section. Make sure CORS rules allow the WebhookController to receive incoming posts. 

## Troubleshooting
You may have to install `imagick` to enable the QR code generation on your server. Look out for messages like this:

```bash
[previous exception] [object] (BaconQrCode\\Exception\\RuntimeException(code: 0): You need to install the imagick extension to use this back end at /var/www/laravel/vendor/bacon/bacon-qr-code/src/Renderer/Image/ImagickImageBackEnd.php:64)
```
Simply install imagick and add its php module:

```bash
sudo apt-get install php8.2-imagick
sudo phpenmod imagick
sudo systemctl restart apache2
```

## Usage
To use ByteAuth-Laravel in your application, follow these steps:

- Route Setup: Import the package routes in your routes/api.php file.
- Use the sample landing page at a route of your convenience. It will offer your users a way to log into your site or register using ByteWallet
- To register your domain for free for this service go to wallet.bytefederal.com/web/login and register your domain, webhook url and API key.
- Enjoy a biometrically secured passwordless authentication system

Refer to the [documentation](https://fast.bytefederal.com/docs/PlugNPlay/byteauth-laravel) for detailed usage instructions.

Happy coding!

## Contributing
Contributions to ByteAuth-Laravel are welcome.

License
ByteAuth-Laravel is open-sourced software licensed under the MIT license.
