$('document').ready(function(){
    /*-------------------------     Barre de recherche    -------------------------------*/

    $('#mSearchBarUserModalFicheProjet').keyup(function(){
        //Récupération de l'entrée utilisateur
        var currentSearchText = $(this).val();
        $('.user-name').each(function(){
            if($(this).find('p').text().toLowerCase().indexOf(currentSearchText.toLowerCase()) === -1){
                $(this).hide('slow');
            }else{
                $(this).show('slow');
            }
        });
    });

    /*--------------------------------------------------------------------------------*/
});
