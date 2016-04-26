function modalOpen(event){
    event.preventDefault();
    var background = $("<div></div>");
    background.addClass("modal-background");
    var width = $(document).innerWidth();
    var height = $(document).innerHeight();
   
    background.css({width:width+'px', height:height+'px'});
    $('body').append(background);
    
    var modal = $('.modal');
    modal.css("display","block");
    setTimeout(function(){
        modal.css("top", height/2 - modal.height()/2 + "px");
    }, 10);
}

function modalClose(event){
    event.preventDefault();
    var modal = $('.modal').first();
    while(modal.children().prop("tagName") !== "BUTTON"){        
        modal.children(modal.children().prop("tagName")).remove();
    }
    modal.css({
        top: '10%',
        display: 'none'
    });
    var background = $('.modal-background');
    background.remove();
}

