############################################
# Local VM Server
############################################

set :stage, :vm
set :stage_domain, "localhost:8443"
server "127.0.0.1", user: "deploy", roles: %w{web app db}, port:2222
set :deploy_to, "/var/www/html"


############################################
# Setup Git
############################################

# The git branch for staging
def current_git_branch
  branch = `git symbolic-ref HEAD 2> /dev/null`.strip.gsub(/^refs\/heads\//, '')
  puts "Deploying branch #{branch}"
  branch
end

# Set the deploy branch to the current branch
set :branch, current_git_branch