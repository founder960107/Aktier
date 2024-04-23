jQuery(document).ready(function ($) {
    console.log('test');
   
    // $('#news').hide();
    $('#card_category').change(function () {
        var category = $(this).val();

        // Hide all fields initially
        $('.card-fields').hide();

        // Show fields based on selected category
        $('.' + category + '-fields').show();
    });

    // Trigger change event on page load to show/hide fields based on initial value
    $('#card_category').change();


    // Add event listener for when a file is selected
    $('#article_image').change(function (event) {
        // Get the selected file
        const file = event.target.files[0];

        // Create a FileReader object
        const reader = new FileReader();

        // Set up FileReader onload callback
        reader.onload = function (e) {
            // Get the URL of the selected image
            const imageUrl = e.target.result;

            // Display the image preview
            $('#image-preview').attr('src', imageUrl).show();

        };

        // Read the selected file as a data URL
        reader.readAsDataURL(file);
    });

    // $('#news').hide();
    $('#article_categorychecklist input[type="checkbox"]').map((i ,checkbox) => {
        if($(checkbox).is(':checked')) {
           console.log($(checkbox).val());
           var categoryName = $(checkbox).closest('label').text().trim();
           var categoryId = $(checkbox).val();
           fetchCategoryId(categoryName, categoryId, true);
        } else {
            var categoryName = $(checkbox).closest('label').text().trim();
            var categoryId = $(checkbox).val();
            fetchCategoryId(categoryName, categoryId , false);
        }
    })

    if (!$('#article_categorychecklist input[type="checkbox"]').is(':checked')) {
        var checkbox = $('#article_categorychecklist input[type="checkbox"]').first();
        $(checkbox).prop('checked', true).change();
        var categoryName = $(checkbox).closest('label').text().trim();
        var categoryId = $(checkbox).val();
        fetchCategoryId(categoryName, categoryId, true);
    }

    $('#article_categorychecklist input[type="checkbox"]').change(function() {
        if($(this).is(':checked')) {
            var categoryName = $(this).closest('label').text().trim();
            var categoryId = $(this).val();
            fetchCategoryId(categoryName, categoryId, true);
        }
        else {
            var categoryName = $(this).closest('label').text().trim();
            var categoryId = $(this).val();
            fetchCategoryId(categoryName, categoryId , false);
        }
    });

    function fetchCategoryId(categoryName, categoryId, checked) {
        $.ajax({
            url: 'http://localhost/wordpress/wp-json/wp/v2/article_category?slug=' + encodeURIComponent(categoryName),
            type: 'GET',
            success: function(response) {
                if (response.length > 0) {
                    console.log(categoryId, response[0].id);
                    if(categoryId.toString() === response[0].id.toString()) {
                        if(checked) {
                            $('#'+ response[0].slug).removeClass('display-none');
                            $('#'+ response[0].slug).addClass('display-block');
                        }
                        else {
                            $('#'+ response[0].slug).removeClass('display-block');
                            $('#'+ response[0].slug).addClass('display-none');
                        }
                    }
                } else {
                    console.log('Category not found');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching category:', error);
            }
        });
    }

});
