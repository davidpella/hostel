# Hostel


```shell
ssh root@143.110.243.19
```

## How To Install Nginx on Ubuntu 20.04
### Step 1 – Installing Nginx
```shell
sudo apt update
sudo apt install nginx
```

### Step 2 – Adjusting the Firewall

Before testing Nginx, the firewall software needs to be adjusted to allow access to the service. Nginx registers itself as a service with ufw upon installation, making it straightforward to allow Nginx access.

List the application configurations that ufw knows how to work with by typing:
```shell
sudo ufw app list
```

It is recommended that you enable the most restrictive profile that will still allow the traffic you’ve configured. Right now, we will only need to allow traffic on port 80.

You can enable this by typing:
```shell
sudo ufw allow 'Nginx Full'
```

If UFW was not active. you can enable by typing:
```shell
sudo ufw enable
```

You can verify the change by typing:
```shell
sudo ufw status
```

### Step 4 – Managing the Nginx Process
Now that you have your web server up and running, let’s review some basic management commands.

To stop your web server, type:
```shell
sudo systemctl stop nginx
```

To start the web server when it is stopped, type:
```shell
sudo systemctl start nginx
```

To stop and then start the service again, type:
```shell
sudo systemctl restart nginx
```

If you are only making configuration changes, Nginx can often reload without dropping connections. To do this, type:
```shell
sudo systemctl reload nginx
```

By default, Nginx is configured to start automatically when the server boots. If this is not what you want, you can disable this behavior by typing:
```shell
sudo systemctl disable nginx
```

To re-enable the service to start up at boot, you can type:
```shell
sudo systemctl enable nginx
```

You have now learned basic management commands and should be ready to configure the site to host more than one domain.


## How to Install PHP 8 on Ubuntu 20.04
```shell
sudo apt update -y
sudo apt upgrade -y
```

### 3. Add PHP Repository
By default, the PHP 8.0 is not included in the Ubuntu 20.04 default repository. So you will need to add the ondrej/php PPA repository to your system.

First, install the required dependencies using the following command:
```shell
sudo apt install software-properties-common -y
```

Next, add the ondrej/php PPA repository with the following command:
```shell
add-apt-repository ppa:ondrej/php
```

Once the repository is added, you can update it with the following command:
```shell
sudo apt update -y
```

### 4. Install PHP 8.0
You can install the Apache web server with PHP 8.0 by running the following command:
```shell
sudo apt install php8.0 -y 
```

You can also install the most commonly used PHP extensions using the following command:
```shell
sudo apt install php8.0-common php8.0-mysql php8.0-fpm php8.0-xml php8.0-bcmath php8.0-curl php8.0-gd php8.0-imagick php8.0-cli php8.0-dev php8.0-imap php8.0-mbstring php8.0-opcache php8.0-soap php8.0-zip -y
```


## How To Install and Use Composer on Ubuntu 20.04

### Step 1 — Installing PHP and Additional Dependencies
In addition to dependencies that should be already included within your Ubuntu 20.04 system, such as git and curl, Composer requires php-cli in order to execute PHP scripts in the command line, and unzip to extract zipped archives. We’ll install these dependencies now.

First, update the package manager cache by running:
```shell
sudo apt update
```

Next, run the following command to install the required packages:
```shell
sudo apt install php8.0-cli unzip
```

You will be prompted to confirm installation by typing Y and then ENTER.

Once the prerequisites are installed, you can proceed to installing Composer.

### Step 2 — Downloading and Installing Composer
Composer provides an installer script written in PHP. We’ll download it, verify that it’s not corrupted, and then use it to install Composer.

Make sure you’re in your home directory, then retrieve the installer using curl:
```shell
cd ~
curl -sS https://getcomposer.org/installer -o composer-setup.php
```

