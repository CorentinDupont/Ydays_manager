var idProject = $('.cJavascriptParameterBlock').text();
idProject = parseInt(idProject);

/*-----------------------------------  TITRE ----------------------------------------*/

var titleIsInEdition = false;
var projectTitleP = undefined;
var currentTitleEditButtonSvg = undefined;
//Au clique du bouton d'édition du titre
$('#cTitleEditRoundButtonProjectDashboard').click(function(){
    if(!titleIsInEdition){
        currentTitleEditButtonSvg = $(this).find('svg');
        $(this).find('svg').replaceWith('<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="512px" height="512px" viewBox="0 0 448.8 448.8" style="enable-background:new 0 0 448.8 448.8;" xml:space="preserve"> <g> <g id="check"> <polygon points="142.8,323.85 35.7,216.75 0,252.45 142.8,395.25 448.8,89.25 413.1,53.55   " fill="#FFFFFF"/> </g> </g></svg>');
        titleIsInEdition = true;
        projectTitleP = $(this).parent().find('h1');
        var titleHeight = projectTitleP.height();
        var titleWidth = projectTitleP.width();
        var titleText = projectTitleP.text();
        projectTitleP.replaceWith('<input type="text" id="cInputTitleProjetDashboard">');
        var titleInput = $(this).parent().find('input');
        titleInput.val(titleText);
        titleInput.css("width",titleWidth);
        titleInput.css("height",titleHeight);
    }else{
        titleIsInEdition = false;
        var newTitle = $(this).parent().find('input').val();
        projectTitleP.text($(this).parent().find('input').val());
        $(this).parent().find('input').replaceWith(projectTitleP);
        $(this).find('svg').replaceWith(currentTitleEditButtonSvg);

        //Appel de la route du Project controller pour modifier le titre
        var route = Routing.generate('projet_ydays_manager_project_update_title');

        $.ajax({
            url: route,
            method:"post",
            data: {idProject:idProject, newTitle:newTitle}
        }).done(function(msg){
            alert("Titre modifié avec succès")
        });


    }

});

/*-----------------------------------------------------------------------------------------*/

/*----------------------------------- MENU DEROULANT (OPTIONS) ----------------------------------------*/

var optionMenuIsVisible=false;
$('.cHamMenuProjectDashboard>svg').click(function(){
    if(!optionMenuIsVisible){
        $(this).parent().find('.cDropdownMenuProjectDashboard').css("visibility", "visible");
        optionMenuIsVisible=true;
    }else{
        $(this).parent().find('.cDropdownMenuProjectDashboard').css("visibility", "hidden");
        optionMenuIsVisible=false;
    }
});

/*-----------------------------------------------------------------------------------------------------*/

/*--------------------------------------  IMAGE -------------------------------------------*/

//Au clique du bouton d'édition de l'image
$('#cImageInputProjectDashboard').change(function(){
    previewImage($(this), $(this).parent().find('img'));
});

function previewImage(input, image) {
    var oFReader = new FileReader();
    oFReader.readAsDataURL(input.get(0).files[0]);

    oFReader.onload = function (oFREvent) {
        image.attr('src', oFREvent.target.result);
    };
};

/*-----------------------------------------------------------------------------------------*/




/*-----------------------------------  DESCRIPTION ----------------------------------------*/

var descIsInEdition = false;
var projectDescriptionP = undefined;
var currentDescEditButtonSvg = undefined;
//Au clique du bouton d'édition de la description
$('#cEditRoundButtonDescProjectDashboard').click(function(){
    if(!descIsInEdition){
        currentDescEditButtonSvg = $(this).find('svg');
        $(this).find('svg').replaceWith('<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="512px" height="512px" viewBox="0 0 448.8 448.8" style="enable-background:new 0 0 448.8 448.8;" xml:space="preserve"> <g> <g id="check"> <polygon points="142.8,323.85 35.7,216.75 0,252.45 142.8,395.25 448.8,89.25 413.1,53.55   " fill="#FFFFFF"/> </g> </g></svg>');
        descIsInEdition = true;
        projectDescriptionP = $(this).parent().find('p');
        var descHeight = projectDescriptionP.height();
        var descText = projectDescriptionP.text();
        projectDescriptionP.replaceWith('<textarea id="cDescTextAreaProjetDashboard">'+descText+'</textarea>');
        var textArea = $(this).parent().find('textarea');
        textArea.css("width","100%");
        textArea.css("height",descHeight);
        textArea.css("resize","vertical");
    }else{
        descIsInEdition = false;
        var newDescription = $(this).parent().find('textarea').val();
        $(this).parent().find('textarea').replaceWith(projectDescriptionP.text($(this).parent().find('textarea').val()));
        $(this).find('svg').replaceWith(currentDescEditButtonSvg);

        //Appel de la route du Project controller pour modifier le titre
        var route = Routing.generate('projet_ydays_manager_project_update_description');

        $.ajax({
            url: route,
            method:"post",
            data: {idProject:idProject, newDescription:newDescription}
        }).done(function(msg){
            alert("Description modifié avec succès")
        });
    }

});

