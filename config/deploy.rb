###########################################
# Capistrano Deployment
# https://github.com/chapmanu/chap-press
########################################### 
 
# config valid for current version and patch releases of Capistrano
lock "~> 3.10.2"

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
set :linked_dirs, %w{content/uploads content/wonolog vendor}

namespace :deploy do
  include Helpers

  desc "create WordPress files for symlinking"
  task :create_wp_files do
    on roles(:app) do
      execute :touch, "#{shared_path}/wp-config.php"
    end
  end

  after 'check:make_linked_dirs', :create_wp_files

  desc "Restart Nginx & Php-fpm services"
  task :restart_services do
    on roles(:app) do
      execute "sudo systemctl restart nginx.service" 
      execute "sudo systemctl restart php-fpm.service"
    end
  end

  after :finished, :restart_services
  after :finishing, "deploy:cleanup"

  after :finished, 'prompt:complete' do 
    print_success("Deployment to #{fetch(:stage_domain)} complete!")
  end

end
