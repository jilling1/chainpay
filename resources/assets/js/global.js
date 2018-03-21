function successMessage(){

}

function infoMessage(){

}

function errorMessage(){

}

$('form.ajax_form_save').on('submit', (evt)=>{
    evt.preventDefault();

    let action = evt.target.action,
        // formData = new FormData(evt.target);
        formData = $(evt.target).serialize();

    $.ajax({
        url: action,
        processData: false,
        method: 'post',
        data: formData
    }).then(()=>{

    }).fail((error)=>{

    });
});