const ingredientsDiv = document.getElementById("ingredients")
let autoincrement = ingredientsDiv.children.length

function addIngredient() {
  const ingredientsDiv = document.getElementById("ingredients")
  const key = ++autoincrement
  const ingredientDiv = document.createElement("div")
  ingredientDiv.className = "ingredient"
  ingredientDiv.innerHTML = `
  <h3>Ingredient</h3>
  <label
    >Id:
    <input type="number" step="1" name="ingredient[${key}][id]" value="" />
  </label>
  <label
    >Name:
    <input type="text" name="ingredient[${key}][name]" value="" />
  </label>
  <label
    >Quantity:
    <input
      type="number"
      min="0"
      step="0.01"
      name="ingredient[${key}][quantity]"
      value=""
      required
    />
  </label>
  <label
    >Unit:
    <select name="ingredient[${key}][unit]" required>
      <option value="l">liter</option>
      <option value="g">gram</option>
      <option value="pc">piece</option>
    </select>
  </label>
  <label
    >Necessary:
    <input
      type="checkbox"
      name="ingredient[${key}][necessary]"
      value="1"
    />
  </label>
  <label
    >Comment:
    <input type="text" name="ingredient[${key}][comment]" value=""
  /></label>
  <button type="button" class="remove" onclick="removeIngredient(this)">
    Remove
  </button>
      `
  ingredientsDiv.appendChild(ingredientDiv)
}

function removeIngredient(button) {
  button.parentElement.remove()
}
