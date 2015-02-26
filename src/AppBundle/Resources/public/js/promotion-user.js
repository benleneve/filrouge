$(document).ready(function() {
   
    var $container = $('div#appbundle_user_promotions');

    var $addLink = $('<a href="#add_promotion" id="add_promotion" class="btnAction newPromotion">> Ajouter une promotion</a>');
    $container.append($addLink);

    $addLink.click(function(e) {
        addPromotion($container);
        e.preventDefault(); 
        return false;
    });

    var index = $container.find(':input').length;

    if (index == 0) {
        addSchool($container);
    } else {
           $container.children('div').each(function() {
            addDeleteLink($(this));
        });
    }

    function addPromotion($container) {
        
        var $prototype = $($container.attr('data-prototype').replace(/__name__label__/g, 'Etape n°' + (index+1))
        .replace(/__name__/g, index));
      
        addDeleteLink($prototype);
       
        $container.append($prototype);
      
        index++;
    }

    function addDeleteLink($prototype) {
        
        $deleteLink = $('<a href="#" class="btnAction deletePromotion">> Supprimer</a><div class="clear"></div>');
   
        $prototype.append($deleteLink);
       
        $deleteLink.click(function(e) {
            $prototype.remove();
            e.preventDefault(); 
            return false;
        });
    }
});