/*-----------------------------------------------------------------------------------------*/

/*-----------------------------------  COMMENTAIRE ----------------------------------------*/

//Ajustement de la ligne grise
drawLineAnswerBlockOneComment();

$(window).resize(function(){
    drawLineAnswerBlockOneComment();
});

function drawLineAnswerBlockOneComment(){
    $('.cBlockAnswerOneCommentProjectDashboard').each(function(){
        $(this).find('.cLeftBarProjectDashboard').height(0);
        $(this).find('.cLeftBarProjectDashboard').height($(this).find('.cAllAnswersToOneCommentProjectDashboard').height());
    });
}




//Suppression de commentaire
$('.cDeleteRoundButton').click(function(){
    deleteComment($(this));
});

function deleteComment(clickedElement){
    if (clickedElement.parents('.cAllAnswersToOneCommentProjectDashboard').length) {
        clickedElement.closest('.cOneCommentProjectDashboard').remove();
        drawLineAnswerBlockOneComment();
    }else{
        clickedElement.closest('.cBlockOneCommentProjectDashboard').remove();
    }
}

//Rédiger un commentaire
$('#cAddCommentButtonProjectDashboard').click(function(){
   $('#cBlockHiddenInputAddCommentProjectDashboard').css("display", "flex");
});

//Annuler répondre ou faire commentaire
$('.cCancelCommentButtonProjectDashboard').click(function(){
    cancelPostComment($(this));
});

function cancelPostComment(clickedElement){
    clickedElement.closest('.cBlockHiddenInputCommentProjectDashboard').css("display", "none");
}

//Répondre commentaire
$('.cAnswerRoundButton').click(function(){
    replyComment($(this));
});

function replyComment(clickedElement){
    clickedElement.closest('.cBlockOneCommentProjectDashboard').find('.cBlockHiddenInputCommentProjectDashboard').css("display", "flex");
    drawLineAnswerBlockOneComment();
}

//Poster commentaire
$('.cPostCommentButtonProjectDashboard').click(function(){
    postComment($(this))
});

function postComment(clickedElement){
    //Si le bouton de post cliqué appartient à l'input caché des réponses d'un commentaire
    if(clickedElement.parents('.cAllAnswersToOneCommentProjectDashboard').length){
        //Insertion de la nouvelle réponse en haut des autres, mais en dessous de l'input caché.
        $(getCommentHTML(clickedElement.closest('.cAllAnswersToOneCommentProjectDashboard').find('textarea').val(), true)).insertAfter(clickedElement.closest('.cBlockHiddenInputCommentProjectDashboard'));
        //Ajout des fonctionnalités de clique sur le bouton supprimé de la nouvelle réponse.
        clickedElement.closest('.cAllAnswersToOneCommentProjectDashboard:nth-child(2)').find('.cDeleteRoundButton').click(function() {
            deleteComment($(this));
        });
        //Disparition de l'input
        clickedElement.closest('.cBlockHiddenInputCommentProjectDashboard').css("display", "none");
        drawLineAnswerBlockOneComment();
    }else{
        $(getCommentHTML(clickedElement.closest('.cContainerSquareAndTextCommentProjectDashboard').find('textarea').val(), false)).insertAfter(clickedElement.closest('.cBlockHiddenInputCommentProjectDashboard'));
        //Ajout événement de clique sur le bouton post du nouvel input caché
        $('.cPostCommentButtonProjectDashboard').click(function(){
            postComment($(this));
        });
        //Ajout événement clique sur bouton annuler du nouvel input caché
        $('.cCancelCommentButtonProjectDashboard').click(function(){
            cancelPostComment($(this));
        });
        //Ajout événement clique sur bouton supprimé du commentaire posté
        $('.cDeleteRoundButton').click(function(){
            deleteComment($(this));
        });
        //Ajout événement clique sur bouton répondre du commentaire posté
        $('.cAnswerRoundButton').click(function(){
            replyComment($(this));
        });
        clickedElement.closest('.cBlockHiddenInputCommentProjectDashboard').css("display", "none");
    }
}

