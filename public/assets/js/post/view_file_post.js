// $(document).ready(function () {
//     $('#add_file_post').on('click', function () {
//         document.getElementById('file_post').style.display='block';
//     });
// });

var $collectionHolder1;

// setup an "add a tag" link
var $addTagButton1 = $('<button type="button" class="btn btn-outline-secondary mb-2 mr-2">Dodaj zdjęcie</button>');
var $newLinkLi1 = $('<li></li>').append($addTagButton1);

jQuery(document).ready(function() {

    // Get the ul that holds the collection of tags
    $collectionHolder1 = $('ul.file_post');

    // add the "add a tag" anchor and li to the tags ul
   $collectionHolder1.append($newLinkLi1);

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionHolder1.data('index', $collectionHolder1.find('input').length);
    var x = 1;
    $addTagButton1.on('click', function(e) {
        // add a new tag form (see next code block)
        addTagForm1($collectionHolder1, $newLinkLi1, x);

    });

    $($collectionHolder1).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault();
        $(this).parent().remove();
        x--;
    })

});


function addTagForm1($collectionHolder1, $newLinkLi1, x) {
    // Get the data-prototype explained earlier
    var prototype = $collectionHolder1.data('prototype');
    // get the new index
    var index = $collectionHolder1.data('index');

    var newForm1 = prototype;
    // You need this only if you didn't set 'label' => false in your tags field in TaskType
    // Replace '__name__label__' in the prototype's HTML to
    // instead be a number based on how many items we have
    // newForm = newForm.replace(/__name__label__/g, index);

    // Replace '__name__' in the prototype's HTML to
    // instead be a number based on how many items we have
    var newForm1 = newForm1.replace(/__name__/g, index);
    // newForm.setAttribute('class', 'float');
    // increase the index with one for the next item
    $collectionHolder1.data('index', index + 1);

    // Display the form in the page in an li, before the "Add a tag" link li
    var $newForm1Li = $('<div class="mb-2 "><button type="button" class="remove_field mb-2 font-13 text-white p-1 btn bg-danger">Usuń</button><b class="float-left mr-3 pt-1 font-weight-light">Zdjęcie</b></div>').append(newForm1);
    // $newForm1Li.append('<button type="button" class="remove_field font-13 text-white p-1 btn bg-danger">Usuń</button>');
    x++;
    $newLinkLi1.before($newForm1Li);
}