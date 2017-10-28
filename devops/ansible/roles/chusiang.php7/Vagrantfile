# -*- mode: ruby -*-
Vagrant.configure("2") do |config|

  # Ubuntu 14.04
  config.vm.define "ubuntu1404", primary: true do |node|
    node.vm.box = "ubuntu/trusty64"
    node.vm.hostname = "ubuntu1404.php7.local"
    node.vm.provision "ansible" do |ansible|
      ansible.playbook = "setup.yml"
      ansible.sudo = true
    end
  end

  # Debian 7
  #config.vm.define "debian7" do |node|
  #  node.vm.box = "debian/wheezy64"
  #  node.vm.hostname = "php7-debian7.local"
  #    node.vm.provision "ansible" do |ansible|
  #      ansible.playbook = "setup.yml"
  #      ansible.sudo = true
  #  end
  #end

  # Debian 8
  config.vm.define "debian8" do |node|
    node.vm.box = "debian/jessie64"
    node.vm.hostname = "debian8.php7.local"
    node.vm.provision "ansible" do |ansible|
      ansible.playbook = "setup.yml"
      ansible.sudo = true
    end
  end

  # Debian 9
  config.vm.define "debian9" do |node|
    node.vm.box = "debian/stretch64"
    node.vm.hostname = "debian9.php7.local"
    node.vm.provision "ansible" do |ansible|
      ansible.playbook = "setup.yml"
      ansible.sudo = true
    end
  end

  # CentOS 6.7
  config.vm.define "centos6" do |node|
    node.vm.box = "bento/centos-6.7"
    node.vm.hostname = "centos6.php7.local"
    node.vm.provision "ansible" do |ansible|
      ansible.playbook = "setup.yml"
      ansible.sudo = true
    end
  end
  
  # CentOS 7.2
  config.vm.define "centos7" do |node|
    node.vm.box = "bento/centos-7.2"
    node.vm.hostname = "centos7.php7.local"
    node.vm.provision "ansible" do |ansible|
      ansible.playbook = "setup.yml"
      ansible.sudo = true
    end
  end
  
end

# vi: set ft=ruby :