function getCommentHTML(commentText, isAnswer){
    var newHTMLComment = "";
    if(!isAnswer){
        newHTMLComment += ' <!-- Bloc d\'un commentaire et ses réponses -->\n' +
            '            <div class="cBlockOneCommentProjectDashboard">';
    }
    newHTMLComment += '<div class="cOneCommentProjectDashboard">\n' +
        '                     <img src="/ydays_manager/web/img/image3.png" class="cProfilImageProjectDashboard cShadowed">\n' +
        '                     <div class="cContainerSquareAndTextCommentProjectDashboard cShadowed cRounded">\n' +
        '                         <!-- <div class=\"cArrowCommentProjectDashboard\"></div>-->\n' +
        '                         <p>'+commentText+'</p>\n' +
        '                         <!-- Conteneur Bouton rond suppression-->\n' +
        '                         <div class="cButtonRowContainer">' +
        '                             <div class="cRoundButton cDeleteRoundButton cTomatoRed cShadowed">\n' +
        '                                 <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 59 59" style="enable-background:new 0 0 59 59;" xml:space="preserve" width="512px" height="512px">\\n\' +\n' +
        '                                 <path d="M52.5,6H38.456c-0.11-1.25-0.495-3.358-1.813-4.711C35.809,0.434,34.751,0,33.499,0H23.5c-1.252,0-2.31,0.434-3.144,1.289  C19.038,2.642,18.653,4.75,18.543,6H6.5c-0.552,0-1,0.447-1,1s0.448,1,1,1h2.041l1.915,46.021C10.493,55.743,11.565,59,15.364,59  h28.272c3.799,0,4.871-3.257,4.907-4.958L50.459,8H52.5c0.552,0,1-0.447,1-1S53.052,6,52.5,6z M20.5,50c0,0.553-0.448,1-1,1  s-1-0.447-1-1V17c0-0.553,0.448-1,1-1s1,0.447,1,1V50z M30.5,50c0,0.553-0.448,1-1,1s-1-0.447-1-1V17c0-0.553,0.448-1,1-1  s1,0.447,1,1V50z M40.5,50c0,0.553-0.448,1-1,1s-1-0.447-1-1V17c0-0.553,0.448-1,1-1s1,0.447,1,1V50z M21.792,2.681  C22.24,2.223,22.799,2,23.5,2h9.999c0.701,0,1.26,0.223,1.708,0.681c0.805,0.823,1.128,2.271,1.24,3.319H20.553  C20.665,4.952,20.988,3.504,21.792,2.681z" fill="#FFFFFF"/>\\n\' +\n' +
        '                                 </svg>\n' +
        '                             </div>\n';
    if(!isAnswer){//-----------Ajout du bouton rond réponse--------------
        newHTMLComment += '<div class="cRoundButton cAnswerRoundButton cYnovGreen cShadowed">\n' +
            '                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 384 384" style="enable-background:new 0 0 384 384;" xml:space="preserve" width="512px" height="512px">\n' +
            '                                <g>\n' +
            '                                    <g>\n' +
            '                                        <path d="M149.333,117.333V32L0,181.333l149.333,149.333V243.2C256,243.2,330.667,277.333,384,352    C362.667,245.333,298.667,138.667,149.333,117.333z" fill="#FFFFFF"/>\n' +
            '                                    </g>\n' +
            '                                </g>\n' +
            '                                </svg>\n' +
            '                            </div>';
    }
    newHTMLComment += '</div>' +
        '           </div>' +
        '       </div>';
    if(!isAnswer){//-----------Ajout du block de commentaire--------------
        newHTMLComment += '<!-- Bloc de réponse du commentaire -->\n' +
            '                <div class="cBlockAnswerOneCommentProjectDashboard">\n' +
            '\n' +
            '                    <div class="cLeftBarProjectDashboard"></div>\n' +
            '\n' +
            '                    <div class="cAllAnswersToOneCommentProjectDashboard">\n' +
            '\n' +
            '                        <!-- Input commentaire caché, affichier avec bouton "rédiger un commentaire" -->\n' +
            '                        <div class="cOneCommentProjectDashboard cBlockHiddenInputCommentProjectDashboard">\n' +
            '                            <img src="/ydays_manager/web/img/image3.png" class="cProfilImageProjectDashboard cShadowed">\n' +
            '                            <div class="cInputAddCommentProjectDashboard cContainerSquareAndTextCommentProjectDashboard cShadowed cRounded">\n' +
            '                                <!-- <div class="cArrowCommentProjectDashboard"></div>-->\n' +
            '                                <textarea class="cTextAreaAddCommentProjectDashboard" title="cTextAreaAnswerCommentProjectDashboard"></textarea>\n' +
            '                                <!-- Conteneur Bouton-->\n' +
            '                                <div class="cButtonRowContainer">\n' +
            '                                    <!-- Bouton annuler -->\n' +
            '                                    <button class="cCancelCommentButtonProjectDashboard cRounded cTomatoRed cShadowed cButton">Annuler</button>\n' +
            '                                    <!-- Bouton poster -->\n' +
            '                                    <button class="cPostCommentButtonProjectDashboard cRounded cYnovGreen cShadowed cButton">Poster</button>\n' +
            '                                </div>\n' +
            '                            </div>\n' +
            '                        </div>' +
            '                    </div>\n' +
            '                </div>\n' +
            '            </div>';
    }
    return newHTMLComment;
}

/*-----------------------------------------------------------------------------------------*/

