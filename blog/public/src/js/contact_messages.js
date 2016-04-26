$(document).ready(function(){
    var contactMessages = $('.contact-message');
    contactMessages.find('.view').on('click', modalOpen);
    contactMessages.find('.view').on('click', modalContent);
    contactMessages.find('.delete').on('click', deleteContactMessage);
    
    $('#modal-close').on('click', modalClose);
});

function modalContent(event){
    event.preventDefault();
    var subject = $(this).parent().parent().parent().parent().find('h3').text();
    var sender = $(this).parent().parent().parent().parent().find('.info').text();
    var message = $(this).parent().parent().parent().parent().data('message');
    var modal = $('.modal').first();
    var modalSubject = $('<h1></h1>');
    var modalSender = $('<h3></h3>');
    var modalMessage = $('<p></p>');
    modalSubject.text(subject);
    modalSender.text(sender);
    modalMessage.text(message);
    
    modalSubject.insertBefore(modal.children().first());
    modalSender.insertAfter(modal.children('h1'));
    modalMessage.insertAfter(modal.children('h3'));
    
}

function deleteContactMessage(event){
    event.preventDefault();
    $(this).off('click');
    var messageId = $(this).parent().parent().parent().parent().data('id');
    var article = $(this).parent().parent().parent().parent();
    ajax("GET", "/admin/contact/message/"+messageId+"/delete", null, messageDeleted, article);
}

function messageDeleted(responseObj, articleInfo){
    var article = articleInfo;
    if(responseObj.success){
        article.css("background-color", "#ffc4be");
        setTimeout(function(){
            article.remove();            
        }, 300);
    }
}

function ajax(method, url, params, callback, callbackParams) {
    $.ajax({
        url: baseUrl + url,
        headers: {'X-CSRF-TOKEN': token},
        type: method,
        data: params,
        dataType: 'JSON',
        success: function (resp) {
            callback(resp, callbackParams);
        },
        error: function (resp) {
            alert(resp.message);
        }
    });
}