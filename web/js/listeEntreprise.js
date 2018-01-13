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

    //nom entreprise
    var nameEts = $('.jNameAddEntreprise').val();
    //Si le nom est vide
    if(nameEts.replace(/\s/g, '') === ''){
        numOfError++;
        $('.jNameAddEntreprise').css("background-color", "#FFCBCB");
    }else{
        $('.jNameAddEntreprise').css("background-color", "#FFFFFF");
    }

    //informations entreprise
    var infosEts = $('.jInfosAddEntreprise').val();
    //Si les informations sont vides
    if(infosEts.replace(/\s/g, '') === ''){
        numOfError++;
        $('.jInfosAddEntreprise').css("background-color", "#FFCBCB");
    }else{
        $('.jInfosAddEntreprise').css("background-color", "#FFFFFF");
    }

    //siret entreprise
    var siretEts = $('.jSiretAddEntreprise').val();
    //Si le siret est vide
    if(siretEts.replace(/\s/g, '') === ''){
        numOfError++;
        $('.jSiretAddEntreprise').css("background-color", "#FFCBCB");
    }else{
        $('.jSiretAddEntreprise').css("background-color", "#FFFFFF");
    }

    //adresse entreprise
    var addressEts = $('.jAddressAddEntreprise').val();
    //Si l'adresse est vide
    if(addressEts.replace(/\s/g, '') === ''){
        numOfError++;
        $('.jAddressAddEntreprise').css("background-color", "#FFCBCB");
    }else{
        $('.jAddressAddEntreprise').css("background-color", "#FFFFFF");
    }

    //CP entreprise
    var cpEts = $('.jCPAddEntreprise').val();
    //Si le CP est vide
    if(cpEts.replace(/\s/g, '') === ''){
        numOfError++;
        $('.jCPAddEntreprise').css("background-color", "#FFCBCB");
    }else{
        $('.jCPAddEntreprise').css("background-color", "#FFFFFF");
    }

    //ville entreprise
    var cityEts = $('.jCityAddEntreprise').val();
    //Si la ville est vide
    if(cityEts.replace(/\s/g, '') === ''){
        numOfError++;
        $('.jCityAddEntreprise').css("background-color", "#FFCBCB");
    }else{
        $('.jCityAddEntreprise').css("background-color", "#FFFFFF");
    }
    
    //image (chargé au niveau du js image au début du fichier)
    //Si aucune image n'est choisie
    if(imageBase64===""){
        numOfError++;
        $('#jProjetImageContainerAddEntreprise').parent().find('label').css("background-color", "#FFCBCB");
    }else{
        $('#jProjetImageContainerAddEntreprise').parent().find('label').css("background-color", "#FFFFFF");
    }

    if(numOfError===0){

        //image
        //préparation à l'upload
        var imageDatas = new Array();

        //dossier d'upload
        imageDatas.push(['uploadDirectory', "../uploads/entreprise/img/"]);

        //l'image en elle même
        imageDatas.push(['image', imageBase64]);

        //nom de l'image
        var imgEts = makeid()+$('#jProjetImageContainerAddEntreprise')[0].files[0]['name'];
        imageDatas.push(['imgEts', imgEts]);

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
                $('.jButtonAddEntreprise').val('Ajout d\'entreprise');

            },
            error: function(xhr, status, error) {//sinon
                $('.jButtonAddEntreprise').val('Erreur : Upload Image');
                $('.jButtonAddEntreprise').css("background-color", "#EC4747");
            }
        }).done(function(){//Quand l'upload est terminée
            if(imageIsCorrectlyUpload){
                //Appel de la route du entreprise Controller
                var route = Routing.generate('projet_ydays_manager_push_entreprise_in_db');
                console.log(route);
                //Requete ajax pour éxecuter l'ajout du projet en arrière plan
                $.ajax({
                    url: route,
                    method:"post",
                    data: {'nameEts':nameEts, 'infosEts':infosEts, 'siretEts':siretEts, 'addressEts':addressEts, 'cpEts':cpEts, 'cityEts':cityEts, 'imgEts': imgEts},
                    success: function( data ) {
                        $('.jButtonAddEntreprise').val('Entreprise ajoutée !');
                    },  
                    error: function(xhr, status, error) {
                        $('.jButtonAddEntreprise').val('Erreur : Échec de l\'envoi');
                        $('.jButtonAddEntreprise').css("background-color", "#EC4747");
                    }
                })
                window.location.reload(true);
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

//Suppression de l'entreprise
$('.cDeleteRoundButton').click(function(){
    deleteEntreprise($(this));
});

function deleteEntreprise(clickedElement){
    if (clickedElement.parents('.cButtonRowContainer').length) {
        clickedElement.closest('.cListentrepriseProject').remove();
    }else{
        var deletedEntrepriseId = clickedElement.parents('.cListentrepriseProject');
        console.log(deletedEntrepriseId);
        var route = Routing.generate('projet_ydays_manager_entreprise_delete');
        console.log(route);

        $.ajax({
            url: route,
            method:"post",
            data: {idEntreprise:idEntreprise, deletedEntrepriseId:deletedEntrepriseId}
        }).done(function(msg){
            clickedElement.closest('.cListentrepriseProject').remove();
        });
    }
}
