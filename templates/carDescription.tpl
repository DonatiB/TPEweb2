{include file="templates/header.tpl"}

{*Navs diferentes para los templates*}
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="login">Login</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      
        {if $admin == 3}
          <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="visitHome">Home</a>
          </li>  
        {else if $admin == 0 || $admin == 1}
          <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="{BASE_URL}">Home</a>
          </li>
        {/if} 
       {if $admin == 3}
          <li class="nav-item">
            {foreach from=$carDescription item=$car}
                <a class="nav-link active" aria-current="page" href="visitCars/{$car->brand}">{$car->brand}</a>
            {/foreach}
          </li> 
        {else if $admin == 0 || $admin == 1}
          <li class="nav-item">
            {foreach from=$carDescription item=$car}
                <a class="nav-link active" aria-current="page" href="{BASE_URL_BRAND}/{$car->brand}">{$car->brand}</a>
            {/foreach}
          </li>
        {/if} 
        <li class="nav-item"> 
            {foreach from=$carDescription item=$car}
             <a class="nav-link disabled"  tabindex="-1" aria-disabled="true">{$car->car}</a>
            {/foreach}
        </li>
      </ul>
    </div>
  </div>
</nav>

{*Traigo con un iner datos de las tablas marca y auto*}
{foreach from=$carDescription item=$car}
  <div class="container">
    <div class="card bg-dark text-white" style="max-width: 45rem; margin:auto;">
      {*Traigo las imagenes de los autos, si el nombre del auto es igual al nombre del auto por imagen*}
      {foreach from=$carsImg item=$img}
        {if $car->car == $img->carImg}
          <img src="images/cars/{$img->name}" class="card-img-top" alt="{$car->car}">
        {/if} 
      {/foreach}
      <div class="card-img-overlay">
          <h4 class="card-title">{$car->car}</h4>
          <h5 class="card-title">{$car->brand}</h5>
          <p class="card-text">{$car->year}</p>
          <p class="card-text">{$car->description}</p>
          <p class="card-text">${$car->price}</p>
          {if !$car->sold}
            On sale
          {else}
            Sold
          {/if}
      </div>  
    </div>  
  </div>
 
 
  <div id="list" id-car="{$car->id}" id-user="{$id_user}" admin="{$admin}">
      <div class="mb-3">
          <div class="col-8">
              <ul class="list-comments list-group list-group-flush" id="area">
              
              </ul>
              
              <form  class="form-comment" method="post"> 
              
                {if $admin == 1 || $admin == 0}
                  <label for="comment" class="form-label">Dejanos tu opinion acerca de esta bestia</label>
                  <textarea class="form-control" id="comment" placeholder="Ingrese su comentario" rows="3"></textarea>
                  <label for="score">Score (between 1 and 5):</label>
                  <input id="score" type="number" id="quantity" name="quantity" min="1" max="5">
                  <button type="submit">Comentar</button>
                {/if}
              </form>
                 
          </div>
      </div>
  </div>
  
    
  <script src="./js/app.js"></script>
{/foreach}

{include file="templates/footer.tpl"}

