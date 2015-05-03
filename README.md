# simpleWAF

How to use 

Include the application in your script, and use: <br />
e.g : $sec = new simpleWAF(); => to init the application.

To add vulns for script to verify, you can simple: <br />
e.g: $sec->add('UNION SELECT');
 
Now you can set the parameter, you want to secure ($_GET / $_POST) <br />
e.g: $sec->secure($_GET);

Now you need to add check function to check blacklist. <br />
e.g: $sec->check();

Now you can start application by: <br />
e.g $sec->start();
