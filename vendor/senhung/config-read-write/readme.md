# Config Read Write

## Description

A PHP package for reading and setting configuration fast and easy.

## Setup

1. Add Dependency

```bash
$ composer require senhung/config-read-write
```

2. Add a Configuration File

Create a file and input the configurations

For example: 

```
# Some Comments
APP_NAME=config-read
VERSION=2.0.0
```

## How To Use

### Initialize

```php
Configruation::initializeConfigs(
    [string $configFilePath [, bool $absolutePath [, string $separator]]]
): void
```

`$configFilePath`: the location your config file is placed (default: `'.env'`)

`$absolutePath`: the path defined is absolute path or relative path (default: `true`)

`$separator`: the separator between config keys and values (default: `'='`)

#### Config Entry

Add the following code in your program's main entry if you want to specify a different config file name or separator 
other than the default ones

```php
<?php

require_once 'vendor/autoload.php';

use Senhung\Config\Configuration;

/* Initialize config array in Configuration class */
Configuration::initializeConfigs('config_file_path', true, 'separator');

```

Note: you don't need to have this file if you are using `.env` as your config path and `=` as your separator.

### Comment Config

Use `#` in config file to comment a line

```
# This is a comment, will not be read by the tool
OTHER_CONFIG=will-be-read
```

**Note: Set config will overwrite comments and empty lines in original config file**

### Read Config

```php
Configuration::read('<config-you-want-to-read>');
```

### Write Config

```php
Configuration::set('<config-you-want-to-write>', '<change-to>');
```

**Note: Set config will overwrite comments and empty lines in original config file**

## Example

### Configuration File

```
# App Configs
APP_NAME=config-read
VERSION=2.0.0
```

### Config Reading and Writing

```php
<?php

require_once 'vendor/autoload.php';

use Senhung\Config\Configuration;

/* Read config APP_NAME */
echo Configuration::read('APP_NAME') . "\n";

/* Read config VERSION */
echo Configuration::read('VERSION') . "\n";

/* Set APP_NAME to config-write */
Configuration::set('APP_NAME', 'config-write');

/* Read APP_NAME again to see the changes */
echo Configuration::read('APP_NAME') . "\n";

```

Output:

```bash
config-read
2.0.0
config-write
```
