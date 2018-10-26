function countitSMS (_input, _output) {
    var self = this;
    var input = _input;
    var reg = /[\u0600-\u06FF]/g;
    var output = _output;
    var unicode = false;
    var chartext1 = '(Characters: ';
    var chartext2 = 'SMS: ';
    var alert = 'Text is too long';
    var marketingTotal = 'Total SMS: ';
    var limit = 4;
    var translate = {};
    var copyFrom;

    input.addEventListener('change', function (event) {
        if(reg.test(this.value)){
            unicode = true;
        }else{
            unicode = false;
        }
        count(event, input, output, alert, limit, unicode, translate, copyFrom, chartext1, chartext2);
    }, false);
    
    input.addEventListener('keyup', function (event) {
        if(reg.test(this.value)){
            unicode = true;
        }else{
            unicode = false;
        }
        count(event, input, output, alert, limit, unicode, translate, copyFrom, chartext1, chartext2);
    }, false);

    var event = new Event('change');
    input.dispatchEvent(event);
}

function count(event, input, output, alert, limit, unicode, translate, copyFrom, chartext1, chartext2) 
{
    if (typeof copyFrom === 'object') {
        input.value = copyFrom.value;
    }

    for (var key in translate) {
        String.prototype.replaceAll = function (find, replace) {
            var str = this;
            return str.replace(new RegExp(find, 'g'), replace);
        };
        input.value = input.value.replaceAll('{' + key + '}', translate[key]);
    }

    if (unicode) {
        var sms1 = 70;
        var header = 3;
    } else {
        var sms1 = 160;
        var header = 7;
    }
    var len = input.value.length;
    var total = 0;

    if (len > sms1) {
        total = parseInt((len - 1) / (sms1 - header)) + 1;
    } else if (len > 0) {
        total = 1;
    }

    output.innerHTML = chartext1 + len + ' , ' + chartext2 + ' ' + total + ')';
    
    if (alert && limit < total) {
        input.value = input.value.substring(0, limit * (sms1 - header));
        window.alert(alert);
        count(event, input, output, alert, limit, unicode, translate, copyFrom, chartext1, chartext2);
    }
    input.focus();
}

function setCursorPosition(input, position) 
{
    if (input.setSelectionRange) {
        input.focus();
        input.setSelectionRange(position, position);
    } else if (input.createTextRange) {
        var range = input.createTextRange();
        range.collapse(true);
        range.moveEnd('character', position);
        range.moveStart('character', position);
        range.select();
    }
}

function getCursorPosition(node) 
{
    node.focus();
    /* without node.focus() IE will returns -1 when focus is not on node */
    if(node.selectionStart)
        return node.selectionStart;
    else if(!document.selection)
        return node.value.length;
    var c = "\001";
    var sel = document.selection.createRange();
    var dul = sel.duplicate();
    var len = 0;
    dul.moveToElementText(node);
    sel.text = c;
    len = (dul.text.indexOf(c));
    sel.moveStart('character', -1);
    sel.text = "";
    return len;
};

function prepareTags(containerId){
    var tr = document.createElement("tr");
    var td = document.createElement("td");
    tr.appendChild(td);
    td = document.createElement("td");
    td.innerHTML = '<label id="' + containerId + '_label" class="counter-sms"></label>';
    tr.appendChild(td);
    document.getElementById('row_' + containerId + '_textarea').parentNode.appendChild(tr);

    var tr = document.createElement("tr");
    var td = document.createElement("td");
    td.colSpan = 2;
    td.innerHTML = '<span id="' + containerId + '_customer_name" class="sms-block-btn">Customer Name</span>&nbsp;&nbsp;<span id="' + containerId + '_order_id" class="sms-block-btn">Order id</span>&nbsp;&nbsp;<span id="' + containerId + '_shop_name" class="sms-block-btn">Your store name</span>';
    tr.appendChild(td)
    document.getElementById('row_' + containerId + '_textarea').parentNode.appendChild(tr);

    document.getElementById(containerId + '_customer_name').onclick = function(){
        var node = document.getElementById(containerId + "_textarea");
        var post = getCursorPosition(node);
        node.value = node.value.substr(0, post) + "{customer_name}" + node.value.substr(post);
        var event = new Event('change');
        node.dispatchEvent(event);
    };

    document.getElementById(containerId + '_order_id').onclick = function(){
        var node = document.getElementById(containerId + "_textarea");
        var post = getCursorPosition(node);
        node.value = node.value.substr(0, post) + "{order_id}" + node.value.substr(post);
        var event = new Event('change');
        node.dispatchEvent(event);
    };

    document.getElementById(containerId + '_shop_name').onclick = function(){
        var node = document.getElementById(containerId + "_textarea");
        var post = getCursorPosition(node);
        node.value = node.value.substr(0, post) + "{shop_name}" + node.value.substr(post);
        var event = new Event('change');
        node.dispatchEvent(event);
    };
}

window.onload = function() {
    prepareTags('sms_order');
    prepareTags('sms_order_status');

    countitSMS(document.getElementById("sms_order_textarea"), document.getElementById("sms_order_label"));
    countitSMS(document.getElementById("sms_order_status_textarea"), document.getElementById("sms_order_status_label"));
}