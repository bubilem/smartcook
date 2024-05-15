const api_url = "https://www.smartcook-project.eu/client/app/"
function load(url, element) {
  fetch(url)
    .then((response) => response.text())
    .then((data) => {
      element.innerHTML = data
    })
}
load(api_url + "recipes.php", document.getElementById("recipes"))

let buttons = document.querySelectorAll("#recipe-category-btns button")
buttons.forEach((button) => {
  button.onclick = () => {
    buttons.forEach((button) => {
      button.classList.remove("active")
    })
    button.classList.add("active")
    let category = button.getAttribute("data-recipe-category")
    load(
      api_url + "recipes.php?recipe-category=" + category,
      document.getElementById("recipes")
    )
  }
})

function show_recipe(recipe_id) {
  load(
    api_url + "recipe.php?recipe_id=" + recipe_id,
    document.getElementById("recipe")
  )
  document.getElementById("recipe").style.display = "block"
}

function hide_recipe() {
  document.getElementById("recipe").style.display = "none"
}
