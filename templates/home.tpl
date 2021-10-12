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
          <a class="nav-link active" aria-current="page" href="allCars">All Cars</a>
        </li>  
      </ul>
    </div>
    <div class="d-flex">
      <a href="logout"><button class="btn btn-danger" type="submit">Sign off</button></a>
    </div>
  </div>
</nav>

<div class="container">   
    <div class="forms">
        <div class="form-car">
            <form action="createCar" method="post">    
                <div class="mb-3">        
                    <label for="enter-car" class="form-label" >Enter Car</label>
                    <input type="text" name="car" class="form-control" id="enter-car">    
                </div>
                <select name="brand" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                    {foreach from=$allBrands item=$brand}
                    <option value="{$brand->id_brand}">{$brand->brand}</option> 
                    {/foreach}
                </select>
                <div class="mb-3">
                    <label for="enter-year" class="form-label" >Year</label>
                    <input type="number" name="year" class="form-control" id="enter-year"> 
                </div>
                <div class="form-floating">
                    <textarea name="description" class="form-control" placeholder="Leave a description here" id="floatingTextarea"></textarea>
                    <label for="floatingTextarea">Description</label>
                </div>
                <div class="mb-3 form-check">   
                    <input type="checkbox" name="sold" class="form-check-input" id="check-car">  
                    <label class="form-check-label" for="check-car">On sale - Sold</label>
                </div>      
                <div class="mb-3">
                    <label for="enter-price" class="form-label" >Euro Price</label>
                    <input type="number" name="euro"class="form-control" id="enter-price"> 
                </div>  
                <button type="submit" class="btn btn-primary">Register</button>      
            </form>
        </div>
        
        <div class="form-brand">
            <form action="createBrand" method="post"> 
                <div class="mb-3">
                    <label for="enter-brand" class="form-label">Enter Brand</label>
                    <input type="text" name="brand"  class="form-control" id="enter-brand">        
                </div> 
                <div class="form-floating">
                    <textarea name="descriptionBrand" class="form-control" placeholder="Leave a description here" id="floatingTextarea"></textarea>
                    <label for="floatingTextarea">Description New Brand</label>
                </div> 
                <br> 
                <button type="submit" class="btn btn-primary">Register New Brand</button>   
            </form>   
            <br>
            <form action="modifiedName" method="POST">  
                <div class="mb-3">
                    <label for="enter-brand" class="form-label">New Brand</label>
                    <input type="text" name="newName"  class="form-control" id="enter-brand">        
                </div>           
                <div class="mb-3">
                    <label for="enter-brand" class="form-label">Modified Brand</label>
                    <input type="text" name="nameModified"  class="form-control" id="enter-brand">        
                </div>  
                <button type="submit" class="btn btn-primary">Save Modified</button>
            </form>    
        </div>
    </div> 
    
    <div class="card-brands">
        {foreach from=$allBrands item=$brand}                             
                <div class="card" style="width: 18rem;">   
                <img src="images/brands/mazda.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{$brand->brand}</h5>
                    <p class="card-text">{$brand->description}</p>                            
                    <a href="brand/{$brand->brand}" class="btn btn-primary">Go Cars</a>
                    <a href="deleteBrand/{$brand->brand}" class="btn btn-danger">Delete</a>
                </div>
            </div>
        {/foreach}
    </div> 
</div>

{include file="templates/footer.tpl"}