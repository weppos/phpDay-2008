require 'rubygems'
require 'rake'

namespace :phps do

  desc "Create syntax highlighted source for each .php file"
  task :create do
    Dir.glob('**/*.php').each do |file|
      highlighted_source = %x(php -s #{file})
      highlighted_file   = "#{file}.html"
      File.open(highlighted_file, 'w+') { |f| f.write(highlighted_source) }
      puts "Created #{highlighted_file} from #{file}"
    end
  end

  desc "Clean syntax highlighted source files"
  task :clean do
    Dir.glob('**/*.php.html').each do |file|
      File.delete(file)
      puts "Removed #{file}"
    end
  end

end

desc "Create a package for distribution"
task :package => ['phps:create'] do
  source = '.'
  target = 'pkg/phpday2008.tgz'
  FileUtils.mkpath('pkg')
  %x(tar -czvf #{target} #{source} --exclude "*.private" --exclude pkg --exclude ".git")
  puts "Created #{target}"
end