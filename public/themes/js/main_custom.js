	//TABLE CHECKBOX FEATURE
	$(document).ready(function () {
		$(".checkbox-table").each(function () {
			if($(this).prop("checked"))
			{
				$(this).parent().parent().addClass("active");
			}
		})
	});


$(".checkbox-table").change(function () {
	if($(this).prop("checked"))
	{
		$(this).parent().parent().addClass("active");
	}
	else
	{
		$(this).parent().parent().removeClass("active");
	}
});

// TAB FEATURE
$('ul.tabs').each(function(){
  // For each set of tabs, we want to keep track of
  // which tab is active and its associated content
  var $active, $content, $links = $(this).find('a');

  // If the location.hash matches one of the links, use that as the active tab.
  // If no match is found, use the first link as the initial active tab.
  $active = $($links.filter('[href="'+location.hash+'"]')[0] || $links[0]);
  $active.addClass('active');

  $content = $($active[0].hash);

  // Hide the remaining content
  $links.not($active).each(function () {
    $(this.hash).hide();
  });

  // Bind the click event handler
  $(this).on('click', 'a', function(e){
    // Make the old tab inactive.
    $active.removeClass('active');
    $content.hide();

    // Update the variables with the new link and content
    $active = $(this);
    $content = $(this.hash);

    // Make the tab active.
    $active.addClass('active');
    $content.show();

    // Prevent the anchor's default click action
    e.preventDefault();
  });
});

// ACCORDION FEATURE
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        if (panel.style.display === "block") {
            panel.style.display = "none";
			$(this).children().removeClass("icon-arrow-up");
			$(this).children().addClass("icon-arrow-down");
        } else {
            panel.style.display = "block";
			$(this).children().removeClass("icon-arrow-down");
			$(this).children().addClass("icon-arrow-up");
        }
    });
}

//THIRD SUBMENU CHILD
$('li.sub-submenu a').click(function () {
	  
	  $(".expanded").removeClass("expanded");
			$(".opened").removeClass("opened");
	  
		if($(this).children(".arrow-third-menu").hasClass("os-icon-chevron-down"))
		{
			$(this).siblings(".third-menu").addClass("expanded");
			$(this).parent(".sub-submenu").addClass("opened");
			$(this).children(".arrow-third-menu").removeClass("os-icon-chevron-down");
			$(this).children(".arrow-third-menu").addClass("os-icon-chevron-right");
		}
		else if($(this).children(".arrow-third-menu").hasClass("os-icon-chevron-right"))
		{
			$(this).siblings(".third-menu").removeClass("expanded");
			$(this).parent(".sub-submenu").removeClass("opened");
			$(this).children(".arrow-third-menu").removeClass("os-icon-chevron-right");
			$(this).children(".arrow-third-menu").addClass("os-icon-chevron-down");
		}

    
  });
  
//STAY MENU WHEN PAGE ACTICE
$(document).ready(function () {
	$(".sub-submenu.active .sub-menu-w.third-menu").addClass("expanded");
});
