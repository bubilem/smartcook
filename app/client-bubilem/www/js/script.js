function load(url, element) {
  fetch(url)
    .then((response) => response.text())
    .then((data) => {
      element.innerHTML = data
    })
}
load(GET_URL + "recipes.php", document.getElementById("recipes"))

let main_filter_buttons = document.querySelectorAll(".filter-main button")
let filter_navs = document.querySelectorAll(".filter nav")
let filter_buttons = document.querySelectorAll(".filter nav button")

main_filter_buttons.forEach((button) => {
  button.onclick = () => {
    if (button.classList.contains("active")) return
    main_filter_buttons.forEach((button) => {
      button.classList.remove("active")
    })
    button.classList.add("active")
    if (button.getAttribute("data-filter")) {
      filter_navs.forEach((nav) => {
        if (nav.getAttribute("id") == button.getAttribute("data-filter")) {
          nav.style.display = "grid"
        } else {
          nav.style.display = "none"
        }
      })
    } else {
      filter_navs.forEach((nav) => {
        nav.style.display = "none"
      })
      filter_buttons.forEach((button) => {
        button.classList.remove("active")
      })
      load(GET_URL + "recipes.php", document.getElementById("recipes"))
    }
  }
})

filter_buttons.forEach((button) => {
  button.onclick = () => {
    filter_buttons.forEach((button) => {
      button.classList.remove("active")
    })
    button.classList.add("active")
    //check if exist data attribute
    if (button.getAttribute("data-dish-category")) {
      $query =
        "recipes.php?dish-category=" + button.getAttribute("data-dish-category")
    } else if (button.getAttribute("data-recipe-category")) {
      $query =
        "recipes.php?recipe-category=" +
        button.getAttribute("data-recipe-category")
    } else if (button.getAttribute("data-tolerance")) {
      $query = "recipes.php?tolerance=" + button.getAttribute("data-tolerance")
    } else {
      $query = "recipes.php"
    }
    load(GET_URL + $query, document.getElementById("recipes"))
  }
})

function show_recipe(recipe_id) {
  load(
    GET_URL + "recipe.php?recipe_id=" + recipe_id,
    document.getElementById("recipe")
  )
  document.getElementById("recipe").style.display = "block"
}

function hide_recipe() {
  document.getElementById("recipe").style.display = "none"
}
