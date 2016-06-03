# Xin for Artisan command

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)

![Xin Logo](xin-logo.png)

**Xin**, _in Vietnamese_, is to "ask for something on demand". Now, you can **xin** something right into Laravel Artisan console.

## Install

Via Composer

``` bash
$ composer require petehouston/xin-artisan
```

### Configuration

Append this line to `$providers` variable on `config/app.php` file:

```
    'providers' => [
        ...
        Petehouston\Xin\XinServiceProvider::class,
    ]
```

## Usage

### Ask for IP address

**Get local IP address:**

```
$ php artisan xin:ip
Local IP address is: 192.168.100.3
```

**Get public/external IP address:**

```
$ php artisan xin:ip --public
External IP address is: 13.66.202.129
```

### Open a Laravel documentation section

**List all available Laravel documentation sections:**

```
$ php artisan xin:docs list

All of Laravel documentation sections are listed below:
+----------------------------+-------------------------+
| Section                    | Key                     |
+----------------------------+-------------------------+
| Release Notes              | releases                |
| Upgrade Guide              | upgrade                 |
| Contribution Guide         | contributions           |
| Installation               | installation            |
| Configuration              | configuration           |
| Homestead                  | homestead               |
| Valet                      | valet                   |
| Basic Task List            | quickstart              |
| Intermediate Task List     | quickstart-intermediate |
| Routing                    | routing                 |
| Middleware                 | middleware              |
| Controllers                | controllers             |
| Requests                   | requests                |
| Responses                  | responses               |
| Views                      | views                   |
| Blade Templates            | blade                   |
| Request Lifecycle          | lifecycle               |
| Application Structure      | structure               |
| Service Providers          | providers               |
| Service Container          | container               |
| Contracts                  | contracts               |
| Facades                    | facades                 |
| Authentication             | authentication          |
| Authorization              | authorization           |
| Artisan Console            | artisan                 |
| Billing                    | billing                 |
| Cache                      | cache                   |
| Collections                | collections             |
| Elixir                     | elixir                  |
| Encryption                 | encryption              |
| Errors & Loggin            | errors                  |
| Events                     | events                  |
| Filesystem & Cloud Storage | filesystem              |
| Hashing                    | hashing                 |
| Helpers                    | helpers                 |
| Localization               | localization            |
| Mail                       | mail                    |
| Package Development        | packages                |
| Pagination                 | pagination              |
| Queues                     | queues                  |
| Redis                      | redis                   |
| Session                    | session                 |
| SSH Tasks                  | envoy                   |
| Task Scheduling            | scheduling              |
| Testing                    | testing                 |
| Validation                 | validation              |
| Database - Getting Started | database                |
| Query Builder              | queries                 |
| Migrations                 | migrations              |
| seeding                    | seeding                 |
| Eloquent - Getting Started | eloquent                |
| Relationships              | eloquent-relationships  |
| Eloquent Collections       | eloquent-collections    |
| Mutators                   | eloquent-mutators       |
| Eloquent Serialization     | eloquent-serialization  |
+----------------------------+-------------------------+
```

**Open the section on browser:**

Xin will use the default system browser to open URL. Key is the value available from "list".

```
$ php artisan xin:docs read --key=envoy
```

**Open documentation in different languages:**

Use `--locale` option. Currently, only "en" and "vn" are supported. Default is "en".

```
$ php artisan xin:docs read --key=structure --locale=vn
```


## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/petehouston/xin-artisan.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/petehouston/xin-artisan.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/petehouston/xin-artisan
[link-downloads]: https://packagist.org/packages/petehouston/xin-artisan
[link-author]: https://github.com/petehouston
[link-contributors]: ../../contributors
