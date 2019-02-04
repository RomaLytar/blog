"use strict";

// NODE_ENV=production npm run build - Command for production task

// Global
const gulp = require("gulp");
const plumber = require("gulp-plumber");
const rimraf = require("rimraf");
const rename = require("gulp-rename");
const runSequence = require("run-sequence");
const cheerio = require("gulp-cheerio");
const gulpIf = require("gulp-if");
const server = require("browser-sync").create();

// SVG, PNG, JPG, WEBP
const imagemin = require("gulp-imagemin");
const svgmin = require("gulp-svgmin");
const svgstore = require("gulp-svgstore");
const webp = require("gulp-webp");

// JS
const babel = require("gulp-babel");
const uglify = require("gulp-uglify");
const concat = require("gulp-concat");

// CSS
const sass = require("gulp-sass");
const postcss = require("gulp-postcss");
const autoprefixer = require("autoprefixer");
const minify = require("gulp-csso");
const csscomb = require("gulp-csscomb");

// Variables
const isProduction = process.env.NODE_ENV == "production";
const themeName = "theatreblog";
const sourceFolderName = "src";
const buildFolder = `wp-content/themes/${themeName}`;

const proxyName = `http://${themeName}/`;

var path = {
  src: {
    phpServices: [`${sourceFolderName}/php/**/*.php`, `${sourceFolderName}/pages/**/*.php`, `${sourceFolderName}/pages/style.css`],
    phpDotServices: `${sourceFolderName}/php/.php/*.php`,
    phpIncludes: `${sourceFolderName}/_blocks/**/*.php`,
    js: [`${sourceFolderName}/_blocks/**/*.js`, `!${sourceFolderName}/_blocks/**/jq-*.js`],
    jsJq: `${sourceFolderName}/_blocks/**/jq-*.js`,
    jsPlug: `${sourceFolderName}/js/*.js`,
    plugins: `${sourceFolderName}/plugins/**/*`,
    css: `${sourceFolderName}/scss/main.scss`,
    cssCases: `${sourceFolderName}/_blocks/cases/**/main.scss`,
    img: `${sourceFolderName}/img/_blocks/**/*.{png,jpg,gif,webp}`,
    blockSvg: `${sourceFolderName}/img/_blocks/**/*.svg`,
    fonts: [`${sourceFolderName}/fonts/**/*.*`, `!${sourceFolderName}/fonts/**/*.scss`],
    favicon: `${sourceFolderName}/img/favicon/*`,
    sprite: `${sourceFolderName}/img/sprite/*`,
    svgSprite: `${sourceFolderName}/img/svg/*.svg`,
    webmanifest: `${sourceFolderName}/manifest-*.json`,
    mod: [`${sourceFolderName}/mod/**/*.*`]
  },
  watch: {
    css: `${sourceFolderName}/**/*.scss`
  },
  build: {
    phpServices: `${buildFolder}/`,
    phpDotServices: `${buildFolder}/.php/`,
    phpIncludes: `${buildFolder}/includes/`,
    js: `${buildFolder}/js/`,
    plugins: `${buildFolder}/plugins/`,
    css: `${buildFolder}/css/`,
    img: `${buildFolder}/img/`,
    fonts: `${buildFolder}/fonts/`,
    favicon: `${buildFolder}/img/favicon/`,
    sprite: `${buildFolder}/img/sprite/`,
    svgSprite: `${buildFolder}/img/svg`,
    webmanifest: `${buildFolder}/`,
    mod: `${buildFolder}/mod/`
  },
  clean: `${buildFolder}/*`,
};

gulp.task("clean", function (cb) {
  return rimraf(path.clean, cb);
});

gulp.task("copyPHP", function() {
  return gulp.src(path.src.phpServices)
    .pipe(gulp.dest(path.build.phpServices))
    .pipe(server.reload({stream: true}));
});

gulp.task("copyDotsPHP", function() {
  return gulp.src(path.src.phpDotServices)
    .pipe(gulp.dest(path.build.phpDotServices))
    .pipe(server.reload({stream: true}));
});

gulp.task("copyPHPIncludes", function() {
  return gulp.src(path.src.phpIncludes)
    .pipe(gulp.dest(path.build.phpIncludes))
    .pipe(server.reload({stream: true}));
});

gulp.task("webp", function() {
  return gulp.src(`${sourceFolderName}/img/_blocks/**/*.{png,jpg}`)
  .pipe(webp({quality: 90}))
  .pipe(gulp.dest(`${sourceFolderName}/img/_blocks/`));
});

gulp.task("symbols", function() {
  return gulp.src(path.src.svgSprite)
    .pipe(svgmin())
    .pipe(svgstore({
      inlineSvg: true
    }))
    .pipe(cheerio({
      run: function($) {
        $("svg").attr("style", "display:none");
      },
      parserOptions: { xmlMode: true }
    }))
    .pipe(rename("symbols.svg"))
    .pipe(gulp.dest(path.build.svgSprite))
    .pipe(server.reload({stream: true}));
});

gulp.task("fonts", function() {
  return gulp.src(path.src.fonts)
    .pipe(gulp.dest(path.build.fonts))
    .pipe(server.reload({stream: true}));
});

