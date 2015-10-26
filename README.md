# mon ami - Your Monitoring Friend
#### An open-source project of [Sussex Network Laboratories](http://www.sussexlabs.net)

**Please Note** - This is a 'living' piece of software, and all development is
done in the master branch. Things may break. Please use this at your own risk,
and PLEASE DO submit PRs for things that you think may be broken! We love
collaboration and participation!

mon ami is a server and network monitoring tool to help manage your internet
infrastructure. It is written entirely in PHP, using a combination of a web
UI front-end (built using the CodeIgniter web framework), MySQL for a database,
and a backend processing script (also written in PHP) run via cronjob.

As of now, monami can monitor the availablity of TCP ports and ICMP responses.

#### Installation Instructions
1. Create a new MySQL database, and run ./monami.sql against it
2. To create a new user, insert a record into **tblMonitoringUsers** using your favorite sql admin tool. You'll need to md5hash the password.
3. Open ./monami/config/config.php and edit the line containing "**$config['base_url']**" to match your domain name
4. Open ./monami/config/database.php and edit the lines containing 	'**hostname**', '**username**', '**password**' and '**database**' to match the database you created in step 1 above.
5. Point your browser to the URL you set in step 3, and login with the credentials you set in step 2.
