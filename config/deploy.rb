###########################################
# Capistrano deployment sourced from Chapman Blogs
# https://github.com/chapmanu/blogs
# Capistrano Gem updated to 3.9
########################################### 
 
lock '3.9'

############################################
# Setup project
############################################

set :application, "chappress"
set :repo_url, "git@github.com:chapmanu/chap-press.git"

############################################
# Setup Capistrano
############################################

set :log_level, :debug
set :use_sudo, false
set :pty, true
set :ssh_options, forward_agent: true
set :keep_releases, 5

############################################
# Linked files and directories (symlinks)
############################################

set :linked_files, %w{public/wp-config.php}
set :linked_dirs, %w{content/uploads}

namespace :deploy do
  include Helpers

  desc "create WordPress files for symlinking"
  task :create_wp_files do
    on roles(:app) do
      execute :mkdir, "-p #{shared_path}/public"
      execute :touch, "#{shared_path}/public/wp-config.php"
    end
  end

  after 'check:make_linked_dirs', :create_wp_files
  
  desc "WordPress directory and file permissions"
  task :wp_permissions do
    on roles(:app) do
      execute :chmod, "644 #{release_path}/public/wp-config.php"
    end
  end

  # Task source: https://github.com/chapmanu/blogs/blob/development/lib/capistrano/tasks/wp.cap 
  desc "Generates wp-config.php on staging server"
  task :generate_staging_config do
    on roles(:web) do
      database = YAML::load_file('config/database.yml')[fetch(:stage).to_s]
      # Create config file in staging environment
      db_config = ERB.new(File.read('config/templates/wp-config.php.erb')).result(binding)
      io = StringIO.new(db_config)
      upload! io, File.join(shared_path, "public/wp-config.php")
      print_success("The WordPress config file has been created on #{fetch(:stage_domain)}")
    end
  end

  desc "Install Composer packages"
  task :install_composer_packages do
    on roles(:app) do
      execute "composer install"
    end
  end  

  desc "Restart Nginx & Php-fpm services"
  task :restart_services do
    on roles(:app) do
      execute "sudo systemctl restart nginx.service" 
      execute "sudo systemctl restart php-fpm.service"
    end
  end

  after :finished, :wp_permissions
  after :finished, :generate_staging_config
  after :finished, :install_composer_packages
  after :finished, :restart_services
  after :finishing, "deploy:cleanup"

  after :finished, 'prompt:complete' do 
    print_success("Deployment to #{fetch(:stage_domain)} complete!")
  end

end
