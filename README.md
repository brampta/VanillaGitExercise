Hi,

To run this, place the complete app on a PHP web server, run composer install at the root of the app to get the packages under vendor and access the file at web/index.php which is the application entry point.

note:
Due to GitHub OAuth limitation the application must be accessed under the http://localhost domain but the path can be anything.

expected results:
*when accessing web/index.php you should see a link to login via github
*clicking the link should take you to a github login page
*after successful login with your github credentials you should be redirected back to the site on localhost and be presented with your github repos, grouped by owner
*you can also log out to erase the session




