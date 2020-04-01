// Validate form.
$("#addUser").validate
(
  // Create and pass this object as a parameter.
  {
    // Create a method for this object named "errorPlacement".
    errorPlacement: function(error, element)
    {
      error.appendTo(element.parent());
    },

    // Create a method for this object named "success".
    success: function(label)
    {
      // Remove the "error-parent" class.
      label.parent().removeClass("error-parent");
    },

    // Create a method for this object named "highlight".
    highlight: function(element, errorClass)
    {
      // Add a new "error-parent" class for the element that was passed as a parameter.
      $(element).parent().addClass("error-parent");
    },

    // Create a property for this object named "rules".
    rules:
    {
      username:
      {
        required: true,
        minlength: 5,
        maxlength: 25
      },

      password:
      {
        required: true,
        minlength: 5,
        maxlength: 25
      }
    },

    // Create a property for this object named "messages".
    messages:
    {
      username:
      {
        required: "<br>You must enter a username!",
        minlength: "<br>Username must be at least 5 characters!",
        maxlength: "<br>Username can not be greater than 25 characters!"
      },

      password:
      {
        required: "<br>You must enter a password!",
        minlength: "<br>Password must be at least 5 characters!",
        maxlength: "<br>Password can not be greater than 25 characters!"
      }
    }
  }
);
