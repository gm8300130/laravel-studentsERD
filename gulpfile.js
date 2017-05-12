/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */

//laravel5.3 原生
const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

//客制引入
const gulp = require('gulp');
const webpack = require("webpack");
const webpackConfig = require("./webpack.config.js");
const spritesmith = require('gulp.spritesmith');
const imagemin = require('gulp-imagemin');
const glob = require('glob');
const fs = require("fs");
const hashFiles = require('hash-files');

const config = {
    bowerDir: './vendor/bower_components',
    npmDir: './node_modules',
};

/**
 * Gulp 任務區
 */

//執行 webpack
gulp.task('webpack', function(callback) {
    var webpackConfigObject = Object.create(webpackConfig);

    webpack(webpackConfigObject, function (err, stats) {
        callback();
    });
});

//檢查編碼格式 stylelint
gulp.task('lint-css', function lintCssTask() {
    var gulpStylelint = require('gulp-stylelint');

    return gulp
        .src(elixir.config.get('assets.css.sass.folder') + '/**/*.scss')
        .pipe(gulpStylelint({
            syntax: 'scss',
            failAfterError: true,
            reporters: [
                {formatter: 'string', console: true}
            ]
        }));
});

//處理小圖
gulp.task('csssprite', function(callback) {
	/*
	會用到 glob, fs, hashFiles, spritesmith, vinyl-buffer, imagemin
	 */
});

/**
 * Elixir
 */
//預設檔案路徑 ： node_modules/laravel-elixir/dist/Congig.js
elixir.config.assetsPath = 'resources/';
elixir.config.css.autoprefix = {
    enabled: true,
    options: {
        cascade: true,
        browsers: ['last 6 versions', '> 1%']
    }
};

elixir((mix) => {

	//css 可用 less, sass, stylus, 或只做原生css合併

    //js
    mix.webpack('all.js', './public/js/page/all.js', 'public/js/page/')
    	.webpack('home.js', './public/js/page/home.js', 'public/js/page/')
    	.webpack('admin.js', './public/js/page/admin.js', 'public/js/page/')
    	.webpack('profile.js', './public/js/page/profile.js', 'public/js/page/')
    	.webpack('test.js', './public/js/page/test.js', 'public/js/page/');

    //插件最小min.js合併
    mix.combine([
                'jquery/dist/jquery.min.js',
                'bootstrap/dist/js/bootstrap.min.js',
                'jquery-validation/dist/jquery.validate.min.js',
                'autosize/dist/autosize.min.js',
                'layzr.js/dist/layzr.min.js'
            ], 'public/js/vendor.js', config.bowerDir);

    //script 可以寫腳本做合併

    //copy 拷貝文件/目錄

    //版本號
    mix.version([
    	'public/css/page/all.css',
    	'public/css/page/home.css',
    	'public/css/page/admin.css',
    	'public/css/page/profile.css',
    	'public/css/page/test.css',
    	'public/js/page/all.js',
    	'public/js/page/home.js',
    	'public/js/page/admin.js',
    	'public/js/page/profile.js',
    	'public/js/page/test.js',
    	'public/js/vendor.js'
    ]);

});
