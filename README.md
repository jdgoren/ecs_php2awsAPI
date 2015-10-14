apache-php
===================================

A Docker image based on Ubuntu, serving PHP running as Apache Module. Useful for Web developers in need for a fixed PHP version. In addition, the `error_reporting` setting in php.ini is configurable per container via environment variable.

Tags
-----

* 5.3.10: Ubuntu 12.04 (LTS), Apache 2.2, PHP 5.3.10
* 5.5.9-1: Ubuntu 14.04 (LTS), Apache 2.4, PHP 5.5.9 with support for setting `error_reporting`

Usage
------

```
$ docker run -d -P bylexus/apache-php
```

A bit more specific:

```bash
$ docker run -d -p 8080:80 -p 2022:22 \
    -v /home/user/webroot:/var/www \
    -e SERVER_PASSWORD=ubuntu bylexus/apache-php:5.3.10
```

* `-v [local path]:/var/www` maps the container's webroot to a local path
* `-p [local port]:80` maps a local port to the container's HTTP port 80
* `-p [local port]:22` maps a local port to the container's SSH daemon port 22
* `-e SERVER_PASSWORD=[secret]` sets the user passwords for both `root` and the unprivileged `ubuntu` user
* `-e SERVER_KEY=[ssh-key-string]` sets the SSH key for the `ubuntu` user to log in passwordless via ssh
* `-e PHP_ERROR_REPORTING=[php error_reporting settings]` sets the value of `error_reporting` in the php.ini files.

  Example: `-e PHP_ERROR_REPORTING='E_ALL & ~E_STRICT'`

### Access apache logs

You can of course SSH into the container and tail / view the Apache logs in `/var/www/apache2`. A better approach is to expose the log directory as a Volume, and use it in a 2nd container to log:

```bash
# start container as daemon:
$ docker run --name=myapache -d -v /var/log bylexus/apache-php:5.5.9

# attach a 2nd container for logging:
$ docker run --name=logger -t --volumes-from=myapache ubuntu:14.04 \
    /bin/bash -c 'tail -f /var/log/apache2/*'

# next time you need the logging container, just start / re-attach:
$ docker attach logger
```


Installed packages
-------------------
* Ubuntu Server, based on ubuntu docker iamge
* openssh-server
* apache2
* php5
* php5-cli
* libapache2-mod-php5
* php5-gd
* php5-json
* php5-ldap
* php5-mysql
* php5-pgsql

Configurations
----------------

* Apache: .htaccess-Enabled in webroot (mod_rewrite with AllowOverride all)
* php.ini:
  * display_errors = On
  * error_reporting = E_ALL & ~E_DEPRECATED & ~E_NOTICE (default)
