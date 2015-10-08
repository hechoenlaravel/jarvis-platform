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
    /** Confirm dialog **/
    $(document).on('click', '.confirm', function (e) {
        e.preventDefault();
        var $this = $(this);
        bootbox.dialog({
            message: $this.data('message') || "Esta seguro de eliminar este elemento?",
            title: $this.data('title') || "Eliminar elemento",
            buttons: {
                success: {
                    label: $this.data('success') || "Si",
                    className: "btn-success",
                    callback: function () {
                        window.location.href = $this.attr('href');
                    }
                },
                danger: {
                    label: $this.data('danger') || "No",
                    className: "btn-danger",
                    callback: function () {

                    }
                }
            }
        });
    });
    /** SlugAble **/
    if ($('.slugable').length > 0) {
        var $target = $('.slugable').find('.slug-target');
        var $source = $('.slugable').find('.slug-source');
        $target.slugify($source);
    }
    /** Permissions modal **/
    $(document).on('click', '[data-action="AssignPermission"]', function () {
        var $this = $(this);
        /** get the permissions Model **/
        $.ajax({
            url: '/backend/roles/permissions/get',
            type: 'GET',
            dataType: 'json',
            data: {
                type: $this.data('type'),
                model: $this.data('model')
            },
            beforeSend: function () {
                $this.button('loading');
            },
            success: function (json) {
                $('#Modeltype').val($this.data('type'));
                $('#Modelid').val($this.data('model'));
                $.each(json, function (index, obj) {
                    $('#permissionsSelect').append(new Option(obj.display_name, obj.id, true, false));
                });
                $('#permissionsSelect').selectpicker();
                $('#AssignPermissionsForm').attr('action', $this.data('url'));
                $('#permissionsAddModal').modal('show');
            },
            complete: function () {
                $this.button('reset');
            }
        });
    });
    
    $(".wysihtml5").wysihtml5();
    $(".datepicker").datepicker();
});