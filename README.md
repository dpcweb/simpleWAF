# simpleWAF

How to use 

Include the application your script, and use:
e.g : $sec = new simpleWAF(); => to init the application.

To add vulns for script to verify, you can simple:
e.g: $sec->add('UNION SELECT');

Now you can set the parameter, you want to secure ($_GET / $_POST)
e.g: $sec->secure($_GET);

Now you need to add check function to check blacklist.
e.g: $sec->check();

Now you can start application by:
e.g $sec->start();
