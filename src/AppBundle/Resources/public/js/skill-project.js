$(document).ready(function() {
    
    // On récupère la balise <div> en question qui contient l'attribut « data-prototype » qui nous intéresse.
    var $containerSkill = $('div#appbundle_project_projectSkills');

    // On ajoute un lien pour ajouter une nouvelle compétence
    var $addLinkSkill = $('<a href="#add_projectSkills" id="add_projectSkills" class="btnAction newSkill">> Ajouter une compétence</a>');
    $containerSkill.append($addLinkSkill);

    // On ajoute un nouveau champ à chaque clic sur le lien d'ajout.
    $addLinkSkill.click(function(e) {
        addSkill($containerSkill);
        e.preventDefault(); // évite qu'un # apparaisse dans l'URL
        return false;
    });

    // On définit un compteur unique pour nommer les champs qu'on va ajouter dynamiquement
    var indexSkill = $containerSkill.find(':input').length;


    // Pour chaque catégorie déjà existante, on ajoute un lien de suppression
    $containerSkill.children('div').each(function() {
        addDeleteLinkSkill($(this));
    });


    // La fonction qui ajoute un formulaire Skill
    function addSkill($containerSkill) {
        // Dans le contenu de l'attribut « data-prototype », on remplace :
        // - le texte "__name__label__" qu'il contient par le label du champ
        // - le texte "__name__" qu'il contient par le numéro du champ
        var $prototype = $($containerSkill.attr('data-prototype').replace(/__name__label__/g, 'Etape n°' + (indexSkill+1))
        .replace(/__name__/g, indexSkill));
        // On ajoute au prototype un lien pour pouvoir supprimer la catégorie
        addDeleteLinkSkill($prototype);
        // On ajoute le prototype modifié à la fin de la balise <div>
        $containerSkill.append($prototype);
        // Enfin, on incrémente le compteur pour que le prochain ajout se fasse avec un autre numéro
        indexSkill++;
    }

    // La fonction qui ajoute un lien de suppression d'une étape
    function addDeleteLinkSkill($prototype) {
        // Création du lien
        $deleteLinkSkill = $('<a href="#" class="btnAction deleteSkill">> Supprimer</a><div class="clear"></div>');
        // Ajout du lien
        $prototype.append($deleteLinkSkill);
        // Ajout du listener sur le clic du lien
        $deleteLinkSkill.click(function(e) {
            $prototype.remove();
            e.preventDefault(); // évite qu'un # apparaisse dans l'URL
            return false;
        });
    }
});
