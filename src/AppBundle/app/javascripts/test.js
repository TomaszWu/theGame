$("#test").on('click', function() {
   $.ajax({
      method: 'POST',
      type: 'JSON',
     data: { test: 'test' }
   }).success(function(response) {
     alert(response);
  });
});