/**
 * Gulp Tasks
 *
 * @author      Scar Wu
 * @copyright   Copyright (c) Scar Wu (http://scar.tw)
 */

const gulp = require('gulp')
const del = require('del')
const $ = require('gulp-load-plugins')()
const log = require('fancy-log')
const colors = require('ansi-colors')
const webpack = require('webpack')
const webpackStream = require('webpack-stream')
const webpackConfig = require('./webpack.config.js')
const postfix = (new Date()).getTime().toString()
const sassCompiler = $.sass(require('dart-sass'))

let ENVIRONMENT = 'development'
let WEBPACK_NEED_WATCH = false

/**
 * Compile Style & Script
 */
function handleCompileError(event) {
    log.error(colors.red(event.message), 'error.')
}

function compileSass() {
    return gulp.src('src/assets/styles/theme.{sass,scss}')
        .pipe(sassCompiler({
            outputStyle: ('production' === ENVIRONMENT) ? 'compressed' : 'expanded'
        }).on('error', handleCompileError))
        .pipe($.autoprefixer())
        .pipe($.rename(function (path) {
            path.basename = path.basename.split('.')[0]
            path.extname = '.min.css'
        }))
        .pipe(gulp.dest('temp/assets/styles'))
}

function compileWebpack(callback) {
    if ('production' === ENVIRONMENT) {
        let definePlugin = new webpack.DefinePlugin({
            'process.env': {
                'ENV': "'production'",
                'BUILD_TIME': postfix,
                'NODE_ENV': JSON.stringify('production')
            }
        })

        webpackConfig.mode = ENVIRONMENT
        webpackConfig.plugins = webpackConfig.plugins || []
        webpackConfig.plugins.push(definePlugin)
    }

    if (WEBPACK_NEED_WATCH) {
        webpackConfig.watch = true
    }

    let result = gulp.src('src/assets/scripts/theme.js')
        .pipe(webpackStream(webpackConfig, webpack).on('error', handleCompileError))
        .pipe(gulp.dest('temp/assets/scripts'))

    if (WEBPACK_NEED_WATCH) {
        callback()
    } else {
        return result
    }
}

/**
 * Copy Files & Folders
 */
function copyMeta() {
    return gulp.src([
            'src/constant.php',
            'src/config.php'
        ])
        .pipe(gulp.dest('temp'))
}

function copyExtensions() {
    return gulp.src('src/extensions/**/*')
        .pipe(gulp.dest('temp/extensions'))
}

function copyHandlers() {
    return gulp.src('src/handlers/**/*')
        .pipe(gulp.dest('temp/handlers'))
}

function copyViews() {
    return gulp.src('src/views/**/*')
        .pipe(gulp.dest('temp/views'))
}

function copyAssetsFonts() {
    return gulp.src('src/assets/fonts/*')
        .pipe(gulp.dest('temp/assets/fonts'))
}

function copyAssetsImages() {
    return gulp.src('src/assets/images/**/*')
        .pipe(gulp.dest('temp/assets/images'))
}

function copyVendorFonts() {
    return gulp.src('node_modules/@fortawesome/fontawesome-free/webfonts/*.{otf,eot,svg,ttf,woff,woff2}')
        .pipe(gulp.dest('temp/assets/fonts/vendor'))
}

/**
 * Watching Files
 */
function watch() {

    // Watch Files
    gulp.watch('temp/**/*').on('change', $.livereload.changed)
    gulp.watch('src/{config,constant}.php', copyMeta)
    gulp.watch('src/extensions/**/*', copyExtensions)
    gulp.watch('src/handlers/**/*', copyHandlers)
    gulp.watch('src/views/**/*', copyViews)
    gulp.watch('src/assets/fonts/*', copyAssetsFonts)
    gulp.watch('src/assets/images/**/*', copyAssetsImages)
    gulp.watch('src/assets/styles/**/*.{sass,scss}', compileSass)

    // Start LiveReload
    $.livereload.listen({
        host: '0.0.0.0'
    })
}

/**
 * Release
 */
function releaseCopyAll() {
    return gulp.src('temp/**/*')
        .pipe(gulp.dest('dist'))
}

function releaseReplaceLayout() {
    return gulp.src('dist/views/layout.php')
        .pipe($.replace('$postfix = time()', '$postfix = ' + postfix))
        .pipe(gulp.dest('dist/views'))
}

/**
 * Set Variables
 */
function setEnv(callback) {

    // Warrning: Change ENVIRONMENT to Prodctuion
    ENVIRONMENT = 'production'

    callback()
}

function setWatch(callback) {

    // Webpack need watch
    WEBPACK_NEED_WATCH = true

    callback()
}

/**
 * Clean Temp Folders
 */
function cleanTemp() {
    return del('temp')
}

function cleanDist() {
    return del('dist')
}

/**
 * Bundled Tasks
 */
gulp.task('prepare', gulp.series(
    cleanTemp,
    gulp.parallel(copyMeta, copyExtensions, copyHandlers, copyViews, copyAssetsFonts, copyAssetsImages, copyVendorFonts),
    gulp.parallel(compileSass, compileWebpack)
))

gulp.task('release', gulp.series(
    setEnv, cleanDist,
    'prepare',
    releaseCopyAll, releaseReplaceLayout
))

gulp.task('default', gulp.series(
    setWatch,
    'prepare',
    watch
))
