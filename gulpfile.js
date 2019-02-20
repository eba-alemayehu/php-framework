var gulp = require("gulp"),
// webpack = require("webpack"),
    sass = require('gulp-sass');

sass.compiler = require('node-sass');

var scss_src = "./public/assets/scss/app.scss";
var scss_dest = "./public/css/";

// gulp.task('webpack', function(){
//     webpack("./webpack.config.js", function(){
//         console.log("web pack complited");
//     });
// });

gulp.task('sass', function () {
    return gulp.src(scss_src)
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest(scss_dest));
});

gulp.task('sass:watch', function () {
    gulp.watch(scss_src, ['sass']);
});


