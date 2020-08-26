$(function () {
    $(document).ajaxStart($.blockUI).ajaxStop($.unblockUI);

    $('#product').change(function () {
        // alert("Hello");
        getSmithLength($('#product').val())
    })
    function getSmithLength(id) {
        alert("What the heck");
        $.ajax({
            url : "api/v1/products/get_smithlength/"+id,
            type:"GET",
            success: function (data) {
                alert("Success");
                var psid = $('#length').val();
                $('length').html(' ');
                var sel;
                for (var i=0;  i < data.length; i++){
                    length = data[i];
                    if (i==0)
                        sel = length.id;
                    if (psid == length.id)
                    {
                        sel = length.id;
                        $('#length').append(
                            '<option value="'+length.id+'"selected>'+length.plength+'</option>'
                        );
                    }
                    else {
                        $('#length').append(
                            $('<option/>',{
                                value:length.id,
                                html:length.plength
                            }));
                    }
                }
                $("#length").val(sel);
            },
            error:function (xhr, errmsg, err) {
                $('#results').html("<div class='alert-box alert radius' data-alert>Oops! We have encountered an error:"+errmsg+"<a href='#' class='close'>&times;</a></div>");
                console.log(xhr.status + ":" + xhr.responseText);
            }
        })
    }

})