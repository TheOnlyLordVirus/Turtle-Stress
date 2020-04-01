  $.validator.addMethod
  (
    'IP4Checker',

    function(value)
    {
      var ip = "^([01]?\\d\\d?|2[0-4]\\d|25[0-5])\\." + "([01]?\\d\\d?|2[0-4]\\d|25[0-5])\\." + "([01]?\\d\\d?|2[0-4]\\d|25[0-5])\\." + "([01]?\\d\\d?|2[0-4]\\d|25[0-5])$";
      return value.match(ip);
    },

    'Invalid IP address'
  );

  $.validator.addMethod
  (
    'IsNumber',

    function(value)
    {
      return !isNaN(value);
    },

    'This is not a number'
  );

  $.validator.addMethod
  (
    'Durration',

    function(value)
    {
      if(!isNaN(value))
      {
        if (parseInt(value) >= 30 && parseInt(value) <= 1800)
        {
          return true;
        }
      }

      return false;
    },

    'Durration is not in range'
  );

  // Validate form.
	$("#mainForm").validate
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
				ip:
				{
					required: true,
          IP4Checker: true
				},

        port:
        {
          required: true,
          IsNumber: true
        },

				dur:
				{
					required: true,
          IsNumber: true,
          Durration: true
				},
			},

			// Create a property for this object named "messages".
			messages:
			{
				ip:
				{
					required: "<br>Please enter a IP Address!",
					IP4Checker: "<br>You must add a valid IP!"
				},

        port:
        {
          required: "<br>You must enter a port!",
          IsNumber: "<br>You must enter a valid port number!"
        },

				dur:
				{
					required: "<br>You must enter an attack time!",
          IsNumber: "<br>Attack time must be a valid number!",
          Durration: "<br>Attack time must be within 30 and 1800 seconds!"
				}
			}
		}
	);
