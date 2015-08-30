# -*- mode: ruby -*-
# vi: set ft=ruby :

# |
# | Require YAML module
# |
require 'yaml'

# |
# | Get dir path
# |
dir = File.dirname(File.expand_path(__FILE__))

# |
# | Read YAML files
# |
servers       = YAML.load_file("#{dir}/config.vagrant.yml")

playbook_file = YAML.load_file("#{dir}/config.ansible.yml")

# |
# | Set values for message
# |
$mysql_user   = playbook_file['mysqlUser']
$mysql_pass   = playbook_file['mysqlPass']
$db_name      = playbook_file['dbName']
$db_user      = playbook_file['dbUser']
$db_pass      = playbook_file['dbPass']
$wpDomain     = playbook_file['wpDomain']

# |
# | Vagrantfile API/syntax version. Don't touch unless you know what you're doing!
# |
VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
    servers.each do |server|
        config.vm.define server["name"] do |srv|

          srv.vm.box = server["box"]

          if server["box_check_update"]
              srv.vm.box_check_update = server["box_check_update"]
          end

          #|
          #| :::::: Networdk
          #|

          if server["network"]["ip_private"]
            srv.vm.network "private_network", ip: server["network"]["ip_private"]
          end

          if server["network"]["ip_public"] && server["network"]["bridge"]
            srv.vm.network "public_network", ip: server["network"]["ip_public"], :bridge => server["network"]["bridge"]
          end

          #|
          #| :::::: Ports forwarded
          #|
          if server["ports"]
              server['ports'].each do |ports|
                  srv.vm.network "forwarded_port",
                      guest: ports["guest"],
                      host: ports["host"],
                      auto_correct: true
              end
          end

          #|
          #| :::::: Folder Sync
          #|
          if server["syncDir"]
              server['syncDir'].each do |syncDir|

                  if syncDir["owner"] && syncDir["group"]
                      srv.vm.synced_folder syncDir["host"],
                      syncDir["guest"],
                      owner: "#{syncDir["owner"]}",
                      group: "#{syncDir["group"]}",
                      mount_options:["dmode=#{syncDir["dmode"]}",
                      "fmode=#{syncDir["fmode"]}"],
                      create: true
                  else
                      srv.vm.synced_folder syncDir['host'],
                        syncDir['guest'],
                        create: true
                  end
              end
          end

          #|
          #| :::::: Vm Setup
          #|
          srv.vm.provider :virtualbox do |vb|
              vb.name     = server["name"]
              vb.memory   = server["ram"]
              if server["gui"]
                  vb.gui      = server["gui"]
              end
              if server["cpus"]
                  vb.cpus     = server["cpus"]
              end
              vb.customize ["modifyvm", :id, "--usb", "off"]
              vb.customize ["modifyvm", :id, "--usbehci", "off"]
          end

          #|
          #| :::::: Bash provision
          #|
          if server["bash"]
              srv.vm.provision :shell, :path => server["bash"]
          end

          #|
          #| :::::: Puppet Config
          #|
          if server["puppet"]
              srv.vm.provision :puppet do |puppet|
                 puppet.module_path    = "puppet/modules"
                 puppet.manifests_path = "puppet/manifests"
                 puppet.manifest_file  = server["puppet"]
              end
          end

          #|
          #| :::::: Asible Config
          #|
          if server["ansible"]
              srv.vm.provision:ansible do |ansible|
                  if server["ansible"]["verbose"]
                      ansible.verbose = server["ansible"]["verbose"]
                  end
                  if server["ansible"]["playbook"]
                      ansible.playbook = server["ansible"]["playbook"]
                  end
                  if server["ansible"]["inventory_path"]
                      ansible.inventory_path = server["ansible"]["inventory_path"]
                  end
                  if server["ansible"]["host_key_checking"]
                      ansible.host_key_checking = server["ansible"]["host_key_checking"]
                  end
                  if server["ansible"]["limit"]
                      ansible.limit = server["ansible"]["limit"]
                  end
              end
              File.open('ansible/inventory' ,'w') do |f|
                  f.write "[vagrant]\n"
                  f.write "#{server["network"]["ip_private"]}\n"
              end
          end

            #|
            #| :::::: Vagrant Message
            #|
            srv.vm.post_up_message = " \e[0;37m
················································································
    WORDPRESS > Install
················································································

  Url            : \e[0;33mhttp://#{server['network']['ip_private']}\e[0;37m
  Url (optional) : \e[0;33mhttp://#{$wpDomain}\e[0;37m

  Database Name  : \e[0;33m#{$db_name}\e[0;37m
  Database User  : \e[0;33m#{$db_user}\e[0;37m
  Database Pass  : \e[0;33m#{$db_pass}\e[0;37m

  Mysql User     : #{$mysql_user}
  Mysql Pass     : #{$mysql_pass}

················································································
  Edit Hosts Files (optional)
················································································

  In your terminal copy and run this command:
  \e[0;33mecho \"\\n#{server['network']['ip_private']}     #{$wpDomain}\" | sudo tee -a /etc/hosts\e[0;37m

················································································
  VAGRANT VM
················································································

  Vm Name    : #{server['name']}
  Private ip : \e[0;33m#{server["network"]["ip_private"]}\e[0;37m

················································································
\e[32m"

        end
    end
end
