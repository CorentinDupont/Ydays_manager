var imageBase64="";
//Input image
$('#mMidDashboardInputFileProposerProjet').change(function(){
    $(this).parent().find('label').css('background-color','transparent');
    $(this).parent().find('label').css('color','transparent');
    $(this).parent().find('label svg').find('*').css('opacity','0');

    previewImage($(this), $(this).parent().find('img'));
});

function previewImage(input, image) {
    var oFReader = new FileReader();
    oFReader.readAsDataURL(input.get(0).files[0]);

    oFReader.onload = function (oFREvent) {
        image.attr('src', oFREvent.target.result);
        imageBase64 = oFREvent.target.result;
    };
};
//clique bouton proposer projet
$('.mButtonProposerProjet').click(function(){
    var numOfError = 0;

    //titre
    var title = $('.mNameProjetProposerProjet').val();
    //Si le titre est vide
    if(title.replace(/\s/g, '') === ''){
        numOfError++;
        $('.mNameProjetProposerProjet').css("background-color", "#FFCBCB");
    }else{
        $('.mNameProjetProposerProjet').css("background-color", "#FFFFFF");
    }

    //projet pro ?
    var isPro=false;
    if($('.mCategorieProposerProjet').find(":selected").text().toLowerCase() === "pro"){
        isPro=true;
    }

    //projet interne ?
    var isInternal=false;
    if($('.mAffiliationProposerProjet').find(":selected").text().toLowerCase() === "interne"){
        isInternal=true;
    }

    //image (chargé au niveau du js image au début du fichier)
    //Si aucune image n'est choisie
    if(imageBase64===""){
        numOfError++;
        $('#mMidDashboardInputFileProposerProjet').parent().find('label').css("background-color", "#FFCBCB");
    }else{
        $('.mMidDashboardInputFileProposerProjet').parent().find('label').css("background-color", "#FFFFFF");
    }

    //description
    var description = $('.mDescriptionProposerProjet').val();
    //Si le titre est vide
    if(description.replace(/\s/g, '') === ''){
        numOfError++;
        $('.mDescriptionProposerProjet').css("background-color", "#FFCBCB");
    }else{
        $('.mDescriptionProposerProjet').css("background-color", "#FFFFFF");
    }

    //image
    //préparation à l'upload
    var imageDatas = new Array();

    //dossier d'upload
    imageDatas.push(['uploadDirectory', "../uploads/project/img/"]);

    //l'image en elle même
    imageDatas.push(['image', imageBase64]);

    //nom de l'image
    var imageName = makeid()+$('#mMidDashboardInputFileProposerProjet')[0].files[0]['name'];
    imageDatas.push(['imageName', imageName]);

    if(numOfError===0){
        var imageIsCorrectlyUpload = false;
        //Upload de l'image
        $.ajax({
            type : "POST",
            url: "../php/imageFileUpload.php",
            data: {imageDatas:imageDatas},
            beforeSend: function(xhr){
                $('.mButtonProposerProjet').css("background-color", "grey");
                $('.mButtonProposerProjet').val('Upload..');
                $('.mButtonProposerProjet').prop('disabled', true);
            },
            success: function( data ) {
                imageIsCorrectlyUpload = true;
                $('.mButtonProposerProjet').val('Proposition projet ...');

            },
            error: function(xhr, status, error) {
                $('.mButtonProposerProjet').val('Erreur : Upload Image');
                $('.mButtonProposerProjet').css("background-color", "#EC4747");
                alert(error);
            }
        }).done(function(){//Quand l'upload est terminée
            if(imageIsCorrectlyUpload){
                //Appel de la route du Project controller pour modifier le nom de l'image
                var route = Routing.generate('projet_ydays_manager_push_project_in_db');

                //Requete ajax pour éxecuter l'ajout du projet en arrière plan
                $.ajax({
                    url: route,
                    method:"post",
                    data: {title:title, isPro:isPro, isInternal:isInternal, imageName: imageName, description: description},
                    success: function( data ) {
                        $('.mButtonProposerProjet').val('Projet Proposé !');
                    },
                    error: function(xhr, status, error) {
                        $('.mButtonProposerProjet').val('Erreur : Proposer Projet');
                        $('.mButtonProposerProjet').css("background-color", "#EC4747");
                    }
                });
            }
        });
    }
});

//Retourne un texte aléatoire de 10 careactères
function makeid() {
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    for (var i = 0; i < 10; i++)
        text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
}