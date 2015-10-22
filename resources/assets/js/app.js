var JarvisPlatform = angular.module('JarvisPlatform', ['angular-loading-bar', 'ngAnimate', 'as.sortable', 'tableSort', 'ng-sortable', 'flow'])
    .config(['cfpLoadingBarProvider', function (cfpLoadingBarProvider) {
        cfpLoadingBarProvider.includeSpinner = false;
    }]);
/** Compile directive to bring html from backend and have Angular evaluate it **/
JarvisPlatform.directive('compile', function ($compile) {
    return function (scope, element, attrs) {
        scope.$watch(
            function (scope) {
                return scope.$eval(attrs.compile);
            },
            function (value) {
                element.html(value);
                $compile(element.contents())(scope);
            }
        );
    };
});
function HandleErrorResponse(data, code) {
    if (code === 422) {
        swal({
            title: "Hay un problema?",
            text: "Problema de Validación<br />" + parseValidationErrors(data.errors),
            type: "error",
            confirmButtonText: "Ok",
            html: true
        });
    }
}
function parseValidationErrors(errors) {
    var str = '';
    for (x in errors) {
        for (y in errors[x]) {
            str += errors[x][y] + '<br />';
        }
    }
    return str;
}
;
/** Datatables **/
$.extend(true, $.fn.dataTable.defaults, {
    language: {
        "url": GLOBALS.datablesLang
    }
});
$(function () {
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
        language: 'es'
    });
    $(".wysihtml5").wysihtml5();
    $(".datepicker").datepicker();
    /** delete dialog **/
    $(document).on('click', '.confirm-delete', function (e) {
        e.preventDefault();
        var $this = $(this);
        swal({
                title: "Esta seguro de eliminar esto?",
                text: "Tenga en cuenta que esto no se puede revertir",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Si, estoy seguro",
                cancelButtonText: "No, cancelar acción!",
                closeOnConfirm: true,
                closeOnCancel: true
            },
            function (isConfirm) {
                if (isConfirm) {
                    $('#deleteForm').attr('action', $this.attr('href')).submit();
                }
            });
    });
});