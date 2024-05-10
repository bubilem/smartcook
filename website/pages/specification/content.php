<article>
  <h1>Development specification</h1>
  <p>We wrote a basic project development specification document.</p>
  <h2>File for download</h2>

  <h2>We must do (commitment; necessary technological minimum; part of the project documentation):</h2>
  <ul>
    <li>web presentation (static page, information about the project, articles, photos...) about the project (info page)
    </li>
    <li>modern web application "SmartCook"</li>
    <li>database, records:
      <ul>
        <li>raw materials (name, type, units, allergens, prices...)</li>
        <li>prices (guide price of the raw material for the given country, I would give the ISO code for the country id)
        </li>
        <li>recipes (name, description)</li>
        <li>recipe_has_raw material (in addition to FK, quantity and unit)</li>
        <li>about allergens</li>
        <li>about...</li>
      </ul>
    </li>
    <li>generate recipes according to preferences for a few days in advance, including a shopping list</li>
    <li>generation filter (selection preference):
      <ul>
        <li>about raw materials
          <ul>
            <li>(yes and no)</li>
            <li>expiration of food (days until consumption?)</li>
            <li>quantity (value + unit)</li>
          </ul>
        </li>
        <li>cost level (cheap, standard, luxury?)</li>
        <li>about diets (only deal with allergens yet?)</li>
        <li>by the number of servings</li>
      </ul>
    </li>
    <li>REST API (server side, JS, PHP, HTTPS, JSON...)</li>
    <li>GUI (web, HTML, CSS, JS…)</li>
  </ul>

  <h2>Czech do:</h2>
  <ul>
    <li>Web presentation (status, fulfillment of articles)</li>
    <li>Web application (development, implementation, testing)</li>
    <li>We take pictures and film the progress of the work</li>
    <li>Workshops</li>
  </ul>

  <h2>Poles do:</h2>
  <ul>
    <li>educational presentation of the gastronomy industry</li>
    <li>social networks</li>
    <li>recipes for the web application</li>
    <li>cooks/takes pictures of food</li>
  </ul>

  <h2>Comment:</h2>
  <ul>
    <li>Do the minimum necessary, then deal with system expansion!</li>
    <li>Administration with user accesses and management is not required.</li>
    <li>No user management required. Maybe then in version 2.0.</li>
    <li>The recipe will be unit (default is one "standard" portion) and thus scalable.</li>
    <li>How to effectively insert recipes without administration? Use REST and JSON?</li>
    <li>Static elements to JSON, dynamic elements to relational DB.</li>
  </ul>

  <h2>File for download</h2>
  <ul>
    <li><a href="pages/specification/SmartCook_devdoc_en.pdf">Project development specification document (PDF)</a></li>
  </ul>
</article>