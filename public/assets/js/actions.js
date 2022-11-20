"use strict";
var formActions={
    saveInvoice: function (data, form) {
        $(".page-loader").removeClass("is-hidden");
        var url = form.attr('action');
        $.ajax({
            url: url,
            method: "POST",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            success: function (data) {
                console.log(data)
                if (data['success']) {
                    GrowlNotification.notify({
                        title: '',
                        description: data['message'],
                        type: 'success',
                        position: 'top-right',
                        showProgress: true,
                        closeTimeout: 30000
                    });
                    setTimeout(function () {
                       location.reload();
                    }, 1000);
                    $(".page-loader").addClass("is-hidden");
                }
            },
            error: function (data) {
                console.error(data.responseJSON.message)
                $(".page-loader").addClass("is-hidden");
                if (data.status === 500) {
                    GrowlNotification.notify({
                        title: '',
                        description: data.responseJSON.message,
                        type: 'warning',
                        position: 'top-right',
                        showProgress: true,
                        closeTimeout: 30000
                    });
                } else {
                    var errors = data.responseJSON;
                    $.each(errors.errors, function (key, value) {
                        GrowlNotification.notify({
                            title: '',
                            description: value[0],
                            type: 'warning',
                            position: 'top-right',
                            showProgress: true,
                            closeTimeout: 30000
                        });
                    });
                }
            }
        })
    },
    showBillTo: function () {
        $(".page-loader").removeClass("is-hidden");
        var id= $("#customer_id").val();
        $.ajax({
            url: '/api/customer/'+id,
            method: "GET",
            processData: false,
            contentType: false,
            cache: false,
            success: function (data) {
                if (data['success']) {
                    //set the
                    let customer=data['customer'];
                    if(customer) {
                        $("#bill-to-data").empty().append('<span > <b>Name:</b> ' + customer.contact_person_name + '</span><br>\n' +
                            '<span>   <b>Company:</b> ' + customer.name + '</span><br>\n' +
                            ' <span>   <b>Email: </b>' + customer.email + '</span><br>\n' +
                            '<span>  <b>Phone: </b>' + customer.phone + '</span><br>\n' +
                            ' <span>   <b>Street:</b> ' + customer.city + ', ' + customer.street + ', ' + customer.post_code + '</span>');
                        $("#bill-to").slideDown();
                    }
                    $(".page-loader").addClass("is-hidden");
                }
            },
            error: function (data) {

                $(".page-loader").addClass("is-hidden");
                if (data.status === 500) {
                    GrowlNotification.notify({
                        title: '',
                        description: "Your request encounter a problem. Your change were not saved. Please try again. If issue persist please reach out to our support team.",
                        type: 'warning',
                        position: 'top-right',
                        showProgress: true,
                        closeTimeout: 30000
                    });
                } else {
                    var errors = data.responseJSON;
                    $.each(errors.errors, function (key, value) {
                        GrowlNotification.notify({
                            title: '',
                            description: value[0],
                            type: 'warning',
                            position: 'top-right',
                            showProgress: true,
                            closeTimeout: 30000
                        });
                    });
                }
            }
        })
    },
};
