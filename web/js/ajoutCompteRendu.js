/*$imageBase64="";
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
};*/
//clique bouton proposer compte rendu
$('#inputValidAjoutCompteRendu').click(function(){
    var numOfError = 0;

    //recup id projet
    var projectId = $('#projectIdAjoutCompteRendu').text();
    projectId = parseInt(projectId);
    //compte rendu global
    var globalReport = $('#textareaCompteRenduAjoutCompteRendu').val();
    //Si la textarea compte rendu est vide
    if(globalReport.replace(/\s/g, '') === ''){
        numOfError++;
        $('#textareaCompteRenduAjoutCompteRendu').css("background-color", "#FFCBCB");
    }else{
        $('#textareaCompteRenduAjoutCompteRendu').css("background-color", "#FFFFFF");
    }

    //compte rendu individuel
    var individualReport = $('#textareaCompteRenduIndividuelAjoutCompteRendu').val();
    //Si la textarea compte rendu individuel est vide
    if(individualReport.replace(/\s/g, '') === ''){
        numOfError++;
        $('#textareaCompteRenduIndividuelAjoutCompteRendu').css("background-color", "#FFCBCB");
    }else{
        $('#textareaCompteRenduIndividuelAjoutCompteRendu').css("background-color", "#FFFFFF");
    }

     //compte rendu objectifs scéance suivante
     var objectivesReport = $('#textareaObjectifsAjoutCompteRendu').val();
     //Si la textarea objectif compte rendu est vide
     if(objectivesReport.replace(/\s/g, '') === ''){
         numOfError++;
         $('#textareaObjectifsAjoutCompteRendu').css("background-color", "#FFCBCB");
     }else{
         $('#textareaObjectifsAjoutCompteRendu').css("background-color", "#FFFFFF");
     }

    //compte rendu besoins scéance suivante
    var needsReport = $('#textareaBesoinsAjoutCompteRendu').val();
    //Si la textarea besoin compte rendu est vide
    if(needsReport.replace(/\s/g, '') === ''){
        numOfError++;
        $('#textareaBesoinsAjoutCompteRendu').css("background-color", "#FFCBCB");
    }else{
        $('#textareaBesoinsAjoutCompteRendu').css("background-color", "#FFFFFF");
    }

    //compte rendu annexe scéance 
    var annexReport = $('#textareaAnnexesAjoutCompteRendu').val();
    //Si la textarea annexe compte rendu est vide
    if(annexReport.replace(/\s/g, '') === ''){
        numOfError++;
        $('#textareaAnnexesAjoutCompteRendu').css("background-color", "#FFCBCB");
    }else{
        $('#textareaAnnexesAjoutCompteRendu').css("background-color", "#FFFFFF");
    }

    console.log(projectId);
    if(numOfError===0){

        //Appel de la méthode du ReportController pour entrer en base de données le compte rendu
        window.location.href = Routing.generate('projet_ydays_manager_push_report_in_db', {
            'globalReport': globalReport,
            'individualReport': individualReport,
            'objectivesReport': objectivesReport,
            'needsReport': needsReport,
            'annexReport': annexReport,
            'projectId' : projectId
        });
    }

    $( document ).ajaxComplete(function() {
        console.log( "Triggered ajaxComplete handler." );
        $('#inputValidAjoutCompteRendu').val('Compte rendu créé.');
    });

});
