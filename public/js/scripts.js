function onClickBtnLike(event) {
  event.preventDefault();

  const url = this.href;
  const spanCount = this.querySelector("span.js-like");
  const icone = this.querySelector("i");

  axios
    .get(url)
    .then(function (response) {
      const likes = response.data;
      console.log(likes);
      spanCount.textContent = likes;

      if (icone.classList.contains("fas"))
        icone.classList.replace("fas", "far");
      else icone.classList.replace("far", "fas");
    })
    .catch(function (error) {
      if (error.response.status == 403) {
        window.alert("vous netes pas connecte");
      }
    });
}
document.querySelectorAll("a.js-likes").forEach(function (link) {
  link.addEventListener("click", onClickBtnLike);
});

// like function
document.querySelectorAll('a.js-likes').forEach(function (link) {
link.addEventListener('click', onClickBtnLike);
})
