<script src="{{ asset('assets') }}/jquery-3.6.0.min.js"></script>
<script>
    $("document").ready(function() {
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
    });
</script>
