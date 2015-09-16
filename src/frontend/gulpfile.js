(function(require) {
  "use strict";

  var gulp = require('gulp');
  var concat = require('gulp-concat');
  var templateCache = require('gulp-angular-templatecache');
  var uglify = require('gulp-uglify');

  var MINIFY = true;
  var ASSETS_DIRECTORY = '../www/public/assets';
  var TMP_DIRECTORY = './tmp';

  var tasks = [
    'angular-modules',
    'angular-templates',
    'concat-js'
  ];

  var tasksProduction = tasks.slice(0);
      tasksProduction.unshift('mode-production');

  var tasksDevelopment = tasks.slice(0);
      tasksDevelopment.unshift('mode-development');

  gulp.task('default', tasksProduction);
  gulp.task('development', tasksDevelopment);

  gulp.task('mode-production', function() {
    MINIFY = true;
  });

  gulp.task('mode-development', function() {
    MINIFY = false;
  });

  gulp.task('angular-modules', function() {
    var src = MINIFY
      ? [
      'bower_components/angular/angular.min.js',
      'bower_components/angular-ui-router/release/amgilar-ui-router.min.js',
      'angular/modules/**/*.js'
    ] : [
      'bower_components/angular/angular.js',
      'bower_components/angular-ui-router/release/amgilar-ui-router.js',
      'angular/modules/**/*.js'
    ];

    return gulp.src(src)
      .pipe(concat('angular-modules.js'))
      .pipe(gulp.dest(TMP_DIRECTORY))
    ;
  });

  gulp.task('angular-templates', function() {
    return gulp.src('angular/**/template.html')
      .pipe(templateCache())
      .pipe(concat('angular-template.js'))
      .pipe(gulp.dest(TMP_DIRECTORY))
    ;
  });

  gulp.task('concat-js', function() {
    var task = gulp.src(TMP_DIRECTORY + '/**/*.js')
      .pipe(concat('app.js'))
    ;

    if(MINIFY) {
      task.pipe(uglify());
    }

    task.pipe(gulp.dest(ASSETS_DIRECTORY));

    return task
  });
})(require);