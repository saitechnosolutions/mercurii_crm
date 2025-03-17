/* ---------- Select2 scripts ----------- */
// vendor scripts

$('#addvendor_state_list,#addvendor_cat_list,#addvendor_city_list').select2({
    placeholder: 'Search or Select',
    allowClear: true,
});

$(document).on("change", '.state_list', function () {

    fetchCitiesVendor($(this).val());
});

function fetchCitiesVendor(stateId) {
    if (stateId) {
        $.ajax({
            url: '/get-cities/' + stateId,
            method: 'GET',
            success: function (response) {
                $('#addvendor_city_list').empty().append('<option value=""> -- Choose City -- </option>');

                $.each(response, function (index, city) {
                    $('#addvendor_city_list').append(
                        `<option value="${city.id}">${city.city_name}</option>`
                    );
                });
            },
            error: function () {
                alert('Unable to fetch cities.');
            }
        });
    }
}

// add products page scripts

$('#product_category_select').select2({
    placeholder: 'Search or Select',
    allowClear: true,
});

function refreshSelect2Dropdown() {
    $('.product_category_po,.products_dropdown_po,.vendor_dropdown_po').select2({
        placeholder: 'Search or Select',
        allowClear: true,
    });
}

refreshSelect2Dropdown();


// to clone the po form fields

// $(".po-form-box .po-remove-btn:nth-child(1)").hide();

$("#po_add_product_plus").click(function () {
    var productBox = $(".po-form-box").first().clone(); // Clone the first form box

    productBox.find("input").val(""); // Clear input values
    productBox.find("select").val(null).trigger("change"); // Reset Select2 dropdowns

    // Remove old Select2 instance
    productBox.find("select").removeClass("select2-hidden-accessible").next(".select2-container").remove();

    $(".po-form-box").last().after(productBox); // Append after the last form box

    // Reinitialize Select2 for ALL dropdowns including new and old
    refreshSelect2Dropdown();
});

$(document).on("click", ".po-remove-btn", function () {
    $(this).closest('.po-form-box').remove();
});


// ajax functions

$(document).on('change', '.product_category_po', function () {
    var catId = $(this).val();
    var $this = $(this);
    // alert(catId);
    $.ajax({
        url: '/get-products/' + catId,
        method: 'GET',
        dataType: 'JSON',
        success: function (data) {


            if (data) {
                let $productDropdown = $this.closest('.po-form-box').find(".products_dropdown_po");

                $productDropdown.empty();
                $productDropdown.append('<option value="">-- Choose Product --</option>');

                let $vendorDropdown = $this.closest('.po-form-box').find(".vendor_dropdown_po");
                $vendorDropdown.empty();
                $vendorDropdown.append('<option value="">-- Choose Vendor --</option>');

                // append products data
                if (data.productData.length > 0) {
                    data.productData.forEach(function (item) {
                        let option = `<option value="${item.id}" data-existquantity="${item.quantity}" data-rate="${item.rate}" data-hsn="${item.hsn}" data-gst="${item.gst}">
                            ${item.productname}
                        </option>`;
                        $productDropdown.append(option);
                    });
                } else {
                    $productDropdown.append('<option value="">No products available</option>');
                }

                // append vendor data
                if (data.vendors.length > 0) {
                    data.vendors.forEach(function (item) {
                        let option = `<option value="${item.id}">
                            ${item.company_name}
                        </option>`;
                        $vendorDropdown.append(option);
                    });
                } else {
                    $vendorDropdown.append('<option value="">No vendors available</option>');
                }
            }
        },
        error: function (e) {
            Swal.fire({
                title: 'Erorr',
                text: 'Unable to fetch data, try again.',
                icon: 'error',
                confirmButtonText: 'OK'
            });

        }
    });
});

$(document).on("change", ".products_dropdown_po", function () {
    let selectedOption = $(this).find(':selected');
    var rate = parseFloat(selectedOption.data('rate'));
    var gst = parseFloat(selectedOption.data('gst'));
    var existQty = selectedOption.data('existquantity');
    $(this).closest('.po-form-box').find(".po_qty").val("1");
    $(this).closest('.po-form-box').find(".po_exist_qty").val(existQty);
    $(this).closest('.po-form-box').find(".po_unit_price").val(rate);
    $(this).closest('.po-form-box').find(".po_gst").val(gst);
    var qty = $(this).closest('.po-form-box').find(".po_qty").val();
    var subtotal = parseFloat(qty) * rate;
    $(this).closest('.po-form-box').find(".product_subtotal").val(subtotal);
    var productGstAmt = (rate / 100) * gst;
    var productTotal = rate + productGstAmt;
    $(this).closest('.po-form-box').find(".pro_tot_amt").val(productTotal);

    var roundOffTotal = Math.round(productTotal);

    if ($(this).closest('.po-form-box').find(".roundoff").prop("checked")) {
        $(this).closest('.po-form-box').find(".pro_tot_amt").val(roundOffTotal);
    } else {
        $(this).closest('.po-form-box').find(".pro_tot_amt").val(productTotal);
    }
});

$(document).on('click', '.roundoffCheckbox', function () {
    var rate = parseFloat($(this).closest('.po-form-box').find(".po_unit_price").val());
    var gst = parseFloat($(this).closest('.po-form-box').find(".po_gst").val());
    var qty = parseInt($(this).closest('.po-form-box').find(".po_qty").val());
    var productGstAmt = (rate / 100) * gst;
    var productTempTotal = rate + productGstAmt;
    var productTotal = qty * productTempTotal;
    var roundOffTotal = Math.round(productTotal);
    var subtotal = qty * rate;
    $(this).closest('.po-form-box').find(".product_subtotal").val(subtotal);

    if ($(this).prop("checked")) {

        $(this).closest('.form-group').find('.roundoff').val('1');
        if (productTotal != NaN) {
            $(this).closest('.po-form-box').find(".pro_tot_amt").val(roundOffTotal);
        } else {
            $(this).closest('.po-form-box').find(".pro_tot_amt").val('');
        }

    } else {
        $(this).closest('.form-group').find('.roundoff').val('0');
        if (productTotal != NaN) {
            $(this).closest('.po-form-box').find(".pro_tot_amt").val(productTotal);
        } else {
            $(this).closest('.po-form-box').find(".pro_tot_amt").val('');
        }
    }
});

// to calculate total amt when user type the quantity

$(document).on("input", ".po_qty", function () {
    var qty = parseInt($(this).val());
    var rate = parseFloat($(this).closest('.po-form-box').find(".po_unit_price").val());
    if (rate != NaN) {
        var gst = parseFloat($(this).closest('.po-form-box').find(".po_gst").val());
        var productGstAmt = (rate / 100) * gst;
        var productTempTotal = rate + productGstAmt;
        var productTotal = qty * productTempTotal;
        var roundOffTotal = Math.round(productTotal);
        var subtotal = qty * rate;
        $(this).closest('.po-form-box').find(".product_subtotal").val(subtotal);
        if ($(this).prop("checked")) {
            $(this).closest('.po-form-box').find(".pro_tot_amt").val(roundOffTotal);
        } else {
            $(this).closest('.po-form-box').find(".pro_tot_amt").val(productTotal);
        }
    }

});