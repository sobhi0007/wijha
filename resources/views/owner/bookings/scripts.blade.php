<script src="{{ asset('assets') }}/jquery-3.6.0.min.js"></script>
<script>
    $("document").ready(function() {
        //============================================= LOADER
        // function spinner() {
        //     $(document)
        //         .ajaxStart(function() {
        //             $('#loading').removeClass('d-none');
        //         })
        //         .ajaxStop(function() {
        //             $('#loading').addClass('d-none');
        //         });
        // }

        //============================================= AJAX REQUEST FOR SHOWING ADD NEW RECORD MODAL
        $(document).on('click', "#add_btn", function(e) {
            e.preventDefault();
            let url = $(this).attr("href");
            let title = $(this).attr("data-title");
            $("#modal-title").html(title);
            $.ajax({
                url: url,
                method: "get",
                success: function(data) {
                    $("#modal-body").html(data);
                },
                error: function() {
                    alert("Please try again ... ");
                }
            });
        });

        //============================================= AJAX REQUEST FOR ADDING RECORD
        $(document).on('click', "#submit_add_form", function() {
            let theForm = $("#add_form");
            let formAction = theForm[0].action;
            let formMethod = theForm[0].method;
            let formData = new FormData($('#add_form')[0]);

            $.ajax({
                url: formAction,
                method: formMethod,
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: "json",
                success: function(data) {
                    $('#add_form').find('small').remove();
                    $('#add_form').find('.error').removeClass('error');
                    $("#add_form_messages").empty().removeClass()
                        .addClass('alert alert-success').append(data['success'])
                        .get(0).scrollIntoView({
                            behavior: 'instant',
                            block: 'center'
                        });

                    setTimeout(function() {
                        $(':input', '#add_form')
                            .not(':button, :submit, :reset, :hidden')
                            .val('')
                            .prop('checked', false)
                            .prop('selected', false);
                        $("#add_form_messages").empty().removeClass();
                        $("#mainModal").modal('hide');
                        $("#mainCont").load(" #mainCont > *");
                    }, 1000);
                },
                error: function(xhr) {
                    $('#add_form').find('small').remove();
                    $('#add_form').find('.error').removeClass('error');
                    $.each(xhr.responseJSON.errors, function(key, value) {
                        let el;
                        if (key.indexOf('.') > -1) {
                            $array = key.split(".");
                            el = $('#add_form').find('[name="' + $array[0] + '[' +
                                $array[1] + ']' + '"]').first().addClass(
                                'error');
                        } else {
                            el = $('#add_form').find('[name="' + key + '"]').first()
                                .addClass('error');
                        }
                        el.after($('<small class="text-danger">' + value[0] +
                            '</small>'));
                    });
                    $('html, body').animate({
                        scrollTop: $('small:first').offset().top
                    }, 500);
                },
                beforeSend: function() {
                    $('#submit_add_form').attr('disabled', true);
                    $('#loading').removeClass('d-none');
                },
                complete: function() {
                    $('#submit_add_form').attr('disabled', false);
                    $('#loading').addClass('d-none');
                }
            });
        });

        //============================================= AJAX REQUEST FOR SHOWING DELETE MODAL
        $(document).on('click', ".deleteClass", function(e) {
            let url = $(this).attr("href");
            let title = $(this).attr("data-title");
            $("#delete-modal-title").html(title);
            $("#submit_delete").attr("href", url);
        });

        //============================================= AJAX REQUEST FOR DELETING RECORD
        $(document).on('click', "#submit_delete", function(e) {
            e.preventDefault();
            let url = $(this).attr("href");
            $.ajax({
                url: url,
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: "json",
                success: function(data) {
                    $("#delete_alert_div").removeClass().addClass('alert alert-success')
                        .append(data['success']);

                    setTimeout(function() {
                        $("#mainCont").load(" #mainCont > *");
                        $("#deleteModal").load(" #deleteModal > *");
                        $('#deleteModal').modal('toggle');
                    }, 1000);
                },
                error: function() {
                    alert("Please try again ...");
                },
                beforeSend: function() {
                    $('#submit_delete').attr('disabled', true);
                    $('#loading').removeClass('d-none');
                },
                complete: function() {
                    $('#submit_delete').attr('disabled', false);
                    $('#loading').addClass('d-none');
                }
            });
        });

        //============================================= SCRIPT FOR SHOWING EDITING MODAL
        $(document).on('click', ".editClass", function(e) {
            e.preventDefault();
            let url = $(this).attr("href");
            let title = $(this).attr("data-title");
            $("#modal-title").html(title);
            $.ajax({
                url: url,
                method: "get",
                success: function(data) {
                    $("#modal-body").html(data);
                },
                error: function() {
                    alert("Please try again ... ");
                }
            });
        });

        //============================================= AJAX REQUEST FOR UPDATING
        $(document).on('click', "#submit_edit_form", function() {
            let theForm = $("#edit_form");
            let formAction = theForm[0].action;
            let formMethod = theForm[0].method;
            let formData = new FormData($('#edit_form')[0]);

            $.ajax({
                url: formAction,
                method: formMethod,
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: "json",
                success: function(data) {
                    $('#edit_form').find('small').remove();
                    $('#edit_form').find('.error').removeClass('error');
                    $("#edit_form_messages").empty().removeClass()
                        .addClass('alert alert-success').append(data['success'])
                        .get(0).scrollIntoView({
                            behavior: 'instant',
                            block: 'center'
                        });

                    setTimeout(function() {
                        $("#mainCont").load(" #mainCont > *");
                        $("#edit_form_messages").empty().removeClass();
                        $("#mainModal").modal('hide');
                    }, 1000);
                },
                error: function(xhr) {
                    $('#edit_form').find('small').remove();
                    $('#edit_form').find('.error').removeClass('error');
                    $.each(xhr.responseJSON.errors, function(key, value) {
                        let el;
                        if (key.indexOf('.') > -1) {
                            $array = key.split(".");
                            el = $('#edit_form').find('[name="' + $array[0] + '[' +
                                $array[1] + ']' + '"]').first().addClass(
                                'error');
                        } else {
                            el = $('#edit_form').find('[name="' + key + '"]')
                                .first()
                                .addClass('error');
                        }
                        el.after($('<small class="text-danger">' + value[0] +
                            '</small>'));
                    });
                    $('html, body').animate({
                        scrollTop: $('small:first').offset().top
                    }, 500);
                },
                beforeSend: function() {
                    $('#submit_edit_form').attr('disabled', true);
                    $('#loading').removeClass('d-none');
                },
                complete: function() {
                    $('#submit_edit_form').attr('disabled', false);
                    $('#loading').addClass('d-none');
                }
            });

        });

        //============================================= SCRIPT FOR DISPLAYING RECORD DETAILS ON MODAL
        $(document).on('click', ".displayClass", function(e) {
            e.preventDefault();
            let formAction = $(this).attr("href");
            let title = $(this).attr("data-title");
            $("#modal-title").html(title);
            $.ajax({
                url: formAction,
                method: "get",
                success: function(data) {
                    $("#modal-body").html(data);
                },
                error: function() {
                    alert("failed .. Please try again !");
                }
            });
        });

        //============================================= AJAX REQUEST FOR GETTING DISTRICTS BASED ON CITY SELECTION
        $(document).on('change', "#city_id", function(e) {
            e.preventDefault();
            let city_id = $(this).val();
            let url = $(this).attr('data-url');

            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    city_id: city_id,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: "json",
                success: function(data) {
                    $("#district_id").find('option').not(':first').remove();
                    $.each(data['success'], function(key, value) {
                        $('#district_id').append(
                            `<option value="${value.id}">${value.name}</option>`
                        );
                    });
                },
                error: function(xhr) {
                    alert("Something wrong happens.. Please try again !");
                },
            });
        });

    });
</script>
