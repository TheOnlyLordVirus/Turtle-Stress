// Add the "createTabs" method to all jQuery objects that use the fn object template or "Blueprint".
$.fn.createTabs = function ()
{
  if(this.is("ul"))
  {
    this.addClass("myTabs");

    let $content = this.children().first()/*li*/.children()/*ul's*/;

    let contentArray = $content.toArray()/*ul array*/;

    let $tabs = $(contentArray[0]);

    let tabsArray = $tabs.children().toArray()/*li array*/;

    //~~~

    // Content for each tab.
    $content.each
    (
      function (i)
      {
        if(i)
        {
          $(this).addClass("content-" + i + " tabContent");
        }
      }
    )

    // Content 1 is enabled.
    $(contentArray[1]).addClass("enabled");

    //~~~

    // Each tab.
    $tabs.children().each
    (
      function (i)
      {
        $(this).addClass("tab-" + (i + 1) + " tab");
      }
    );

    // Tab 1 is selected.
    $(tabsArray[0]).addClass("selected");

    //~~~

    // Change tab.
    $(tabsArray).on
    ("click",
      function ()
      {
        if(!$(this).hasClass("selected"))
        {
          $tabs.children().each
          (
            function (i)
            {
              $(this).hasClass("selected") ? $(tabsArray[i]).removeClass("selected") : null;
            }
          );

          $content.each
          (
            function (i)
            {
              if(i)
              {
                $(this).hasClass("enabled") ? $(this).removeClass("enabled") : null;
              }
            }
          )

          let contentNum = $(this).attr("class").replace("tab-", "").replace(" tab", "");
          $(this).addClass("selected");
          $(contentArray[contentNum]).addClass("enabled");
        }
      }
    );

    //~~~
  }

  else
  {
    console.error("Tabs error: createTabs must be ran on a <ul>.");
  }
}

// Notice: first option will always be selected by default as is.
$(".myTabs").createTabs();
