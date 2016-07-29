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

### Setup

Append this line to `$providers` variable on `config/app.php` file:

```
    'providers' => [
        ...
        Petehouston\Xin\XinServiceProvider::class,
    ]
```

### Configuration

You need to add xin config file `xin.php` to your project:

```
$ php artisan vendor:publish --provider="Petehouston\Xin\XinServiceProvider" --tag=config
```

**Some config variables for use:**

* `browser.bin`: the absolute path to the browser binary you want to use. Default, xin will automatically look up for you.

## Command list

Following commands are supported:

* [xin:ip](#ask-for-ip-address): get IP address.
* [xin:docs](#open-a-laravel-documentation-section): read Laravel documentation.
* [xin:log](#play-with-log-files): play around with log files.
* [xin:gist](#share-code-via-gist): Share code via public Gist.

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

### Play with log files

All logs are stored under `storage/logs` directory.

**Read log file**

The default log file is `laravel.log`.

```
$ php artisan xin:log
```

You can read content of different log files by name:

```
$ php artisan xin:log --name=custom.log
```

**Clean log file content**

```
$ php artisan xin:log --clean
```

The log file will be empty.

You can combine clean a custom log file:

```
$ php artisan xin:log --name=custom.log --clean
```

**Remove all logs**

```
$ php artisan xin:log --remove-all
```

This command will remove all files in `storage/logs` directory.

### Share code via Gist

This command will share a source file to public Gist. It will response with **Gist Id** and **Gist Url**.

```
$ php artisan xin:gist [filename] --desc="Sharing description."
```

For example, if you want to share `public/index.php` file:

```
$ php artisan xin:gist public/index.php --desc="Sharing Laravel index file."
Gist Sharing Information
------------------------------------------------------------------
Gist Id:  37c55c18cd63c34195c22fafbff6fe16
Gist Url: https://gist.github.com/37c55c18cd63c34195c22fafbff6fe16
```

**Note:** on Windows, since the path separator is `\`, so you need to wrap the `filename` with double-quotation mark `"` like this:

```
$ php artisan xin:gist "public\index.php"
```

### Create empty Blade view

Wanna create Blade view file from command quickly? Use this:

```
$ php artisan xin:view admin.auth.login
```

It will create `login.blade.php` at `resources/views/admin/auth`, it also does create any directory that doesn't exist in the path.

Apparently, in Linux/Unix/Mac, you can use `touch`.

```
$ mkdir resources/views/admin/auth
$ touch resources/views/admin/auth/login.blade.php
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
