<script src="{{ asset('assets') }}/jquery-3.6.0.min.js"></script>
<script>
    $("document").ready(function() {
        //============================================= AJAX REQUEST FOR UPDATING
        $(document).on('click', "#submit_edit_form", function() {
            let theForm = $("#edit_form");
            let formAction = theForm[0].action;
            let formMethod = theForm[0].method;
            let formData = new FormData($('#edit_form')[0]);

            if (window.location.href.indexOf("terms") > -1) {
                formData.append('terms', tinyMCE.get('terms').getContent());
            }

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
                        $("#edit_form_messages").empty().removeClass();
                        window.location.reload();
                    }, 1000);
                },
                error: function(xhr) {
                    $('#edit_form').find('small').remove();
                    $('#edit_form').find('.error').removeClass('error');
                    $.each(xhr.responseJSON.errors, function(key, value) {
                        let el = $(document).find('[name="' + key + '"]').first()
                            .addClass('error');
                        el.after($('<small class="text-danger">' + value[0] +
                            '</small>'));
                    });
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
    });
</script>
