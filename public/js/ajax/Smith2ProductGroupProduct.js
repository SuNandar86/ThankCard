$(function () {
    $(document).ajaxStart($.blockUI).ajaxStop($.unblockUI);
    getProductGroup();
    getSmith2JobTypeGroup();

    function  getSmith2JobType(id,jid) {
        // alert("In Smith2JobType");
        $.ajax({
            url : "api/v1/products/getSmith2JobType/"+id+"/"+jid,
            type:"GET",
            success: function (data) {
                // alert("Success");
                // alert(id);
                // alert(jid);
                var psid = $('#jobtype').val();
                $('#jobtype').html(' ');
                var sel;
                for (var i=0;  i < data.length; i++){
                    product = data[i];
                    if (i==0)
                        sel = product.id;
                    if (psid == product.id)
                    {
                        sel = product.id;
                        $('#jobtype').append(
                            '<option value="'+product.id+'"selected>'+product.name+'</option>'
                        );
                    }
                    else {
                        $('#jobtype').append(
                            $('<option/>',{
                                value:product.id,
                                html:product.name
                            }));
                    }
                }
                $("#jobtype").val(sel);
            },
            error:function (xhr, errmsg, err) {
                $('#results').html("<div class='alert-box alert radius' data-alert>Oops! We have encountered an error:"+errmsg+"<a href='#' class='close'>&times;</a></div>");
                console.log(xhr.status + ":" + xhr.responseText);
            }
        })
    }
    function getProductGroup(){
        $.ajax({
            url: "api/v1/products/getProductGroup/",
            type: "GET",
            success:function (data) {
                var loc;
                var locid=$("#pgroup").val();

                // alert($("#location").val());
                $("#pgroup").html('');
                for (var i = 0; i < data.length; i++) {
                    locobj = data[i];
                    // alert("in for loop");
                    if(i==0)
                        {
                            loc=locobj.id;
                        }
                    if(locid==locobj.id)
                    {
                        loc = locobj.id;
                        // alert('in selected');
                        $("#pgroup").append(
                            '<option value="' + locobj.id + '" selected>'
                            + locobj.name
                            + '</option>'
                        );
                    }
                    else{
                        // alert("In Not Selected");
                        $("#pgroup").append(
                        $('<option/>', {
                            value: locobj.id,
                            html: locobj.name
                        }));
                    }

                }
                // alert("ProductGroupid:"+loc);
                $("#pgroup").val(loc);
                // alert(loc);
                // alert($("#location").val(loc));
                getInventoryProduct(loc);
            },
            // handle a non-successful response
            error: function (xhr, errmsg, err) {
                $('#results').html("<div class='alert-box alert radius' data-alert>Oops! We have encountered an error: " + errmsg +
                    " <a href='#' class='close'>&times;</a></div>"); // add the error to the dom
                console.log(xhr.status + ": " + xhr.responseText); // provide a bit more info about the error to the console
            }
        });
    }

    function getSmith2JobTypeGroup(){
        $.ajax({
            url: "api/v1/products/getSmith2JobTypeGroup/",
            type: "GET",
            success:function (data) {
                var loc;
                var locid=$("#jobtypegroup").val();

                // alert($("#location").val());
                $("#jobtypegroup").html('');
                for (var i = 0; i < data.length; i++) {
                    locobj = data[i];
                    // alert("in for loop");
                    if(i==0)
                        {
                            loc=locobj.id;
                        }
                    if(locid==locobj.id)
                    {
                        loc = locobj.id;
                        // alert('in selected');
                        $("#jobtypegroup").append(
                            '<option value="' + locobj.id + '" selected>'
                            + locobj.name
                            + '</option>'
                        );
                    }
                    else{
                        // alert("In Not Selected");
                        $("#jobtypegroup").append(
                        $('<option/>', {
                            value: locobj.id,
                            html: locobj.name
                        }));
                    }

                }
                $("#jobtypegroup").val(loc);
                // alert(loc);
                // alert($("#location").val(loc));
                getJobTypeSubGroup(loc);
                getSmith2JobType($('#product').val(),$("#jobtypesubgroup").val());
            },
            // handle a non-successful response
            error: function (xhr, errmsg, err) {
                $('#results').html("<div class='alert-box alert radius' data-alert>Oops! We have encountered an error: " + errmsg +
                    " <a href='#' class='close'>&times;</a></div>"); // add the error to the dom
                console.log(xhr.status + ": " + xhr.responseText); // provide a bit more info about the error to the console
            }
        });
    }

    $('#pgroup').change(function () {
        // alert("In ProductGroup Change");
        getInventoryProduct($('#pgroup').val())
    })
    $('#reducey').change(function () {
        // alert("In Reduce Y Change");
         var reduce_k=$("#reducek").val()
        // alert(reduce_k);
        var reduce_p=$("#reducep").val();
        // alert(reduce_p);
        var reduce_y=$("#reducey").val();
        // alert(reduce_y);
        // var getp=(reduce_y % 7.5);
        // alert ('get p'+getp);
        // var getk=(getp+reduce_p)%16;
        // alert ('getk'+getk);
        // var getw=getk+reduce_k;
        // alert ('getw'+getw);
        // var getg=getw*16.6;
        // alert('getGram'+getg);
        var y=parseFloat(reduce_y);
        var p=parseInt(reduce_p);
        var k=parseInt(reduce_k);
        var weight= (((y / 8) + p) / 16) + k;

        // alert(weight);
        var gram=weight*16.606;
        // alert(gram.toFixed(4));
        $('#reducew').html(' ');
        // document.getElementById('reduce_g').value=weight;

        $('#reducew').val(gram.toFixed(2));
        
    })
    
    function getInventoryProduct(id) {
        $.ajax({
            url : "api/v1/products/getProducts/"+id,
            type:"GET",
            success: function (data) {
                // alert("Proudct  Success");
                var psid = $('#product').val();
                // alert ("Product"+psid);
                $('#product').html(' ');
                var sel;
                for (var i=0;  i < data.length; i++){
                    product = data[i];
                    if (i==0)
                    {
                        sel = product.id;
                    }

                    if (psid == product.id)
                    {
                        sel = product.id;
                        $('#product').append(
                            '<option value="'+product.id+'"selected>'+product.name+'</option>'
                        );
                    }
                    else {
                        $('#product').append(
                            $('<option/>',{
                                value:product.id,
                                html:product.name
                            }));
                    }
                }
                $("#product").val(sel);
                // alert("IN Product Get Process");
                getSmith2JobType(sel,$("#jobtypesubgroup").val());
                // alert("ProductSelected "+ sel);
            },
            error:function (xhr, errmsg, err) {
                $('#results').html("<div class='alert-box alert radius' data-alert>Oops! We have encountered an error:"+errmsg+"<a href='#' class='close'>&times;</a></div>");
                console.log(xhr.status + ":" + xhr.responseText);
            }
        })
    }

    $('#jobtypegroup').change(function () {
        // alert("Hello In Job Type Group Change");
        getJobTypeSubGroup($('#jobtypegroup').val());
        // getSmith2JobType($('#product').val(),$("#jobtypesubgroup").val());
    })

     $('#product').change(function () {
        // alert("Hello In Product Change");
        getSmith2JobType($('#product').val(),$("#jobtypesubgroup").val());
    })
    $("#jobtypesubgroup").change(function(){
        // alert("In JobType Sub Group Change");
        getSmith2JobType($('#product').val(),$("#jobtypesubgroup").val());
    })
    function getJobTypeSubGroup(id) {
        // alert("What the heck");
        $.ajax({
            url : "api/v1/products/getSmith2JobTypeSubGroup/"+id,
            type:"GET",
            success: function (data) {
                // alert("Success");
                var psid = $('#jobtypesubgroup').val();
                $('#jobtypesubgroup').html(' ');
                var sel;
                for (var i=0;  i < data.length; i++){
                    product = data[i];
                    if (i==0)
                        sel = product.id;
                    if (psid == product.id)
                    {
                        sel = product.id;
                        $('#jobtypesubgroup').append(
                            '<option value="'+product.id+'"selected>'+product.name+'</option>'
                        );
                    }
                    else {
                        $('#jobtypesubgroup').append(
                            $('<option/>',{
                                value:product.id,
                                html:product.name
                            }));
                    }
                }
                // alert("In Job Type Sub Group");
                $("#jobtypesubgroup").val(sel);
                getSmith2JobType($('#product').val(),$("#jobtypesubgroup").val());
            },
            error:function (xhr, errmsg, err) {
                $('#results').html("<div class='alert-box alert radius' data-alert>Oops! We have encountered an error:"+errmsg+"<a href='#' class='close'>&times;</a></div>");
                console.log(xhr.status + ":" + xhr.responseText);
            }
        })
    }

})