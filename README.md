# WordPressInstaller
Automated Wordpress Installer using PHP and mySQL and Google Captcha for security.

Step 1: The Script downloads current version of Word Press .zip, unpacks it, copies it to web-root directory then deletes it self.

Step 2: The Script creates mySQL database with user provided custom name.(Need CREATE rights for DB user).

Step 3: Output with new WordPress clickable site URL


# Getting Started:
1. Pull git repo to your web-root sub dir

2. Create SQL database and assign DB user that has CREATE rights. Update inc_db_con.php with connection info

3. In index.php enter your Google Captcha API and secret keys: data-sitekey="PASTE YOUR KEY HERE" and $key = 'PASTE YOUR KEY HERE';


Word Press Installer directory should reside inside web-root sub-directory. Example path:

https://yoursite.org/wordpress_install
The script will copy WP files to your web-root dir(one dir above) so that after it ran your new site URL will be:
https://yoursite.org/yournewWPsite

Click generated URL and follow standard WP setup procedure.

Enjoy your new WordPress site.
