LazyBone Micro Framework
========================

This is a demonstration of the todoapp from backbone.js example.

Which uses LazyRecord as ORM, Roller Router to handle RESTful requests.


Bootstrap
---------

Install Onion:

    $ curl http://install.onionphp.org/ | bash
    $ onion bundle

Install LazyRecord:

    $ pear channel-discover pear.corneltek.com
    $ pear install corneltek/LazyRecord

Build database config:

    $ lazy build-conf config/lazy.yml

Build sql:

    $ lazy build-sql

Change permission:

    $ chmod 666 /tmp/todos.db

Check bootstrap.php script

    $ php bootstrap.php

