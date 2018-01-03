/*--------------------------- AJOUT D'OBJECTIF -------------------------*/

//Ouverture et fermeture de la petite fenêtre d'ajout
$('.cAddGoalButton').click(function(){
    if($(this).parent().find('#cAddGoalHiddenBlockCheckList').css('visibility').toLowerCase() === 'visible'){
        closeAddGoalWindow();
    }else {
        $(this).parent().find('#cAddGoalHiddenBlockCheckList').css("visibility","visible");
    }
});

function closeAddGoalWindow(){
    $('#cAddGoalHiddenBlockCheckList').css("visibility","hidden");
}

//Ajout de l'objectif dans la liste
$('#cPushNewGoalButton').click(function(){
    if($(this).parent().find('input').val().replace(/\s/g, '') !== '') {
        $('#cCheckListContainerCheckList').prepend(getHTMLGoalItem($(this).parent().find('input').val(), $('#cCheckListContainerCheckList').children.length+2));
        $(this).parent().find('input').val('');
        closeAddGoalWindow();
    }
});

function getHTMLGoalItem(goalText, id){
    return '<div class="cOneGoalBlockCheckList">\n' +
        '       <input type="checkbox" class="cCheckBoxCheckList" id="cCheckBox'+id+'CheckList"/>\n' +
        '       <label for="cCheckBox'+id+'CheckList" class="cShadowed">'+goalText+'</label>\n' +
        '   </div>'
}



/*----------------------------------------------------------------------*/