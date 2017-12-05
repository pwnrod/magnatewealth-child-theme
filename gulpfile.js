/**
 * Created by Biven Toma on 7/6/2016.
 */

var gulp = require('gulp');
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var sourcemaps = require('gulp-sourcemaps');

gulp.task('sass', function(){
    return gulp.src('sass/style.scss')
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(autoprefixer())
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest('./'))
});

gulp.task('watch', function(){
    gulp.watch('sass/**/*.scss', ['sass']);
});

