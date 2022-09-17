<style type="text/css">
    .sidebar li .submenu{ 
        list-style: none; 
        margin: 0; 
        padding: 0; 
        padding-left: 1rem; 
        padding-right: 1rem;
    }
</style>

<div class="list-group list-group-flush">
    <nav class="sidebar">
    <ul class="nav flex-column" id="nav_accordion">
        <li class="nav-item">
            <a class="nav-link list-group-item list-group-item-action bg-light" href="/dashboard"> Dashboard </a>
        </li>
        <li class="nav-item has-submenu">
            <a class="nav-link list-group-item list-group-item-action bg-light" href="#"> Manage  </a>
            <ul class="submenu collapse bg-light">
                 <li><a class="nav-link list-group-item-action" href="/api-sources">Api Sources </a></li>
                <li><a class="nav-link list-group-item-action" href="/endpoints">Endpoints </a></li>
            </ul>
        </li>
        <li class="nav-item has-submenu">
            <a class="nav-link list-group-item list-group-item-action bg-light" href="#"> Reports  </a>
            <ul class="submenu collapse bg-light">
                <li>
                    <span class="nav-link"> JC API  </span>
                    <ul class="submenu collapse bg-light">
                         <li><a class="nav-link list-group-item-action" href="/api-sources">Reports Name </a></li>
                    </ul>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link list-group-item list-group-item-action bg-light" href="#"> Emails  </a>
            <ul class="submenu collapse bg-light">
                <li>
                    <span class="nav-link"> JC API  </span>
                    <ul class="submenu collapse bg-light">
                         <li><a class="nav-link list-group-item-action" href="/api-sources">Sample Emails </a></li>
                    </ul>
                </li>
            </ul>
        </li>
    </ul>
    </nav>
</div>

<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function(){
document.querySelectorAll('.sidebar .nav-link').forEach(function(element){
    
    element.addEventListener('click', function (e) {

      let nextEl = element.nextElementSibling;
      let parentEl  = element.parentElement;    

        if(nextEl) {
            e.preventDefault(); 
            let mycollapse = new bootstrap.Collapse(nextEl);
            
            if(nextEl.classList.contains('show')){
              mycollapse.hide();
            } else {
                mycollapse.show();
                // find other submenus with class=show
                var opened_submenu = parentEl.parentElement.querySelector('.submenu.show');
                // if it exists, then close all of them
                if(opened_submenu){
                  new bootstrap.Collapse(opened_submenu);
                }
            }
        }
    }); // addEventListener
  }) // forEach
}); 
</script>