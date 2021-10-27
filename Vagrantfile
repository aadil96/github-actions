Vagrant.configure("2") do |config|
	config.vm.box = "geerlingguy/ubuntu2004"

	config.vm.network "private_network", ip: "192.168.20.20"

	config.vm.network "public_network"
    config.vm.synced_folder "./", "/home/vagrant", type: "nfs"

	config.vm.provider "virtualbox" do |vb|
		vb.name = 'github-actions'
		vb.customize ['modifyvm', :id, '--memory', '2048']
		vb.customize ['modifyvm', :id, '--cpus', '1']
		vb.customize ['modifyvm', :id, '--natdnsproxy1', 'on']
		vb.customize ['modifyvm', :id, '--natdnshostresolver1', 'on']
		vb.customize ['modifyvm', :id, '--ostype', 'Ubuntu_64']
	end

	$script = <<-SCRIPT
		sudo apt-get update
		sudo apt-get install wget curl git nginx php7.4 php7.4-common php7.4-xml -y
	SCRIPT

	config.vm.provision "install dependencies", type: "shell" do |s|
		s.privileged = true
		s.inline = $script
	end

	$composerScript =  <<-SCRIPT
		php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
		php -r "if (hash_file('sha384', 'composer-setup.php') === '906a84df04cea2aa72f40b5f787e49f22d4c2f19492ac310e8cba5b96ac8b64115ac402c8cd292b8a03482574915d1a8') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
		sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer
		php -r "unlink('composer-setup.php');"
	SCRIPT

	config.vm.provision "install composer", type: "shell" do |s|
		s.privileged = true
		s.inline = $composerScript
	end

	$nodeInstallScript =  <<-SCRIPT
		php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
		php -r "if (hash_file('sha384', 'composer-setup.php') === '906a84df04cea2aa72f40b5f787e49f22d4c2f19492ac310e8cba5b96ac8b64115ac402c8cd292b8a03482574915d1a8') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
		sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer
		php -r "unlink('composer-setup.php');"
	SCRIPT

  end
