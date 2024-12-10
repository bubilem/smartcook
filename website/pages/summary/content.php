<article>
  <h1>Summary</h1>
  <h2>SmartCook server database application</h2>
  <p>
    At the beginning of our work, we faced the design of the architecture of our SmartCook database system. We decided
    on a modern solution that offers a very wide and universal use, and that is to create a system like a REST API.
    First, we designed and created a relational database for recording all recipes, ingredients and their
    categorization. We programmatically used the SQL query language to communicate with DBMS MySQL. Next, we created a
    PHP application that served as a REST API. The core of the application and endpoints for structure, authors,
    recipes, ingredients and more have been created. We used OOP and separated controllers and data (models). To make it
    possible for other programmers to use the API, we have created complete documentation for it in the Markdown
    language directly on the public github service github. We also defined an error reporting system, standardized
    responses in JSON format and ensured the possibility to sign individual queries to the API using keys. Even the API
    itself used a public key to sign its responses. Only a registered user had access to important API queries, and the
    communication itself was signed not only for the purpose of authorization, but also for the purpose of verifying the
    correctness (originality of the message) of the communication. It was now possible for our database to be managed
    very simply (saving recipes, obtaining recipes according to filters, deleting recipes and much more) using http
    queries and responses and with the support of documentation. The API could now be used by other developers and
    create other different applications with it.
  </p>
  <div class="gallery">
    <figure>
      <img src="pages/summary/browser_api.webp" alt="Web browser API demo">
      <figcaption>1. Web browser API demo</figcaption>
    </figure>
    <figure>
      <img src="pages/summary/api_documentation.webp" alt="API documentation - inserting a recipe">
      <figcaption>Figure 2. API documentation - inserting a recipe</figcaption>
    </figure>
    <figure>
      <img src="pages/summary/database.webp" alt="Schéma databáze SmartCook">
      <figcaption>Figure 3. Schéma databáze SmartCook</figcaption>
    </figure>
  </div>
  <h2>Web presentation</h2>
  <p>We also created a web presentation for this project, which has at least two main functions. The website introduces
    the results of the work and contains several interesting articles from our work and also contains all important
    links (the API itself, documentation, individual demo examples and others). It thus functions as the main signpost
    for the entire project and can be found at: <a
      src="https://www.smartcook-project.eu/">https://www.smartcook-project.eu/</a>.
  </p>
  <div class="gallery">
    <figure>
      <img src="pages/summary/web.webp" alt="Web presentation preview">
      <figcaption>Figure 4. Web presentation preview</figcaption>
    </figure>
  </div>
  <h2>Web applications</h2>
  <p>We wanted to somehow demonstrate our API itself and also manage the database of recipes and ingredients
    effectively. That's why we ended up creating five more different apps. All are optimized for display on larger
    displays and smaller mobile devices.
  </p>
  <h3>Form</h3>
  <p>Form is a web application for more efficient management of our recipe database. We have individual recipes and
    ingredients so they did not have to insert/edit/delete using http queries, but in the web browser in the form of a
    graphical user interface environment, created forms.
  </p>
  <div class="gallery">
    <figure>
      <img src="pages/summary/app_form.webp" alt="Form - an application for managing the recipe database">
      <figcaption>Figure 5. Form - an application for managing the recipe database</figcaption>
    </figure>
  </div>
  <h3>Catalog</h3>
  <p>The catalog allows us to display an overview of recipes with filtering, as well as a detail of each recipe on which
    we see it detailed description including ingredients.
  </p>
  <div class="gallery">
    <figure>
      <img src="pages/summary/app_catalog.webp" alt="Recipe catalog">
      <figcaption>Figure 6. Recipe catalog</figcaption>
    </figure>
  </div>
  <h3>Today’s table</h3>
  <p>This is an app to inspire people on what to cook today. Thus, he compiles a random menu (breakfast, soup, main
    course, dessert and dinner) for one day.
  </p>
  <div class="gallery">
    <figure>
      <img src="pages/summary/app_todays_table.webp" alt="Application for randomly generating a daily menu">
      <figcaption>Figure 7. Application for randomly generating a daily menu</figcaption>
    </figure>
  </div>
  <h3>Guess the Recipe</h3>
  <p>This application is intended purely for simple entertainment. Recipes are generated here and the player guesses
    which recipe it is. In addition to entertainment, it can again serve as inspiration, for example, what sweet can we
    create today.
  </p>
  <div class="gallery">
    <figure>
      <img src="pages/summary/app_game.webp" alt="Recipe guess preview">
      <figcaption>Figure 8. Recipe guess preview</figcaption>
    </figure>
  </div>
  <h3>Recipe by ingredients</h3>
  <p>This application will show us an overview of the ingredients in its opening menu. The user can simply and quickly
    choose which ingredients are available at home, or what they feel like, and then use the "Find recipes" button to
    search for recipes containing these ingredients.
  </p>
  <div class="gallery">
    <figure>
      <img src="pages/summary/app_recipe_by_ingredients.webp" alt="Searching for recipes by ingredients">
      <figcaption>Figure 9. Searching for recipes by ingredients</figcaption>
    </figure>
  </div>
  <h3>Another application</h3>
  <p>Since the system is built using a REST API, it is possible to create more and more applications. For example, an
    application simulating a refrigerator with recipe recommendations based on the current contents of the refrigerator,
    or an application for weekly meal planning, etc.
  </p>
  <h2>More work</h2>
  <p>During the actual creation of the software, we encountered other activities than just programming or database
    design. For example, cooking with Polish friends, designing and creating the logo of the project itself, as well as
    generating recipe images using artificial intelligence were very interesting for us.
  </p>
  <div class="gallery">
    <figure>
      <img src="pages/summary/cooking.webp" alt="Cooking together">
      <figcaption>Figure 10. Cooking together</figcaption>
    </figure>
    <figure>
      <img src="pages/summary/logo.webp" alt="Color variants of the logo">
      <figcaption>Figure 11. Color variants of the logo</figcaption>
    </figure>
    <figure>
      <img src="pages/summary/ai_soup.webp" alt="AI generated image of soup">
      <figcaption>Figure 12. AI generated image of soup</figcaption>
    </figure>
  </div>
</article>