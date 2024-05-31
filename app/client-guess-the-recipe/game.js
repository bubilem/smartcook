let correctGuesses = 0
let totalGames = 0

function getRandomRecipes(num) {
  let shuffled = recipes.sort(() => 0.5 - Math.random())
  return shuffled.slice(0, num)
}

function loadNewGame() {
  const selectedRecipes = getRandomRecipes(4)
  const correctRecipe =
    selectedRecipes[Math.floor(Math.random() * selectedRecipes.length)]
  const recipe_image_href =
    "https://www.smartcook-project.eu/api/image/" + correctRecipe.id + ".webp"
  document.getElementById("recipeImage").src = recipe_image_href
  document.getElementById("bg").style.backgroundImage =
    'url("' + recipe_image_href + '")'

  const buttons = document.getElementsByClassName("option")

  for (let i = 0; i < buttons.length; i++) {
    buttons[i].textContent = selectedRecipes[i].name
    buttons[i].dataset.recipeId = selectedRecipes[i].id
  }

  document.getElementById("correctGuesses").textContent = correctGuesses
  document.getElementById("totalGames").textContent = totalGames

  return correctRecipe.id
}

let correctRecipeId = loadNewGame()

function makeGuess(guessedIndex) {
  totalGames++
  const guessedRecipeId =
    document.getElementsByClassName("option")[guessedIndex].dataset.recipeId
  if (parseInt(guessedRecipeId) === correctRecipeId) {
    correctGuesses++
  }
  correctRecipeId = loadNewGame()
}

document.addEventListener("DOMContentLoaded", (event) => {
  correctRecipeId = loadNewGame()
})
