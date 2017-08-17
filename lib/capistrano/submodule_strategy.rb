module SubmoduleStrategy
  
  # check for a .git directory
  def test
    test! " [ -d #{repo_path}/.git ] "
  end
 
  # same as in Capistrano::Git::DefaultStrategy
  def check
    test! :git, :'ls-remote', repo_url
  end
 
  def clone
    git :clone, '-b', fetch(:branch), '--recursive', repo_url, repo_path
  end
 
  # same as in Capistrano::Git::DefaultStrategy
  def update
    git :remote, :update
  end
 
  # put the working tree in a release-branch,
  # make sure the submodules are up-to-date
  # and copy everything to the release path
  def release
    release_branch = fetch(:release_branch, File.basename(release_path))

    # Create a branch and check it out
    git :branch, '-f', release_branch, fetch(:remote_branch, "origin/#{fetch(:branch)}")
    git :checkout, release_branch

    # Update submodules
    # git :submodule, :update, '--init'

    # Copy WordPress files to release path
    context.execute "rsync -ar --filter=':- .wpignore' --exclude=.git\* #{repo_path}/ #{release_path}"

    # Delete the old branches
    git :branch, "| grep -v #{release_branch} | xargs git branch -D"

  end
end