window.Clipboard = (function(window, document, navigator) {
    var textArea,
        copy;

    function isOS() {
        return navigator.userAgent.match(/ipad|iphone/i);
    }

    function createTextArea(text) {
        textArea = document.createElement('textArea');
        textArea.value = text;
        document.body.appendChild(textArea);
    }

    function selectText() {
        var range,
            selection;

        if (isOS()) {
            range = document.createRange();
            range.selectNodeContents(textArea);
            selection = window.getSelection();
            selection.removeAllRanges();
            selection.addRange(range);
            textArea.setSelectionRange(0, 999999);
        } else {
            textArea.select();
        }
    }

    function copyToClipboard() {
        document.execCommand('copy');
        document.body.removeChild(textArea);
    }

    copy = function(text) {
        createTextArea(text);
        selectText();
        copyToClipboard();
    };

    return {
        copy: copy
    };
})(window, document, navigator);

$('form.ajax_form_save').on('submit', (evt)=>{
    evt.preventDefault();

    let action = evt.target.action,
        // formData = new FormData(evt.target);
        form = $(evt.target),
        formData = form.serialize(),
        title = form.data('title');

    $.ajax({
        url: action,
        processData: false,
        method: 'post',
        data: formData
    }).then(()=>{
        toastr.success(title + ' was saved');
    }).fail((error)=>{
        toastr.error(error.responseJSON.message);
    }).always((response)=>{
        if(form.data('callback')){
            window[form.data('callback')](form, response);
        }
        if(form.data('clearfields')){
            form.find('input:not([type="hidden"])').val('');
        }
    });
});

var copyingMode = false;

$('.copy-to-clipboard').on('click', (evt)=>{
    Clipboard.copy(evt.target.textContent.trim());
    // let $temp = $("<input>");
    // $("body").append($temp);
    // $temp.val(evt.target.textContent.trim()).select();
    // document.execCommand("copy");
    // $temp.remove();
    toastr.info('Copied to clipboard');
});
