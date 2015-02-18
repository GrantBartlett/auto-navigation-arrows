'use strict';
module.exports = function (grunt) {
    // Load all tasks
    require('load-grunt-tasks')(grunt);
    // Show elapsed time
    require('time-grunt')(grunt);

    var jsFileList = [
        'assets/js/admin.js',
        'assets/js/widget.js'
    ];

    grunt.initConfig({
        jshint: {
            options: {
                jshintrc: '.jshintrc'
            },
            all: [
                'Gruntfile.js',
                'assets/js/*.js',
                '!assets/js/*.js',
                '!assets/**/*.min.*'
            ]
        },
        less: {
            dev: {
                files: {
                    'assets/css/admin.css': [
                        'assets/less/admin.less'
                    ],
                    'assets/css/widget.css': [
                        'assets/less/widget.less'
                    ]
                },
                options: {
                    compress: false
                    // LESS source map
                    // To enable, set sourceMap to true and update sourceMapRootpath based on your install
                    //sourceMap: true,
                    //sourceMapFilename: 'assets/css/*.map',
                    //sourceMapRootpath: '/'
                }
            },
            build: {
                files: {
                    'assets/css/admin.min.css': [
                        'assets/less/admin.less'
                    ],
                    'assets/css/widget.min.css': [
                        'assets/less/widget.less'
                    ]
                },
                options: {
                    compress: true
                }
            }
        },
        concat: {
            basic_and_extras: {
                files: {
                    'assets/js/admin.js': ['assets/js/admin.min.js']
                }
            }
        },
        uglify: {
            dist: {
                //files: {
                //    'assets/js/scripts.min.js': [jsFileList]
                //}

                files: {
                    'assets/js/admin.min.js': [
                        'assets/js/admin.js'
                    ]
                }
            }
        },
        autoprefixer: {
            options: {
                browsers: ['last 2 versions', 'ie 8', 'ie 9', 'android 2.3', 'android 4', 'opera 12']
            },
            dev: {
                options: {
                    map: {
                        prev: 'assets/css/'
                    }
                },
                src: ['assets/css/admin.css', 'assets/css/widget.css']
            },
            build: {
                src: ['assets/css/admin.min.css', 'assets/css/widget.min.css']
            }
        },
        version: {
            default: {
                options: {
                    format: true,
                    length: 32,
                    manifest: 'assets/manifest.json',
                    querystring: {
                        style: 'roots_css',
                        script: 'roots_js'
                    }
                },
                files: {
                    'lib/scripts.php': 'assets/{css,js}/{main,scripts}.min.{css,js}'
                }
            }
        },
        watch: {
            less: {
                files: [
                    'assets/less/*.less',
                    'assets/less/**/*.less'
                ],
                tasks: ['less:dev', 'autoprefixer:dev']
            },
            js: {
                files: [
                    jsFileList,
                    '<%= jshint.all %>'
                ],
                tasks: ['jshint', 'concat']
                //tasks: ['jshint']
            },
            livereload: {
                // Browser live reloading
                // https://github.com/gruntjs/grunt-contrib-watch#live-reloading
                options: {
                    livereload: false
                },
                files: [
                    'assets/css/main.css',
                    'assets/js/widget.js',
                    'views/*.php',
                    '*.php'
                ]
            }
        }
    });

    // Register tasks
    grunt.registerTask('default', [
        'dev'
    ]);
    grunt.registerTask('dev', [
        'jshint',
        'less:dev',
        'autoprefixer:dev',
        'concat'
    ]);
    grunt.registerTask('build', [
        'jshint',
        'less:build',
        'autoprefixer:build',
        'uglify',
        'version'
    ]);
};
