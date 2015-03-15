$(document).ready(function() {
    
    // On récupère la balise <div> en question qui contient l'attribut « data-prototype » qui nous intéresse.
    var $containerPromotion = $('div#appbundle_user_promotions');

    // On ajoute un lien pour ajouter une nouvelle promotion
    var $addLinkPromotion = $('<a href="#add_userPromotions" id="add_userPromotions" class="btnAction newPromotion">ajouter une promotion</a>');
    $containerPromotion.append($addLinkPromotion);

    // On ajoute un nouveau champ à chaque clic sur le lien d'ajout.
    $addLinkPromotion.click(function(e) {
        addPromotion($containerPromotion);
        e.preventDefault(); // évite qu'un # apparaisse dans l'URL
        return false;
    });

    // On définit un compteur unique pour nommer les champs qu'on va ajouter dynamiquement
    var indexPromotion = $containerPromotion.find(':input').length;


    // Pour chaque catégorie déjà existante, on ajoute un lien de suppression
    $containerPromotion.children('div').each(function() {
        addDeleteLinkPromotion($(this));
    });


    // La fonction qui ajoute un formulaire promotion
    function addPromotion($containerPromotion) {
        // Dans le contenu de l'attribut « data-prototype », on remplace :
        // - le texte "__name__label__" qu'il contient par le label du champ
        // - le texte "__name__" qu'il contient par le numéro du champ
        var $prototype = $($containerPromotion.attr('data-prototype').replace(/__name__label__/g, 'Etape n°' + (indexPromotion+1))
        .replace(/__name__/g, indexPromotion));
        // On ajoute au prototype un lien pour pouvoir supprimer la promotion
        addDeleteLinkPromotion($prototype);
        // On ajoute le prototype modifié à la fin de la balise <div>
        $containerPromotion.append($prototype);
        // Enfin, on incrémente le compteur pour que le prochain ajout se fasse avec un autre numéro
        indexPromotion++;
    }

    // La fonction qui ajoute un lien de suppression d'une promotion
    function addDeleteLinkPromotion($prototype) {
        // Création du lien
        $deleteLinkPromotion = $('<a href="#" class="btnAction deletePromotion">supprimer</a><div class="clear"></div>');
        // Ajout du lien
        $prototype.append($deleteLinkPromotion);
        // Ajout du listener sur le clic du lien
        $deleteLinkPromotion.click(function(e) {
            $prototype.remove();
            e.preventDefault(); // évite qu'un # apparaisse dans l'URL
            return false;
        });
    }
});
