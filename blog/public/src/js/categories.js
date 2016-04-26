$(document).ready(function () {
    $('#btn').click(createNewCategory);
    $('.editar').on('click', startEdit);
    $('.excluir').on('click', startDelete);

});

function startEdit(event) {
    event.preventDefault();    
    var li = $(this);    
    var linkEditar = $(this).children();  
    var liInput = $(this).prev();
    var input = $(this).prev().children();
    if (!input.hasClass('ativo')) {
        liInput.css({display: "inline-block"});
        setTimeout(function () {
            input.css({width: '110px'});
        }, 1);
        input.addClass('ativo');
    }    
    linkEditar.text('Salvar');
    li.off("click", startEdit);    
    li.on("click", saveEdit);
}

function saveEdit(event) {
    event.preventDefault();        
    var categoryName = $(this).prev().children().val();
    var categoryId = $(this).parents("article").children().data('id');    
    
    if(categoryName.length === 0){
        alert('coloca um nome ai');
        return;
    }    
    ajax("POST", "/admin/blog/categories/update", "name="+categoryName +"&category_id="+categoryId, endEdit, $(this));
}

function endEdit(responseObj, event){
    var success = responseObj.success;    
    var linkEditar = event;    
    var liInput = linkEditar.prev();
    var input = liInput.children();
    
    if(success){
        var newName = responseObj.newName;
        var article = event.parents("article");
        article.css({backgroundColor: "#afefac"});
        setTimeout(function(){
           article.css({backgroundColor: "white"}); 
        }, 300);
        event.next().parents('article').children().children('h3').text(newName);        
    }        
    linkEditar.children().text('Editar');
    if(input.hasClass('ativo')) {
        input.css({width: '0px'});
        setTimeout(function () {
            liInput.css({display: "none"});
        }, 900);
        input.removeClass('ativo');
    }    
    event.prev().children().val('');
    linkEditar.off("click", saveEdit);    
    linkEditar.on("click", startEdit);    
}

function createNewCategory(event) {
    event.preventDefault();
    var name = $('#name').val();    
    
    if (name.length === 0) {
        alert("Por favor, digite um nome pra categoria");
        return;
    }
    ajax("POST", "/admin/blog/category/create", "name=" + name, newCategoryCreated, [name]);
}

function newCategoryCreated(responseObj) {
    var articles = $('.list').children();
    
    if(articles.length >= 5){                
        $('.list').children().last().remove();        
    }    
    $('.list').prepend(responseObj.categoria);
    alert(responseObj.message);
    if(responseObj.firsTime){
        location.reload();
    }
}

function startDelete(event){
    deleteCategory(event, $(this));
}

function deleteCategory(event, event2){
    event.preventDefault();
    
    event2.off('click', startDelete);
    var categoryId = event2.parents("article").children().data('id'); 
    ajax("GET", "/admin/blog/category/"+categoryId+"/delete", null, categoryDeleted, event2.parents('article'));
}

function categoryDeleted(responseObj, event){
    var article = event;
    if(responseObj.success){
        article.css({backgroundColor:"#ffc4be"});
        setTimeout(function(){
           article.remove();
           location.reload();
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