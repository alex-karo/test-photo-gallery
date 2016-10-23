# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure(2) do |config|

  config.vm.provider "virtualbox" do |vb|
  	vb.customize ["setextradata", :id, "VBoxInternal2/SharedFoldersEnableSymlinksCreate/var/www/", "1"]
  	vb.customize ["setextradata", :id, "VBoxInternal2/SharedFoldersEnableSymlinksCreate/var/www/*", "1"]
  	vb.customize ["setextradata", :id, "VBoxInternal2/SharedFoldersEnableSymlinksCreate/v-root", "1"]
  	vb.customize ["setextradata", :id, "VBoxInternal2/SharedFoldersEnableSymlinksCreate/usr", "1"]
  	vb.customize ["setextradata", :id, "VBoxInternal2/SharedFoldersEnableSymlinksCreate/.", "1"]
  end
  config.vm.box = "herroffizier/php7"
  config.vm.network "private_network", ip: "192.168.33.125"
  config.vm.hostname = "photos.dev"
  config.vm.synced_folder ".", "/var/www/app", :mount_options => ["dmode=777","fmode=666"]
  config.vm.synced_folder "./nginx_conf", "/etc/nginx/conf.d", :mount_options => ["dmode=777","fmode=666"]
  config.vm.provision "shell", path: "vm.provision.sh"
end
