/*-------------------------     Barre de recherche    -------------------------------*/

$('.form-control input').keyup(function(){
    //Récupération de l'entrée utilisateur
    var currentSearchText = $(this).val();
    $('.user-name').each(function(){
        var studentFoundCount = 0;
            if($(this).find('p').text().toLowerCase().indexOf(currentSearchText.toLowerCase()) === -1){
                $(this).hide('slow');
            }else{
                $(this).show('slow');
                studentFoundCount++;
            }
        });
        if(studentFoundCount>0){
            openStudentList($(this).closest('.user-name'));
        }else{
            closeStudentList($(this).closest('.user-name'));
        }
    });
});

/*--------------------------------------------------------------------------------*/