# Vagrant Ansible Wordpress

![Vagrant-Ansible-Wordpress](http://i.imgur.com/qMKdgE4.png)

## Prerequisites

You'll need to have the following prerequisites **installed** on your workstation:

* [VirtualBox](https://www.virtualbox.org/)
* [Vagrant](http://www.vagrantup.com/)
* [Ansible](http://www.ansibleworks.com)
* Add an appropriate vagrant box (optional)
```bash
vagrant box add bento/ubuntu-16.04
```

## Quick Start


```bash
  $ git clone git@github.com:Mayccoll/Vagrant-Ansible-Wordpress.git
  $ cd Vagrant-Ansible-Wordpress
  $ vagrant up
```

**DONE!!!**

Once the process is finished you will see the installation data in your terminal

![Terminal](http://i.imgur.com/CFPQ59Y.png)

#### Install wordpress

In your browser go to http://192.168.70.70 and follow the installation process.

![Wordpress](http://i.imgur.com/EiatoRN.png)


#### Access wordpress files:

Inside your repository in ```./www/wordpress/``` folder you will find all the wordpress files

```
.
├── ansible
├── config.yaml
├── README
├── share
├── Vagrantfile
└── www
    └── wordpress
        ├── index.php
        ├── license.txt
        ├── readme.html
        ├── wp-activate.php
        ├── wp-admin
        ├── wp-blog-header.php
        ├── wp-comments-post.php
        ├── wp-config-sample.php
        ├── wp-content
        ├── wp-cron.php
        ├── wp-includes
        ├── wp-links-opml.php
        ├── wp-load.php
        ├── wp-login.php
        ├── wp-mail.php
        ├── wp-settings.php
        ├── wp-signup.php
        ├── wp-trackback.php
        └── xmlrpc.php

```
## Advanced

## Configuration

There are one configuration file ```CONFIG.yml```.

```bash
.
└── CONFIG.yml

```

#### Config VirtualBox VM

  > **./CONFIG.yaml**

```yaml
- name               : vag-wordpress
  box                : bento/ubuntu-16.04
  box_check_update   : false
  ram                : 1028
  cpus               : 1
```

#### Defining a Forwarded Port

  > **./CONFIG.yaml**

```yaml
ports           :
  - guest       : 3000
    host        : 3000

  - guest       : 80
    host        : 8080
```

#### Config Synced folders

  > **./CONFIG.yaml**

```yaml
  syncDir         :
    - host        : share
      guest       : /home/vagrant/share

    - host        : www
      guest       : /home/vagrant/www
      owner       : vagrant
      group       : vagrant
      dmode       : 775
      fmode       : 775
```


## Ansible


#### Ansible Playbook

This playbook will install all the dependencies for wordpress.

It can be found in:

  > **./ansible/playbook.yaml**

#### Config Ansible Vars

You can config wordpress database, user and password in ```CONFIG.yml```
  > **./CONFIG.yml**


```yaml
---
  # | ······ Set Domain URL
  wpDomain          : 'mywordpress.local'

  # | ······ MySQL Config
  mysqlUser         : 'root'
  mysqlPass         : 'vagrant'
  mysqlTemplatePath : 'templates/my.cnf'

  # | ······ MySQL Database
  dbName            : 'wordpress'
  dbUser            : 'wordpress'
  dbPass            : 'vagrant'

  # | ······ Wordpress Config
  wordpressPath     : '/home/vagrant/www'
  wordpressTemPath  : 'templates/wp-config.php'
  vhostTemplatePath : 'templates/vhost.conf'

  # | ······ Vagrant User and Group
  home              : '/home/vagrant'
  owner             : 'vagrant'
  group             : 'vagrant'

```
