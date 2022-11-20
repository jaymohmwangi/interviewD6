$(document).ready(function(){
    $(document).on('click', '#checkAll', function() {
        $(".itemRow").prop("checked", this.checked);
    });
    $(document).on('click', '.itemRow', function() {
        if ($('.itemRow:checked').length == $('.itemRow').length) {
            $('#checkAll').prop('checked', true);
        } else {
            $('#checkAll').prop('checked', false);
        }
    });
    var count = $(".itemRow").length;
    $(document).on('click', '#addRows', function() {
        count++;
        var htmlRows = '';
        htmlRows += '<tr>';
        htmlRows += '<td><input class="itemRow" type="checkbox"></td>';
        htmlRows += '<td><input type="text" name="description[]" id="description_'+count+'" class="form-control" required></td>';
        htmlRows += '<td><input type="checkbox" class="formcontrol" name="taxed[]" id="taxed_'+count+'" onchange="calculateTaxableTotal()" value="'+count+'"></td>';
        htmlRows += '<td><input type="number" name="amount[]" id="amount_'+count+'" class="form-control" required></td>';
        htmlRows += '</tr>';
        $('#invoiceItem').append(htmlRows);
    });
    $(document).on('click', '#removeRows', function(){
        $(".itemRow:checked").each(function() {
            $(this).closest('tr').remove();
        });
        $('#checkAll').prop('checked', false);
        calculateTotal();
        calculateTaxableTotal();
    });
    $(document).on('blur', "[id^=amount_]", function(){
        calculateTotal();
        calculateTaxableTotal();
    });
    $(document).on('blur', "#taxableAmount", function(){
        calculateTaxableTotal();
    });
    $(document).on('blur', "#taxRate", function(){
        calculateTotal();
    });
    $(document).on('blur', "#totalAftertax", function(){
        calculateTotal();
    });
    $(document).on('blur', "#amountDue", function(){
        calculateTotal();
    });
    $(document).on('blur', "#amountPaid", function(){
        var amountPaid = $(this).val();
        var totalAftertax = $('#totalAftertax').val();
        if(amountPaid && totalAftertax) {
            totalAftertax = totalAftertax-amountPaid;
            $('#amountDue').val(totalAftertax);
        } else {
            $('#amountDue').val(totalAftertax);
        }
    });
    $(document).on('click', '.deleteInvoice', function(){
        var id = $(this).attr("id");
        if(confirm("Are you sure you want to remove this?")){
            $.ajax({
                url:"action.php",
                method:"POST",
                dataType: "json",
                data:{id:id, action:'delete_invoice'},
                success:function(response) {
                    if(response.status == 1) {
                        $('#'+id).closest("tr").remove();
                    }
                }
            });
        } else {
            return false;
        }
    });
});
function calculateTaxableTotal(){

    var taxedValue=0;
    $("[id^='taxed_']:checked").each(function(index){
        //part where the magic happens
        if(!isNaN($(this).val())){
            taxedValue+=parseFloat($(this).val());
            console.log(index+' checkbox has value' +$(this).val());
        }

    });

    $("#taxableAmount").val(taxedValue)
    calculateTotal();
}
function calculateTotal(){
    var totalAmount = 0;

    $("[id^='amount_']").each(function() {
        var id = $(this).attr('id');
         id = id.replace("amount_",'');
         //reset the checkbox values
        $('#taxed_' + id).val(0)
        //get amount val
        var amount = parseFloat($('#amount_'+id).val());
        //check if > 0- dont allow negative value
        if(amount > 0) {
            //set the value of taxed checkbox
            $('#taxed_' + id).val(amount.toFixed(2))
            //calculate total amount
            totalAmount += parseFloat(amount);
        }
    });
    //set subtotal
    $('#subTotal').val(parseFloat(totalAmount).toFixed(2));
    var taxRate = $("#taxRate").val();
    var taxableAmount = $('#taxableAmount').val();
    var subTotal = $('#subTotal').val();
    //calculate tax if taxable amount and rate is set
    if(taxableAmount) {
        var taxAmount = ((parseFloat(taxableAmount)) * taxRate / 100).toFixed(2);
        $('#taxAmount').val(taxAmount);
    }
    if(subTotal) {
        subTotal = parseFloat(subTotal)+parseFloat(taxAmount);
        $('#totalAftertax').val(subTotal);
        var amountPaid = $('#amountPaid').val();
        var totalAftertax = $('#totalAftertax').val();
        if(amountPaid && totalAftertax) {
            totalAftertax = totalAftertax-amountPaid;
            $('#amountDue').val(totalAftertax);
        } else {
            $('#amountDue').val(subTotal);
        }
    }
}


