var path = '/var/www/wordpress/wp-content/themes/modabiz';module.exports = function( grunt ) {   grunt.initConfig({  	pkg: grunt.file.readJSON('package.json'),  	uglify: {  		options: {   			// the banner is inserted at the top of the output    		banner: '/*! <%= pkg.name %> <%= grunt.template.today("dd-mm-yyyy") %> */\n'  		},  		  		dist: {    		files: {      			'scripts.js': [              'bower_components/foundation/js/foundation/foundation.js',              'bower_components/foundation/js/foundation/foundation.dropdown.js',              'bower_components/angular-foundation/mm-foundation-tpls.js',              'js/components/gmap.js',              'js/app.js'            ],    		}  		}	  },    sprite:{      'all': {        src: 'sprites/*.png',        destImg: 'images/spritesheet.png',        destCSS: 'sprites.css',        algorithm: 'binary-tree'      }    },  cssmin: {    add_banner: {            options: {        banner: '/*\nTheme Name: <%= pkg.title %>\nTheme URI: <%= pkg.homepage %>\nDescription: <%= pkg.description %>\nVersion: <%= pkg.version %>\nAuthor: <%= pkg.author %>\nTags: <%= pkg.tags %>\nText Domain: <%= pkg.name %>\n*/'      },          files: {        'style.css': [          'stylesheets/*.css'        ]      }    }  },  imagemin: {            dist: {                options: {                    optimizationLevel: 7,                    progressive: false                },                files: [{                    //expand: true,                    cwd: 'images/',                    src: 'images/*',                    dest: 'images/'                }]            }  },  'ftp-deploy': {      build: {        auth: {        host: 'foccus.cc',        port: 21,        authKey: 'key1'      },        src: path,        dest: '/wp-content/themes/radarsertanejo',        exclusions: [          path+'/node_modules/*',          path+'/node_modules',          path+'/bower_components/*',          path+'/bower_components',          path+'/sprites/*',          path+'/sprites',          path+'/scss/*',          path+'/scss',          path+'/js',          path+'/js/*',          path+'/stylesheets/*',          path+'/stylesheets',          path+'/media/*',          path+'/media',          path+'/.sass-cache/*',          path+'/.sass-cache',          path+'/Gruntfile.js',          path+'/bower.json',          path+'/README.md',          path+'/.gitignore',          path+'/.ftppass',          path+'/.bowerrc',          path+'/.DS_Store',          path+'/package.json',          path+'/.git/*',          path+'/.git',          path+'/config.rb',          path+'/fonts/*',          path+'/images/*',          path+'/img',          path+'/functions',          //path+'/includes',          path+'/temp',          path+'/admin',          //path+'/page-templates',          path+'/screenshot.png',          path+'/sprites.css',          path+'/robots.txt',          path+'/favicon.ico',          path+'/humans.txt',          path+'/Gemfile',          path+'/Gemfile.lock',          path+'/fonts/.DS_Store',          path+'/*.php-tmp'        ]      }},    	watch : {          dist : {            files : [              'js/*','js/components/*.js','stylesheets/*','images/*','*.php','*.html','sprites/*'            ],                 tasks : [ 'uglify','sprite','cssmin','imagemin' ],            options: {              livereload: true            }          },        }  });    grunt.loadNpmTasks('csswring');  grunt.loadNpmTasks('grunt-ftp-deploy');  //grunt.loadNpmTasks('grunt-contrib-jshint');  //grunt.loadNpmTasks('jshint-stylish');  grunt.loadNpmTasks('grunt-contrib-uglify');  grunt.loadNpmTasks('grunt-contrib-cssmin');  grunt.loadNpmTasks('grunt-spritesmith');  grunt.loadNpmTasks('grunt-contrib-watch');  //grunt.loadNpmTasks("grunt-rsync");  grunt.loadNpmTasks('grunt-contrib-imagemin');  //grunt.loadNpmTasks('grunt-contrib-connect');  //grunt.loadNpmTasks('grunt-uncss');  grunt.registerTask( 'default', ['watch'] );  grunt.registerTask( 'w', [ 'watch' ] );};