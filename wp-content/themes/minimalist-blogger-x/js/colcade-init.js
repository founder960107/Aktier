"use strict";

(function () {
  if (
    document.getElementsByClassName("minimalist-blogger-x-colcade-column").length <=
      0 ||
    document.getElementsByClassName("all-blog-articles").length <= 0 ||
    document.getElementsByClassName("blogposts-list").length <= 0
  ) {
    return;
  }

  var minimalist_blogger_x_theme_colcade = new Colcade(
    ".add-blog-to-sidebar .all-blog-articles",
    {
      columns: ".minimalist-blogger-x-colcade-column",
      items: ".posts-entry.blogposts-list",
    }
  );
})();
