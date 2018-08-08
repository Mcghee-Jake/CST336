$("#search-btn").click(function(e) {

    e.preventDefault(); // avoid to execute the actual submit of the form.
    
    $.ajax({
           type: "POST",
           url: "inc/process-search.php",
           data: $("#filter-form, #search-form").serialize(), // serializes the form's elements.
           success: function(data)
           {
               window.location.replace("search.php"); // navigate to the search page
           }
         });
});

