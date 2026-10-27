var $ = jQuery;

function setupProjectSlider() {
  var resetTimeout = null;
  var maxHeight = null;
  var active = true;

  var list = $(".project-list");
  var projects = list.find(".project");
  var button = $(".js-project-more").on("click", function() {
    active = !active;
    var other = button.data("other");
    button.data("other", button.text());
    button.text(other);
    updateProjectToggler();
  });

  function updateProjectToggler() {
    if (!maxHeight) {
      list.height("auto");
      button.hide();
    } else {
      button.show();
      if (active) {
        list.height(maxHeight);
      } else {
        list.height(list[0].scrollHeight);
      }
    }
  }
  function resetProjectHeight() {
    if (resetTimeout) return;
    resetTimeout = setTimeout(function() {
      resetTimeout = null;
      var first = projects.eq(0);
      var third = projects.eq(2);
      if (!third) {
        maxHeight = 0;
      } else {
        maxHeight = third.offset().top + third.height() - first.offset().top - 10;
      }
      updateProjectToggler();
    });
  }

  $(".project-media")
    .slick({dots: false, arrows: true})
    .on("setPosition", function() {
      resetProjectHeight();
    });
}

// Intersection is clipped by overflow:hidden ancestors, so iframes in inactive slick slides or in
// the collapsed part of .project-list don't count as visible.
function lazyLoadIframes() {
  var iframes = $("iframe[data-src]");
  function load(iframe) {
    iframe.src = iframe.getAttribute("data-src");
    iframe.removeAttribute("data-src");
  }
  if (!("IntersectionObserver" in window)) {
    iframes.each(function() { load(this); });
    return;
  }
  var observer = new IntersectionObserver(
    function(entries) {
      entries.forEach(function(entry) {
        if (!entry.isIntersecting) return;
        observer.unobserve(entry.target);
        load(entry.target);
      });
    },
    {rootMargin: "200px 0px"}
  );
  iframes.each(function() { observer.observe(this); });
}

$(function() {
  setupProjectSlider();
  // after slick has created its cloned slides, so the clones get observed too
  lazyLoadIframes();
  $('a[href*="#"]').on("click", function(e) {
    var href = $(this).attr("href");
    var $target = $("#" + href.split("#")[1]);
    if ($target.length) {
      $("html, body").animate({scrollTop: $target.offset().top - 50}, 500);
      e.preventDefault();
    }
  });

  var ua = window.navigator.userAgent;
  if (ua.indexOf("MSIE ") > 0 || !!ua.match(/Trident.*rv\:11\./)) $("body").addClass("is-ie");
});
