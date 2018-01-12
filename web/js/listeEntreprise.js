var imageBase64="";
//Input image
$('#jProjetImageContainerAddEntreprise').change(function(){
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
$('.jButtonAddEntreprise').click(function(){
    var numOfError = 0;

//image (chargé au niveau du js image au début du fichier)
//Si aucune image n'est choisie
if(imageBase64===""){
    numOfError++;
    $('#jProjetImageContainerAddEntreprise').parent().find('label').css("background-color", "#FFCBCB");
}else{
    $('#jProjetImageContainerAddEntreprise').parent().find('label').css("background-color", "#FFFFFF");
}

//image
    //préparation à l'upload
    var imageDatas = new Array();

    //dossier d'upload
    imageDatas.push(['uploadDirectory', "../uploads/project/img/"]);

    //l'image en elle même
    imageDatas.push(['image', imageBase64]);

    //nom de l'image
    var imageName = makeid()+$('#jProjetImageContainerAddEntreprise')[0].files[0]['name'];
    imageDatas.push(['imageName', imageName]);

    if(numOfError===0){
        var imageIsCorrectlyUpload = false;
        //Upload de l'image
        $.ajax({
            type : "POST",
            url: "../php/imageFileUpload.php",
            data: {imageDatas:imageDatas},
            beforeSend: function(xhr){//Avant d'envoyer la requête
                $('.jButtonAddEntreprise').css("background-color", "grey");
                $('.jButtonAddEntreprise').val('Upload..');
                $('.jButtonAddEntreprise').prop('disabled', true);
            },
            success: function( data ) {//Si la requête à fonctionnée
                imageIsCorrectlyUpload = true;
                $('.jButtonAddEntreprise').val('Proposition projet ...');

            },
            error: function(xhr, status, error) {//sinon
                $('.jButtonAddEntreprise').val('Erreur : Upload Image');
                $('.jButtonAddEntreprise').css("background-color", "#EC4747");
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
                        $('.jButtonAddEntreprise').val('Projet Proposé !');
                    },
                    error: function(xhr, status, error) {
                        $('.jButtonAddEntreprise').val('Erreur : Proposer Projet');
                        $('.jButtonAddEntreprise').css("background-color", "#EC4747");
                    }
                });
            }
        });
    }
});