gulp.task("mod", function() {
  return gulp.src(path.src.mod)
    .pipe(gulp.dest(path.build.mod))
    .pipe(server.reload({stream: true}));
});

gulp.task("blocksvg", function() {
  return gulp.src(path.src.blockSvg)
    .pipe(gulpIf(isProduction, svgmin()))
    .pipe(gulp.dest(path.build.img))
    .pipe(server.reload({stream: true}));
});

gulp.task("copyfavicon", function() {
  return gulp.src(path.src.favicon)
    .pipe(gulp.dest(path.build.favicon))
    .pipe(server.reload({stream: true}));
});

gulp.task("copywebmanifest", function() {
  return gulp.src(path.src.webmanifest)
    .pipe(gulp.dest(path.build.webmanifest))
    .pipe(server.reload({stream: true}));
});

gulp.task("copysprite", function() {
  return gulp.src(path.src.sprite)
    .pipe(gulp.dest(path.build.sprite))
    .pipe(server.reload({stream: true}));
});

gulp.task("copyjs", function() {
  return gulp.src(path.src.jsPlug)
    .pipe(gulp.dest(path.build.js))
    .pipe(server.reload({stream: true}));
});

gulp.task("copyPlugins", function() {
  return gulp.src(path.src.plugins)
    .pipe(gulp.dest(path.build.plugins))
    .pipe(server.reload({stream: true}));
});

gulp.task("style", function() {
  gulp.src(path.src.css)
    .pipe(plumber())
    .pipe(gulpIf(isProduction, csscomb()))
    .pipe(sass())
    .pipe(postcss([
      autoprefixer()
    ]))
    .pipe(gulpIf(isProduction, minify()))
    .pipe(gulp.dest(path.build.css))
    .pipe(server.reload({stream: true}));
});

gulp.task("styleCases", function() {
  gulp.src(path.src.cssCases)
    .pipe(plumber())
    .pipe(gulpIf(isProduction, csscomb()))
    .pipe(sass())
    .pipe(postcss([
      autoprefixer()
    ]))
    .pipe(gulpIf(isProduction, minify()))
    .pipe(rename(function(path) {
      path.basename = path.dirname;
      path.dirname = "cases";
    }))
    .pipe(gulp.dest(path.build.css))
    .pipe(server.reload({stream: true}));
});

gulp.task("scripts", function() {
  return gulp.src(path.src.js)
    .pipe(babel({
      presets: ["env"]
    }))
    .pipe(concat("script.js"))
    .pipe(gulpIf(isProduction, uglify()))
    .pipe(gulp.dest(path.build.js))
    .pipe(server.reload({stream: true}));
});

gulp.task("scriptsJq", function() {
  return gulp.src(path.src.jsJq)
    .pipe(babel({
      presets: ["env"]
    }))
    .pipe(concat("jq-script.js"))
    .pipe(gulpIf(isProduction, uglify()))
    .pipe(gulp.dest(path.build.js))
    .pipe(server.reload({stream: true}));
});

gulp.task("image", function() {
  return gulp.src(path.src.img)
    .pipe(gulpIf(isProduction, imagemin([
      imagemin.optipng({optimizationLevel: 3}),
      imagemin.jpegtran({progressive: true})
    ])))
    .pipe(gulp.dest(path.build.img))
    .pipe(server.reload({stream: true}));
});

gulp.task("serve", function() {
  server.init({
    proxy: proxyName,
    notify: false,
    open: true,
    cors: true,
    ui: false
  });
});

gulp.task("watcher", function() {
  gulp.watch(path.src.img, ["image"]);
  gulp.watch(path.src.js, ["scripts"]);
  gulp.watch(path.src.jsJq, ["scriptsJq"]);
  gulp.watch(path.src.jsPlug ["copyjs"]);
  gulp.watch(path.src.plugins ["copyPlugins"]);
  gulp.watch(path.watch.css, ["style", "styleCases"]);
  gulp.watch(path.src.fonts, ["fonts"]);
  gulp.watch(path.src.mod, ["mod"]);
  gulp.watch(path.src.favicon, ["copyfavicon"]);
  gulp.watch(path.src.webmanifest, ["copywebmanifest"]);
  gulp.watch(path.src.blockSvg, ["blocksvg"]);
  gulp.watch(path.src.sprite, ["copysprite"]);
  gulp.watch(path.src.phpServices, ["copyPHP"]);
  gulp.watch(path.src.phpIncludes, ["copyPHPIncludes"]);
  gulp.watch(path.src.phpDotServices, ["copyDotsPHP"]);
});

gulp.task("build", function(callback) {
  runSequence("clean",
    "symbols",
    [
    "image",
    "style",
    "styleCases",
    "scripts",
    "scriptsJq",
    "fonts",
    "mod",
    "copyjs",
    "copyPlugins",
    "copyfavicon",
    "blocksvg",
    "copysprite",
    "copywebmanifest",
    "copyPHP",
    "copyPHPIncludes",
    "copyDotsPHP"
    ],
    "serve",
    "watcher",
    callback);
});
