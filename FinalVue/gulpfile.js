let gulp = require('gulp');
let webpack = require('webpack-stream');
let watch = require('gulp-watch');
let batch = require('gulp-batch');
let connect = require('gulp-connect');
let copy = require('gulp-copy');

// Run webpack
gulp.task('webpack', function(){
    return gulp.src('src/main.js')
        .pipe(webpack( require('./webpack.config.js') ))
        .pipe(gulp.dest('dist/js/'))
        .pipe(connect.reload());
});

// Run the webserver
gulp.task('webserver', function() {
    connect.server({
        livereload: true,
        root: 'dist'
    });
});

// Copy index.html file
gulp.task('build.index', function(){
    return gulp.src('./src/index.html')
        .pipe(gulp.dest('./dist'));
});

// Default task
gulp.task('default', ['webpack', 'build.index']);