# config valid only for Capistrano 3.1
lock '3.9'

############################################
# Setup project
############################################

set :application, "chappress"
set :repo_url, "git@github.com:chapmanu/chap-press.git"

set :git_strategy, SubmoduleStrategy

############################################
# Setup WordPress
############################################

set :local_domain, 'localhost:80'

############################################
# Setup Capistrano
############################################

set :log_level, :debug
set :use_sudo, false
set :pty, true

set :ssh_options, {
  forward_agent: true
}

set :keep_releases, 5

############################################
# Linked files and directories (symlinks)
############################################

set :linked_files, %w{wp-config.php}
set :linked_dirs, %w{content/uploads}

namespace :deploy do

  after 'starting', 'check_changes'

  desc "create WordPress files for symlinking"
  task :create_wp_files do
    on roles(:app) do
      execute :touch, "#{shared_path}/wp-config.php"
    end
  end

  after 'check:make_linked_dirs', :create_wp_files

  desc "WordPress directory and file permissions"
  task :wp_permissions do
    on roles(:app) do
      execute :chmod, "644 #{release_path}/public/wp-config.php"
    end
  end

  desc "Restart services"
  task :restart_services do
    on roles(:app) do
      sudo :service, :nginx, :restart
      sudo :service, :'php-fpm' , :restart
    end
  end

  desc "Wp Core Install"
  task :core_install do
    on roles(:app) do
      execute "cd '#{release_path}/public'; wp core install --url=http://localhost:80 --title=chap-press --admin_user=chappress --admin_password=password --admin_email=chappress@gmail.com"
    end
  end    

  after :finished, :wp_permissions
  after :finished, :restart_services
  after :finished, :core_install
  after :finishing, "deploy:cleanup"

  after :finished, 'prompt:complete' do 
    print_success("Deployment to #{fetch(:stage_domain)} complete!")
  end

end
