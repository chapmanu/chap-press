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

set :linked_files, %w{wp-config.php}
set :linked_dirs, %w{content/uploads}

namespace :deploy do
  include Helpers

  desc "create WordPress files for symlinking"
  task :create_wp_files do
    on roles(:app) do
      execute :touch, "#{shared_path}/wp-config.php"
    end
  end

  after 'check:make_linked_dirs', :create_wp_files
  
  #TODO FIX: remove cp config line, use shared folder to symlink to config file or better solution
  desc "WordPress directory and file permissions"
  task :wp_permissions do
    on roles(:app) do
      execute "cp -v #{release_path}/public/wp-config.php{-dist,}"
      execute :chmod, "644 #{release_path}/public/wp-config.php"
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
  after :finished, :restart_services
  after :finishing, "deploy:cleanup"

  after :finished, 'prompt:complete' do 
    print_success("Deployment to #{fetch(:stage_domain)} complete!")
  end

end
