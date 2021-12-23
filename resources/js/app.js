/**
 * First we will load all of this project's JavaScript dependencies which
 * includes React and other helpers. It's a great starting point while
 * building robust, powerful web applications using React + Laravel.
 */

require('./bootstrap');
require('./adminlte');
require('./chart');
require('datatables.net-bs4');
require('datatables.net-buttons-bs4');
require('datatables.net/js/jquery.dataTables.js' );
require('datatables.net-bs4/js/dataTables.bootstrap4.js' );
require('datatables.net-buttons/js/dataTables.buttons');
require('datatables.net-buttons/js/buttons.flash');
require('datatables.net-buttons/js/buttons.html5');
require('datatables.net-buttons/js/buttons.print');
require('datatables.net-buttons/js/buttons.colVis');
// require('./dropzoneForm');

/**
 * Next, we will create a fresh React component instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

 window.pdfMake = require('pdfmake/build/pdfmake');
    window.pdfFonts = require('pdfmake/build/vfs_fonts');
    pdfMake.vfs = pdfFonts.pdfMake.vfs;