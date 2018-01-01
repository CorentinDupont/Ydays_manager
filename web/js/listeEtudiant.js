/*-------------------------     Barre de recherche    -------------------------------*/

$('.cSearchBarStudentList input').keyup(function(){
    //Récupération de l'entrée utilisateur
    var currentSearchText = $(this).val();
    $('.cStudentClassBlockStudentList').each(function(){
        var studentFoundCount = 0;
        $(this).find('.cOneStudentItemStudentList').each(function(){
            if($(this).find('h3').text().toLowerCase().indexOf(currentSearchText.toLowerCase()) === -1){
                $(this).hide('slow');
            }else{
                $(this).show('slow');
                studentFoundCount++;
            }
        });
        if(studentFoundCount>0){
            openStudentList($(this).closest('.cStudentClassBlockStudentList'));
        }else{
            closeStudentList($(this).closest('.cStudentClassBlockStudentList'));
        }
    });
});

/*--------------------------------------------------------------------------------*/

/*-------------------------     Barre de promo     -------------------------------*/

$('.cClassStudentListContainerStudentList').each(function(){
    $(this).hide(0);
});

$('.cStudentClassBarStudentList').click(function(){
    if(/*$(this).parent().find('.cClassStudentListContainerStudentList').css('display').toLowerCase() === 'none'*/!$(this).parent().find('.cClassStudentListContainerStudentList').is(":visible")){
        openStudentList($(this).closest('.cStudentClassBlockStudentList'));
    }else{
        closeStudentList($(this).closest('.cStudentClassBlockStudentList'));
    }
 });

function closeStudentList(oneClassBlock){
    oneClassBlock.find('.cClassStudentListContainerStudentList').hide('slow');
    oneClassBlock.find('.cStudentClassBarStudentList svg').css('transform', 'Rotate(0)');
}

function openStudentList(oneClassBlock){
    oneClassBlock.find('.cClassStudentListContainerStudentList').show('slow');
    oneClassBlock.find('.cStudentClassBarStudentList svg').css('transform', 'Rotate(180deg)');
}

/*--------------------------------------------------------------------------------*/