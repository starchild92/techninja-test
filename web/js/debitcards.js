var $collectionDC;
var $cantHijos;
// setup an "add a tag" link
var $addTagLinkDCs = $('<button style="margin-top: 10px;" class="btn btn-success btn-sm" type="button" href="#" class="add_tag_link"><span class="glyphicon glyphicon-credit-card" aria-hidden="true"></span> Add Debit Card</button>');
var $newLinkLiDCs = $('<div></div>').append($addTagLinkDCs);

jQuery(document).ready(function() {
    // Get the ul that holds the collection of tags
    $collectionDC = $('div.debitcards');

    //Para en el editar quitar un almacen
    $collectionDC.children().append(
        '<a href="#" class="remove-tag-debitcard btn btn-danger btn-sm"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Remove Debit Card</a>');

    $removerDC = $collectionDC.find('.remove-tag-debitcard');
    $cantHijos = $removerDC.length;

    //Para quitar el primer label 0 ese ladilloso y el label 1 cuando hay dos almacenes agregados
    $collectionDC.find('.control-label').first().remove();
    /*if ($cantHijos > 1) {
        $hijos = $collectionDC.find('.control-label');
        $hijos.get(2).remove();
    };*/

    $removerDC.click(function(e) {
        e.preventDefault();
        $(this).parent().remove();
        if($cantHijos > 0){ $cantHijos--; }

        return false;
    });
    // add the "add a tag" anchor and li to the tags ul
    $collectionDC.append($newLinkLiDCs);

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionDC.data('index', $collectionDC.find(':input').length);

    $addTagLinkDCs.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();
        // add a new tag form (see next code block)
        //Es la cantidad maxima de items que podrá agregar a la venta
        if($cantHijos < 100){ addTagFormDC($collectionDC, $newLinkLiDCs); $cantHijos++; }
    });
});
function addTagFormDC($collectionDC, $newLinkLiDCs) {

    // Get the data-prototype explained earlier
    var prototypet = $collectionDC.data('prototype');

    // get the new index
    var index = $collectionDC.data('index');

    // Replace '__name__' in the prototype's HTML to
    // instead be a number based on how many items we have
    var newFormt = prototypet.replace(/__name__/g, index);

    // increase the index with one for the next item
    $collectionDC.data('index', index + 1);

    // Display the form in the page in an li, before the "Add a tag" link li
    var $newFormLiDCs = $('<div></div>').append(newFormt);
    //Quita los #label_ de los nuevos almacenes
    $newFormLiDCs.find('.control-label').first().remove();
    //$newLinkLiDCs.before($newFormLiDCs);

    // also add a remove button, just for this example
    $newFormLiDCs.append('<a href="#" class="remove-tag-debitcard btn btn-danger btn-sm"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Remove Debit Card</a>');
    
    $newLinkLiDCs.before($newFormLiDCs);
    
    // handle the removal, just for this example
    $('.remove-tag-debitcard').click(function(e) {
        e.preventDefault();
        if($cantHijos > 0){ $cantHijos--; }
        $(this).parent().remove();
        return false;
    });
}