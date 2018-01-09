$imageBase64="";
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
        $imageBase64 = oFREvent.target.result;
    };
};

$('.mButtonProposerProjet').click(function(){
    var numOfError = 0;

    //titre
    $title = $('.mNameProjetProposerProjet').val();
    //Si le titre est vide
    if($title.replace(/\s/g, '') === ''){
        numOfError++;
        $('.mNameProjetProposerProjet').css("background-color", "#FFCBCB");
    }else{
        $('.mNameProjetProposerProjet').css("background-color", "#FFFFFF");
    }

    //projet pro ?
    $isPro=false;
    if($('.mCategorieProposerProjet').find(":selected").text().toLowerCase() === "pro"){
        $isPro=true;
    }

    //projet interne ?
    $isInternal=false;
    if($('.mAffiliationProposerProjet').find(":selected").text().toLowerCase() === "interne"){
        $isInternal=true;
    }

    //image (chargé au niveau du js image au début du fichier)
    //Si aucune image n'est choisie
    if($imageBase64===""){
        numOfError++;
        $('#mMidDashboardInputFileProposerProjet').parent().find('label').css("background-color", "#FFCBCB");
    }else{
        $('.mMidDashboardInputFileProposerProjet').parent().find('label').css("background-color", "#FFFFFF");
    }

    //description
    $description = $('.mDescriptionProposerProjet').val();
    //Si le titre est vide
    if($description.replace(/\s/g, '') === ''){
        numOfError++;
        $('.mDescriptionProposerProjet').css("background-color", "#FFCBCB");
    }else{
        $('.mDescriptionProposerProjet').css("background-color", "#FFFFFF");
    }

    //image
    //préparation à l'upload
    var imageDatas = new Array();
    imageDatas.push(['image', $imageBase64]);
    //récupération du nom pour la base de donnée.
    $imageName = makeid()+$('#mMidDashboardInputFileProposerProjet')[0].files[0]['name'];
    console.log($imageName);
    imageDatas.push(['imageName', $imageName]);

    if(numOfError===0){
        //Upload de l'image
        $.ajax({
            type : "POST",
            url: "../php/proposerProjectFileUpload.php",
            data: {imageDatas:imageDatas},
            beforeSend: function(xhr){
                $('.mButtonProposerProjet').css("background-color", "grey");
                $('.mButtonProposerProjet').val('Upload..');
                $('.mButtonProposerProjet').prop('disabled', true);
            },
            error: function(data){
                console.log(data.status);
                if(data.status === '200'){

                }else{
                }

            }
        });


        //Appel de la méthode du ProjectController pour entrer en base de données le projet
        window.location.href = Routing.generate('projet_ydays_manager_push_project_in_db', {
            'title': $title,
            'isPro': $isPro,
            'isInternal': $isInternal,
            'imageName': $imageName,
            'description': $description
        });
    }

    $( document ).ajaxComplete(function() {
        console.log( "Triggered ajaxComplete handler." );
        $('.mButtonProposerProjet').val('Projet proposé.');
    });

});

function makeid() {
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    for (var i = 0; i < 10; i++)
        text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
}