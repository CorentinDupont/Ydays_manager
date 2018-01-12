/*--------------------------- AJOUT D'OBJECTIF -------------------------*/
// id Projet 
var projectId = $('#projectIdAjoutObjective').text();
projectId = parseInt(projectId);
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



//Gestion dynamique check d'un objectif + update en bdd 

$('.cItemObjective').click(function(){
    
    var that = $(this);
    var route = Routing.generate('projet_ydays_manager_project_update_checkbox_state');
    
    var checkedbox = that.prev();
         //Appel de la route du Objective controller pour modifier l'etat de la checkbox
    if(!checkedbox.is(':checked')){
        
         //on récup l'id d'objectif courant
         var objectiveId=that.next().children().text();
        //var objectiveId = $(this).find(".cJavascriptParameterBlock").find(".objectiveIdAjoutObjective").find("p").text();
        parseInt(objectiveId);
        console.log(objectiveId);
        console.log(projectId);
        //Requete ajax pour éxecuter l'update en arrière plan
        $.ajax({
            url: route,
            method:"post",
            data: {checkedState: 1, objectiveId:objectiveId, projectId:projectId}
        }).done(function(msg){
            alert("Félicitation ! \n Toujours plus proche du but final.")
        });
    }
    else if(checkedbox.is(':checked')){
        var objectiveId=that.next().children().text();
        parseInt(objectiveId);
       //Requete ajax pour éxecuter l'update en arrière plan
       $.ajax({
           url: route,
           method:"post",
           data: {checkedState: 0, objectiveId:objectiveId,projectId:projectId}
       }).done(function(msg){
           alert("Mmmmmh ... \n Reculer pour mieux sauter.")
       });
    }
   
});


function getHTMLGoalItem(goalText, id){
    return '<div class="cOneGoalBlockCheckList">\n' +
        '       <input type="checkbox" class="cCheckBoxCheckList" id="cCheckBox'+id+'CheckList"/>\n' +
        '       <label for="cCheckBox'+id+'CheckList" class="cShadowed">'+goalText+'</label>\n' +
        '   </div>'
}

/*----------------------------------------------------------------------*/



