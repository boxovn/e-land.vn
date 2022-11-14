module.exports = function (grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        watch: {
            build: {
                files: ['src/js/*.js', 'src/js/libs/*.js', 'src/scss/*.scss'],
                tasks: ['build'],
                options: {
                    spawn: false
                }
            }
        },
        compass: {
            build: {
                options: {
                    sassDir: 'src/scss',
                    cssDir: 'src/css',
                    force: true,
                    outputStyle: 'compact'
                }
            }
        },
        cssmin: {
            options: {
                sourceMap: true
            },
            target: {
                files: [{
                        expand: true,
                        cwd: 'src/css',
                        src: ['*.css', '!*.min.css'],
                        dest: 'dist',
                        ext: '.min.css'
                    },
                ]
            }
        },
        uglify: {
            options: {
                preserveComments: false,
                quoteStyle: 3,
                screwIE8: true
            },
            build: {
                files: {
                    'dist/callToScroll.min.js': ['src/js/libs/*.js', 'src/js/*.js']
                }
            }
        }
    });
    

    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-compass');

    grunt.registerTask('build', ['compass', 'uglify', 'cssmin']);
};
