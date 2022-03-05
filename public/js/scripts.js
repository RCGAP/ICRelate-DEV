function onClickBtnLike(event) {
  event.preventDefault();

  const url = this.href;
  const btn = this.querySelector("button.js-like");
  axios
    .get(url)
    .then(function (response) {
      if (btn.classList.contains("button--green--validate"))
        btn.classList.replace("button--green--validate", "button--green");
      else btn.classList.replace("button--green", "button--green--validate");
    })
    .catch(function (error) {
      if (error.response.status == 403) {
      }
    });
}
document.querySelectorAll("a.js-likes").forEach(function (link) {
  link.addEventListener("click", onClickBtnLike);
});