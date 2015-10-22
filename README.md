# monami - Your Monitoring Friend
#### An open-source project of [Sussex Network Laboratories](http://www.sussexlabs.net)

**Please Note** - This is a 'living' piece of software, and all development is
done in the master branch. Things may break. Please use this at your own risk,
and PLEASE DO submit PRs for things that you think may be broken! We love
collaboration and participation!

monami is a server and network monitoring tool to help manage your internet
infrastructure. It is written entirely in PHP, using a combination of a web
UI front-end (built using the CodeIgniter web framework), MySQL for a database,
and a backend processing script (also written in PHP) run via cronjob.

As of now, monami can monitor the availablity of TCP ports and ICMP responses.
