php-gpio-web
============

Website integration example of the [php-gpio](https://github.com/ronanguilloux/php-gpio) lib



Hardware prerequisites
----------------------

After having installed & wired your LED & resistor on a breadboard, 
add appropriate modules from the Linux Kernel:

For LEDs, enable the gpio module :

``` bash
    $ sudo modprobe w1-gpio
```

([see a complete circuit diagram for a single LED + explanations & schemas here](https://projects.drogon.net/raspberry-pi/gpio-examples/tux-crossing/gpio-examples-1-a-single-led/))


Installation
------------

The recommended way to install php-gpio-web is through [composer](http://getcomposer.org).

Just run these three commands to install it (`curl` needed):

``` bash
    $ sudo apt-get install git
    $ wget http://getcomposer.org/composer.phar
    $ php composer.phar create-project --stability='dev' ronanguilloux/php-gpio-web
```


Blink with style
----------------

Fetch the ready-to-use blinker file inside your project

``` bash
    $ cd php-gpio-web
    $ cp vendor/ronanguilloux/php-gpio/blinker .
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
    www-data ALL=NOPASSWD: /path/to/blinker
    myCurrentLinuxLogin ALL=NOPASSWD: /path/to/blinker
```

Just replace myCurrentLinuxLogin by your own linux user login
The blinker file provided is ready to use the API.


Run it!
-------

``` bash
    $ php -S "`hostname -I`:8080" -t web/
```

