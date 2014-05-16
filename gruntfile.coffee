module.exports = (grunt) -> 
	grunt.initConfig(
		'sftp-deploy':
			build:
				auth:
					host: '50.116.51.79'
					port: 22
					authKey: 'key1'
				src: 'theme'
				dest: 'wp-content/themes/squibbs-pd'
				exclusions: [
					'theme/**/.DS_Store',
					'theme/.DS_Store',
					'theme/languages',
					'theme/images',
					'theme/*.php',
					'theme/*.png',
					'theme/xml',
					'theme/lib',
					'theme/js'
				]

		sass:                              # Task
			dist:                            # Target
				options:                       # Target options
					style: 'expanded'
				files:                         # Dictionary of files
					'theme/style.css': 'custom.scss',       # 'destination': 'source'


		watch:
			deploy:
				files: 'theme/*'
				tasks: ['sftp-deploy']
			styles:
				files: 'custom.scss'
				tasks: ['sass']
	)

	grunt.loadNpmTasks('grunt-contrib-sass')
	grunt.loadNpmTasks('grunt-contrib-watch')
	grunt.loadNpmTasks('grunt-sftp-deploy')
	grunt.registerTask('default', ['watch'])
	grunt.registerTask('deploy', ['sass','sftp-deploy'])
