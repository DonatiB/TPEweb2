{include file="templates/header.tpl"}

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="login">Login</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{BASE_URL}">Home</a>
        </li>
        <li class="nav-item">
            {foreach from=$carDescription item=$car}
                <a class="nav-link active" aria-current="page" href="{BASE_URL_BRAND}/{$car->brand}">{$car->brand}</a>
            {/foreach}
        </li>
        <li class="nav-item"> 
            {foreach from=$carDescription item=$car}
             <a class="nav-link disabled"  tabindex="-1" aria-disabled="true">{$car->car}</a>
            {/foreach}
        </li>
      </ul>
    </div>
  </div>
</nav>

{foreach from=$carDescription item=$car}
  <div class="container">
    <div class="card bg-dark text-white" style="max-width: 45rem; margin:auto;">
      <img src="images/cars/supramk4.jpg" class="card-img" alt="Honda S2000">
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
{/foreach}

{include file="templates/footer.tpl"}

