# Vagrant Ansible Wordpress


## Prerequisites

You'll need to have the following prerequisites **installed** on your workstation:

* [VirtualBox](https://www.virtualbox.org/)
* [Vagrant](http://www.vagrantup.com/)
* [Ansible](http://www.ansibleworks.com)
* Add an approriate vagrant box
```bash
vagrant box add trusty64 https://atlas.hashicorp.com/ubuntu/boxes/trusty64/versions/20150817.0.0/providers/virtualbox.box
```

## Quick Start


```bash
  $ git clone git@github.com:Mayccoll/Vagrant-Ansible-Wordpress.git
  $ cd Vagrant-Ansible-Wordpress
  $ vagrant up
```
Once the process is finished you will see the installation data in your terminal

![Terminal](http://i.imgur.com/8fUgfqV.png)

#### Install wordpress

In your browser go to http://192.168.55.55

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

## Configuration

There are two configuration files ```config.yaml``` and ```playbook.yaml```

```bash
.
├── ansible
│   └── playbook.yaml
└── config.yaml

```

#### Config VirtualBox VM

  > **./config.yaml**

```yaml
- name:                 vag-wordpress
  box:                  trusty64
  box_check_update:     false
  ram:                  2048
  ip:                   192.168.55.55
  cpus:                 2
```

#### Defining a Forwarded Port

  > **./config.yaml**

```yaml
ports           :
  - guest       : 3000
    host        : 3000

  - guest       : 80
    host        : 8080
```

#### Config Synced folders

  > **./config.yaml**

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

#### Ansible

  > **./ansible/playbook.yaml**

#### Config Wordpress and Mysql

  > **./ansible/playbook.yaml**


```yaml
---
- hosts      : vagrant
  remote_user: vagrant
  sudo       : yes
  vars:
    mysqlUser        : root            # <---
    mysqlPass        : vagrant         # <---
    dbName           : wordpress       # <---
    dbUser           : wordpress       # <---
    dbPass           : vagrant         # <---
    wordpressPath    : /home/vagrant/www
    vhostTemplatePath: templates/vhost.conf
    mysqlTemplatePath: templates/mysql
```
