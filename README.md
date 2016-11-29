# SymfonyLibrinfoUserBundle
Manage user authentication

The goal of this bundle is to define a minimum configured environment for user authentication.

Default User and Group classes are defined and mapped with ORM driver.

Installation
============

Prequiresites
-------------

- having a working Symfony2 environment
- having created a working Symfony2 app (including your DB and your DB link)
- having composer installed (here in /usr/local/bin/composer, with /usr/local/bin in the path)

Downloading
-----------
```
$ composer require libre-informatique/user-bundle dev-master
```

Sonata bundles
--------------

Please refer to the Sonata Project's instructions, foundable here :
https://sonata-project.org/bundles/user/2-2/doc/reference/installation.html

The "libre-informatique" bundles
--------------------------------

Edit your app/AppKernel.php file and add your "libre-informatique/user-bundle" :

```php
    // app/AppKernel.php
    // ...
    public function registerBundles()
    {
        $bundles = array(
            // ...

            // The libre-informatique bundles
            new FOS\UserBundle\FOSUserBundle(),
            new Sonata\UserBundle\SonataUserBundle('FOSUserBundle'),
            new Librinfo\UserBundle\LibrinfoUserBundle(),

            // your personal bundles
        );
    }
```

Usages
======

Configuring your FOS_User properties
------------------------------------

```
# app/config/config.yml (or any other file that is loaded by your bundle)
fos_user:
    # ...
    db_driver: orm # other valid values are 'mongodb', 'couchdb' and 'propel'
    firewall_name: N/A 
    # ...
    user_class: Librinfo\BaseEntitiesBundle\Entity\GenericEntity
    group:
        group_class: Librinfo\BaseEntitiesBundle\Entity\GenericEntity
        group_manager: sonata.user.orm.group_manager
    service:
        user_manager: sonata.user.orm.user_manager
```

#### Note
Using ```Librinfo\BaseEntitiesBundle\Entity\GenericEntity``` as ```User``` and ```Group``` classes let this bundle defining it's own User and Group classes.
If you define custom User and Group Classes, the bundle will not override your values.

Configuring the Json type from sonata-project/doctrine-extension
----------------------------------------------------------------

```
# app/config/config.yml (or any other file that is loaded by your bundle)
doctrine:
    dbal:
        # ...
        types:
            json: Sonata\Doctrine\Types\JsonType
        # ...
```

Note: an abvious mistake can be the addition of this key outside the main ```doctrine``` key, where you have all your DB configuration.

###### Note:
```Librinfo\BaseEntitiesBundle\Entity\GenericEntity``` and default classes values (```FOS\UserBundle\Entity\User``` and ```FOS\UserBundle\Entity\Group```) will be replaced with defaults ```LibrinfoUserBundle``` configuration values in ```LibrinfoUserBundle/Resources/config/bundles/fos_user.yml```. Custom values in ```app/config/config.yml``` for the key ```fos_user``` will not be overriden by the ```LibrinfoUserBundle```.

Updating your schema to add User and Group entities tables
----------------------------------------------------------

    $ app/console doctrine:schema:validate
    $ app/console doctrine:schema:update --dump-sql
    $ app/console doctrine:schema:update --force
