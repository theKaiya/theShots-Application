let gulp = require('gulp'),
    less = require('gulp-less'),
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify');

gulp.task('scripts', function () {
    gulp.src([
        'public/assets/js/sweetAlert.min.js',
        'public/assets/js/pace.min.js',
        'public/assets/js/app.min.js',
        'public/assets/js/custom.js',
        'public/assets/js/moment.js',
        'public/assets/js/helpers.js',
        'public/assets/js/url.min.js',
        'public/assets/js/angular.min.js',
        'public/assets/js/angular-cookies.js',
        'public/assets/js/app.js',
    ])
        .pipe(concat('app.js'))
        .pipe(gulp.dest('public/production/'));
});