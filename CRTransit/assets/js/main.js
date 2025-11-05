
    document.addEventListener("DOMContentLoaded", () => {
      fetch("general.html")
        .then(res => res.text())
        .then(html => {
          document.getElementById("layout-container").innerHTML = html;
        });
    });
  