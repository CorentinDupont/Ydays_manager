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

//Ajout de l'objectif dans la liste et en bdd
$('#cPushNewGoalButton').click(function(){
    var numOfError = 0;
    if($(this).parent().find('input').val().replace(/\s/g, '') !== '') {

        //textObjective
        var textObjective = $('#cInputAddGoalCheckList').val();
        // id Projet 
        var projectId = $('#projectIdAjoutObjective').text();
        projectId = parseInt(projectId);
        console.log(textObjective);
        console.log(projectId);
        if(numOfError===0){
            
            //Appel de la méthode du ReportController pour entrer en base de données le nouvel objectif
            window.location.href = Routing.generate('projet_ydays_manager_push_objective_in_db', {
                'textObjective': textObjective,
                'projectId' : projectId
         });

        $('#cCheckListContainerCheckList').prepend(getHTMLGoalItem($(this).parent().find('input').val(), $('#cCheckListContainerCheckList').children.length+2));
        $(this).parent().find('input').val('');
        closeAddGoalWindow();

        
        }
       
    }
    else{
        numOfError++;
        $('#cInputAddGoalCheckList').css("background-color", "#FFCBCB");
    }
});

function getHTMLGoalItem(goalText, id){
    return '<div class="cOneGoalBlockCheckList">\n' +
        '       <input type="checkbox" class="cCheckBoxCheckList" id="cCheckBox'+id+'CheckList"/>\n' +
        '       <label for="cCheckBox'+id+'CheckList" class="cShadowed">'+goalText+'</label>\n' +
        '   </div>'
}

/*----------------------------------------------------------------------*/



