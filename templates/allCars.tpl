{include file="templates/header.tpl"}

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{BASE_URL}">Home</a>
        </li>    
      </ul>
    </div>
  </div>
</nav>

<div class="card-brands">
    {foreach from=$allCars item=$car}                             
      <div class="card" style="width: 15rem;">   
        <img src="images/cars/supramk4.jpg" class="card-img" alt="Honda S2000">
        <div class="card-body">
            <h5 class="card-title">{$car->car}</h5>
            <p class="card-text">{$car->description|truncate:50}</p>
            <p class="card-text"><small class="text-muted">Year: {$car->year}</small></p>
        </div>
      </div>
    {/foreach}
</div> 

{include file="templates/footer.tpl"}