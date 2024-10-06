const buttons = document.querySelectorAll("button[data-ingredient-id]")

const selected_ingredients = {}

buttons.forEach((button) => {
  button.onclick = () => {
    const ingredient_id = button.dataset.ingredientId
    const ingredient_name = button.dataset.ingredientName
    button.classList.toggle("active")
    if (button.classList.contains("active")) {
      selected_ingredients[ingredient_id] = ingredient_name
    } else {
      delete selected_ingredients[ingredient_id]
    }
    const selected_ingredients_list =
      Object.values(selected_ingredients).join(", ")
    document.getElementById("selected-ingredients").textContent =
      selected_ingredients_list

    document
      .getElementById("ingredients")
      .setAttribute("value", Object.keys(selected_ingredients).join(","))
    //console.log(`Vybrána ingredience s ID ${ingredient_id}`)
    //console.log(selected_ingredients)
  }
})
