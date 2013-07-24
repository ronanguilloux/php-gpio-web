php-gpio-web
============

Website integration example of the [php-gpio](https://github.com/ronanguilloux/php-gpio) lib,
allowing your php-based website to blink LEDs.



Hardware prerequisites
----------------------

After having installed & wired your LED & resistor on a breadboard,
add appropriate modules from the Linux Kernel:

For LEDs, enable the gpio module :

``` bash
$ sudo modprobe w1-gpio
```

([see a complete circuit diagram for a single LED + explanations & schemas here](https://projects.drogon.net/raspberry-pi/gpio-examples/tux-crossing/gpio-examples-1-a-single-led/))

To load such kernel module automatically at boot time, edit the `/etc/modules` file & add this line:

```
w1-gpio
```


Installation
------------

The recommended way to install php-gpio-web is through [composer](http://getcomposer.org).

Install a webserver, git, php5 & curl:

``` bash
$ sudo apt-get install git php5 apache2 libapache2-mod-php5 curl
```

Clone this repo & install vendors (dependencies)

``` bash
$ git clone git://github.com/ronanguilloux/php-gpio-web.git
$ cd php-gpio-web
$ curl -sS https://getcomposer.org/installer | php
$ php composer.phar install
```

Configure apache2 vhost


Permission to blink
-------------------

Fetch the ready-to-use blinker file inside your project

``` bash
$ cd php-gpio-web
$ cp vendor/ronanguilloux/php-gpio/blinker .
$ chmod a+x blinker
```

To run this blinker with sudo permissions but without password inputting,
just allow your `www-data` or your `pi` user to run the blinker script.
With the solution provided below, only one blinker script is needed to manage all your leds,
and your webserver application needs only one php file to be specified in /etc/sudoers.

Edit your `/etc/sudoers` file:

``` bash
$ sudo visudo
```

Then add this two lines in your `/etc/sudoers` file :

```
www-data ALL=NOPASSWD: /path/to/the/blinker
```

Replace /pat/to/the/blinker with your project path

The blinker file provided is ready to use the API. You do not need to install apache2-suexec nor suPHP.


Run it!
-------

Via the *PHP built-in web server*:

``` bash
$ php -S "`hostname -I`:8080" -t web/
```

Via *Apache2*: cf. the [apache2.conf](https://github.com/ronanguilloux/php-gpio-web/blob/master/apache2.conf) example file

