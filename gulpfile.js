var gulp        = require('gulp');
var browserSync = require('browser-sync').create();

gulp.task('bs', function(){
    browserSync.init({
        files: "**",
        proxy:"localhost/demo_teek/DoorPass"
    });
});
