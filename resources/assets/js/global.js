$('form.ajax_form_save').on('submit', (evt)=>{
    evt.preventDefault();

    let action = evt.target.action,
        // formData = new FormData(evt.target);
        formData = $(evt.target).serialize(),
        title = $(evt.target).data('title');

    $.ajax({
        url: action,
        processData: false,
        method: 'post',
        data: formData
    }).then(()=>{
        toastr.success(title + ' was saved');
    }).fail((error)=>{

    });
});