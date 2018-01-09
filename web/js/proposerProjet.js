
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
        $completeImagePath = oFREvent.target.result;
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

    //image
    console.log($completeImagePath);

    if(numOfError===0){
        window.location.href = Routing.generate('projet_ydays_manager_accueil');
    }

});