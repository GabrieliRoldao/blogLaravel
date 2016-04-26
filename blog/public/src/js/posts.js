var addedCategoriesText;
var addedCategoriesIds;

$(document).ready(function (){
    var addCategoryBtn = $('.btn').first();
    addedCategoriesIds = $('#categories');
    addCategoryBtn.on('click', addCategoryToPost);
    addedCategoriesText = $('.added-categories');
    $('.addedCategory').on('click', removeCategoryFromPost);
});

function addCategoryToPost(event){
    event.preventDefault();
    var select = $('#category_select');
    var selectedCategoryId = select.val();
    var selectedCategoryName = $('#category_select :selected').text();
    if(addedCategoriesIds.val().split(",").indexOf(selectedCategoryId) !== -1){
        return;
    }
    if(addedCategoriesIds.val().length > 0){        
        addedCategoriesIds.val(addedCategoriesIds.val() + "," + selectedCategoryId);
    }else{
        addedCategoriesIds.val(selectedCategoryId);
    }
    var newCategoryLi = $("<li></li>");
    var newCategoryLink = $("<a></a>");
    newCategoryLink.attr("href", "#");
    newCategoryLink.text(selectedCategoryName);
    newCategoryLink.data('category_id', selectedCategoryId);
    newCategoryLink.on('click', removeCategoryFromPost);
    newCategoryLi.append(newCategoryLink);
    addedCategoriesText.children().append(newCategoryLi);
}

function removeCategoryFromPost(event){
    event.preventDefault();
    $(this).off('click');
    var categoryId = $(this).data('id');
    var categoryIdArray = addedCategoriesIds.val().split(",");
    var index = categoryIdArray.indexOf(categoryId.toString());
    categoryIdArray.splice(index, 1);
    var newCategoriesIds = categoryIdArray.join(',');
    addedCategoriesIds.val(newCategoriesIds);
    $(this).parent().remove();    
}