Next, we’ll verify that the downloaded installer matches the SHA-384 hash for the latest installer found on the Composer Public Keys / Signatures page. To facilitate the verification step, you can use the following command to programmatically obtain the latest hash from the Composer page and store it in a shell variable:
```shell
HASH=`curl -sS https://composer.github.io/installer.sig`
```

If you want to verify the obtained value, you can run:
```shell
echo $HASH
```

Now execute the following PHP code, as provided in the Composer download page, to verify that the installation script is safe to run:
```shell
php -r "if (hash_file('SHA384', 'composer-setup.php') === '$HASH') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
```

If the output says Installer corrupt, you’ll need to download the installation script again and double check that you’re using the correct hash. Then, repeat the verification process. When you have a verified installer, you can continue.

To install composer globally, use the following command which will download and install Composer as a system-wide command named composer, under /usr/local/bin:
```shell
sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer
```

To test your installation, run:
```shell
composer
```


## Installing MySQL
Now that you have a web server up and running, you need to install the database system to be able to store and manage data for your site. MySQL is a popular database management system used within PHP environments.

Again, use apt to acquire and install this software:
```shell 
sudo apt install mysql-server
```

When the installation is finished, it’s recommended that you run a security script that comes pre-installed with MySQL. This script will remove some insecure default settings and lock down access to your database system. Start the interactive script by running:
```shell
sudo mysql_secure_installation
```

When you’re finished, test if you’re able to log in to the MySQL console by typing:
```shell
sudo mysql
```

This will connect to the MySQL server as the administrative database user root, which is inferred by the use of sudo when running this command. You should see output like this:

Output
Welcome to the MySQL monitor.  Commands end with ; or \g.
Your MySQL connection id is 22
Server version: 8.0.19-0ubuntu5 (Ubuntu)

Copyright (c) 2000, 2020, Oracle and/or its affiliates. All rights reserved.

Oracle is a registered trademark of Oracle Corporation and/or its
affiliates. Other names may be trademarks of their respective
owners.

Type 'help;' or '\h' for help. Type '\c' to clear the current input statement.

mysql>
To exit the MySQL console, type:

exit

Notice that you didn’t need to provide a password to connect as the root user, even though you have defined one when running the mysql_secure_installation script. That is because the default authentication method for the administrative MySQL user is unix_socket instead of password. Even though this might look like a security concern at first, it makes the database server more secure because the only users allowed to log in as the root MySQL user are the system users with sudo privileges connecting from the console or through an application running with the same privileges. In practical terms, that means you won’t be able to use the administrative database root user to connect from your PHP application. Setting a password for the root MySQL account works as a safeguard, in case the default authentication method is changed from unix_socket to password.

For increased security, it’s best to have dedicated user accounts with less expansive privileges set up for every database, especially if you plan on having multiple databases hosted on your server.

Note: At the time of this writing, the native MySQL PHP library mysqlnd doesn’t support caching_sha2_authentication, the default authentication method for MySQL 8. For that reason, when creating database users for PHP applications on MySQL 8, you’ll need to make sure they’re configured to use mysql_native_password instead. We’ll demonstrate how to do that in Step 6.

Your MySQL server is now installed and secured. Next, we’ll install PHP, the final component in the LEMP stack.

Step 3 – Installing PHP
You have Nginx installed to serve your content and MySQL installed to store and manage your data. Now you can install PHP to process code and generate dynamic content for the web server.

While Apache embeds the PHP interpreter in each request, Nginx requires an external program to handle PHP processing and act as a bridge between the PHP interpreter itself and the web server. This allows for a better overall performance in most PHP-based websites, but it requires additional configuration. You’ll need to install php-fpm, which stands for “PHP fastCGI process manager”, and tell Nginx to pass PHP requests to this software for processing. Additionally, you’ll need php-mysql, a PHP module that allows PHP to communicate with MySQL-based databases. Core PHP packages will automatically be installed as dependencies.

To install the php-fpm and php-mysql packages, run:

sudo apt install php-fpm php-mysql

When prompted, type Y and ENTER to confirm installation.

You now have your PHP components installed. Next, you’ll configure Nginx to use them.
 


