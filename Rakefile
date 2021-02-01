task default: %w[status]

desc "Run containers and setup the project"
task :setup do
    Rake::Task["up"].invoke
    Rake::Task["composer"].invoke
    Rake::Task["migrate"].invoke
end

desc "install project dependencies with composer"
task :composer do
    Rake::Task[:exec].invoke("composer install")
end

desc "Run database migrations"
task :migrate do
    Rake::Task[:artisan].invoke("migrate")
end

desc "Show current running containers"
task :status do
    Rake::Task[:dc].invoke("ps")
end

desc "Run containers"
task :up do
    Rake::Task[:dc].invoke("up -d")
end

desc "Removes all containers"
task :destroy do
    Rake::Task[:dc].invoke("down")
end

desc "Open shell in web container"
task :shell do
    Rake::Task[:exec].invoke("bash", "application", "1")
end

desc "Open shell in web container as root user"
task :rshell do
    Rake::Task[:exec].invoke("bash", "root", "1")
end

desc "show logs"
task :logs, [:service] do |task, args|
    service = args[:service].nil? ? '' : args[:service]
    Rake::Task[:dc].invoke("logs -f #{service}")
end

desc "stop containers"
task :stop do
    Rake::Task[:dc].invoke("stop")
end

desc "pull"
task :pull do
    sh "git pull"
end

desc "update"
task :update do
    Rake::Task["pull"].invoke
    Rake::Task["composer"].invoke
    Rake::Task["migrate"].invoke
end

desc "clear cache"
task :cc do
    Rake::Task[:artisan].invoke("cache:clear")
end

desc "Run console command"
task :artisan, [:cmd] do |task,args|
    Rake::Task[:exec].invoke("php artisan #{args[:cmd]}")
end

desc "Exec command in web container"
task :exec, [:cmd, :user, :interactive] do |task,args|
    user = args[:user].nil? ? "application" : args[:user]
    disable_tty = args[:interactive].nil? ? '-T' : ''
    if args[:cmd].nil?
        puts "cmd argument is required"
    else
        Rake::Task[:dc].invoke("exec #{disable_tty} -w /app --user #{user} web #{args[:cmd]}")
    end
end

desc "Run docker-compose command"
task :dc, [:cmd] do |task,args|
    sh "docker-compose #{args[:cmd]}"
end
