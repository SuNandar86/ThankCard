$(function () {
    $(document).ajaxStart($.blockUI).ajaxStop($.unblockUI);

    getProductGroup();
    getJewelType();
    getDesignGroup();
    getDesignTypeGroup();
    // getDesignTypeGroup();
    // getProductSubGroup(id);
    // getJewelType();
    // getDiamondColor();
    // getDiamondType();
    // getProduct(id);

    // $('#productedit').click(function () {
    //     alert("Hi");
    //     getProduct($('#productedit').val());
    // });

    // function getProduct(id) {
    //     alert("This is get product");
    //     $.ajax({
    //         url: "/inventory/api/v1/product/get_product/" + id, // the endpoint
    //         method: 'POST',
    //         success:function (data) {
    //             $('#hidden_id').val(data['id']);
    //             $('#hidden_photoid').val(data['photo']);
    //             $('#name').val(data['name']);
    //             $('#designname').val(data['designname']);
    //             $('#barcode').val(data['barcode']);
    //             $('#tag').val(data['tag']);
    //             $('#pgroup').val(data['pgroup']);
    //             $('#psubgroup').val(data['psubgroup']);
    //             $('#preduce').val(data['preduce']);
    //             $('#plength').val(data['plength']);
    //             $('#maxqty').val(data['maxqty']);
    //             $('#minqty').val(data['minqty']);
    //             $('#labourcharge').val(data['labourcharge']);
    //             $('#sellinglabourcharge').val(data['sellinglabourcharge']);
    //             $('#remarks').val(data['remarks']);
    //             $('#row_no').val(data['row_no']);
    //             $('#diamondtype').val(data['diamondtype']);
    //             $('#diamondshape').val(data['diamondshape']);
    //             $('#diamondcolor').val(data['diamondcolor']);
    //             $('#diamond').val(data['diamond']);
    //             $('#diamondmeasurement').val(data['diamondmeasurement']);
    //             $('#diamondclarity').val(data['diamondclarity']);
    //             $('#diamondcaratweight').val(data['diamondcaratweight']);
    //             $('#jeweltype').val(data['jeweltype']);
    //             $('#jewelshape').val(data['jewelshape']);
    //             $('#jewellength').val(data['jewellength']);
    //             $('#jewelcost').val(data['jewelcost']);
    //             $('#jewelprice').val(data['jewelprice']);
    //             $('#active').val(data['active']);
    //         },
    //         // handle a non-successful response
    //          error: function (xhr, errmsg, err) {
    //             $('#results').html("<div class='alert-box alert radius' data-alert>Oops! We have encountered an error: " + errmsg +
    //                 " <a href='#' class='close'>&times;</a></div>"); // add the error to the dom
    //             console.log(xhr.status + ": " + xhr.responseText); // provide a bit more info about the error to the console
    //         }
    //     })
    // }

    // function getProductLength(psgroup_id) {
    //     $.ajax({
    //         url: "api/v1/products/get_productlength/" + psgroup_id, // the endpoint
    //         type: "GET", // http method
    //         // handle a successful response
    //         success: function (data) {
    //             var sel;
    //             for (var i = 0; i < data.length; i++) {
    //                 plength = data[i];
    //                 if (i == 0)
    //                     sel = plength.id
    //                 $("#plength").append(
    //                     $('<option/>', {
    //                         value: plength.id,
    //                         html: plength.plength
    //                     }));
    //             }
    //             $("#plength").val(sel)
    //         },
    //         // handle a non-successful response
    //         error: function (xhr, errmsg, err) {
    //             $('#results').html("<div class='alert-box alert radius' data-alert>Oops! We have encountered an error: " + errmsg +
    //                 " <a href='#' class='close'>&times;</a></div>"); // add the error to the dom
    //             console.log(xhr.status + ": " + xhr.responseText); // provide a bit more info about the error to the console
    //         }
    //     });
    // }
 function getLocation(){
        $.ajax({
            url: "api/v1/products/get_location/",
            type: "GET",
            success:function (data) {
                var loc;
                var locid=$("#location").val();

                // alert("in location");
                $("#location").html('');
                for (var i = 0; i < data.length; i++) {
                    location = data[i];
                    if(i==0)
                        {
                            loc=location.id;
                        }
                    if(locid==location.id)
                    {
                        loc = location.id;
                        // alert('in selected');
                        $("#location").append(
                            '<option value="' + location.id + '" selected>'
                            + location.loc_name
                            + '</option>'
                        );
                    }
                    else{

                        $("#location").append(
                        $('<option/>', {
                            value: location.id,
                            html: location.loc_name
                        }));
                    }

                }
                $("#location").val(loc);
                alert($("#location").val(loc));
                getBinGroup(loc);
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
    getLocation();



    $('#location').change(function () {
        alert("In Change");
        // alert($('#pgroup').val());
        getLocationBingroup($('#location').val());
        getBinGroup($('#location').val());
        // getProSubGroup($('#location').val());//updated by SSM to use the text input search in product sub group4/5/2018
    });

    $('#product').change(function () {
     // alert('In change');
    // alert($('#pgroup').val());
        getSmithLength($('#product').val())
    });

    function getSmithLength( id ) {
        console.log($('#product').val());
        // alert("Hello");
        $.ajax({

            url: "api/v1/products/get_smithlength/" + id, // the endpoint
            type: "GET", // http method
            // handle a successful response
            success: function (data) {
                // alert('hello success');
                var psid=$("#length").val();
                // alert("productlengthdetail");
                $('#length').html(' ');
                var sel;
                for (var i = 0; i < data.length; i++) {
                   // alert(i);
                    length = data[i];
                  //  alert(psgroup.name);
                    if (i == 0)
                        sel = length.id;
                     if(psid==length.id)
                    {
                        sel = length.id;
                        // alert('in selected');
                        $("#length").append(
                            '<option value="' + length.id + '" selected>'
                            + length.plength
                            + '</option>'
                        );
                    }
                    else{

                        $("#length").append(
                        $('<option/>', {
                            value: length.id,
                            html: length.plength
                        }));
                    }

                    // $("#psgroup").append(
                    //     $('<option/>', {
                    //         value: psgroup.id,
                    //         html: psgroup.name
                    //     }));
                }
                $("#length").val(sel);
                // $("#plength").val(sel);

                // getProductLength(sel);
            },
            // handle a non-successful response
            error: function (xhr, errmsg, err) {
                $('#results').html("<div class='alert-box alert radius' data-alert>Oops! We have encountered an error: " + errmsg +
                    " <a href='#' class='close'>&times;</a></div>"); // add the error to the dom
                console.log(xhr.status + ": " + xhr.responseText); // provide a bit more info about the error to the console
            }
        });
    }

    function getProduct(id) {
        $.ajax({

            url: "api/v1/products/get_product/" + id, // the endpoint
            type: "GET", // http method
            // handle a successful response
            success: function (data) {
                // alert('hello success');
                var psid=$("#product").val();
                // alert(psid);
                $('#product').html(' ');
                //clean list
                var sel;
                for (var i = 0; i < data.length; i++) {
                   // alert(i);
                    product = data[i];
                  //  alert(psgroup.name);
                    if (i == 0)
                        sel = product.id;
                     if(psid==product.id)
                    {
                        sel = product.id;
                        // alert('in selected');
                        $("#product").append(
                            '<option value="' + product.id + '" selected>'
                            + product.designname +' ('+product.name +')'
                            + '</option>'
                        );
                    }
                    else{

                        $("#product").append(
                        $('<option/>', {
                            value: product.id,
                            html: product.designname +' ('+product.name+')'
                        }));
                    }

                    // $("#psgroup").append(
                    //     $('<option/>', {
                    //         value: psgroup.id,
                    //         html: psgroup.name
                    //     }));
                }
                $("#product").val(sel);

            },
            // handle a non-successful response
            error: function (xhr, errmsg, err) {
                $('#results').html("<div class='alert-box alert radius' data-alert>Oops! We have encountered an error: " + errmsg +
                    " <a href='#' class='close'>&times;</a></div>"); // add the error to the dom
                console.log(xhr.status + ": " + xhr.responseText); // provide a bit more info about the error to the console
            }
        });
    }

    function getProductLength(id) {
        $.ajax({

            url: "api/v1/products/get_productlength/" + id, // the endpoint
            type: "GET", // http method
            // handle a successful response
            success: function (data) {
                // alert('hello success');
                var psid=$("#plength").val();
                // alert("productlengthdetail");
                $('#plength').html(' ');
                var sel;
                for (var i = 0; i < data.length; i++) {
                   // alert(i);
                    plength = data[i];
                  //  alert(psgroup.name);
                    if (i == 0)
                        sel = plength.id;
                    if(psid == plength.id)
                    {
                        sel = plength.id;
                        // alert('in selected');
                        $("#plength").append(
                            '<option value="' + plength.id + '" selected>'
                            + plength.plength +'(' +plength.fromweight+' to '+plength.toweight+' )'+
                            '</option>'
                        );
                        // var aa = document.getElementById(plength.fromweight);
                        console.log(Object.values(plength.plength));
                    }
                    else{
                        // alert("in else");
                             $("#plength").append(
                                 $('<option/>', {
                                     value: plength.id,
                                     html: plength.plength+'('+plength.fromweight+' to '+plength.toweight+')'
                                 }));
                    }
                }
                $("#plength").val(sel);
            },
            error: function (xhr, errmsg, err) {
                $('#results').html("<div class='alert-box alert radius' data-alert>Oops! We have encountered an error: " + errmsg +
                    " <a href='#' class='close'>&times;</a></div>"); // add the error to the dom
                console.log(xhr.status + ": " + xhr.responseText); // provide a bit more info about the error to the console
            }
        });
    }
    function getProductGroup() {
        $.ajax({
            url: "api/v1/products/get_productgroup/", // the endpoint
            type: "GET", // http method
            // handle a successful response
            success: function (data) {

                var sel;
                var pid=$("#pgroup").val();

                // alert(pid);
                $("#pgroup").html('');
                for (var i = 0; i < data.length; i++) {
                    pgroup = data[i];
                    if(i==0)
                        {
                            sel=pgroup.id;
                        }
                    if(pid==pgroup.id)
                    {
                        sel = pgroup.id;
                        // alert('in selected');
                        $("#pgroup").append(
                            '<option value="' + pgroup.id + '" selected>'
                            + pgroup.name
                            + '</option>'
                        );
                    }
                    else{

                        $("#pgroup").append(
                        $('<option/>', {
                            value: pgroup.id,
                            html: pgroup.name
                        }));
                    }

                }
                $("#pgroup").val(sel);
                getProductSubGroup(sel);
                getProSubGroup(sel);
            },
            // handle a non-successful response
            error: function (xhr, errmsg, err) {
                $('#results').html("<div class='alert-box alert radius' data-alert>Oops! We have encountered an error: " + errmsg +
                    " <a href='#' class='close'>&times;</a></div>"); // add the error to the dom
                console.log(xhr.status + ": " + xhr.responseText); // provide a bit more info about the error to the console
            }
        });
    }
    function getDesignGroup() {
        $.ajax({
            url: "api/v1/products/getProductGroup/", // the endpoint
            type: "GET", // http method
            // handle a successful response
            success: function (data) {

                var sel;
                var pid=$("#dgroup").val();

                // alert(pid);
                $("#dgroup").html('');
                for (var i = 0; i < data.length; i++) {
                    dgroup = data[i];
                    if(i==0)
                        {
                            sel=dgroup.id;
                        }
                    if(pid==dgroup.id)
                    {
                        sel = dgroup.id;
                        // alert('in selected');
                        $("#dgroup").append(
                            '<option value="' + dgroup.id + '" selected>'
                            + dgroup.name
                            + '</option>'
                        );
                    }
                    else{

                        $("#dgroup").append(
                        $('<option/>', {
                            value: dgroup.id,
                            html: dgroup.name
                        }));
                    }

                }
                $("#dgroup").val(sel);
                getPGroupProduc($("#dgroup").val(sel));
            },
            // handle a non-successful response
            error: function (xhr, errmsg, err) {
                $('#results').html("<div class='alert-box alert radius' data-alert>Oops! We have encountered an error: " + errmsg +
                    " <a href='#' class='close'>&times;</a></div>"); // add the error to the dom
                console.log(xhr.status + ": " + xhr.responseText); // provide a bit more info about the error to the console
            }
        });
    }
    function getDesignTypeGroup() {
        $.ajax({
            url: "api/v1/products/getProductGroup/", // the endpoint
            type: "GET", // http method
            // handle a successful response
            success: function (data) {
                // alert("IN Design Type Group Sucess");
                var sel;
                var pid=$("#designgroup").val();

                // alert(pid);
                $("#designgroup").html('');
                for (var i = 0; i < data.length; i++) {
                    designgroup = data[i];
                    if(i==0)
                        {
                            sel=designgroup.id;
                        }
                    if(pid==designgroup.id)
                    {
                        sel = designgroup.id;
                        // alert('in selected');
                        $("#designgroup").append(
                            '<option value="' + designgroup.id + '" selected>'
                            + designgroup.name
                            + '</option>'
                        );
                    }
                    else{

                        $("#designgroup").append(
                        $('<option/>', {
                            value: designgroup.id,
                            html: designgroup.name
                        }));
                    }

                }
                $("#designgroup").val(sel);
                getDesignName($("#designgroup").val(sel));
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
        // alert('In change');
        // alert($('#pgroup').val());

        getProductSubGroup($('#pgroup').val());
        getProSubGroup($('#pgroup').val());//updated by SSM to use the text input search in product sub group4/5/2018
    });
      $('#dgroup').change(function () {
        // alert('In change');
        // alert($('#pgroup').val());
        getPGroupProduc($('#dgroup').val());
        // getDesignName($('#designgroup').val());
    });
      $('#designgroup').change(function () {
        // alert('In change');

        // alert($('#pgroup').val());
        getDesignName($('#designgroup').val());
    });
function getPGroupProduc(id) {
        $.ajax({

            url: "api/v1/products/getProducts/" + id, // the endpoint
            type: "GET", // http method
            // handle a successful response
            success: function (data) {
                // alert('hello success');
                var psid=$("#product").val();
                // alert(psid);
                $('#product').html(' ');
                //clean list
                var sel;
                for (var i = 0; i < data.length; i++) {
                   // alert(i);
                    product = data[i];
                  //  alert(psgroup.name);
                    if (i == 0)
                        sel = product.id;
                     if(psid==product.id)
                    {
                        sel = product.id;
                        // alert('in selected');
                        $("#product").append(
                            '<option value="' + product.id + '" selected>'
                            + product.designname
                            + '</option>'
                        );
                    }
                    else{

                        $("#product").append(
                        $('<option/>', {
                            value: product.id,
                            html: product.designname
                        }));
                    }

                    // $("#psgroup").append(
                    //     $('<option/>', {
                    //         value: psgroup.id,
                    //         html: psgroup.name
                    //     }));
                }
                $("#product").val(sel);

            },
            // handle a non-successful response
            error: function (xhr, errmsg, err) {
                $('#results').html("<div class='alert-box alert radius' data-alert>Oops! We have encountered an error: " + errmsg +
                    " <a href='#' class='close'>&times;</a></div>"); // add the error to the dom
                console.log(xhr.status + ": " + xhr.responseText); // provide a bit more info about the error to the console
            }
        });
    }
function getDesignName(id) {
        $.ajax({

            url: "api/v1/products/getProducts/" + id, // the endpoint
            type: "GET", // http method
            // handle a successful response
            success: function (data) {
                // alert('hello in Pro Sub Group');
                // var psid=$("#psgroup").val();
                // alert(psid);
                $('#default_loc').html(' ');
                // alert($("#default_sub").val());
                var product=$("#product").val();
                // alert($("#psubgroup").val());
                $("#product").html(' ');
                // $("#psubgroup").val(product);
                var sel;
                // alert(data.length);
                for (var i = 0; i < data.length; i++) {
                   // alert(i);
                    psgroup = data[i];
                    // alert(psgroup.name);
                    $("#default_loc").append(
                            '<option value="' + psgroup.designname + '" >'

                            + '</option>'
                        );

                }

            },
            // handle a non-successful response
            error: function (xhr, errmsg, err) {
                $('#results').html("<div class='alert-box alert radius' data-alert>Oops! We have encountered an error: " + errmsg +
                    " <a href='#' class='close'>&times;</a></div>"); // add the error to the dom
                console.log(xhr.status + ": " + xhr.responseText); // provide a bit more info about the error to the console
            }
        });
    }

    //updated by SSM to make text search input in Product Sub Group 4/5/2018
    function getProSubGroup(id) {
        $.ajax({

            url: "api/v1/products/get_prosubgroup/" + id, // the endpoint
            type: "GET", // http method
            // handle a successful response
            success: function (data) {
                // alert('hello in Pro Sub Group');
                // var psid=$("#psgroup").val();
                // alert(psid);
                $('#default_sub').html(' ');
                // alert($("#default_sub").val());
                var product=$("#psubgroup").val();
                // alert($("#psubgroup").val());
                $("#psubgroup").html(' ');
                // $("#psubgroup").val(product);
                var sel;
                // alert(data.length);
                for (var i = 0; i < data.length; i++) {
                   // alert(i);
                    psgroup = data[i];
                    // alert(psgroup.name);
                    $("#default_sub").append(
                            '<option value="' + psgroup.name + '" >'

                            + '</option>'
                        );

                }

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
            url:"api/v1/products/get_locationbingroup/"+id,
            type:"GET",
            success:function (data) {
                var binid = $("#bingroup").val();
                $('#bingroup').html(' ');
                var sel;
                for(var i = 0 ;i <data.length;i++){
                    bingroup = data[i];
                    if(i==0)
                        sel = bingroup.id;
                    if(binid==bingroup.id){
                        sel = bingroup.id;

                        $('#bingroup').append(
                            '<input type="checkbox" value="\' + bingroup.id + \'" checked>' + bingroup.name
                        );
                    }
                    else {
                          $("#bingroup").append(
                        $('<option/>', {
                            value: bingroup.id,
                            html: bingroup.name
                        }));
                    }
                }
                $("#bingroup.id").val();
            },
                error: function (xhr, errmsg, err) {
                    $('#results').html("<div class='alert-box alert radius' data-alert>Oops! We have encountered an error: " + errmsg +
                        " <a href='#' class='close'>&times;</a></div>"); // add the error to the dom
                    console.log(xhr.status + ": " + xhr.responseText);
                }
            });
    }
    
    function getBinGroup(id) {
        $.ajax({
            url: "api/v1/products/get_bingroup/" + id, // the endpoint
            type: "GET", // http method
            // handle a successful response
            success: function (data) {
                // alert('hello success');
                var psid=$("#bin").val();
                // alert(psid);
                $('#bin').html(' ');
                var sel;
                for (var i = 0; i < data.length; i++) {
                   // alert(i);
                    bin = data[i];
                  //  alert(bin_group.name);
                    if (i == 0)
                        sel = bin.id;
                     if(psid==bin.id)
                    {
                        sel = bin.id;
                        // alert('in selected');
                        $("#bin").append(
                            '<input type="checkbox" value="' + bin.id + '" checked>'
                            + bin.name
                        );
                    }
                    else{

                        $("#bin").append(
                        $('<option/>', {
                            value: bin.id,
                            html: bin.name
                        }));
                    }

                    // $("#psgroup").append(
                    //     $('<option/>', {
                    //         value: psgroup.id,
                    //         html: psgroup.name
                    //     }));
                }
                $("#bin").val(sel);
                // getProduct(sel);
                // getProductLength(sel);
            },
            // handle a non-successful response
            error: function (xhr, errmsg, err) {
                $('#results').html("<div class='alert-box alert radius' data-alert>Oops! We have encountered an error: " + errmsg +
                    " <a href='#' class='close'>&times;</a></div>"); // add the error to the dom
                console.log(xhr.status + ": " + xhr.responseText); // provide a bit more info about the error to the console
            }
        });
    }

    function getProductSubGroup(id) {
        $.ajax({

            url: "api/v1/products/get_productsubgroup/" + id, // the endpoint
            type: "GET", // http method
            // handle a successful response
            success: function (data) {
                // alert('hello success');
                var psid=$("#psgroup").val();
                // alert(psid);
                $('#psgroup').html(' ');
                var sel;
                for (var i = 0; i < data.length; i++) {
                   // alert(i);
                    psgroup = data[i];
                  //  alert(psgroup.name);
                    if (i == 0)
                        sel = psgroup.id;
                     if(psid==psgroup.id)
                    {
                        sel = psgroup.id;
                        // alert('in selected');
                        $("#psgroup").append(
                            '<option value="' + psgroup.id + '" selected>'
                            + psgroup.name
                            + '</option>'
                        );
                    }
                    else{

                        $("#psgroup").append(
                        $('<option/>', {
                            value: psgroup.id,
                            html: psgroup.name
                        }));
                    }

                    // $("#psgroup").append(
                    //     $('<option/>', {
                    //         value: psgroup.id,
                    //         html: psgroup.name
                    //     }));
                }
                $("#psgroup").val(sel);
                getProduct(sel);
                getProductLength(sel);
            },
            // handle a non-successful response
            error: function (xhr, errmsg, err) {
                $('#results').html("<div class='alert-box alert radius' data-alert>Oops! We have encountered an error: " + errmsg +
                    " <a href='#' class='close'>&times;</a></div>"); // add the error to the dom
                console.log(xhr.status + ": " + xhr.responseText); // provide a bit more info about the error to the console
            }
        });
    }

    $('#psgroup').change(function () {
        // alert('In change sub group');
        // alert($('#pgroup').val());
        getProduct($('#psgroup').val());
        getProductLength($('#psgroup').val());
    });

    $('#reduce_y').change(function () {
        // alert("in change");
        // getProductGroup();
        var reduce_k=$("#reduce_k").val()
        // alert(reduce_k);
        var reduce_p=$("#reduce_p").val();
        // alert(reduce_p);
        var reduce_y=$("#reduce_y").val();
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
        $('#reduce_g').html(' ');
        // document.getElementById('reduce_g').value=weight;

        $('#reduce_g').val(gram.toFixed(4));
        // alert(weight);
        getProSubGroup($('#pgroup').val());
        getProduct($('#psgroup').val());
        getProductLength($('#psgroup').val());

    });

    $('#cost_reduce_y').change(function () {
        // alert("in cost change");
        // getProductGroup();
        var reduce_k=$("#cost_reduce_k").val();
        var reduce_p=$("#cost_reduce_p").val();
        var reduce_y=$("#cost_reduce_y").val();

        var y=parseFloat(reduce_y);
        var p=parseInt(reduce_p);
        var k=parseInt(reduce_k);
        var weight= (((y / 8) + p) / 16) + k;

        // alert(weight);
        var gram=weight*16.606;
        // alert(gram.toFixed(4));
        $('#cost_reduce_g').html(' ');
        // document.getElementById('reduce_g').value=weight;

        $('#cost_reduce_g').val(gram.toFixed(4));
        // alert(weight);


        // document.getElementById('cost_reduce_g').value=weight;

        // document.getElementById('reduce_g').value=weight;


        getProSubGroup($('#pgroup').val());
        getProduct($('#psgroup').val());
        getProductLength($('#psgroup').val());

    });






    function getJewelType() {
        $.ajax({
            url: "api/v1/products/get_jeweltype/", // the endpoint
            type: "GET", // http method
            // handle a successful response

            success: function (data) {
                var sel;
                 // alert("In Jewel Type");
                for (var i = 0; i < data.length; i++) {
                    jeweltype = data[i];
                    if (i == 0)
                        sel = jeweltype.id;
                    $("#jeweltype").append(
                        $('<option/>', {
                            value: jeweltype.id,
                            html: jeweltype.name
                        }));
                }
                $("#jeweltype").val(sel)
                getJewelShape(sel)
            },
            // handle a non-successful response
            error: function (xhr, errmsg, err) {
                $('#results').html("<div class='alert-box alert radius' data-alert>Oops! We have encountered an error: " + errmsg +
                    " <a href='#' class='close'>&times;</a></div>"); // add the error to the dom
                console.log(xhr.status + ": " + xhr.responseText); // provide a bit more info about the error to the console
            }
        });
    }

    function getJewelShape(jeweltype_id) {
        $.ajax({
            url: "api/v1/products/get_jewelshape/" + jeweltype_id, // the endpoint
            type: "GET", // http method
            // handle a successful response
            success: function (data) {
                $('#jewelshape').html(' ');
                var sel;
                for (var i = 0; i < data.length; i++) {
                    jeweltype = data[i]
                    if (i == 0)
                        sel = jeweltype.id

                    $("#jewelshape").append(
                        $('<option/>', {
                            value: jeweltype.id,
                            html: jeweltype.name
                        }));
                }
                $("#jewelshape").val(sel);
                // getJewelLength(sel);
            },
            // handle a non-successful response
            error: function (xhr, errmsg, err) {
                $('#results').html("<div class='alert-box alert radius' data-alert>Oops! We have encountered an error: " + errmsg +
                    " <a href='#' class='close'>&times;</a></div>"); // add the error to the dom
                console.log(xhr.status + ": " + xhr.responseText); // provide a bit more info about the error to the console
            }
        });
    }

    // function getJewelLength(jewelshape_id) {
    //     $.ajax({
    //         url: "api/v1/products/get_jewellength/" + jewelshape_id, // the endpoint
    //         type: "GET", // http method
    //         // handle a successful response
    //         success: function (data) {
    //             var sel;
    //             for (var i = 0; i < data.length; i++) {
    //                 jewellength = data[i];
    //                 if (i == 0)
    //                     sel = jewellength.id
    //                 $("#jewellength").append(
    //                     $('<option/>', {
    //                         value: jewellength.id,
    //                         html: jewellength.name
    //                     }));
    //             }
    //             $("#jewellength").val(sel)
    //         },
    //         // handle a non-successful response
    //         error: function (xhr, errmsg, err) {
    //             $('#results').html("<div class='alert-box alert radius' data-alert>Oops! We have encountered an error: " + errmsg +
    //                 " <a href='#' class='close'>&times;</a></div>"); // add the error to the dom
    //             console.log(xhr.status + ": " + xhr.responseText); // provide a bit more info about the error to the console
    //         }
    //     });
    // }
    //
    $('#jeweltype').change(function () {
        getJewelShape($('#jeweltype').val());
    });
    // $('#jewelshape').change(function () {
    //     getJewelLength($('#jewelshape').val());
    // });
    //
    // function getDiamondColor() {
    //     $.ajax({
    //         url: "api/v1/products/get_diamondcolor/", // the endpoint
    //         type: "GET", // http method
    //         // handle a successful response
    //         success: function (data) {
    //             var sel;
    //             for (var i = 0; i < data.length; i++) {
    //                 diamondcolor = data[i];
    //                 if (i == 0)
    //                     sel = diamondcolor.id
    //                 $("#diamondcolor").append(
    //                     $('<option/>', {
    //                         value: diamondcolor.id,
    //                         html: diamondcolor.name
    //                     }));
    //             }
    //             $("#diamondcolor").val(sel)
    //         },
    //         // handle a non-successful response
    //         error: function (xhr, errmsg, err) {
    //             $('#results').html("<div class='alert-box alert radius' data-alert>Oops! We have encountered an error: " + errmsg +
    //                 " <a href='#' class='close'>&times;</a></div>"); // add the error to the dom
    //             console.log(xhr.status + ": " + xhr.responseText); // provide a bit more info about the error to the console
    //         }
    //     });
    // }
    //
    // function getDiamondType() {
    //     $.ajax({
    //         url: "api/v1/products/get_diamondtype/", // the endpoint
    //         type: "GET", // http method
    //         // handle a successful response
    //         success: function (data) {
    //             var sel;
    //             for (var i = 0; i < data.length; i++) {
    //                 diamondtype = data[i];
    //                 if (i == 0)
    //                     sel = diamondtype.id;
    //                 $("#diamondtype").append(
    //                     $('<option/>', {
    //                         value: diamondtype.id,
    //                         html: diamondtype.name
    //                     }));
    //             }
    //             $("#diamondtype").val(sel)
    //             getDiamondShape(sel)
    //         },
    //         // handle a non-successful response
    //         error: function (xhr, errmsg, err) {
    //             $('#results').html("<div class='alert-box alert radius' data-alert>Oops! We have encountered an error: " + errmsg +
    //                 " <a href='#' class='close'>&times;</a></div>"); // add the error to the dom
    //             console.log(xhr.status + ": " + xhr.responseText); // provide a bit more info about the error to the console
    //         }
    //     });
    // }
    //
    // function getDiamondShape(diamondtype_id) {
    //     $.ajax({
    //         url: "api/v1/products/get_diamondshape/" + diamondtype_id, // the endpoint
    //         type: "GET", // http method
    //         // handle a successful response
    //         success: function (data) {
    //             $('#diamondshape').html(' ');
    //             var sel;
    //             for (var i = 0; i < data.length; i++) {
    //                 diamondtype = data[i]
    //                 if (i == 0)
    //                     sel = diamondtype.id
    //
    //                 $("#diamondshape").append(
    //                     $('<option/>', {
    //                         value: diamondtype.id,
    //                         html: diamondtype.name
    //                     }));
    //             }
    //             $("#diamondshape").val(sel)
    //         },
    //         // handle a non-successful response
    //         error: function (xhr, errmsg, err) {
    //             $('#results').html("<div class='alert-box alert radius' data-alert>Oops! We have encountered an error: " + errmsg +
    //                 " <a href='#' class='close'>&times;</a></div>"); // add the error to the dom
    //             console.log(xhr.status + ": " + xhr.responseText); // provide a bit more info about the error to the console
    //         }
    //     });
    // }
    //
    //
    // $('#diamondtype').change(function () {
    //     getDiamondShape($('#diamondtype').val());
    // });

    // This function gets cookie with a given name
    function getCookie(name) {
        var cookieValue = null;
        if (document.cookie && document.cookie != '') {
            var cookies = document.cookie.split(';');
            for (var i = 0; i < cookies.length; i++) {
                var cookie = jQuery.trim(cookies[i]);
                // Does this cookie string begin with the name we want?
                if (cookie.substring(0, name.length + 1) == (name + '=')) {
                    cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                    break;
                }
            }
        }
        return cookieValue;
    }

    var csrftoken = getCookie('csrftoken');

    /*
    The functions below will create a header with csrftoken
    */

    function csrfSafeMethod(method) {
        // these HTTP methods do not require CSRF protection
        return (/^(GET|HEAD|OPTIONS|TRACE)$/.test(method));
    }

    function sameOrigin(url) {
        // test that a given url is a same-origin URL
        // url could be relative or scheme relative or absolute
        var host = document.location.host; // host + port
        var protocol = document.location.protocol;
        var sr_origin = '//' + host;
        var origin = protocol + sr_origin;
        // Allow absolute or scheme relative URLs to same origin
        return (url == origin || url.slice(0, origin.length + 1) == origin + '/') ||
            (url == sr_origin || url.slice(0, sr_origin.length + 1) == sr_origin + '/') ||
            // or any other URL that isn't scheme relative or absolute i.e relative.
            !(/^(\/\/|http:|https:).*/.test(url));
    }

    $.ajaxSetup({
        beforeSend: function (xhr, settings) {
            if (!csrfSafeMethod(settings.type) && sameOrigin(settings.url)) {
                // Send the token to same-origin, relative URLs only.
                // Send the token only if the method warrants CSRF protection
                // Using the CSRFToken value acquired earlier
                xhr.setRequestHeader("X-CSRFToken", csrftoken);
            }
        }
    });
});