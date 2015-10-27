# SymfonyLibrinfoUserBundle
Manage user authentication

Installation
============

Prequiresites
-------------

- having a working Symfony2 environment
- having created a working Symfony2 app (including your DB and your DB link)
- having composer installed (here in /usr/local/bin/composer, with /usr/local/bin in the path)

Downloading
-----------

  $ composer require libre-informatique/user-bundle dev-master

Sonata bundles
--------------

Please refer to the Sonata Project's instructions, foundable here :
https://sonata-project.org/bundles/admin/2-3/doc/reference/installation.html

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
    db_driver: orm # other valid values are 'mongodb', 'couchdb' and 'propel'
    # ...
    user_class: Librinfo\UserBundle\Entity\User
    # ...
    group:
        group_class:   Librinfo\UserBundle\Entity\Group
        group_manager: ~
    service:
        user_manager: ~
```

Updating your schema to add User and Group entities tables
----------------------------------------------------------

    $ app/console doctrine:schema:validate
    $ app/console doctrine:schema:update --dump-sql
    $ app/console doctrine:schema:update --force

Using with SonataUserBundle
---------------------------

Update your config.yml specifying sonata user as user and group manager
Define ```Librinfo\UserBundle\Entity``` as ```User``` and ```Group``` classes under ```sonata_user``` key

```
# app/config/config.yml (or any other file that is loaded by your bundle)
fos_user:
    db_driver: orm # other valid values are 'mongodb', 'couchdb' and 'propel'
    firewall_name: main
    user_class: Librinfo\UserBundle\Entity\User
    group:
        group_class:   Librinfo\UserBundle\Entity\Group
        group_manager: sonata.user.orm.group_manager
    service:
        user_manager: sonata.user.orm.user_manager

sonata_user:
    # ...
    class:                  # Entity Classes
        user:               Librinfo\UserBundle\Entity\User
        group:              Librinfo\UserBundle\Entity\Group
```

Disabling User Registration
---------------------------

Just add this « overriding » configuration routing to your routing.yml

```
# app/config/routing.yml
sonata_user_register:
    resource: "@LibrinfoUserBundle/Resources/config/registration_routes.xml"
    prefix: /register
```

All these routes will throw a NotFoundHttpException, disallowing registration process.