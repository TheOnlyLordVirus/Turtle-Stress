function countAttackTime (duration)
{
  let i = duration;

  function loop ()
  {
    if(i >= 0)
    {
      $("#attackCount").text("Attack Time: " + i);
      i--;
      setTimeout(loop, 1000);
    }

    else
    {
      $("#attackCount").text("");
    }
  }

  loop();
}
