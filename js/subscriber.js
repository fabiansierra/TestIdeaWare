$(function() {
  $save            = $("#save");
  $nameSubscriber  = $("#name_subscriber");
  $emailSubscriber = $("#email_subscriber");
  $trackSubscriber = $("#track_subscriber");
  $checkTerms      = $("#check_terms");
  $check           = 0;

  $save.on("click", function(e){
    e.preventDefault();

    //Get fields empty
    var value = $('.form-control').filter(function () {
      return this.value != '';
    });

    //Validate all fields are not empty
    if(value.length <= 0){
      alert("You must complete all fields!");
      return false;
    }

    //Validate terms and conditions check
    if($checkTerms.is(":checked")){
      $check = 1;
    }else{
      $check = 0;
    }

    $.ajax({
      url: 'controllers/subscribers.php',
      method: 'POST',
      data: {
        'name'  : $nameSubscriber.val(),
        'email' : $emailSubscriber.val(),
        'track' : $trackSubscriber.val(),
        'check' : $check
      },
      error: function(error){
        console.log(error)
      },
      success: function(response){
        if(response === "200"){
          alert("Data saved successfully");
          $nameSubscriber.val("");
          $emailSubscriber.val("");
          $trackSubscriber.val("");
          $checkTerms.attr("checked", false);
        }
      }
    });
  })
});