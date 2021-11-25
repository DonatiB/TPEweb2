{include file="templates/header.tpl"}

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      {if $admin == 3}
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="visitHome">Home</a>
        </li>  
      {else $admin == 0 || $admin == 1}
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{BASE_URL}">Home</a>
        </li>
      {/if}   
      </ul>
    </div>
  </div>
</nav>

<div class="card-brands">
    {foreach from=$allCars item=$car}                             
      <div class="card" style="width: 15rem;"> 
        {if $car->car == $car->carImg}
          <img src="images/cars/{$car->name}" class="card-img-top" alt="{$car->car}">
        {/if} 
        <div class="card-body">
            <h5 class="card-title">{$car->car}</h5>
            <p class="card-text">{$car->description|truncate:50}</p>
            <p class="card-text"><small class="text-muted">Year: {$car->year}</small></p>
        </div>
      </div>
    {/foreach}
</div> 

{include file="templates/footer.tpl"}