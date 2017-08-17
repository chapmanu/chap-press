###########################################
# Capistrano Defaults
########################################### 

# Load DSL and set up stages
require "capistrano/setup"

# Include default deployment tasks
require "capistrano/deploy"

require "capistrano/scm/git"
install_plugin Capistrano::SCM::Git


###########################################
# Chapman Blogs Custom Config
# https://github.com/chapmanu/blogs
###########################################   

# Custom Helpers
require './lib/helpers.rb'

# Include custom strategy for deploying git submodules
require './lib/capistrano/submodule_strategy'

# Enter Sudo password for restarting nginx/php
require 'sshkit/sudo'

# Load custom tasks from `lib/capistrano/tasks` if you have any defined
Dir.glob('lib/capistrano/tasks/*.cap').each { |r| import r }

