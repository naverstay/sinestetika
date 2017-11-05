module.paths.push('./node_modules');

var gulp = require('gulp'),
    runSequence  = require('run-sequence'),
    sass         = require('gulp-sass'),
    postcss      = require('gulp-postcss'),
    sourcemaps   = require('gulp-sourcemaps'),
    autoprefixer = require('autoprefixer'),
    focus        = require('postcss-focus'),
    flexbugs     = require('postcss-flexbugs-fixes'),
    sorting      = require('postcss-sorting'),
    pseudoel     = require('postcss-pseudoelements'),
    uglifycss    = require('gulp-uglifycss'),
    rename       = require('gulp-rename'),
    concat       = require('gulp-concat'),
    plumber      = require('gulp-plumber');

var paths = {
    vendor: ['./bootstrap.min.css', './slick.css'],
    site: './site/style.sass'
};

var processors = [
  focus(),
  autoprefixer({
    browsers: ['last 10 versions'],
    remove: true, // remove outdated prefixes?
    // cascade: false
  }),
  sorting(),
  pseudoel(),
  flexbugs()
];

gulp.task('default', function (cb) {
  runSequence(['build'], 'watch',
    cb
  )
})

gulp.task('build', function(cb) {
  runSequence(
    'css:vendor',
    'css:site',
    cb
  );
});

gulp.task('css:vendor', function () {
    return gulp.src(paths.vendor)
        .pipe(sourcemaps.init())
        .pipe(plumber())
        .pipe(concat('vendor.css'))
        .pipe(postcss( processors ))
        .pipe(gulp.dest('.'))
        .pipe(uglifycss({ preserveComments: 'license' }))
        .pipe(rename({ extname: '.min.css' }))
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest('.'));
});

gulp.task('css:site', function () {
    return gulp.src(paths.site)
        .pipe(sourcemaps.init())
        .pipe(plumber())
        .pipe(sass({
          outputStyle: 'expanded',
          precision: 5,
          // includePaths : ['./']
        }))
        .pipe(postcss( processors ))
        .pipe(gulp.dest('.'))
        .pipe(uglifycss({ preserveComments: 'license' }))
        .pipe(rename({ extname: '.min.css' }))
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest('.'));
});

gulp.task('watch', function() {
    gulp.watch(paths.vendor, ['css:vendor']);
    gulp.watch('./site/**/*.*', ['css:site']);
});
