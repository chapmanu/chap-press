############################################
# Staging Server
############################################

set :stage, :staging
set :stage_domain, "chappress-staging.chapman.edu"
server "cprs-pre-wb01.chapman.edu", user: "wimops", roles: %w(web app db)
set :deploy_to, "/usr/share/nginx/html"


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
