# Laravel table comment for migration

[![Latest Version on Packagist](https://img.shields.io/packagist/v/chuoke/laravel-table-comment.svg?style=flat-square)](https://packagist.org/packages/chuoke/laravel-table-comment)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/chuoke/laravel-table-comment/Check%20&%20fix%20styling?label=code%20style)](https://github.com/chuoke/laravel-table-comment/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/chuoke/laravel-table-comment.svg?style=flat-square)](https://packagist.org/packages/chuoke/laravel-table-comment)

---

Just a simple extension for commenting table in laravel migration.

## Installation

You can install the package via composer:

```bash
composer require chuoke/laravel-table-comment
```

## Usage

```php
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
// use Illuminate\Database\Migrations\Migration;
use Chuoke\LaravelTableComment\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 30)->comment('Name');

            $table->comment('User info table');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}

```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
