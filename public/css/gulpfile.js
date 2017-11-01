module.paths.push('./node_modules');

var gulp = require('gulp')
    //watch = require('gulp-watch')
;

var patchs = {
    css: ['./bootstrap.min.css', './site/fonts/BrutalType.css', './slick.css']//, './site/style.css']
};

gulp.task('css', function () {
    var postcss      = require('gulp-postcss'),
        sourcemaps   = require('gulp-sourcemaps'),
        autoprefixer = require('autoprefixer'),
        uglifycss    = require('gulp-uglifycss'),
        rename       = require('gulp-rename'),
        concat       = require('gulp-concat'),
        plumber      = require('gulp-plumber');

    return gulp.src(patchs.css)
        .pipe(sourcemaps.init())
        .pipe(plumber())
        .pipe(concat('site.css'))
        .pipe(postcss([ autoprefixer() ]))
        .pipe(gulp.dest('.'))
        .pipe(uglifycss({ preserveComments: 'license' }))
        .pipe(rename({ extname: '.min.css' }))
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest('.'));
});

gulp.task('watch', function() {
    gulp.watch(patchs.css, ['css']);
});