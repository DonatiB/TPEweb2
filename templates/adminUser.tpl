{include file="header.tpl"}

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


<h1>Users</h1>
<table class="table table-striped table-dark">
    <thead>
        <tr>
            <th scope="col">EMAIL</th>
            <th scope="col">ADMIN</th>
            <th scope="col">DELETE</th>
            <th scope="col">UPDATE</th>
        </tr>
    </thead>
    {foreach from=$users item=$user}

        {$isAdmin = $user->admin}
        <tbody>
            <tr>
                <th scope="row">{$user->email}</th>
                <td>
                    {if $isAdmin}
                        Administrador
                    {else}
                        Usuario
                    {/if}
                </td>
                
                <td><a href="{BASE_URL}deleteUser/{$user->id_user}"><button> delete </button></a></td>
                <td><a href="{BASE_URL}updateUser/{$user->id_user}"><button> update </button></a></td>
                
            </tr>
        </tbody>
    {/foreach}
</table>

{include file="footer.tpl"}