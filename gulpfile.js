'use strict';

const gulp         = require( 'gulp' );
const autoprefixer = require( 'gulp-autoprefixer' );
const cleanCSS     = require( 'gulp-clean-css' );
const rename       = require( 'gulp-rename' );
const sass         = require( 'gulp-sass' );

const pump         = require( 'pump' );
const concat       = require( 'gulp-concat' );
const eslint       = require( 'gulp-eslint' );
const uglify       = require( 'gulp-uglify-es' ).default;

const browsersList = [
	'last 2 version',
	'> 1%'
];

const library = {
	source: {},
	output: {},
	watch: {}
};

library.source.styles = './assets/scss/admin.scss';
library.output.styles = './dist/css/';

library.watch.styles = [
	library.source.styles + '**/**/*.scss'
];

library.source.scripts = [
	'./assets/js/admin.js',
];
library.output.scripts = './dist/js/';

const uglifyOptions = {
	compress: {
		drop_console: true
	}
};

gulp.task( 'admin-styles', () => {
	return gulp.src( library.source.styles )
		.pipe( autoprefixer( browsersList ))
		.pipe( sass({ outputStyle: 'expanded' }).on( 'error', sass.logError ) )
		.pipe( cleanCSS() )
		.pipe( rename({ suffix: '.min' }) )
		.pipe( gulp.dest( library.output.styles ) );
});

gulp.task( 'admin-scripts', ( cb ) => {
	pump([
		gulp.src( library.source.scripts ),
		eslint(),
		eslint.format(),
		eslint.failAfterError(),
		concat( 'admin.js' ),
		uglify( uglifyOptions ),
		rename({ suffix: '.min' }),
		gulp.dest( library.output.scripts ),
	], cb, err => {
		if ( err ) {
			console.log(err);
		}
		cb();
	});
});
