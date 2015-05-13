# PHPHammer

## What is PHPHammer?

PHPHammer is a build tool, built in native PHP. It uses build script written with JSON.


## Why did you build another build tool? Phing is great.

Two reasons:

1.  I don't like XML
2.  We all like freedom. PHPHammer gets you the freedom of choice.


## Why should I choose PHPHammer?

-   Maybe you either don't like XML
-   Want to try an alternative?
-   Easy to extend with your custom builders


## Show me your build file

Look at this:

    {
        "name": "OmgDb",
        "version": "1.0",
        "globals": {
            "rightsdirs": [
                "app/cache",
                "app/logs"
            ]
        },
        "targets": {
            "rights": [
                [ "changeowner", "www-data", "$rightsdirs" ],
                [ "changemod", "0775", "$rightsdirs" ]
            ],
            "cacheclear": [
                [ "output", "clearing cache" ],
                [ "symfony", "cache:clear" ],
                [ "output", "directory rights" ],
                [ "target", "rights" ]
            ],
            "update-install": [
                [ "console", "composer update --optimize-autoloader" ],
                [ "target", "rights" ],
                [ "output", "open config.php from your webbrowser for further checks" ]
            ]
        }
    }

This sample build file provides the following information:

1.  The application name
2.  The application version
3.  Global variables that can be referenced by builders
4.  Build targets

Build targets work as follows:

-   You define a name for your target, eg "rights"
-   You define each step of the target as an array
-   The first entry of this array is the builder's name
-   The builder's name is at the same time the name of a php function sitting somewhere in a PHP file under the `src/builders/` directory
-   The complete array will be passed to this function and executed


## How can I use PHPHammer?

### First, create your build file

You can use the example file as a start. Put your build file named as `build.json` in your project's root folder.

### Second, build it

    php phar.php

This will create a directory called `bin/`. There you will find a file called `phphammer.phar`. Move it to your project's root folder.

### Third, swing your hammer

    php phphammer.phar TARGET

where TARGET is your defined target you want to execute.


## How can I support you?

Fork me, contribute your builders, create pull requests, buy me a beer.
