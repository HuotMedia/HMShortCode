HMShortCode
===========

Allows users to render view helpers using short codes. Useful when used with editors like TinyMCE.

Installation
--------------

### Main Setup

#### By cloning project

1. Clone this project into your `./vendor/` directory.

#### With composer

Coming Soon...

#### Post installation

1. Enabling it in your `application.config.php`file.

    ```php
    <?php
    return array(
        'modules' => array(
            // ...
            'HMShortCode',
        ),
        // ...
    );
    ```

Using HMShortCode
-----------------

Simply add {{viewHelper[parameters to pass in]}} to any view or even within an editor like TinyMCE. This removes the need for allowing users to add php to content from an editor. 

EXAMPLE:

```
{{url['home', array()]}}
```

Current Version
---------------

The current version of this module is unfinished. Still trying to prevent the module of running when trying to edit existing short codes within an editor. 