<div class="container">
  <h3>Bootstrap 3 Popover HTML Example</h3>
  <ul class="list-unstyled">
    <li><a data-placement="bottom" data-toggle="popover" data-container="body" data-placement="left" type="button" data-html="true" href="#" id="login"><span class="glyphicon glyphicon-search" style="margin:3px 0 0 0"></span></a></li>
    <div id="popover-content" class="hide">
      <form class="form-inline" role="form">
        <div class="form-group"> 
          <input class="headerSearch search-query" id="str" name="str" type="text" placeholder="Search..." />
          <span class="glyphicon glyphicon-search" style="margin:3px 8px 0 -20px;"></span>
          <input class="btn btn-primary btn-xs" id="phSearchButton" type="submit" value="Search" /> 
          <input class="btn btn-primary btn-xs" id="searchButton" type="submit" value="Dictionary" />
        </div>
      </form>
    </div>
  </ul>
</div>
