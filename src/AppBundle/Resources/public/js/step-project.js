$(document).ready(function() {
    
    // On récupère la balise <div> en question qui contient l'attribut « data-prototype » qui nous intéresse.
    var $containerStep = $('div#appbundle_project_steps');

    // On ajoute un lien pour ajouter une nouvelle étape
    var $addLinkStep = $('<a href="#add_step" id="add_step" class="btnAction newStep">> Ajouter une étape</a>');
    $containerStep.append($addLinkStep);

    // On ajoute un nouveau champ à chaque clic sur le lien d'ajout.
    $addLinkStep.click(function(e) {
        addStep($containerStep);
        e.preventDefault(); // évite qu'un # apparaisse dans l'URL
        return false;
    });

    // On définit un compteur unique pour nommer les champs qu'on va ajouter dynamiquement
    var indexStep = $containerStep.find(':input').length;

    // Pour chaque catégorie déjà existante, on ajoute un lien de suppression
    $containerStep.children('div').each(function() {
        addDeleteLinkStep($(this));
    });

    // La fonction qui ajoute un formulaire Step
    function addStep($container) {
        // Dans le contenu de l'attribut « data-prototype », on remplace :
        // - le texte "__name__label__" qu'il contient par le label du champ
        // - le texte "__name__" qu'il contient par le numéro du champ
        var $prototype = $($containerStep.attr('data-prototype').replace(/__name__label__/g, 'Etape n°' + (indexStep+1))
        .replace(/__name__/g, indexStep));
        // On ajoute au prototype un lien pour pouvoir supprimer la catégorie
        addDeleteLinkStep($prototype);
        // On ajoute le prototype modifié à la fin de la balise <div>
        $containerStep.append($prototype);
        // Enfin, on incrémente le compteur pour que le prochain ajout se fasse avec un autre numéro
        indexStep++;
    }

    // La fonction qui ajoute un lien de suppression d'une étape
    function addDeleteLinkStep($prototype) {
        // Création du lien
        $deleteLinkStep = $('<a href="#" class="btnAction deleteStep">> Supprimer</a><div class="clear"></div>');
        // Ajout du lien
        $prototype.append($deleteLinkStep);
        // Ajout du listener sur le clic du lien
        $deleteLinkStep.click(function(e) {
            $prototype.remove();
            e.preventDefault(); // évite qu'un # apparaisse dans l'URL
            return false;
        });
    }

});
