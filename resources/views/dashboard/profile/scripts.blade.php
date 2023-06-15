<script src="{{ asset('assets') }}/jquery-3.6.0.min.js"></script>
<script>
    $("document").ready(function(){
        //============================================= LOADER
        var $loading = $('#loading').hide();
        $(document)
        .ajaxStart(function () {
            $loading.show();
        })
        .ajaxStop(function () {
            $loading.hide();
        });

        //============================================= AJAX REQUEST FOR UPDATING INFORMATION
        $(document).on('click', "#submit_information_form", function () {
            let theForm = $("#information_form");
            let formAction = theForm[0].action;
            let formMethod = theForm[0].method;
            let formData = theForm.serialize();
                
            $.ajax({
                url: formAction ,
                method: formMethod ,
                data: formData ,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: "json",
                success: function(data){
                    $('#information_form').find('small').remove();
                    $("#information_form_messages").empty().removeClass()
                    .addClass('alert alert-success').append(data['success'])
                    .get(0).scrollIntoView({ behavior: 'instant', block: 'center' });

                    $("#mainCont").load(" #mainCont > *");
                    setTimeout(function() {
                        $("#information_form").load(" #information_form > *");
                        $("#information_form_messages").empty().removeClass() ;
                    }, 1000);
                },
                error: function(xhr){
                    $('#information_form').find('small').remove();
                    $.each(xhr.responseJSON.errors, function( key, value ) {
                        let el = $(document).find('[name="'+key+'"]');
                        el.after($('<small class="text-danger">'+value[0]+'</small>'));
                    });
                }
            }) ;
    
        }) ;
            
        //============================================= AJAX REQUEST FOR UPDATING PASSWORD
        $(document).on('click', "#submit_password_form", function () {
            let theForm = $("#password_form");
            let formAction = theForm[0].action;
            let formMethod = theForm[0].method;
            let formData = theForm.serialize();
            $.ajax({
                url: formAction ,
                method: formMethod ,
                data: formData ,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: "json",
                success: function(data){
                    $('#password_form').find('small').remove();
                    if (data['failed']) {
                        $("#password_form_messages").empty().removeClass()
                        .addClass('alert alert-danger').append(data['failed'])
                        .get(0).scrollIntoView({ behavior: 'instant', block: 'center' });
                    } else {
                        $("#password_form_messages").empty().removeClass()
                        .addClass('alert alert-success').append(data['success'])
                        .get(0).scrollIntoView({ behavior: 'instant', block: 'center' });
                        setTimeout(function() {
                            $("#password_form").load(" #password_form > *");
                            $("#password_form_messages").empty().removeClass() ;
                        }, 1000);
                    }
                },
                error: function(xhr){
                    $('#password_form').find('small').remove();
                    $.each(xhr.responseJSON.errors, function( key, value ) {
                        let el = $(document).find('[name="'+key+'"]');
                        el.after($('<small class="text-danger">'+value[0]+'</small>'));
                    });
                }
            }) ; 
        
        }) ;

    });
</script>