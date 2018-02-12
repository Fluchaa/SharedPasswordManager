var gulp = require('gulp');
var templateCache = require('gulp-angular-templatecache');

gulp.task('default', function () {
  gulp.src('templates/views/**/*.html')
  .pipe(templateCache('templates.js', {
  	root: 'views/',
  	standalone: true
  }))
  .pipe(gulp.dest('js'));
});