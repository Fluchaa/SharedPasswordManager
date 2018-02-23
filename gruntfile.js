module.exports = function (grunt) {
	var jsResources = [];
	
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		html2js: {
			options: {
				// custom options, see below
				base: 'templates',
				quoteChar: '\'',
				useStrict: true,
				htmlmin: {
					collapseBooleanAttributes: false,
					collapseWhitespace: true,
					removeAttributeQuotes: false,
					removeComments: true,
					removeEmptyAttributes: false,
					removeRedundantAttributes: false,
					removeScriptTypeAttributes: false,
					removeStyleLinkTypeAttributes: false
				}
			},
			main: {
				src: ['templates/views/**/*.html'],
				dest: 'js/templates.js'
			}
		},
		watch: {
			scripts: {
				files: ['gruntfile.js', 'templates/views/*.html'],
				tasks: ['html2js'],
				options: {
					spawn: false,
					interrupt: true,
					reload: true
				}
			}
		},
		copy: {
			js: {
				expand: true,			// Enable dynamic expansion.
				cwd: 'node_modules/',	// Src matches are relative to this path.
				dest: 'js/vendor/',		// Destination path prefix.
				flatten: true,			// Don't keep the subfolders
				src: [
					'angular/angular.js',
					'angular-local-storage/dist/angular-local-storage.min.js',
					'angular-route/angular-route.min.js',
					'ngclipboard/dist/ngclipboard.min.js'
				]
			}
		}
	});

	grunt.loadNpmTasks('grunt-html2js');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-copy');

	grunt.registerTask('default', [
		'html2js',
		'copy',
		'watch:scripts'
	]);
};


