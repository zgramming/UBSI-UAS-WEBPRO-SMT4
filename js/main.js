// Call the dataTables jQuery plugin
 $(document).ready(function() {
     $('#dataTable').DataTable();
    });
    
    
function cekMaxQty() {
        var maxQty = parseInt($("#max_qty").val());
        var num = $("#increment_quantity").val();
        num = replaceComma(num);

        if (num > maxQty) {
            $("#error_qty").show();
            $("#increment_quantity").val(maxQty);
        } else {
            $("#error_qty").hide();
        }
}

function toggleIncrement(type='plus') {
    var num = $("#increment_quantity").val();
    var maxQty = parseInt($("#max_qty").val());

    num = replaceComma(num);
    if (type =='plus') {
        num++;
        if (num > maxQty) {
            $("#increment_quantity").val(maxQty);
        } else {
            $("#increment_quantity").val(num);
        }
            
    } else {
        num--;
        if (num < 0) {
            num = 0;
        }
        if (num <= maxQty) {
            $("#error_qty").hide();
        }
        $("#increment_quantity").val(num);
        
    }
}

function replaceComma(num) {
    return parseInt(num.replace(/,/g, ''));    
}
 
function cekAngka(elem) {
     replace = formatCurrency(elem.value.replace(/[\\A-Za-z!"?$%^&*+_={}; ()\-\:'/@#~,?\<script>?|`?\]\[]/g, ''));
     if (replace.length == 0) replace = 0;
     elem.value = replace;
 }

function cekPhone(elem) {
    replace = elem.value.replace(/[\\A-Za-z!"?$%^&*_={};.\:'/@#~,?\<>?|`?\]\[]/g, '');
    elem.value = replace;
}

function formatCurrency(val) {

    x = val.split(".");
    num = x[0];

    if (num < 1) return "";
    num = num.toString().replace(/\$|\,/g, '');
    if (isNaN(num))
        num = "0";
    sign = (num == (num = Math.abs(num)));
    num = Math.floor(num * 100 + 0.50000000001);
    cents = num % 100;
    num = Math.floor(num / 100).toString();
    if (cents < 10)
        cents = "0" + cents;
    for (var i = 0; i < Math.floor((num.length - (1 + i)) / 3); i++)
        num = num.substring(0, num.length - (4 * i + 3)) + ',' +
        num.substring(num.length - (4 * i + 3));

    if (x.length == 1)
        return (((sign) ? '' : '-') + num);
    else
        return (((sign) ? '' : '-') + num + "." + x[1].substr(0, 2));
}
 
function openBox(url,modalSizeClass = ''){
    $(".modal-dialog").addClass(modalSizeClass);
    $("#modal-default").modal("show");
    $.post(url, function(data){
        $(".modal-view").html(data);
    });
}
