$(function () {
    $(document).ajaxStart($.blockUI).ajaxStop($.unblockUI);
    getLocation();
    getToLocation();
    $('#location').change(function () {
        // alert('In change');
        // alert($('#pgroup').val());
        getLocationBingroup($('#location').val());
        // getBinGroup($('#location').val());
        // getProSubGroup($('#location').val());//updated by SSM to use the text input search in product sub group4/5/2018
    });
    $('#tolocation').change(function () {
        // alert('In change');
        // alert($('#pgroup').val());
        getToLocationBingroup($('#tolocation').val());
        // getBinGroup($('#location').val());
        // getProSubGroup($('#location').val());//updated by SSM to use the text input search in product sub group4/5/2018
    });
    function getLocation(){
        $.ajax({
            url: "api/v1/products/getLocation/",
            type: "GET",
            success:function (data) {
                var loc;
                var locid=$("#location").val();

                // alert($("#location").val());
                $("#location").html('');
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
                        $("#location").append(
                            '<option value="' + locobj.id + '" selected>'
                            + locobj.loc_name
                            + '</option>'
                        );
                    }
                    else{
                        // alert("In Not Selected");
                        $("#location").append(
                        $('<option/>', {
                            value: locobj.id,
                            html: locobj.loc_name
                        }));
                    }

                }
                $("#location").val(loc);
                // alert(loc);
                // alert($("#location").val(loc));
                getLocationBingroup(loc);
            },
            // handle a non-successful response
            error: function (xhr, errmsg, err) {
                $('#results').html("<div class='alert-box alert radius' data-alert>Oops! We have encountered an error: " + errmsg +
                    " <a href='#' class='close'>&times;</a></div>"); // add the error to the dom
                console.log(xhr.status + ": " + xhr.responseText); // provide a bit more info about the error to the console
            }
        });
    }
    function  getLocationBingroup(id) {
        $.ajax({
            url:"api/v1/products/getLocationBingroup/"+id,
            type:"GET",
            success:function (data) {
                // alert ("in success");
                var binid = $("#bingroup").val();
                // alert(binid);
                $('#bingroup').html(' ');
                var sel;
                for(var i = 0 ;i <data.length;i++){
                    objbin = data[i];
                    if(i==0)
                        sel = objbin.name;
                    if(binid==objbin.name){
                        sel = objbin.name;

                        $("#bingroup").append(
                            '<option value="' + objbin.name + '" selected>'
                            + objbin.name
                            + '</option>'
                        );
                    }
                    else {
                          $("#bingroup").append(
                        $('<option/>', {
                            value: objbin.name,
                            html: objbin.name
                        }));
                    }
                }
                 $("#bingroup").val(sel);
                // alert(sel);
            },
                error: function (xhr, errmsg, err) {
                    $('#results').html("<div class='alert-box alert radius' data-alert>Oops! We have encountered an error: " + errmsg +
                        " <a href='#' class='close'>&times;</a></div>"); // add the error to the dom
                    console.log(xhr.status + ": " + xhr.responseText);
                }
            });
    }
    function getToLocation(){
        $.ajax({
            url: "api/v1/products/getLocation/",
            type: "GET",
            success:function (data) {
                var loc;
                var locid=$("#tolocation").val();

                // alert($("#location").val());
                $("#tolocation").html('');
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
                        $("#tolocation").append(
                            '<option value="' + locobj.id + '" selected>'
                            + locobj.loc_name
                            + '</option>'
                        );
                    }
                    else{
                        // alert("In Not Selected");
                        $("#tolocation").append(
                        $('<option/>', {
                            value: locobj.id,
                            html: locobj.loc_name
                        }));
                    }

                }
                $("#tolocation").val(loc);
                // alert(loc);
                // alert($("#location").val(loc));
                getToLocationBingroup(loc);
            },
            // handle a non-successful response
            error: function (xhr, errmsg, err) {
                $('#results').html("<div class='alert-box alert radius' data-alert>Oops! We have encountered an error: " + errmsg +
                    " <a href='#' class='close'>&times;</a></div>"); // add the error to the dom
                console.log(xhr.status + ": " + xhr.responseText); // provide a bit more info about the error to the console
            }
        });
    }
    function  getToLocationBingroup(id) {
        $.ajax({
            url:"api/v1/products/getLocationBingroup/"+id,
            type:"GET",
            success:function (data) {
                // alert ("in success");
                var binid = $("#tobingroup").val();
                // alert(binid);
                $('#tobingroup').html(' ');
                var sel;
                for(var i = 0 ;i <data.length;i++){
                    objbin = data[i];
                    if(i==0)
                        sel = objbin.name;
                    if(binid==objbin.name){
                        sel = objbin.name;

                        $("#tobingroup").append(
                            '<option value="' + objbin.name + '" selected>'
                            + objbin.name
                            + '</option>'
                        );
                    }
                    else {
                          $("#tobingroup").append(
                        $('<option/>', {
                            value: objbin.name,
                            html: objbin.name
                        }));
                    }
                }
                 $("#tobingroup").val(sel);
                // alert(sel);
            },
                error: function (xhr, errmsg, err) {
                    $('#results').html("<div class='alert-box alert radius' data-alert>Oops! We have encountered an error: " + errmsg +
                        " <a href='#' class='close'>&times;</a></div>"); // add the error to the dom
                    console.log(xhr.status + ": " + xhr.responseText);
                }
            });
    }


})