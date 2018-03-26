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