# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure( 2 ) do |config|
    config.vm.box = "bento/ubuntu-16.04"
    config.vm.hostname = 'vm-www.furious-foodie.com'

    config.vm.network :private_network, ip: "192.168.11.94"
    config.vm.network "forwarded_port", guest: 80, host: 8484, auto_correct: true
    config.vm.network "forwarded_port", guest: 443, host: 446, auto_correct: true
    config.vm.synced_folder "./" , "/vagrant", :mount_options => ["dmode=777","fmode=666"]

    config.vm.provider :virtualbox do |v|
        v.customize ["modifyvm", :id, "--natdnshostresolver1", "on"]
        v.customize ["modifyvm", :id, "--memory", 1024]
        v.customize ["modifyvm", :id, "--name", "furious-foodie"]
    end

    config.vm.provision "shell" do |s|
        s.inline = "test -e /usr/bin/python || (apt -y update && apt install -y python-minimal)"
    end

    config.vm.provision "ansible" do |ansible|
        ansible.playbook = "ansible/vagrant.yml"
        ansible.sudo = true
    end
end
