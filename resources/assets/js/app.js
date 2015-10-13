var JarvisPlatform = angular.module('JarvisPlatform', ['angular-loading-bar', 'ngAnimate'])
    .config(['cfpLoadingBarProvider', function(cfpLoadingBarProvider) {
        cfpLoadingBarProvider.includeSpinner = false;
    }]);
;
$(function () {
    /** Datatables **/
    $('.dataTable').dataTable({
        language: {
            "url": GLOBALS.datablesLang
        }
    });
    /** select bootstrap **/
    $('.selectBootstrap').selectpicker();
    /** SlugAble **/
    if ($('.slugable').length > 0) {
        var $target = $('.slugable').find('.slug-target');
        var $source = $('.slugable').find('.slug-source');
        $target.slugify($source);
    }
    /** select2 **/
    $('.select2').select2({
        language : 'es'
    });
    $(".wysihtml5").wysihtml5();
    $(".datepicker").datepicker();
});