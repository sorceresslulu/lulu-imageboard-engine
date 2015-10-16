(function(require) {
  var gulp = require('gulp');
  var gulpConfig = require('./gulpconfig.json');
  var concat = require('gulp-concat');
  var templateCache = require('gulp-angular-templatecache');
  var sass = require('gulp-sass');
  var uglify = require('gulp-uglify');
  var uglifycss = require('gulp-uglifycss');

  var ASSETS_DIRECTORY = './../www/imageboard/public/assets/';
  var TMP_DIRECTORY = './tmp/';

  function GulpRunner() {
    this.gulpConfig = gulpConfig;
    this.options = {
      mode: "production",
      minify: true
    };

    this.setupGulpWatch();
    this.setupModeTask();
    this.setupVendorTask();
    this.setupAngularTask();
    this.setupJsConcatTask();
    this.setupSASSMainLayoutTask();
  }

  GulpRunner.prototype.run = run;
  GulpRunner.prototype.listTasks = listTask;
  GulpRunner.prototype.setupGulpWatch = setupGulpWatch;
  GulpRunner.prototype.setupModeTask = setupModeTask;
  GulpRunner.prototype.setupVendorTask = setupVendorTask;
  GulpRunner.prototype.setupAngularTask = setupAngularTask;
  GulpRunner.prototype.setupJsConcatTask = setupJsConcatTask;
  GulpRunner.prototype.setupSASSMainLayoutTask = setupSASSMainLayoutTask;

  return (new GulpRunner()).run();

  /**
   * Run guklp
   */
  function run() {
    gulp.task('default', ['production']);
    gulp.task('production', this.listTasks({ minify: true }));
    gulp.task('development', this.listTasks({ minify: false }));
  }

  /**
   * Returns list of tasks
   * @param options
   * @returns {string[]}
   */
  function listTask(options) {
    var tasks = [
      "vendor",
      "angular-modules",
      "angular-templates",
      "js-concat",
      "sass-layout-main",
      "sass-layout-main-vendor",
      "sass-layout-main-concat"
    ];

    if(options.minify) {
      tasks.unshift('mode-production');
    }else{
      tasks.unshift('mode-development');
    }

    return tasks;
  }

  /**
   * Gulp watch
   */
  function setupGulpWatch() {
    var options = this.options;

    gulp.watch('./**/*.js', this.listTasks(options));
    gulp.watch('./**/*.sass', this.listTasks(options));
    gulp.watch('./**/*.html', this.listTasks(options));
  }

  /**
   * Production/development mode
   */
  function setupModeTask() {
    var runner = this;

    gulp.task('mode-development', function() {
      runner.options.minify = false;
      runner.options.mode = 'development';
    });

    gulp.task('mode-production', function() {
      runner.options.minify = true;
      runner.options.mode = 'production';
    });
  }

  /**
   * Vendor libs
   */
  function setupVendorTask() {
    var src;

    if(this.options.mode == "production") {
      src = this.gulpConfig.vendor.production;
    }else{
      src = this.gulpConfig.vendor.development;
    }

    gulp.task('vendor', function() {
      return gulp.src(src)
        .pipe(concat('vendor.js'))
        .pipe(gulp.dest(TMP_DIRECTORY))
    });
  }

  /**
   * Angular modules & templates
   */
  function setupAngularTask() {
    var config;

    if(this.options.mode == "production") {
      config = this.gulpConfig.angular.production;
    }else{
      config = this.gulpConfig.angular.development;
    }

    gulp.task('angular-modules', function() {
      var src = [
        'angular/modules/Module.js'
      ];

      config.modules.forEach(function(module) {
        src.push('angular/modules/'+module+'/**/*.js');
      });

      return gulp.src(src)
        .pipe(concat('angular-modules.js'))
        .pipe(gulp.dest(TMP_DIRECTORY))
      ;
    });

    gulp.task('angular-templates', function() {
      return gulp.src('angular/**/template.html')
        .pipe(templateCache())
        .pipe(concat('angular-templates.js'))
        .pipe(gulp.dest(TMP_DIRECTORY))
      ;
    });
  }

  /**
   * Concat all JS files to app.js
   */
  function setupJsConcatTask() {
    var runner = this;

    gulp.task('js-concat', function() {
      var task = gulp.src([
          TMP_DIRECTORY + '/vendor.js',
          TMP_DIRECTORY + '/angular-modules.js',
          TMP_DIRECTORY + '/angular-templates.js'
        ])
        .pipe(concat('app.js'))
      ;

      if(runner.options.minify) {
         task.pipe(uglify());
      }

      task.pipe(gulp.dest(ASSETS_DIRECTORY));

      return task
    });
  }

  /**
   * SASS – Layout – Main
   */
  function setupSASSMainLayoutTask() {
    var runner = this;

    /**
     * Layout.sass
     */
    gulp.task('sass-layout-main', function() {
      return gulp.src('./layout/main/styles/layout.sass')
        .pipe(sass().on('error', sass.logError))
        .pipe(concat('layout-main.css'))
        .pipe(gulp.dest(TMP_DIRECTORY))
      ;
    });

    /**
     * Vendor
     */
    gulp.task('sass-layout-main-vendor', function() {
      var src;

      if(runner.options.mode == "production") {
        src = runner.gulpConfig.layout.main.vendor.production;
      }else{
        src = runner.gulpConfig.layout.main.vendor.development;
      }

      return gulp.src(src)
        .pipe(concat('layout-main-vendor.css'))
        .pipe(gulp.dest(TMP_DIRECTORY))
      ;
    });

    /**
     * Concat & Minify
     */
    gulp.task('sass-layout-main-concat', function() {
      var src = [
        TMP_DIRECTORY + '/layout-main-vendor.css',
        TMP_DIRECTORY + '/layout-main.css'
      ];

      var task = gulp.src(src)
        .pipe(concat('layout-main.css'))
      ;

      if(runner.options.minify) {
        task.pipe(uglifycss());
      }

      return task.pipe(gulp.dest(ASSETS_DIRECTORY));
    });
  }
})(require);