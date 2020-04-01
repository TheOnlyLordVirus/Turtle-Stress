$('#submitAttack').on
(
  'click',
  function(e)
  {
    e.preventDefault();

    countAttackTime($("#dur").val());

    $.ajax
    (
      {
        type: 'post',
        url: 'attack.php',
        data: $("#mainForm").serialize(),
        success: function(results)
        {
          alert("Attack Finished!");
        }
      }
    );
  }
);
