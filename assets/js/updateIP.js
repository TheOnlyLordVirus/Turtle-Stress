(
  function ()
  {
    function updateLoop()
    {
      $.post("../php/ipLogger.php",
        function (data)
        {
          $("#ipLog").html(data);
        }
      );

      setTimeout(updateLoop, 10000);
    }

    updateLoop();
  }
  ()
)
